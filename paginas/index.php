<?php
	//Inicia a sessão, para caso esteja logado
	session_start();
	//Destroi a sessão, caso esteja logado, para impedir erros de acesso
	session_destroy();
	
	$informacoes=false;
	include "info.php";
	include "conexao.php";

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
<title><?php echo $info["nome_escola"]; ?> | Home</title>
<link href="../recursos/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../recursos/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"  />
<link href="css/index.css" rel="stylesheet"  />
</head>

<body>
<?php include ("navbar.php"); ?>
<div class="page-row page-row-expanded">
<?php 
	//Verifica se no GET há algum erro, seja de login etc.
	if(isset($_GET["erro"])) : ?>
	<div class="alerta">
		<b>Erro!</b> <?php echo ($modo=="aluno" ? "RM inexistente" : "CPF e/ou senha incorretos") ?>, favor tentar novamente...
	</div>
<?php endif; ?>
<?php 
	//Faz a consulta no banco de dados, na tabela notícias, para preencher o carousel.
	$res = mysqli_query($conexao,"select * from noticias where destaque_noticia=1 order by data_noticia desc limit ".$info["quantidade_noticias_carousel"].";");
	$i=0;
	//Faz um loop para obter os resultados
	while($row = mysqli_fetch_array($res))
	{
		//Cria um array, preenchendo as informações de cada linha das respostas
		$noticia = array("id" => $row["id_noticia"],"nome" =>$row["titulo_noticia"]);
		//Adiciona essa array na outra array noticias, que conterá todas
		$noticias[] = $noticia;
		//Incrementa a variável de controle, $i
		$i++;
	}
?>
<div class="carousel slide" data-ride="carousel" style="margin-bottom:20px;" id="carousel"> 
  <!-- Indicators -->
  <ol class="carousel-indicators">
  	<?php 
		//Laço de repetição que serve para imprimir os controles do carousel, de acordo com a quantidade de resultados
		for($j=0;$j<$i;$j++) : ?>
    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $j; ?>" <?php if($j==0) echo 'class="active"'; ?>></li>
    <?php endfor; ?>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox" >
  <?php 
		//Laço de repetição que ajusta os slides do carousel, de acordo com a quantidade de resultados
		for($j=0;$j<$i;$j++) : ?>
    <a href="noticia.php?noticia=<?php echo $noticias[$j]["id"]; ?>" class="item <?php if ($j==0) echo "active"; ?>"> <img style="background-image:url('thumbnail.php?tipo=noticias&id=<?php echo $noticias[$j]["id"]; ?>');">
      <div class="carousel-caption">
        <h3><?php echo $noticias[$j]["nome"]; ?></h3>
      </div>
    </a>
  <?php endfor; ?>
  </div>
  
  <!-- Controls --> 
  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
<div class="container">
  <div class="row">
    <div class="col-md-9 col-xs-12">
    	<div id="espaco-noticias">
			<?php 
				//Faz a busca pelas noticias novamente, porém agora busca por todas as noticias, e não apenas destaque.
				$res = mysqli_query($conexao,"select * from noticias order by id_noticia desc limit ".$info["quantidade_noticias_normais"].";");
				//Laço de repetição responsável por gerar as notícias para visualização.
                while($row = mysqli_fetch_array($res)):
            ?>
            <div class="media">
                <div class="media-left">
                    <a href="noticia.php?noticia=<?php echo $row["id_noticia"]; ?>" >
                        <img src="thumbnail.php?tipo=noticias&id=<?php echo $row["id_noticia"];?>" alt="<?php echo $row["titulo_noticia"]; ?>" width="64" height="64">
                    </a>
                </div>
                <div class="media-body">
                    <a href="noticia.php?noticia=<?php echo $row["id_noticia"]; ?>" >
						<h4 class="media-heading"><?php echo $row["titulo_noticia"]; ?></h4>
					</a>
                    <?php echo (strlen(strip_tags($row["conteudo_noticia"],"<a>"))>200 ? substr(strip_tags($row["conteudo_noticia"]),0,200)."..." : strip_tags($row["conteudo_noticia"],"<a>")); ?>
                </div>
            </div>
          <?php endwhile; ?>
		  <?php 
			//Verifica se há notícias mais antigas, para exibir o link para a próxima página
			if(mysqli_num_rows($res)==$info["quantidade_noticias_normais"]): ?>
			<a href="noticias.php?p=2" class="pull-right"  style="padding:10px 0 20px 0;">Notícias mais antigas <i class="fa fa-arrow-right"></i></a>
          <?php endif; ?>
		</div>
    </div>
    <div class="col-md-3 col-xs-12">
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
<script src="js/index.js"></script>
</body>
</html>