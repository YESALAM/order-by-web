<?php
	include "verificar_login.php";
	include "ger_lista_presenca.php";
	include "../info.php";
	
	$atual="";
	
	$erros = array(1 => "Erro no banco de dados", 2 => "Senhas não conferem", 3 => "Senha(s) em branco.", 4 => "Senhas iguais.");
	//Verifica se há erros em algum processo anterior.
	$erro=(isset($_GET["erros"]) ? $erros[$_GET["motivo"]] : "");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $info["nome_escola"]; ?> | Perfil</title>
<link href="../../recursos/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../../recursos/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"  />
<link href="../css/index.css" rel="stylesheet"  />
<style type="text/css">
.notas-form .form-group
{
	margin-top:0;
	margin-bottom:15px;	
}
</style>
</head>

<body>
<?php include "navbar.php" ?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Início</a></li>
            <li class="active">Professores</li>
        </ol>
        <div class="notas-form">
			<?php
				//Verifica se houve algum processo anterior e imprime sua mensagem
                if(isset($_GET["sucesso"])):
                    if($_GET["sucesso"]=="true") :
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Senha mudada!</strong> Agora você já pode fazer login utilizando sua nova senha.
            </div>
            <?php
                    else :
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Erro ao mudar a senha!</strong> <?php echo $erro; ?>
            </div>
            <?php
                    endif;
                endif;
            ?>
            <div class="row">
                <div class="col-sm-6">
                    <form method="post" action="mudar_senha.php">
                        <div class="form-group">
                            <label>Senha atual</label>
                            <input type="password" name="atual" id="atual"  class="form-control"/>
                        </div>  
                        <div class="form-group">
                            <label>Nova senha</label>
                            <input type="password" name="nova" id="nova" class="form-control" />
                        </div> 
                        <div class="form-group">
                            <label>Confirmar senha</label>
                            <input type="password" name="confirmacao" id="confirmacao" class="form-control"/>
                        </div>  
                        <div class="form-group">
                            <button type="submit" class="btn btn-default pull-right">Confirmar</button>
                        </div>                     
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("../footer.php"); ?>
<script src="../../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
</body>
</html>