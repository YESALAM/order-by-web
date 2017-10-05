<?php
include "../conexao.php";

function gerarCursos()
{
	global $conexao;
	$a="";
	//Faz uma query buscando os cursos
	$res = mysqli_query($conexao,"select * from turmas group by turmas.curso_turmas order by turmas.curso_turmas asc;");
	//Verifica se há respostas
	if(mysqli_num_rows($res)>0)
	{
		$a.='<select name="curso" id="cursos-select" class="form-control">
				<option value="selecionar">Selecione um curso</option>';
		//Laço que adiciona no select
		while($row = mysqli_fetch_array($res))
		{
			$a.='<option value="'.$row["curso_turmas"].'">'.$row["curso_turmas"].'</option>';
		}
		$a.='</select>';
	}
	
	return $a;
}

function gerarSalas($curso)
{
	global $conexao;
	$a=array();
	//Faz uma query buscando as turmas
	$res = mysqli_query($conexao,"select * from turmas where turmas.curso_turmas='$curso' group by turmas.grau_turmas, turmas.classe_turmas, turmas.curso_turmas order by turmas.grau_turmas asc, turmas.classe_turmas asc");
	//Verifica se há respostas
	if(mysqli_num_rows($res)>0)
	{
		//Adiciona no vetor de retorno
		while($row = mysqli_fetch_array($res))
		{
			$sala = array("idturma" => $row["idturma"], "grau" => $row["grau_turmas"], "classe" => $row["classe_turmas"], "periodo" => $row["período_turmas"]);
			$a[]=$sala;
		}
	}
	
	//Encoda e retorna em json
	return json_encode($a);
}

function gerarHorario($turma)
{
	global $conexao;
	
	$final = array();
	
	//Faz uma query para buscar as aulas
	$res = mysqli_query($conexao,"select * from aula, materias where aula.turmasidturma_aula=$turma and aula.materiasidmateria_aula=materias.idmateria order by field(aula.dia_aula,'SEGUNDA','TERÇA','QUARTA','QUINTA','SEXTA'), aula.inicio_aula asc");
	
	//Verifica se há respostas
	if(mysqli_num_rows($res)>0)
	{
		//Obtem os resultados
		while($row=mysqli_fetch_array($res))
		{
			$aula["id"] = $row["idaula_aula"];
			$aula["sala"] = $row["salasidsala_aula"];
			$aula["materia"] = $row["sigla_materias"];
			$aula["inicio"] = $row["inicio_aula"];
			$aula["fim"] = $row["fim_aula"];
			$aulastemp[$row["dia_aula"]][]=$aula;
		}
		
		//Faz uma query para buscar os professores
		$res = mysqli_query($conexao,"select * from aulas_professores, professores where professores.cpf_professores=aulas_professores.professorescpf_ap;");

		//Obtem os resultados
		while($row = mysqli_fetch_array($res))
		{
			for($j=1;$j<=5;$j++)
			{
				$dia = getDia($j);
				if(isset($aulastemp[$dia]))
				{
					for($i=0;$i<count($aulastemp[$dia]);$i++)
					{
						if($row["aulasidaula_ap"]==$aulastemp[$dia][$i]["id"])
						{
							$aulastemp[$dia][$i]["professores"][]=$row["sigla_professores"];
						}
					}
				}
			}
		}
		
		//Faz uma query para buscar os horários
		$res = mysqli_query($conexao,"select * from horario_turma where idturma_t=$turma and tipo_horario_t<>'Intervalo' order by entrada_horario_t asc;");
		
		//Obtem os resultados
		while($row = mysqli_fetch_array($res))
		{
			$horario = array();
			$horario["inicio"] = $row["entrada_horario_t"];
			$horario["fim"] = $row["saida_horario_t"];
			
			$final["horarios"][]=$horario;
		}
		
		//Filtra as aulas e organiza as janelas
		for($k=1;$k<=5;$k++)
		{
			$d = getDia($k);
			for($l=0;$l<count($final["horarios"]);$l++)
			{
				if(isset($aulastemp[$d]))
				{
					for($m=0;$m<count($aulastemp[$d]);$m++)
					{
						if(isset($aulastemp[$d][$m]))
						{
							if($aulastemp[$d][$m]["inicio"]==$final["horarios"][$l]["inicio"] && $aulastemp[$d][$m]["fim"]==$final["horarios"][$l]["fim"])
							{
								
								$final["aulas"][$d][]=$aulastemp[$d][$m];
								break;
							}
						}
					}
				}
				if(!isset($final["aulas"][$d][$l]))
				{
					$a["id"]="";
					$a["sala"]="";
					$a["materia"]="";
					$a["inicio"]=$final["horarios"][$l]["inicio"];
					$a["fim"]=$final["horarios"][$l]["fim"];
					$a["professores"]=array();
					$final["aulas"][$d][$l]=$a;
				}
				//if(isset($aulastemp[$d][$l]))
				//	$final["aulas"][$d][]=$aulastemp[$d][$l];
			}
		}
	}
	
	//Retorna encodado em json
	return json_encode($final);	
}

//Função que retorna o dia.
function getDia($numero)
{
	switch ($numero)
	{
		case 1:
		{
			return "SEGUNDA";	
		}
		case 2:
		{
			return "TERÇA";	
		}
		case 3:
		{
			return "QUARTA";	
		}
		case 4:
		{
			return "QUINTA";	
		}
		case 5:
		{
			return "SEXTA";	
		}
	}
}

//Retorna o tipo correto pelo AJAX
if(isset($_POST["tipo"]))
{
	$tipo = $_POST["tipo"];
	if($tipo=="horario")
		echo gerarHorario($_POST["turma"]);
	else if($tipo=="sala")
		echo gerarSalas($_POST["curso"]);
}
?>