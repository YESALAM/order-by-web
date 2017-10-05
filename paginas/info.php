<?php
	//Cria a variável $info, que contem vários aspectos contidos no json, como nome da escola, email, endereço etc.
	$info = json_decode(file_get_contents((isset($_SESSION["tipo"]) || $informacoes ? "../" : "")."informacoes.json"),true);
?>