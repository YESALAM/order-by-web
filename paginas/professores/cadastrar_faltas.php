<?php
	include "../conexao.php";
	include "verificar_login.php";
	
	$sucesso=false;
	$sql="";
	
	for($i=0;$i<$_POST["quantfaltas"];$i++)
	{
		$res="";
		$sql="";
		$sql2="";
		if (isset($_POST["idfalta".($i+1)]))
		{
			if(isset($_POST["falta".($i+1)]))
			{
				if($_POST["falta".($i+1)]=="")
					$sql = "delete from faltas where idfalta=".$_POST["idfalta".($i+1)].";";
				else
					$sql = "update faltas set quantidade_falta=".$_POST["falta".($i+1)]." where idfalta=".$_POST["idfalta".($i+1)].";";
			}
		}
		else
		{
			if(isset($_POST["falta".($i+1)]))
				if($_POST["falta".($i+1)]!="")
					$sql = "insert into faltas values (null,".str_replace(",",".",$_POST["falta".($i+1)]).",".$_POST["mes"].",".$_POST["materia"].",'".$_POST["aluno".($i+1)]."','".$_POST["cpf_prof"]."');";
		}
		
		
		if($sql!="")
		{
			$res = mysqli_query($conexao,$sql);
			$sucesso = ($res ? true : false);
		}
		else
			$sucesso=true;

	}
	
	if($_POST["id_controle"]!="")
	{
		if(isset($_POST["aulasdadas"]) && isset($_POST["aulasprevistas"]))
		{
			if($_POST["aulasdadas"]=="" || $_POST["aulasprevistas"]=="")
				$sql2 = "delete from faltas_materias where id_falta=".$_POST["id_controle"].";";
			else
				$sql2 = "update faltas_materias set aulas_dadas=".$_POST["aulasdadas"].", aulas_pre=".$_POST["aulasprevistas"]." where id_falta=".$_POST["id_controle"].";";
		}
	}
	else
	{
		if(isset($_POST["aulasdadas"]) && isset($_POST["aulasprevistas"]))
		{
			if($_POST["aulasdadas"]!="" || $_POST["aulasprevistas"]!="")
			{
				$sql2 = "insert into faltas_materias values (null,".$_POST["materia"].",".$_POST["aulasdadas"].",".$_POST["aulasprevistas"].",".$_POST["mes"].");";
			}
		}
	}
		
	$res = mysqli_query($conexao,$sql2);
	$sucesso = ($sucesso && $res ? true : false);
	
	//echo $sql2;
	
	header("location: faltas.php?sucesso=".($sucesso ? "true" : "false"));
?>