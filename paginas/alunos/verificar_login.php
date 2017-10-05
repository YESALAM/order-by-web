<?php
//Inicia a sessão
session_start();
//Verifica se há definido a variável $tipo
if(!isset($_SESSION["tipo"]))
{
	// Destrói a sessão limpando todos os valores salvos
	session_destroy(); 
	//Redireciona para a index do site.
	header("location:../");
}	
?>