<?php
	include "../../paginas/conexao.php";
	//Especifica ao navegador o tipo de conteњdo da pсgina
	header("Content-Type: image/png");
	//Pega o id do mщtodo get
	$id = $_GET["id"];
	//Pega o tipo do mщtodo get
	$tipo = $_GET["tipo"];
	
	//Verifica a variсvel $thumb, se estс disponэvel e pega pelo mщtodo get
	$thumb = (isset($_GET["thumb"]) ? $_GET["thumb"] : "true");
	
	//Query que faz a busca na tabela especificada
	$q = mysqli_query($conexao,"select * from $tipo where ".($tipo=="alunos" ? "rm_aluno" : "id_noticia")."='$id' limit 1;");
	//Pega o retorno
	$res = mysqli_fetch_assoc($q);
	
	//Se o retorno nуo for vazio, imprime a imagem do campo blob de cada tabela
	if(!empty($res[($tipo=="alunos" ? "foto_aluno" : "imagem_noticia")]))
	{
		//Verifica se nуo щ thumbnail ou se щ "alunos"
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
			//Calcula a nova altura, com base em proporчуo
			$newheight=($height/$width)*$newwidth;
			//Cria uma imagem vazia para thumbnail
			$thumb = imagecreatetruecolor($newwidth,$newheight);
			
			//Redimensiona a imagem original e coloca na thumbnail
			imagecopyresampled($thumb,$img,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			//Verifica se a imagem estс na horizontal ou vertical
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
	//Caso contrсrio, exibe a imagem padrуo.
	else
	{
		//Verifica se nуo щ thumbnail ou se щ "alunos"
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
			//Calcula a nova altura, com base em proporчуo
			$newheight=($height/$width)*$newwidth;
			//Cria uma imagem vazia para thumbnail
			$thumb = imagecreatetruecolor($newwidth,$newheight);
			
			//Redimensiona a imagem original e coloca na thumbnail
			imagecopyresampled($thumb,$img,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			//Verifica se a imagem estс na horizontal ou vertical
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