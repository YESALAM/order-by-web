<?php
	include "verificar_login.php";
	include "../conexao.php";
	include "../info.php";
	
	$atual="";
	
	//Query que faz a busca do rm do aluno na sessão e pega a turma e outras informações.
	$res = mysqli_query($conexao,"select * from turmas_alunos,turmas, alunos where turmas_alunos.turmasidturma_ta=turmas.idturma and turmas_alunos.alunosrm_ta='".$_SESSION["aluno_rm"]."' and turmas_alunos.alunosrm_ta=alunos.rm_aluno and turmas_alunos.situacao_ta='' limit 1;");
	//Pega o resultado da query.
	$aluno = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $info["nome_escola"]; ?> | Alunos</title>
<link href="../../recursos/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../../recursos/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"  />
<link href="../css/index.css" rel="stylesheet"  />
</head>

<body>
<?php include "navbar.php" ?>
    <div class="page-row page-row-expanded">
    	<div class="container">
            <ol class="breadcrumb">
                <li><a href="logoff.php">Início</a></li>
                <li class="active">Alunos</li>
            </ol>
            <div class="notas-form">
                <div class="row">
                    <div class="col-sm-6">
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td width="100" rowspan="3"><div class="imagem hidden-xs" style="width:140px;height:140px;background-image:url('../thumbnail.php?tipo=alunos&id=<?php echo $_SESSION["aluno_rm"]; ?>');"></div></td>
                                    <td style="text-align:center;"><h3 style="padding:0;margin:0;"><?php echo $aluno["nome_aluno"]; ?></h3></td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul class="user-information-topics">
                                            <li><i class="fa fa-users"></i> <?php echo $aluno["grau_turmas"].$aluno["classe_turmas"]; ?></li>
                                            <li><i class="fa fa-book"></i> <?php echo $aluno["curso_turmas"]; ?></li>
                                            <li><i class="fa fa-clock-o"></i> <?php echo $aluno["período_turmas"]; ?></li>
                                            <li><i class="fa fa-calendar"></i> <?php echo (date("m")>6 ? "2" : "1")."º semestre - ".date("Y"); ?></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <?php include "propaganda_alunos.php" ?>
                    </div>			
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="boletim.php" class="btn btn-default btn-block">Boletim</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="faltas.php" class="btn btn-default btn-block">Faltas</a>
                    </div>
                </div>
            </div>
        </div>
   	</div>
<?php include("../footer.php"); ?>
<script src="../../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
</body>
</html>