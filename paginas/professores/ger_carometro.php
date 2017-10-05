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
	
	$a = array();
	$final = array();
	
	//Faz a query para buscar os alunos da turma especificada
	$res = mysqli_query($conexao,"select * from turmas_alunos, alunos where turmas_alunos.turmasidturma_ta=".$turma." and turmas_alunos.alunosrm_ta=alunos.rm_aluno order by turmas_alunos.numero_ta asc;");
	
	//Laço responsável por adicionar os resultados no json
	while($row = mysqli_fetch_array($res))
	{
			$aluno['nome'] = $row["nome_aluno"];
			$aluno['rm'] = $row["rm_aluno"];
			$aluno['numero'] = sprintf("%03d", $row["numero_ta"]);
			$a[]=$aluno;
			
			$numero++;
	}
	
	$final['quant']=mysqli_num_rows($res);
	$final['alunos']=$a;
	
	//Encoda json e retorna.
	return json_encode($final);	
}

//Função responsável por gerar o html do carometro
function gerarCarometro($turma,$colunas)
{
	global $conexao;
	
	//Faz a query para buscar os alunos da turma especificada
	$res = mysqli_query($conexao,"select * from turmas_alunos, alunos where turmas_alunos.turmasidturma_ta=$turma and turmas_alunos.alunosrm_ta=alunos.rm_aluno and turmas_alunos.situacao_ta='' order by turmas_alunos.numero_ta asc;");
	$alunos = array();
	//Laço responsável por adicionar os resultados no array
	while($row = mysqli_fetch_array($res)) :
		$b = array();
		$b['rm']=$row["rm_aluno"];
		$b['numero']=sprintf("%03d",$row["numero_ta"]);
		$b['nome']=$row["nome_aluno"];
		$alunos[]=$b;
	endwhile;
	
	$a="";
	$tamanho = 100/$colunas;
	//Verifica se há alunos
	if(count($alunos)>0)
	{
		$a .= '<table class="table table-condensed table-bordered" style="margin-bottom:10px;">
				   <tbody>';
		//Arredonda e descobre a quantidade de linhas.
		$quant = ceil(count($alunos) / $colunas) * $colunas;
		//Laço de repetição que imprime as linhas.
		for($i=0;$i<$quant;$i+=$colunas) : 
			$a.="<tr>";
			//Laço de repetição que imprime as fotos.
			for ($j=$i;$j<$i+$colunas;$j++) :
				if ($j<count($alunos)) : 
					$a.="<td width='$tamanho%'><img width='100px' height='100px' src='../thumbnail.php?id=".$alunos[$j]['rm']."&tipo=alunos' /></td>";
				else : 
					$a.="<td width='$tamanho%'></td>";
				endif;
			endfor;
			$a.="</tr><tr>";     
			//Laço de repetição que imprime os nomes.			
			for ($j=$i;$j<$i+$colunas;$j++) :
				if ($j<count($alunos)) :
					$a.="<td width='$tamanho%'>".$alunos[$j]['nome']."</td>";
				else : 
					$a.="<td width='$tamanho%'></td>";
				endif; 
			endfor;
			$a.="</tr>";
		endfor;
	   $a.="</tbody></table>";
	}
	
	return $a;
}


if(isset($_POST["tipo"]))
{
	//Verifica e retorna a informação pedida por ajax.
	$tipo = $_POST["tipo"];
	if($tipo=="alunos")
		echo gerarAlunos($_POST["turma"]);
	else if($tipo=="sala")
		echo gerarSalas($_POST["curso"]);
	else if($tipo=="carometro")
		echo gerarCarometro($_POST["turma"],$_POST["colunas"]);
}
?>