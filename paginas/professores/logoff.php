<?php
	//Inicia a sess�o
	session_start();
	//Destr�i a sess�o
	session_destroy();
	//Redireciona para a index do site.
	header("location:../index.php?modo=professor");
?>