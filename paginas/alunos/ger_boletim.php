<?php
include "../conexao.php";

function gerarBoletim($bim)
{
	global $conexao;
	$a="";
	//Faz uma query para buscar as notas
	$res = mysqli_query($conexao,"select * from notas, materias, professores where notas.materiasidmateria_nota=materias.idmateria and notas.cpfprof_notas=professores.cpf_professores and notas.alunosrm_nota='".$_SESSION["aluno_rm"]."' and notas.bimestre_nota=".$bim." order by materias.nome_materias asc;");
	//Verifica se há resultados
	if(mysqli_num_rows($res)>0)
	{
		$a.='<table class="table table-striped" style="margin:0;padding:0;">
				<thead>
					<th>Nome da disciplina</th>
					<th>Professor</th>
					<th style="text-align:center;">Sigla</th>
					<th style="text-align:center;">Nota</th>
				</thead>
				<tbody>';
		//Laço que adiciona conteúdo na tabela
		while($row = mysqli_fetch_array($res))
		{
			$a.='<tr>
					<td>'.$row["nome_materias"].'</td>
					<td>'.$row["nome_professores"].'</td>
					<td align="center">'.$row["sigla_materias"].'</td>
					<td align="center">'.strtoupper($row["nota_nota"]).'</td>
				  </tr>';
		}
		$a.='	</tbody>
			  </table>';
	}
	
	//Retorna a tabela pronta.
	return $a;
}

function gerarFaltas($mes)
{
	global $conexao;
	$a="";
	//Faz uma query para buscar as faltas
	$res = mysqli_query($conexao,"select * from faltas, materias, professores, faltas_materias where faltas.materiasidmateria_falta=materias.idmateria and faltas_materias.materiaidmateria=materias.idmateria and faltas_materias.mes_mf=$mes and faltas.cpfprof_falta=professores.cpf_professores and faltas.alunosrm_falta='".$_SESSION["aluno_rm"]."' and faltas.mes_falta=".$mes." order by materias.nome_materias asc;");
	
	//Verifica se há resultados
	if(mysqli_num_rows($res)>0)
	{
		$a.='<table class="table table-striped" style="margin:0;padding:0;">
				<thead>
					<th>Nome da disciplina</th>
					<th>Professor</th>
					<th style="text-align:center;">Sigla</th>
					<th style="text-align:center;">Faltas</th>
					<th style="text-align:center;">Aulas dadas</th>
				</thead>
				<tbody>';
		//Laço que adiciona conteúdo na tabela
		while($row = mysqli_fetch_array($res))
		{
			$a.='<tr>
					<td>'.$row["nome_materias"].'</td>
					<td>'.$row["nome_professores"].'</td>
					<td align="center">'.$row["sigla_materias"].'</td>
					<td align="center">'.$row["quantidade_falta"].'</td>
					<td align="center">'.$row["aulas_dadas"].'</td>
				  </tr>';
		}
		$a.='	</tbody>
			  </table>';
	}
	
	//Retorna a tabela pronta.
	return $a;
}

function gerarTotal()
{
	global $conexao;
	
	$total_aulas=0;
	$total_faltas=0;
	
	$a="";
	
	//Laço que vai de Janeiro ao mês atual
	for($i=1;$i<=date('m');$i++)
	{
		//Faz uma query buscando as faltas do determinado mês.
		$res = mysqli_query($conexao,"select * from faltas, materias, professores, faltas_materias where faltas.materiasidmateria_falta=materias.idmateria and faltas_materias.materiaidmateria=materias.idmateria and faltas_materias.mes_mf=$i and faltas.cpfprof_falta=professores.cpf_professores and faltas.alunosrm_falta='".$_SESSION["aluno_rm"]."' and faltas.mes_falta=$i order by materias.nome_materias asc;");	
		//Verifica se há resposta
		if($res)
		{
			//Laço que incrementa as variáveis de controle
			while($row = mysqli_fetch_array($res))
			{
				$total_aulas+=$row["aulas_dadas"];
				$total_faltas+=$row["quantidade_falta"];
			}
		}
	}
	
	//Verifica se há aulas
	if($total_aulas>0)
	{
		//Calcula e retorna a porcentagem das faltas.
		$a = number_format(($total_faltas/$total_aulas)*100,2)."%";
	}
	
	//Retorna o total
	return $a;
}
?>