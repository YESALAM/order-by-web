<?php 
	include "verificar_login.php";
	include "../info.php"; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $info["nome_escola"]; ?> | Carômetro</title>
<link href="../../recursos/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../../recursos/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"  />
<link href="../css/index.css" rel="stylesheet"  />
<style type="text/css">
table td, table th
{
	padding:1px 5px!important;	
}

table:first-of-type td
{
	text-align:left;	
	padding:0;
	font-size:12px;
}

table:nth-of-type(2) td p
{
	padding:0;
	margin:0;
	width:100%;
	height:20px;
	overflow:hidden;
}
</style>
</head>
<body style="text-align:center;padding:10px;margin:0;">
<?php
	
	include "../conexao.php";
	//Pega a turma através do método get
	$turma = $_GET["turma"];
	//Especifica a quantidade de colunas padrão, caso exista, pega do get.
	$colunas=(isset($_GET["colunas"]) ? $_GET["colunas"] : 6);
	$tamanho = 100/$colunas;
	//Faz uma query buscando pelas informações das turmas
	$res = mysqli_query($conexao,"select * from turmas where idturma=$turma limit 1;");
	//Pega os resultados em um vetor associativo
	$resultados = mysqli_fetch_assoc($res);
	
	//Faz outra query para buscar os alunos da turma especificada
	$res = mysqli_query($conexao,"select * from turmas_alunos, alunos where turmas_alunos.turmasidturma_ta=$turma and turmas_alunos.alunosrm_ta=alunos.rm_aluno order by alunos.nome_aluno asc;");
	$numero=0;
	$alunos = array();
	//Laço de repetição responsável por pegar os alunos da query.
	while($row = mysqli_fetch_array($res)) :
		$a = array();
		$a['rm']=$row["rm_aluno"];
		$a['numero']=sprintf("%03d",$numero++);
		$a['nome']=$row["nome_aluno"];
		$alunos[]=$a;
	endwhile;
?>
<table style="margin:0 auto 10px auto;">
	<tr>
    	<td rowspan="3" style="text-align:right;"><img src="../../fotos/site/logo_carometro.png" height="50" width="277"/></td>
        <td><b>ANO</b></td>
        <td><?php echo date("Y"); ?>
        <td><b>SEMESTRE</b></td>
        <td><?php echo (date("m")<=6 ? 1 : 2);?></td>
    </tr>
    <tr>
    	<td><b>CURSO</b></td>
        <td><?php echo $resultados["curso_turmas"]; ?>
        <td><b>PERÍODO</b></td>
        <td><?php echo $resultados["período_turmas"]; ?>
    </tr>
    <tr>
    	<td><b>SÉRIE</b></td>
        <td><?php echo $resultados["grau_turmas"]; ?>
        <td><b>TURMA</b></td>
        <td><?php echo $resultados["classe_turmas"]; ?>
    </tr>
    <tr>
    	<td colspan="5" style="text-align:center;"><b>Emitido em:</b> <?php echo date("d/m/Y") ?></td>
    </tr>
</table>


<table class="table table-condensed table-bordered" style="margin-bottom:10px;">
    <tbody>
		<?php 
			//Faz outra query para buscar os alunos da turma especificada
			$res = mysqli_query($conexao,"select * from turmas_alunos, alunos where turmas_alunos.turmasidturma_ta=$turma and turmas_alunos.alunosrm_ta=alunos.rm_aluno order by alunos.nome_aluno asc;");
			//Faz um arredondamento para descobrir o numero de linhas
			$quant = ceil(count($alunos) / $colunas) * $colunas;
			//Laço de repetição que imprime as linhas.
			for($i=0;$i<$quant;$i+=$colunas) : 
		?>
    	<tr>
        <?php 
			//Laço de repetição que imprime as fotos.
			for ($j=$i;$j<$i+$colunas;$j++) : ?>
        	<?php if ($j<count($alunos)) : ?>
            	<td width='<?php echo $tamanho ?>%'><img width='100px' height='100px' src='../thumbnail.php?id=<?php echo $alunos[$j]['rm']; ?>&tipo=alunos' /></td>
            <?php else : ?>
            	<td width='<?php echo $tamanho ?>%'></td>
            <?php endif; ?>
        <?php endfor; ?>
        </tr>
        
        <tr>       
        <?php 
			//Laço de repetição que imprime os nomes.
			for ($j=$i;$j<$i+$colunas;$j++) : ?>
        	<?php if ($j<count($alunos)) : ?>
            	<td width='<?php echo $tamanho ?>%'><p><?php echo $alunos[$j]['nome']; ?></p></td>
            <?php else : ?>
            	<td width='<?php echo $tamanho ?>%'></td>
            <?php endif; ?>
        <?php endfor; ?>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<center><b>Quantidade total de alunos:</b> <?php echo sprintf("%02d",mysqli_num_rows($res)); ?></center>
<?php if($colunas>=8) : ?>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>
<?php endif; ?>
<script src="../../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script type="text/javascript">
$(document).ready(function()
{
	window.print();
});
</script>
</body>
</html>