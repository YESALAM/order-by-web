<?php
include "../conexao.php";

//Função responsável por gerar um select com os cursos.
function gerarCursos($cpf)
{
	global $conexao;
	$a="";
	//Faz a query para buscar os cursos existentes
	$res = mysqli_query($conexao,"select * from prof_mat_tur_sal, turmas where prof_mat_tur_sal.idtur_pmts=turmas.idturma and prof_mat_tur_sal.cpfprof_pmts='".$cpf."' group by turmas.curso_turmas order by turmas.curso_turmas asc;");
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
function gerarSalas($cpf,$curso)
{
	global $conexao;
	$a=array();
	//Faz a query para buscar as turmas existentes do curso especificado
	$res = mysqli_query($conexao,"select * from prof_mat_tur_sal, turmas where prof_mat_tur_sal.idtur_pmts=turmas.idturma and prof_mat_tur_sal.cpfprof_pmts='".$cpf."' and turmas.curso_turmas='$curso' group by turmas.grau_turmas, turmas.classe_turmas, turmas.curso_turmas order by turmas.grau_turmas asc, turmas.classe_turmas asc");
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

//Função responsável por gerar um json com as matérias da turma especificada
function gerarMaterias($cpf,$turma)
{
	global $conexao;
	$a=array();
	//Faz a query para buscar as matérias da turma especificada
	$res = mysqli_query($conexao,"select * from prof_mat_tur_sal, materias where prof_mat_tur_sal.idmat_pmts=materias.idmateria and prof_mat_tur_sal.cpfprof_pmts='".$cpf."' and prof_mat_tur_sal.idtur_pmts=".$turma." order by materias.nome_materias asc");
	//Verifica se houve respostas.
	if(mysqli_num_rows($res)>0)
	{
		while($row = mysqli_fetch_array($res))
		{
			$materia = array("idmateria" => $row["idmateria"], "sigla" => $row["sigla_materias"], "nome" => $row["nome_materias"]);
			$a[]=$materia;
		}
	}
	
	//Encoda json e retorna.
	return json_encode($a);
}

//Função responsável por gerar um json com os alunos e suas notas no mês especificado.
function gerarAlunos($turma,$materia,$bimestre)
{
	global $conexao;
	
	$a = array();
	$b = array();
	
	$final = array();
	
	//Faz uma query buscando os alunos da turma.
	$res = mysqli_query($conexao,"select * from turmas_alunos, alunos where turmas_alunos.turmasidturma_ta=".$turma." and turmas_alunos.alunosrm_ta=alunos.rm_aluno order by turmas_alunos.numero_ta asc;");
	//Laço de repetição que analisa e pega as informações da query.
	while($row = mysqli_fetch_array($res))
	{
			$aluno['nome'] = $row["nome_aluno"];
			$aluno['rm'] = $row["rm_aluno"];
			$aluno['numero'] = sprintf("%03d", $row["numero_ta"]);
			$a[]=$aluno;
	}
	
	//Faz uma query buscando as notas dos alunos.
	$res = mysqli_query($conexao,"select * from notas, alunos where notas.alunosrm_nota=alunos.rm_aluno and notas.materiasidmateria_nota=".$materia." and notas.bimestre_nota=".$bimestre." order by alunos.nome_aluno asc;");
	//Laço de repetição que analisa e pega as informações da query.
	while($row = mysqli_fetch_array($res))
	{
		$b[$row["rm_aluno"]]["nota"] = $row["nota_nota"];
		$b[$row["rm_aluno"]]["id_nota"] = $row["idnota"];	
	}
	
	//Verifica se há nota para cada aluno, através de um laço de repetição.
	for($i = 0;$i<count($a);$i++)
	{
		$aluno = $a[$i];
		if(isset($b[$aluno['rm']]))
			$aluno['nota'] = $b[$aluno['rm']];	
		$final[] = $aluno;
	}
	
	//Encoda json e retorna.
	return json_encode($final);	
}

//Função responsável por gerar os bimestres.
function gerarBimestres()
{
	$mes = date('m');
	$a = array();
	
	//Verifica o mês atual, e a partir disto gera os bimestres disponíveis.
	if($mes<=3)
		$a[] = array("bimestre" => 1, "nome" => "1º Bimestre");
	else if($mes>3 && $mes<=6)
	{
		$a[] = array("bimestre" => 1, "nome" => "1º Bimestre");
		$a[] = array("bimestre" => 2, "nome" => "2º Bimestre");
	}
	else if($mes>6 && $mes<=9)
	{
		$a[] = array("bimestre" => 1, "nome" => "1º Bimestre");
		$a[] = array("bimestre" => 2, "nome" => "2º Bimestre");
		$a[] = array("bimestre" => 3, "nome" => "3º Bimestre");
	}
	else
	{
		$a[] = array("bimestre" => 1, "nome" => "1º Bimestre");
		$a[] = array("bimestre" => 2, "nome" => "2º Bimestre");
		$a[] = array("bimestre" => 3, "nome" => "3º Bimestre");
		$a[] = array("bimestre" => 4, "nome" => "4º Bimestre");
	}
		
	return json_encode($a);
}

if(isset($_POST["tipo"]))
{
	//Verifica e retorna a informação pedida por ajax.
	$tipo = $_POST["tipo"];
	if($tipo=="materia")
		echo gerarMaterias($_POST["cpf"],$_POST["turma"]);	
	else if($tipo=="alunos")
		echo gerarAlunos($_POST["turma"],$_POST["materia"],$_POST["bimestre"]);
	else if($tipo=="bimestre")
		echo gerarBimestres();
	else if($tipo=="sala")
		echo gerarSalas($_POST["cpf"],$_POST["curso"]);
}
?>