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
<title><?php echo $info["nome_escola"]; ?> | Gerador de Listas de Presença</title>
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
</style>
</head>
<body style="text-align:center;padding:10px;margin:0;">
<?php
	include "../conexao.php";
	$turma = $_GET["turma"];
	//Faz uma consulta buscando informações da turma.
	$res = mysqli_query($conexao,"select * from turmas where idturma=$turma limit 1;");
	//Pega os resultados da query.
	$resultados = mysqli_fetch_assoc($res);
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
	<thead>
		<tr>
        	<th width="70" style="text-align:center;">RM</th>
            <th width="70" style="text-align:center;">Número</th>
            <th>Nome</th>
            <th width="200" style="text-align:center;">Observações</th>
		</tr>
	</thead>
    <tbody>
    <?php 
	//Faz uma consulta para pegar os alunos da turma
	$res = mysqli_query($conexao,"select * from turmas_alunos, alunos where turmas_alunos.turmasidturma_ta=$turma and turmas_alunos.alunosrm_ta=alunos.rm_aluno order by turmas_alunos.numero_ta asc;");
	//Laço responsável por imprimir os alunos.
	while($row = mysqli_fetch_array($res)) : ?>
    	<tr>
        	<td><?php echo $row["rm_aluno"]; ?></td>
            <td><?php echo sprintf("%03d",$row["numero_ta"]); ?></td>
            <td style="text-align:left;"><?php echo $row["nome_aluno"]; ?></td>
            <td style="text-align:left;"><?php echo $row["situacao_ta"]; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<center><b>Quantidade total de alunos:</b> <?php echo sprintf("%02d",mysqli_num_rows($res)); ?></center>
<style type="text/css" media="print">
  @page { size: portrait; }
</style>
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