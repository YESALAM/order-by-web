<?php
	include "verificar_login.php";
	include "ger_boletim.php";
	include "../info.php";
	
	$atual="faltas";
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
                <li class="active">Faltas</li>
            </ol>
            <?php
                $minimo=0;
				//Laço de repetição que pega as faltas de cada mês
                for($i=1;$i<=12;$i++)
                {
                    $resps[$i] = gerarFaltas($i);
                    if($resps[$i]<>"")
                        $minimo+=1;
                }
            ?>   
               
            <div class="boletim">
                <?php if($minimo>0) : ?>  
                <ul class="nav nav-tabs" role="tablist" id="nav-meses">
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[1]<>"") : ?><li role="presentation" class="active"><a href="#mes1" aria-controls="mes1" role="tab" data-toggle="tab">Janeiro</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[2]<>"") : ?><li role="presentation"><a href="#mes2" aria-controls="mes2" role="tab" data-toggle="tab">Fevereiro</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[3]<>"") : ?><li role="presentation"><a href="#mes3" aria-controls="mes3" role="tab" data-toggle="tab">Março</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[4]<>"") : ?><li role="presentation"><a href="#mes4" aria-controls="mes4" role="tab" data-toggle="tab">Abril</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[5]<>"") : ?><li role="presentation"><a href="#mes5" aria-controls="mes5" role="tab" data-toggle="tab">Maio</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[6]<>"") : ?><li role="presentation"><a href="#mes6" aria-controls="mes6" role="tab" data-toggle="tab">Junho</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[7]<>"") : ?><li role="presentation"><a href="#mes7" aria-controls="mes7" role="tab" data-toggle="tab">Julho</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[8]<>"") : ?><li role="presentation"><a href="#mes8" aria-controls="mes8" role="tab" data-toggle="tab">Agosto</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[9]<>"") : ?><li role="presentation"><a href="#mes9" aria-controls="mes9" role="tab" data-toggle="tab">Setembro</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[10]<>"") : ?><li role="presentation"><a href="#mes10" aria-controls="mes10" role="tab" data-toggle="tab">Outubro</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[11]<>"") : ?><li role="presentation"><a href="#mes11" aria-controls="mes11" role="tab" data-toggle="tab">Novembro</a></li><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[12]<>"") : ?><li role="presentation"><a href="#mes12" aria-controls="mes12" role="tab" data-toggle="tab">Dezembro</a></li><?php endif; ?>
                </ul>
                <div class="tab-content">
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[1]<>"")  : ?><div role="tabpanel" class="tab-pane active" id="mes1"><?php echo $resps[1]; ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[2]<>"")  : ?><div role="tabpanel" class="tab-pane" id="mes2"><?php echo $resps[2];  ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[3]<>"")  : ?><div role="tabpanel" class="tab-pane" id="mes3"><?php echo $resps[3];  ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[4]<>"")  : ?><div role="tabpanel" class="tab-pane" id="mes4"><?php echo $resps[4];  ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[5]<>"")  : ?><div role="tabpanel" class="tab-pane" id="mes5"><?php echo $resps[5];  ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[6]<>"")  : ?><div role="tabpanel" class="tab-pane" id="mes6"><?php echo $resps[6];  ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[7]<>"")  : ?><div role="tabpanel" class="tab-pane" id="mes7"><?php echo $resps[7];  ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[8]<>"")  : ?><div role="tabpanel" class="tab-pane" id="mes8"><?php echo $resps[8];  ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[9]<>"")  : ?><div role="tabpanel" class="tab-pane" id="mes9"><?php echo $resps[9];  ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[10]<>"") : ?><div role="tabpanel" class="tab-pane" id="mes10"><?php echo $resps[10]; ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[11]<>"") : ?><div role="tabpanel" class="tab-pane" id="mes11"><?php echo $resps[11]; ?></div><?php endif; ?>
                    <?php /* Verifica em cada caso se há resposta e imprime. */ if($resps[12]<>"") : ?><div role="tabpanel" class="tab-pane" id="mes12"><?php echo $resps[12]; ?></div><?php endif; ?>
                </div>
                <?php else : ?>
                    <p style="text-align:center;">Nenhuma falta cadastrada.</p>
                <?php endif; ?>
            </div>
            <?php
				//Verifica se há respostas e gera o total de faltas.
				if($resps[1]!="" && gerarTotal()!="") : ?>
            	<div class="notas-form" style="text-align:center";>
                	Porcentagem global de faltas: <?php echo gerarTotal() ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php include("../footer.php"); ?>
<script src="../../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
</body>
</html>