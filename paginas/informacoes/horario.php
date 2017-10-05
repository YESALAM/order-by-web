<?php
	session_start();
	session_destroy();
	
	$informacoes = true;
	include "../info.php";
	include "ger_horario.php";
	
	$modo = "aluno";
	$atual = "servicosalunos";
	
	if(isset($_GET["modo"]))
		$modo = $_GET["modo"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $info["nome_escola"]; ?> | Horário de Aula</title>
<link href="../../recursos/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../../recursos/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"  />
<link href="../css/index.css" rel="stylesheet"  />
</head>

<body>
<?php include ("../navbar.php"); ?>
<div class="page-row page-row-expanded">
    <div class="container">
    	<ol class="breadcrumb">
            <li><a href="#">Início</a></li>
            <li><a href="#">Serviços / Alunos</a></li>
            <li class="active">Horário de Aula</li>
        </ol>
    	<div class="notas-form">
        	<div class="row">
            	<div class="col-sm-6">
                    <div class="form-group">
                        <label for="sala" class="control-label">Curso</label>
                        <?php echo gerarCursos(); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group" id="sala">
                        <label for="sala" class="control-label">Turma</label>
                        <select name="sala" id="salas-select" class="form-control" disabled>
                        	<option value="selecionar"></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="alunos" class="notas-form sem-borda-total sem-borda" style="display: none;"></div>
        <div class="notas-form" id="acoes" style="display: none;">
            <button type="button" class="btn btn-default" id="imprimir"><i class="fa fa-print"></i> Imprimir</button>
        </div>
    </div>
</div>
<?php include ("../footer.php"); ?>
<script src="../../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="../../recursos/jquery.mask.js" type="text/javascript"></script>
<script src="../js/index.js"></script>
<script src="js/horario.js" type="text/javascript"></script>
</body>
</html>