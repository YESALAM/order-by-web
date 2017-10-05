<?php
//Especifica ao navegador o tipo de conteúdo da página
header("Content-Type: application/json");
include "../../paginas/conexao.php";

//Realiza uma query para buscar o aluno
$res = mysqli_query($conexao,"select * from turmas_alunos, alunos, responsaveis where turmas_alunos.alunosrm_ta=alunos.rm_aluno and turmas_alunos.alunosrm_ta='".$_GET['rm']."' and alunos.cpf_responsavel_aluno=responsaveis.cpf_responsaveis limit 1;");

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
			$aluno = array('rm' => $row['rm_aluno'], 'nome' => $row['nome_aluno'], 'cpf' => $row['cpf_aluno'], 'telefone' => $row['tel_aluno'], 'celular' => $row['cel_aluno'],"idTurma" => $row["turmasidturma_ta"]);
			$responsavel = array('cpf' => $row['cpf_responsaveis'], 'nome' => $row['nome_responsaveis'], 'telefoneComercial' => $row['tel_com_responsaveis'], 'ramal' => $row['ramal_responsaveis'], 'celular' => $row['celular_responsaveis']);
			$aluno['responsavel'] = $responsavel;
			$resposta['aluno'] = $aluno;
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
echo json_encode($resposta,JSON_FORCE_OBJECT);
//Finaliza a conexão.
mysqli_close($conexao);
?>