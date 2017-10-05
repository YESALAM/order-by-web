<?php
	include "../conexao.php";
	include "verificar_login.php";
	
	$erro=0;
	$sucesso=false;
	
	//Verifica se a senha nova é valida.
	if($_POST["atual"]==$_SESSION["professor_senha"] && $_POST["nova"]==$_POST["confirmacao"] && $_POST["atual"]!="" && $_POST["nova"]!="" && $_POST["confirmacao"]!="" && $_SESSION["professor_senha"]!=$_POST["confirmacao"] && $_SESSION["professor_senha"]!=$_POST["nova"])
	{
		//Executa a query e altera a senha do professor.
		$res = mysql_query("update professores set senha_professores='".$_POST["confirmacao"]."' where cpf_professores='".$_SESSION["professor_cpf"]."';");
		if($res) $sucesso = true;
		else $erro=1;
	}
	else
		$erro = 2;
		
	//Altera a senha do professor na sessão.
	if($sucesso) $_SESSION["professor_senha"] = $_POST["confirmacao"];
		
	//Redireciona para as configurações.
	header("location: configuracoes.php?sucesso=".($sucesso ? "true" : "false").(!$sucesso ? "&motivo=".$erro : ""));
?>