<?php
	include "verificar_login.php";
	include "ger_boletim.php";
	include "../info.php";
	
	$atual="boletim";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $info["nome_escola"]; ?> | Home</title>
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
                <li><a href="index.php">Alunos</a></li>
                <li class="active">Boletim</li>
            </ol>
            <?php
                $minimo=0;
				//Laço de repetição que pega os boletins de cada bimestre
                for($i=1;$i<=4;$i++)
                {
                    $resps[$i] = gerarBoletim($i);
                    if($resps[$i]<>"")
                        $minimo+=1;
                }
            ?>   
               
            <div class="boletim">
                <?php if($minimo>0) : ?>  
                <ul class="nav nav-tabs" role="tablist">
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[1]<>"") : ?><li role="presentation" class="active"><a href="#bim1" aria-controls="bim1" role="tab" data-toggle="tab">1º Bimestre</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[2]<>"") : ?><li role="presentation"><a href="#bim2" aria-controls="bim2" role="tab" data-toggle="tab">2º Bimestre</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[3]<>"") : ?><li role="presentation"><a href="#bim3" aria-controls="bim3" role="tab" data-toggle="tab">3º Bimestre</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[4]<>"") : ?><li role="presentation"><a href="#bim4" aria-controls="bim4" role="tab" data-toggle="tab">4º Bimestre</a></li><?php endif; ?>
                </ul>
                <div class="tab-content">
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[1]<>"") : ?><div role="tabpanel" class="tab-pane active" id="bim1"><?php echo $resps[1]; ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[2]<>"") : ?><div role="tabpanel" class="tab-pane" id="bim2"><?php echo $resps[2]; ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[3]<>"") : ?><div role="tabpanel" class="tab-pane" id="bim3"><?php echo $resps[3]; ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[4]<>"") : ?><div role="tabpanel" class="tab-pane" id="bim4"><?php echo $resps[4]; ?></div><?php endif; ?>
                </div>
                <?php else : ?>
                    <p style="text-align:center;">Nenhuma nota cadastrada.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php include("../footer.php"); ?>
<script src="../../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
</body>
</html>