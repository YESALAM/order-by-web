<?php
	include "../conexao.php";
	include "verificar_login.php";
	
	$sucesso=false;
	$sql="";
	
	for($i=0;$i<$_POST["quantnotas"];$i++)
	{
		$res="";
		$sql="";
		if (isset($_POST["idnota".($i+1)]))
		{
			if(isset($_POST["nota".($i+1)]))
			{
				if($_POST["nota".($i+1)]=="")
					$sql = "delete from notas where idnota=".$_POST["idnota".($i+1)].";";
				else
					$sql = "update notas set nota_nota='".strtoupper($_POST["nota".($i+1)])."' where idnota=".$_POST["idnota".($i+1)].";";
			}
		}
		else
		{
			if(isset($_POST["nota".($i+1)]))
				if($_POST["nota".($i+1)]!="")
					$sql = "insert into notas values (null,'".strtoupper($_POST["nota".($i+1)])."',".$_POST["bimestre"].",'".$_POST["aluno".($i+1)]."','".$_POST["cpf_prof"]."',".$_POST["materia"].");";
		}
		
		if($sql!="")
		{
			$res = mysqli_query($conexao,$sql);
			$sucesso = ($res ? true : false);
		}
		else
			$sucesso=true;

	}
	
	header("location: notas.php?sucesso=".($sucesso ? "true" : "false"));
?>