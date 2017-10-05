<?php
//Especifica ao navegador o tipo de conteúdo da página
header("Content-Type: application/json");

//Função que retorna o dia da semana para acesso nos resultados do banco de dados
function getDia($numero)
{
	$dias = array('1'=>"SEGUNDA",'2'=>"TERÇA",'3'=>"QUARTA",'4'=>"QUINTA",'5'=>"SEXTA");
	return $dias[$numero];
}

	include "../../paginas/conexao.php";

	$turma = $_GET["turma"];
	$add = (isset($_GET["dia"]) ? "and aula.dia_aula='".getDia($_GET["dia"])."'" : "");
	$quant=5;
	$success=false;
	$motivo="";

	$final = array();
	
	//Realiza a consulta no banco de dados em procura dos horários da turma
	$res = mysqli_query($conexao,"select * from aula, materias where aula.turmasidturma_aula=$turma $add and aula.materiasidmateria_aula=materias.idmateria order by aula.inicio_aula asc;");
	
	//Verifica se não houve erros
	if($res)
	{
		//Verifica se houve resultados na query
		if(mysqli_num_rows($res)>0)
		{
			$success=true;
			//Laço de repetição que pega cada linha dos resultados e atribui nas variáveis
			while($row = mysqli_fetch_array($res))
			{
				$aula = array();
				$aula["id"] = $row["idaula_aula"];
				$aula["sala"] = $row["salasidsala_aula"];
				
				$materia["sigla"] = $row["sigla_materias"];
				$materia["nome"] = $row["nome_materias"];
				$aula["materia"] = $materia;
				$aula["inicio"]=substr($row["inicio_aula"],0,-3);
				$aula["fim"]=substr($row["fim_aula"],0,-3);
				$final["aulas"][$row["dia_aula"]][] = $aula;
			}
			
			//Realiza a consulta no banco de dados em procura dos professores das aulas
			$res = mysqli_query($conexao,"select * from aulas_professores, professores where professores.cpf_professores=aulas_professores.professorescpf_ap;");
			
			//Laço de repetição que percorre cada linha dos resultados
			while($row = mysqli_fetch_array($res))
			{
				//Verifica se o horário busca por um dia específico
				if($add=="")
				{
					//Laço de repetição que percorre os cinco dias úteis
					for($j=1;$j<=5;$j++)
					{
						$dia = getDia($j);
						if(isset($final["aulas"][$dia]))
						{
							//Laço que percorre todas as aulas do dia
							for($i=0;$i<count($final["aulas"][$dia]);$i++)
							{
								//Procura pela aula específica pelo ID, e se for atribui os professores.
								if($row["aulasidaula_ap"]==$final["aulas"][$dia][$i]["id"])
								{
									$final["aulas"][$dia][$i]["professores"][]=$row["sigla_professores"];
								}
							}
						}
					}
				}
				else
				{
						$dia = getDia($_GET["dia"]);
						//Laço que percorre todas as aulas do dia
						for($i=0;$i<count($final["aulas"][$dia]);$i++)
						{
							//Procura pela aula específica pelo ID, e se for atribui os professores.
							if($row["aulasidaula_ap"]==$final["aulas"][$dia][$i]["id"])
							{
								$final["aulas"][$dia][$i]["professores"][]=$row["sigla_professores"];
							}
						}
				}
			}
			
			//Realiza a consulta no banco de dados em procura do horário da turma
			$res = mysqli_query($conexao,"select * from horario_turma where idturma_t=$turma and tipo_horario_t<>'Intervalo' order by entrada_horario_t asc;");
			
			//Laço de repetição que percorre cada linha dos resultados e atribui nas variáveis
			while($row = mysqli_fetch_array($res))
			{
				$horario = array();
				$horario["inicio"] = substr($row["entrada_horario_t"],0,-3);
				$horario["fim"] = substr($row["saida_horario_t"],0,-3);
				
				$final["horarios"][]=$horario;
			}
		}
		else
		{
			$motivo="Nenhum horário cadastrado";
		}
	}
	else
	{
		$motivo = "Erro no banco de dados";
	}
	
	if($success)
		$final["success"] = $success;
	else
	{
		$final["success"] = $success;
		$final["motivo"] = $motivo;
	}
	
	//Imprime o json gerado a partir dos vetores associativos
	echo json_encode($final);	
	//Finaliza a conexão.
	mysqli_close($conexao);
?>