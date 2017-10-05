<?php
	include "../../paginas/conexao.php";
	//Especifica ao navegador o tipo de conte�do da p�gina
	header("Content-Type: image/png");
	//Pega o id do m�todo get
	$id = $_GET["id"];
	//Pega o tipo do m�todo get
	$tipo = $_GET["tipo"];
	
	//Verifica a vari�vel $thumb, se est� dispon�vel e pega pelo m�todo get
	$thumb = (isset($_GET["thumb"]) ? $_GET["thumb"] : "true");
	
	//Query que faz a busca na tabela especificada
	$q = mysqli_query($conexao,"select * from $tipo where ".($tipo=="alunos" ? "rm_aluno" : "id_noticia")."='$id' limit 1;");
	//Pega o retorno
	$res = mysqli_fetch_assoc($q);
	
	//Se o retorno n�o for vazio, imprime a imagem do campo blob de cada tabela
	if(!empty($res[($tipo=="alunos" ? "foto_aluno" : "imagem_noticia")]))
	{
		//Verifica se n�o � thumbnail ou se � "alunos"
		if($thumb=="false" || $thumb==false || $tipo=="alunos")
			echo $res[($tipo=="alunos" ? "foto_aluno" : "imagem_noticia")];
		else
		{
			//Cria uma imagem do retorno do banco de dados
			$img = imagecreatefromstring($res["imagem_noticia"]);
			//Pega a largura
			$width = imagesx($img);
			//Pega a altura
			$height = imagesy($img);
			$newwidth=300;
			//Calcula a nova altura, com base em propor��o
			$newheight=($height/$width)*$newwidth;
			//Cria uma imagem vazia para thumbnail
			$thumb = imagecreatetruecolor($newwidth,$newheight);
			
			//Redimensiona a imagem original e coloca na thumbnail
			imagecopyresampled($thumb,$img,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			//Verifica se a imagem est� na horizontal ou vertical
			if($width>$height)
			{
				//Cria uma imagem vazia para a thumbnail final
				$thumbfinal = imagecreatetruecolor($newheight,$newheight);
				//Corta a imagem e centraliza
				imagecopy($thumbfinal,$thumb,0,0,($newwidth-$newheight)/2,0,$newheight,$newheight);	
			}
			else
			{
				//Cria uma imagem vazia para a thumbnail final
				$thumbfinal = imagecreatetruecolor($newwidth,$newwidth);
				//Corta a imagem e centraliza
				imagecopy($thumbfinal,$thumb,0,0,0,($newheight-$newwidth)/2,$newwidth,$newwidth);	
			}
			
			//"Imprime" a imagem gerada
			imagepng($thumbfinal);
		}
	}
	//Caso contr�rio, exibe a imagem padr�o.
	else
	{
		//Verifica se n�o � thumbnail ou se � "alunos"
		if($thumb=="false" || $thumb==false || $tipo=="alunos")
			readfile("../../fotos/".($tipo=="alunos" ? "carometro" : "noticias")."/default.jpg");
		else
		{
			$arquivo = "../../fotos/noticias/default.jpg";
			//Cria uma imagem da presente na pasta
			$img = imagecreatefromjpeg($arquivo);
			//Pega a altura e largura
			list($width, $height) = getimagesize($arquivo);
			$newwidth=300;
			//Calcula a nova altura, com base em propor��o
			$newheight=($height/$width)*$newwidth;
			//Cria uma imagem vazia para thumbnail
			$thumb = imagecreatetruecolor($newwidth,$newheight);
			
			//Redimensiona a imagem original e coloca na thumbnail
			imagecopyresampled($thumb,$img,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			//Verifica se a imagem est� na horizontal ou vertical
			if($width>$height)
			{
				//Cria uma imagem vazia para a thumbnail final
				$thumbfinal = imagecreatetruecolor($newheight,$newheight);
				//Corta a imagem e centraliza
				imagecopy($thumbfinal,$thumb,0,0,($newwidth-$newheight)/2,0,$newheight,$newheight);	
			}
			else
			{
				//Cria uma imagem vazia para a thumbnail final
				$thumbfinal = imagecreatetruecolor($newwidth,$newwidth);
				//Corta a imagem e centraliza
				imagecopy($thumbfinal,$thumb,0,0,0,($newheight-$newwidth)/2,$newwidth,$newwidth);	
			}
			
			//"Imprime" a imagem gerada
			imagepng($thumbfinal);
		}
	}
?>