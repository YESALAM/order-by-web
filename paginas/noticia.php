<?php
	//Inicia a sessão, para caso esteja logado
	session_start();
	//Destroi a sessão, caso esteja logado, para impedir erros de acesso
	session_destroy();
	
	$informacoes = false;
	include "info.php";
	include "conexao.php";
	
	//Faz a consulta no banco de dados em busca da notícia especificada pelo id, através do método get
	$res = mysqli_query($conexao,"select * from noticias,funcionarios where funcionarios.cpf_funcionarios=noticias.criador_noticia and id_noticia=".$_GET["noticia"]." limit 1;");
	//Se há resposta, pega as informações
	if($res)
		$noticia = mysqli_fetch_assoc($res);
	
	//Define o modo como aluno, para a navbar
	$modo = "aluno";
	//Define a página atual (index.php), portanto ""
	$atual="";
	
	//Verifica se o modo (professor | aluno) esta vazio
	if(isset($_GET["modo"]))
		//Se não estiver vazio, pega o valor pelo método GET
		$modo = $_GET["modo"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $info["nome_escola"]; ?> | <?php echo $noticia["titulo_noticia"]; ?></title>
<link href="../recursos/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../recursos/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"  />
<link href="../recursos/lightbox2-master/css/lightbox.css" rel="stylesheet" />
<link href="css/index.css" rel="stylesheet"  />
</head>

<body>
<?php include ("navbar.php"); ?>
<div class="page-row page-row-expanded">
    <div class="container">
    	<ol class="breadcrumb">
            <li><a href="index.php">Início</a></li>
            <li class="active">Notícias</li>
        </ol>
        <div class="row" style="margin-bottom:20px;">
            <div class="col-md-9 col-xs-12">
                <h2 style="margin:0;padding-bottom:5px;"><?php echo $noticia["titulo_noticia"]; ?></h2>
                <ul class="user-information-topics" style="text-align:left;border-bottom:1px dotted #ddd;border-top:1px dotted #ddd;padding:5px 0 5px 0;">
                    <li><i class="fa fa-calendar"></i> <?php echo $noticia["data_noticia"]; ?></li>
                    <li><i class="fa fa-user"></i> <?php echo $noticia["nome_funcionarios"]; ?></li>
                </ul>
                <div class="conteudo-noticia" style="margin-top:10px;border-bottom:1px dotted #ddd;">
                    <?php 
					//Instancia uma variável do tipo DOMDocument
					$dom = new DOMDocument;
					//Carrega o html contido no "conteúdo" da notícia
					$dom->loadHTML($noticia["conteudo_noticia"]);
					//Pega todas as imagens
					$images = $dom->getElementsByTagName('img');
					//Laço de repetição que controla o atributo "data-lightbox", para o efeito lightbox no site
					foreach ($images as $index=>$image) {
							//Define o atributo "data-lightbox" para "Imagem #" e o index
							$image->setAttribute('data-lightbox', 'Imagem #'.$index);
					}
					//Imprime o html alterado
					echo $dom->saveHTML();					
					?>
                </div>
                <?php 
						//Query que consulta no banco de dados as tags da notícia
						$res = mysqli_query($conexao,"select * from noticias_tags where noticia_tag=".$_GET["noticia"].";");
						//Se há resposta
						if($res):
				?>
                <div class="tags">
                	<?php
						//Laço de repetição que controla a impressão das tags
						while($row = mysqli_fetch_array($res)): ?>
                    	<a href="noticias.php?tag=<?php echo $row["nome_tag"]; ?>" class="tag"><?php echo $row["nome_tag"]; ?></a>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-3 hidden-xs">
				<?php
                    //Faz a decodificação do json com as colunas, para poder ajustá-las e exibi-las
					$colunas = json_decode(file_get_contents("coluna_lateral.json"),true);
					//Laço de repetição responsável por exibir o conteúdo das colunas laterais.
					foreach($colunas as $anuncio) :
                ?>
                <div class="noticia">
                    <?php echo $anuncio["conteudo"]; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php include ("footer.php"); ?>
<script src="../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="../recursos/jquery.mask.js" type="text/javascript"></script>
<script src="../recursos/lightbox2-master/js/lightbox.js" type="text/javascript"></script>
<script src="js/index.js"></script>
</body>
</html>