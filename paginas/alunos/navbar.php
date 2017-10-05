<?php 
	//Decodifica as informações do json.
	$info = json_decode(file_get_contents("../informacoes.json"),true); 
?>
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:<?php echo $info["cor_navbar"]; ?>;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-<?php echo ($info["nome_abreviado"]!="" ? "brand" : "logo"); ?>" href="logoff.php"><?php echo ($info["nome_abreviado"]!="" ? $info["nome_abreviado"] : '<img src="../../fotos/site/'.$info["logo_principal"].'" />'); ?></a> </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
         <li <?php echo ($atual=="boletim" ? "class='active'" : ""); ?>><a href="boletim.php">Boletim</a></li>
         <li <?php echo ($atual=="faltas" ? "class='active'" : ""); ?>><a href="faltas.php">Faltas</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["aluno_rm"] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
            	<div class="user-information">
                    <a href="index.php"><div class="imagem" style="background-image:url('../thumbnail.php?tipo=alunos&id=<?php echo $_SESSION["aluno_rm"] ?>');"></div></a>
                    <p><?php echo $_SESSION["aluno_nome"]; ?></p>
                </div>
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="logoff.php">Logoff</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
