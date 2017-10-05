<?php
	include "verificar_login.php";
	include "ger_notas.php";
	include "../info.php";
	
	$atual="notas";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $info["nome_escola"]; ?> | Cadastro de Notas</title>
<link href="../../recursos/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../../recursos/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"  />
<link href="../css/index.css" rel="stylesheet"  />
</head>

<body>
<?php include "navbar.php" ?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Início</a></li>
            <li><a href="#">Professores</a></li>
            <li class="active">Cadastramento de notas</li>
        </ol>
        <form id="form-notas" method="post" action="cadastrar_notas.php" onsubmit="return ValidarTudo();">
        <div class="notas-form">
        <?php
			//Verifica se há algum processo anterior e imprime a mensagem específica.
			if(isset($_GET["sucesso"])):
				if($_GET["sucesso"]=="true") :
		?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
            </button>
            <strong>Notas cadastradas!</strong>
        </div>
        <?php
				else :
		?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
            </button>
            <strong>Erro ao cadastrar!</strong> Favor tentar novamente...
        </div>
        <?php
				endif;
			endif;
		?>
        <input type="hidden" name="cpf_prof" id="cpf_prof" value="<?php echo $_SESSION["professor_cpf"] ?>"  />
         	<div class="row">
            	<div class="col-sm-6">
                    <div class="form-group">
                        <label for="sala" class="control-label">Curso</label>
                        <?php echo gerarCursos($_SESSION["professor_cpf"]); ?>
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
                <div class="col-sm-6">
                    <div class="form-group" id="materia">
                        <label for="materias" class="control-label">Matéria</label>
                        <select name="materia" id="materias-select" class="form-control" disabled>
                        	<option value="selecionar"></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group" id="bimestre">
                        <label for="materias" class="control-label">Bimestre</label>
                        <select name="bimestre" id="bimestre-select" class="form-control" disabled>
                        	<option value="selecionar"></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="alunos" class="notas-form sem-borda" style="display: none;"></div>
        <div class="notas-form" id="btenviar" style="display: none;text-align:right;">
        	
            <button type="button" class="btn btn-default" id="limpar">Limpar</button>
			<button type="button" class="btn btn-default" id="excel" data-toggle="modal" data-target="#modalExcel">Colar do Excel</button>
			<button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        </form>
    </div>
	
<!-- Modal -->
<div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Importar do Excel</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label>Notas do Excel</label>
			<textarea class="form-control" style="text-align:center;" id="notasExcel" rows="40"></textarea>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="okExcel">OK</button>
      </div>
    </div>
  </div>
</div>
<?php include("../footer.php"); ?>
<script src="../../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="js/notas.js" type="text/javascript"></script>
</body>
</html>