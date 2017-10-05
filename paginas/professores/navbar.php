<?php 
	//Decodifica o json com as informações.
	$info = json_decode(file_get_contents("../informacoes.json"),true); 
?>
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:<?php echo $info["cor_navbar"]; ?>;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-<?php echo ($info["nome_abreviado"]!="" ? "brand" : "logo"); ?>" href="logoff.php"><?php echo ($info["nome_abreviado"]!="" ? $info["nome_abreviado"] : '<img src="../../fotos/site/'.$info["logo_principal"].'" />'); ?></a> </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
         <li <?php echo ($atual=="notas" ? "class='active'" : ""); ?>><a href="notas.php">Notas</a></li>
         <li <?php echo ($atual=="faltas" ? "class='active'" : ""); ?>><a href="faltas.php">Faltas</a></li>
         <li <?php echo ($atual=="lista_presenca" ? "class='active'" : ""); ?>><a href="lista_presenca.php">Listas de Presença</a></li>
         <li <?php echo ($atual=="carometro" ? "class='active'" : ""); ?>><a href="carometro.php">Carômetros</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["professor_nome"] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="configuracoes.php">Configurações</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logoff.php">Logoff</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
</nav>
