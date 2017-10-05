<?php
include "conexao.php";

$sucesso=false;

//Pega o tipo pelo mщtodo post, professor ou aluno
$tipo = $_POST["tipo"];
if($tipo=="aluno")
{
	//Query que busca na tabela alunos o rm especificado
	$res = mysqli_query($conexao,"select * from alunos where rm_aluno='".$_POST["rm"]."' limit 1;");
	//Pega a resposta da query
	$resp = mysqli_fetch_assoc($res);
	//Verifica se nуo щ vazio, para assim especificar os valores da sessуo
	if(!empty($resp))
	{
		//Inicia a sessуo
		session_start();	
		$_SESSION["tipo"] = "aluno";
		$_SESSION["aluno_rm"] = $resp["rm_aluno"];
		$_SESSION["aluno_nome"] = $resp["nome_aluno"];
		
		$sucesso=true;
	}
}
else
{
	//Faz a validaчуo do campo do cpf
	$cpf = str_replace("-","",str_replace(".","",$_POST["cpf"]));
	//Query que busca na tabela professores o cpf especificado
	$res = mysqli_query($conexao,"select * from professores where cpf_professores='".$cpf."' and senha_professores='".$_POST["senha_prof"]."' limit 1;");
	//Pega a resposta da query
	$resp = mysqli_fetch_assoc($res);
	//Verifica se nуo щ vazio, para assim especificar os valores da sessуo
	if(!empty($resp))
	{
		//Inicia a sessуo
		session_start();	
		$_SESSION["tipo"] = "professor";
		$_SESSION["professor_cpf"] = $resp["cpf_professores"];
		$_SESSION["professor_nome"] = $resp["nome_professores"];
		$_SESSION["professor_senha"] = $_POST["senha_prof"];
		$_SESSION["professor_sigla"] = $resp["sigla_professores"];
		
		$sucesso=true;
	}
}

//Redireciona para a pсgina especifica de professor ou aluno.
header("location:".($sucesso ? ($_SESSION["tipo"]=="aluno" ? "alunos/" : "professores/notas.php") : "index.php?modo=$tipo&erro=true"));
?>