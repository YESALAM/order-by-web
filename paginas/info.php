<?php
	//Cria a vari�vel $info, que contem v�rios aspectos contidos no json, como nome da escola, email, endere�o etc.
	$info = json_decode(file_get_contents((isset($_SESSION["tipo"]) || $informacoes ? "../" : "")."informacoes.json"),true);
?>