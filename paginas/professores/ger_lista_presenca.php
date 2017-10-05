<?php
include "../conexao.php";

//Função responsável por gerar um select com os cursos.
function gerarCursos()
{
	global $conexao;
	$a="";
	//Faz a query para buscar os cursos existentes
	$res = mysqli_query($conexao,"select * from turmas group by turmas.curso_turmas order by turmas.curso_turmas asc;");
	//Verifica se houve respostas.
	if(mysqli_num_rows($res)>0)
	{
		$a.='<select name="curso" id="cursos-select" class="form-control">
				<option value="selecionar">Selecione um curso</option>';
		//Laço responsável por adicionar as opções no select.
		while($row = mysqli_fetch_array($res))
		{
			$a.='<option value="'.$row["curso_turmas"].'">'.$row["curso_turmas"].'</option>';
		}
		$a.='</select>';
	}
	
	return $a;
}

//Função responsável por gerar um json com as turmas do curso especificado.
function gerarSalas($curso)
{
	global $conexao;
	$a=array();
	//Faz a query para buscar as turmas existentes do curso especificado
	$res = mysqli_query($conexao,"select * from turmas where turmas.curso_turmas='$curso' group by turmas.grau_turmas, turmas.classe_turmas, turmas.curso_turmas order by turmas.grau_turmas asc, turmas.classe_turmas asc");
	//Verifica se houve respostas.
	if(mysqli_num_rows($res)>0)
	{
		//Laço responsável por adicionar os resultados no json
		while($row = mysqli_fetch_array($res))
		{
			$sala = array("idturma" => $row["idturma"], "grau" => $row["grau_turmas"], "classe" => $row["classe_turmas"], "periodo" => $row["período_turmas"]);
			$a[]=$sala;
		}
	}
	
	//Encoda json e retorna.
	return json_encode($a);
}

//Função responsável por gerar um json com os alunos da turma especificada
function gerarAlunos($turma)
{
	global $conexao;
	
	$final = array();
	
	//Faz a query para buscar os alunos da turma especificada
	$res = mysqli_query($conexao,"select * from turmas_alunos, alunos where turmas_alunos.turmasidturma_ta=".$turma." and turmas_alunos.alunosrm_ta=alunos.rm_aluno order by turmas_alunos.numero_ta asc;");
	
	//Laço responsável por adicionar os resultados no json
	while($row = mysqli_fetch_array($res))
	{
			$aluno['nome'] = $row["nome_aluno"];
			$aluno['rm'] = $row["rm_aluno"];
			$aluno['numero'] = sprintf("%03d", $row["numero_ta"]);
			$aluno['observacoes'] = $row["situacao_ta"];
			$final[]=$aluno;
	}
	
	//Encoda json e retorna.
	return json_encode($final);	
}


if(isset($_POST["tipo"]))
{
	//Verifica e retorna a informação pedida por ajax.
	$tipo = $_POST["tipo"];
	if($tipo=="alunos")
		echo gerarAlunos($_POST["turma"]);
	else if($tipo=="sala")
		echo gerarSalas($_POST["curso"]);
}
?>