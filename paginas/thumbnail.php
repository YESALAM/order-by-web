<?php
	include "conexao.php";
	//Especifica ao navegador o tipo de conteúdo da página
	header("Content-Type: image/jpeg");
	//Pega o id do método get
	$id = $_GET["id"];
	//Pega o tipo do método get
	$tipo = $_GET["tipo"];
	
	//Query que faz a busca na tabela especificada
	$q = mysqli_query($conexao,"select * from $tipo where ".($tipo=="alunos" ? "rm_aluno" : "id_noticia")."='$id' limit 1;");
	//Pega o retorno
	$res = mysqli_fetch_assoc($q);
	
	//Se o retorno não for vazio, imprime a imagem do campo blob de cada tabela
	if(!empty($res[($tipo=="alunos" ? "foto_aluno" : "imagem_noticia")]))
	{
		echo $res[($tipo=="alunos" ? "foto_aluno" : "imagem_noticia")];
	}
	//Caso contrário, exibe a imagem padrão.
	else
	{
		readfile("../fotos/".($tipo=="alunos" ? "carometro" : "noticias")."/default.jpg");
	}
?>