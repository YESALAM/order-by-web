<?php
	//Abre a conex�o com o banco de dados MySQL
	$conexao = mysqli_connect("localhost","root","vertrigo");
	//Seleciona o banco de dados, no caso "escola"
	mysqli_select_db($conexao,"escola");
	//Define o charset dos dados, para n�o ter problemas com m� forma��o de caracteres especiais
	mysqli_set_charset($conexao,"utf8");
?>