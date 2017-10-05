<?php
	//Inicia a sessão, para caso esteja logado
	session_start();
	//Destroi a sessão, caso esteja logado, para impedir erros de acesso
	session_destroy();
	
	$informacoes = false;
	include "info.php";
	include "conexao.php";
	
	//Define o modo como aluno, para a navbar
	$modo = "aluno";
	//Define a página atual (index.php), portanto ""
	$atual="";
	
	//Verifica se há o get da variável p, responsável pelo controle da página, no caso contrário, atribui 0.
	$p=(isset($_GET["p"]) ? $_GET["p"]-1 : 0);
	
	//Verifica se há o get da variável tag, responsável pelo controle das tags, no caso contrário, atribui "".
	$t=(isset($_GET["tag"]) ? $_GET["tag"] : "");
	
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
<title><?php echo $info["nome_escola"]; ?> | Índice de notícias</title>
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
                <div id="espaco-noticias">
                <?php 
					//Query que controla a busca por notícias pelos padrões especificados
					$res = mysqli_query($conexao,($t=="" ? "select * from noticias order by id_noticia desc limit ".($info["quantidade_noticias_normais"]*$p).",".$info["quantidade_noticias_normais"].";" : "select * from noticias,noticias_tags where noticias_tags.noticia_tag=noticias.id_noticia and noticias_tags.nome_tag='$t' group by noticias_tags.noticia_tag order by noticias.id_noticia desc limit ".($info["quantidade_noticias_normais"]*$p).",".$info["quantidade_noticias_normais"].";"));
					//Laço de repetição responsável pela impressão de cada notícia.
					while($row = mysqli_fetch_array($res)):
                ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="noticia.php?noticia=<?php echo $row["id_noticia"]; ?>" >
                            <img src="thumbnail.php?tipo=noticias&id=<?php echo $row["id_noticia"];?>" alt="<?php echo $row["titulo_noticia"]; ?>" width="64" height="64">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="noticia.php?noticia=<?php echo $row["id_noticia"]; ?>" ><h4 class="media-heading"><?php echo $row["titulo_noticia"]; ?></h4></a>
                            <?php echo (strlen(strip_tags($row["conteudo_noticia"],"<a>"))>200 ? substr(strip_tags($row["conteudo_noticia"]),0,200)."..." : strip_tags($row["conteudo_noticia"],"<a>")); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php 
					//Verifica se há notícias mais antigas, para exibir o link para a próxima página
					if(mysqli_num_rows($res)==$info["quantidade_noticias_normais"]): ?>
                	<a href="noticias.php?p=<?php echo $p+2; ?>" class="pull-right"  style="padding:10px 0 20px 0;">Notícias mais antigas <i class="fa fa-arrow-right"></i></a>
                <?php endif; ?>
                <?php
					//Verifica se há notícias mais recentes, para exibir o link para a página anterior
					if($p!=0): ?>
                	<a href="noticias.php?p=<?php echo $p; ?>" class="pull-left"  style="padding:10px 0 20px 0;"><i class="fa fa-arrow-left"></i> Notícias mais recentes</a>
                <?php endif; ?>
                </div>
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