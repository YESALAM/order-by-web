<?php
	include "ger_horario.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ETEC "Lauro Gomes" | Horário de Aula</title>
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
	$res = mysqli_query($conexao,"select * from turmas where idturma=$turma limit 1;");
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
        	<th width="100" style="text-align:center;">HORÁRIO</th>
            <th style="text-align:center;" colspan="3">SEGUNDA-FEIRA</th>
            <th style="text-align:center;" colspan="3">TERÇA-FEIRA</th>
            <th style="text-align:center;" colspan="3">QUARTA-FEIRA</th>
            <th style="text-align:center;" colspan="3">QUINTA-FEIRA</th>
            <th style="text-align:center;" colspan="3">SEXTA-FEIRA</th>
		</tr>
        <tr>
        	<th></th>
            <th style="text-align:center;">DISC</th>
            <th style="text-align:center;">PROF</th>
            <th style="text-align:center;">SALA</th>
            <th style="text-align:center;">DISC</th>
            <th style="text-align:center;">PROF</th>
            <th style="text-align:center;">SALA</th>
            <th style="text-align:center;">DISC</th>
            <th style="text-align:center;">PROF</th>
            <th style="text-align:center;">SALA</th>
            <th style="text-align:center;">DISC</th>
            <th style="text-align:center;">PROF</th>
            <th style="text-align:center;">SALA</th>
            <th style="text-align:center;">DISC</th>
            <th style="text-align:center;">PROF</th>
            <th style="text-align:center;">SALA</th>
        </tr>
	</thead>
    <tbody>
    <?php 
	$horario = json_decode(gerarHorario($turma));
	//print ($horario);
	for($i=0;$i<count($horario->horarios);$i++) :
	?>
    	<tr>
        	<td><b><?php echo substr($horario->horarios[$i]->inicio,0,-3); ?> - <?php echo substr($horario->horarios[$i]->fim,0,-3); ?></b></td><td><?php echo (isset($horario->aulas->SEGUNDA[$i]) ? $horario->aulas->SEGUNDA[$i]->materia : ""); ?></td><td><?php echo (isset($horario->aulas->SEGUNDA[$i]) ? implode("/",$horario->aulas->SEGUNDA[$i]->professores) : "");?></td><td><?php echo (isset($horario->aulas->SEGUNDA[$i]) ? $horario->aulas->SEGUNDA[$i]->sala : ""); ?></td><td><?php echo (isset($horario->aulas->TERÇA[$i]) ? $horario->aulas->TERÇA[$i]->materia : ""); ?></td><td><?php echo (isset($horario->aulas->TERÇA[$i]) ? implode("/",$horario->aulas->TERÇA[$i]->professores) : "");?></td><td><?php echo (isset($horario->aulas->TERÇA[$i]) ? $horario->aulas->TERÇA[$i]->sala : ""); ?></td><td><?php echo (isset($horario->aulas->QUARTA[$i]) ? $horario->aulas->QUARTA[$i]->materia : ""); ?></td><td><?php echo (isset($horario->aulas->QUARTA[$i]) ? implode("/",$horario->aulas->QUARTA[$i]->professores) : "");?></td><td><?php echo (isset($horario->aulas->QUARTA[$i]) ? $horario->aulas->QUARTA[$i]->sala : ""); ?></td><td><?php echo (isset($horario->aulas->QUINTA[$i]) ? $horario->aulas->QUINTA[$i]->materia : ""); ?></td><td><?php echo (isset($horario->aulas->QUINTA[$i]) ? implode("/",$horario->aulas->QUINTA[$i]->professores) : "");?></td><td><?php echo (isset($horario->aulas->QUINTA[$i]) ? $horario->aulas->QUINTA[$i]->sala : ""); ?></td><td><?php echo (isset($horario->aulas->SEXTA[$i]) ? $horario->aulas->SEXTA[$i]->materia : ""); ?></td><td><?php echo (isset($horario->aulas->SEXTA[$i]) ? implode("/",$horario->aulas->SEXTA[$i]->professores) : "");?></td><td><?php echo (isset($horario->aulas->SEXTA[$i]) ? $horario->aulas->SEXTA[$i]->sala : ""); ?></td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>
<style type="text/css" media="print">
  @page { size: landscape; }
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