<?php
	//Inicia a sessão
	session_start();
	//Destrói a sessão
	session_destroy();
	//Redireciona para a index do site.
	header("location:../index.php?modo=professor");
?>