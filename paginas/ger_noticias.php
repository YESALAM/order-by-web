<?php
	include "conexao.php";
	include "info.php";
			
	//Fun��o respons�vel por gerar as not�cias e retornar um json com as mesmas, de acordo com a p�gina especificada
	function gerarNoticias($pagina)
	{
		$retorno = array();
		//Faz a query no banco de dados, de acordo com a p�gina especificada
		$res = mysql_query("select * from noticias order by id_noticias desc limit ".($pagina*$info["quantidade_noticias_normais"]).",".$info["quantidade_noticias_normais"].";",$conexao);
		//Verifica se h� resultados
		if(mysql_num_rows($res)>0)
		{
			$sucesso=true;
			$noticias = array();
			//La�o de repeti��o que atribui ao vetor $noticias cada not�cia resultada da query
			while($row = mysql_fetch_array($res))
			{
				$noticia = array("link" => "noticia.php?noticia=".$row["id_noticia"], "titulo" => $row["titulo_noticia"], "conteudo"=>(strlen(strip_tags($row["conteudo_noticia"],"<a>"))>200 ? substr(strip_tags($row["conteudo_noticia"]),0,200)."..." : strip_tags($row["conteudo_noticia"],"<a>")));
				$noticias["noticias"][]=$noticia;
			}
		}
		else
			$sucesso=false;
			
		//Especifica se houve sucesso na requisi��o
		$noticias["sucesso"]=$sucesso;
		//Encoda o array em json e retorna, no formato string
		return json_encode($noticias);
	}
	
	if(isset($_POST))
	{
		//Verifica cada tipo existente e retorna o desejado.
		if($_POST["tipo"]=="carregarmais")
			echo gerarNoticias($_POST["pagina"]);
	}
?>