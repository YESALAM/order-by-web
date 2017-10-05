<?php
//Inicia a sessão
session_start();
//Verifica se a variável $tipo está definida
if(!isset($_SESSION["tipo"]))
{
	// Destrói a sessão limpando todos os valores salvos
	session_destroy(); 
	//Redireciona para a index do site.
	header("location:../index.php");
}	
?>