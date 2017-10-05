<?php
//Especifica ao navegador o tipo de conteúdo da página
header("Content-Type: application/json");
include "../../paginas/conexao.php";

//Realiza a consulta no banco de dados em procura das notícias
$res = mysqli_query($conexao,"select * from noticias,funcionarios where noticias.criador_noticia=funcionarios.cpf_funcionarios order by noticias.id_noticia desc;");

$resposta = array();
//Verifica se não houve erros
if($res)
{
	//Verifica se houve resultados na query
	if(mysqli_num_rows($res)!=0)
	{
		$resposta['success'] = true;
		//Laço de repetição que pega cada linha dos resultados e atribui nas variáveis
		while($row = mysqli_fetch_array($res))
		{
			$noticia = array('id'=>$row["id_noticia"],'titulo'=>$row["titulo_noticia"],'conteudo'=>$row["conteudo_noticia"],'criador'=>$row["nome_funcionarios"],'data'=>$row["data_noticia"]);
			$resposta['noticias'][] = $noticia;
		}
	}
	else
	{
		$resposta['success'] = false;
		$resposta['motivo'] = "RM não encontrado.";
	}
	
}
else
{
	$resposta['success'] = false;
	$resposta['motivo'] = "Erro no Banco de Dados.";
}

//Imprime o json gerado a partir dos vetores associativos
echo json_encode($resposta);
//Finaliza a conexão.
mysqli_close($conexao);
?>