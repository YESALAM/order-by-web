<?php
include "../conexao.php";

//Função responsável por gerar um select com os cursos que o professor dá aula.
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
		//Laço responsável por adicionar os resultados no json
		while($row = mysqli_fetch_array($res))
		{
			$materia = array("idmateria" => $row["idmateria"], "sigla" => $row["sigla_materias"], "nome" => $row["nome_materias"]);
			$a[]=$materia;
		}
	}
	//Encoda json e retorna.
	return json_encode($a);
}

//Função responsável por gerar um json com os alunos e suas faltas no mês especificado.
function gerarAlunos($turma,$materia,$mes)
{
	global $conexao;
	
	$a = array();
	$b = array();
	
	$final = array();
	$final2 = array();
	
	$retorno = array();
	
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
	
	//Faz uma query buscando as faltas dos alunos.
	$res = mysqli_query($conexao,"select * from faltas, alunos where faltas.alunosrm_falta=alunos.rm_aluno and faltas.materiasidmateria_falta=".$materia." and faltas.mes_falta=".$mes." order by alunos.nome_aluno asc;");
	//Laço de repetição que analisa e pega as informações da query.
	while($row = mysqli_fetch_array($res))
	{
		$b[$row["rm_aluno"]]["falta"] = $row["quantidade_falta"];
		$b[$row["rm_aluno"]]["id_falta"] = $row["idfalta"];	
	}
	
	//Verifica se há falta para cada aluno, através de um laço de repetição.
	for($i = 0;$i<count($a);$i++)
	{
		$aluno = $a[$i];
		if(isset($b[$aluno['rm']]))
			$aluno['falta'] = $b[$aluno['rm']];	
		$final[] = $aluno;
	}
	
	//Faz uma query buscando as informações referentes ao professor.
	$res = mysqli_query($conexao,"select * from faltas_materias where materiaidmateria=$materia and mes_mf=$mes limit 1;");
	//Verifica se há resultados.
	if (mysqli_num_rows($res)>0)
	{
		$m = mysqli_fetch_assoc($res);
		$final2['id_controle']=$m['id_falta'];
		$final2['aulas_dadas']=$m['aulas_dadas'];
		$final2['aulas_previstas']=$m['aulas_pre'];	
		
		$retorno = array("alunos" => $final,"dados" => $final2);
	}
	else
		$retorno = array("alunos" => $final);

	//Encoda json e retorna.
	return json_encode($retorno);	
}

//Função responsável por gerar os meses.
function gerarMeses()
{
	$mes = date('m');
	$a = array();
	$meses = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	
	//Laço de repetição que controla os meses disponíveis.
	for($i=1;$i<=$mes;$i++)
	{
		$a[] = array("mes" => $i, "nome" => $meses[$i-1]);
	}
		
	//Encoda json e retorna.
	return json_encode($a);
}

if(isset($_POST["tipo"]))
{
	//Verifica e retorna a informação pedida por ajax.
	$tipo = $_POST["tipo"];
	if($tipo=="materia")
		echo gerarMaterias($_POST["cpf"],$_POST["turma"]);	
	else if($tipo=="alunos")
		echo gerarAlunos($_POST["turma"],$_POST["materia"],$_POST["mes"]);
	else if($tipo=="mes")
		echo gerarMeses();
	else if($tipo=="sala")
		echo gerarSalas($_POST["cpf"],$_POST["curso"]);
}
?>