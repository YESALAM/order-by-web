<?php
//Especifica ao navegador o tipo de conteúdo da página
header("Content-Type: application/json");
include "../../paginas/conexao.php";

//Realiza uma query para buscar as faltas
$res = mysqli_query($conexao,"select * from faltas, materias where faltas.materiasidmateria_falta=materias.idmateria and faltas.alunosrm_falta='".$_GET['rm']."' and faltas.mes_falta=".$_GET['mes']." order by materias.nome_materias asc;");

$resposta = array();
//Verifica se não houve erros
if($res)
{	
	//Verifica se houve resultados na query
	if(mysqli_num_rows($res)!=0)
	{
		$resposta['success'] = true;
		$faltas=array();
		//Laço de repetição que pega cada linha dos resultados e atribui nas variáveis
		while($row = mysqli_fetch_array($res))
		{
			$falta = array('id' => $row['idfalta'], 'quantidade' => $row['quantidade_falta']);
			$materia = array('id' => $row['idmateria'], 'nome' => $row['nome_materias'], 'sigla' => $row['sigla_materias']);
			$falta['materia'] = $materia;
			$faltas[]=$falta;
		}
		$resposta['faltas'] = $faltas;
	}
	else
	{
		$resposta['success'] = false;
		$resposta['motivo'] = "Nenhuma falta cadastrada nesse mês.";
	}
}
else
{
	$resposta['success'] = false;
	$resposta['motivo'] = "Erro no Banco de Dados";
}

//Imprime o json gerado a partir dos vetores associativos
echo json_encode($resposta);
//Finaliza a conexão.
mysqli_close($conexao);
?>