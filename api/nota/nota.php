<?php
//Especifica ao navegador o tipo de conteúdo da página
header("Content-Type: application/json");
include "../../paginas/conexao.php";

//Realiza uma query para buscar as notas
$res = mysqli_query($conexao,"select * from notas, materias where notas.materiasidmateria_nota=materias.idmateria and notas.alunosrm_nota='".$_GET['rm']."' and notas.bimestre_nota=".$_GET['bimestre']." order by materias.nome_materias asc;");

$resposta = array();
//Verifica se não houve erros
if($res)
{
	//Verifica se houve resultados na query
	if(mysqli_num_rows($res)!=0)
	{
		$resposta['success'] = true;
		$notas=array();
		//Laço de repetição que pega cada linha dos resultados e atribui nas variáveis
		while($row = mysqli_fetch_array($res))
		{
			$nota = array('id' => $row['idnota'], 'nota' => $row['nota_nota']);
			$materia = array('id' => $row['idmateria'], 'nome' => $row['nome_materias'], 'sigla' => $row['sigla_materias']);
			$nota['materia'] = $materia;
			$notas[]=$nota;
		}
		$resposta['notas'] = $notas;
	}
	else
	{
		$resposta['success'] = false;
		$resposta['motivo'] = "Nenhuma nota cadastrada nesse bimestre.";
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