$("#cursos-select").change(function()
{
	Limpar("#salas-select");
	//Faz o efeito fade out nos conteúdos.
	$("#alunos").fadeOut('slow');
	$("#acoes").fadeOut('slow');
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#salas-select option[value='selecionar']").text("Carregando...");
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_lista_presenca.php",
			type:"POST",
			data: {
				"tipo": "sala",
				"curso" : $(this).val()
			},
			dataType:"json",
			success: function(response) {
				$("#salas-select option[value='selecionar']").text("Selecione uma turma");
				//Laço responsável por adicionar os resultados no select.
				for(i=0;i<response.length;i++)
				{
					$("#salas-select").append($("<option value='"+response[i].idturma+"'>"+response[i].grau+response[i].classe+" - "+response[i].periodo+"</option>"));	
				}
				$("#salas-select").prop("disabled",false);
				$("#salas-select").focus();
				return;
			}
			
		});
	}
});

$("#salas-select").change(function()
{
	//Faz o efeito fade out nos conteúdos.
	$("#alunos").fadeOut('slow',function(){Limpar("#alunos");
	$("#acoes").fadeOut('slow');
	
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_lista_presenca.php",
			type:"POST",
			data: {
				"tipo": "alunos",
				"turma": $("#salas-select").val()
			},
			dataType:"json",
			success: function(response) {
				//Verifica se há resposta.
				if(response.length>0)
				{
					$("#alunos").addClass("sem-borda").addClass("sem-borda-total");
					$a = "<table class='table table-condensed table-bordered' style='margin:0;' id='alunos'><thead><tr><th style='text-align:center;' width='70'>RM</th><th style='text-align:center;' width='70'>Número</th><th>Nome</th><th style='text-align:center;' width='200'>Observações</th></tr></thead><tbody>";
					//Laço que percorre os resultados e monta a página.
					for(i=0;i<response.length;i++)
					{
						$a+="<tr><td>"+response[i].rm+"</td><td style='text-align:center;'>"+response[i].numero+"</td><td>"+response[i].nome+"</td><td>"+response[i].observacoes+"</td></tr>";
					}
					$("#acoes").fadeIn('slow');
				}
				else
				{
					$a = "<center>Nenhum aluno cadastrado na sala escolhida.</center>";	
					$("#alunos").removeClass("sem-borda-total").removeClass("sem-borda");
				}
				
				$("#alunos").html($a);
				$("#alunos").fadeIn('slow');
				
				return;			
			}
			
		});
	}});
});


function Limpar(elemento)
{
	//Verifica o tipo do elemento, se for aluno limpa de uma maneira, caso contrário somente define o texto no select.
	if(elemento!="#alunos")
	{
		$(elemento).prop("disabled",true);
		$(elemento + " option[value='selecionar']").text("");
		$(elemento + " option[value!='selecionar']").remove();
	}
	else
	{
		$("#alunos").removeClass("sem-borda").removeClass("sem-borda-total");
		$("#alunos").html($("<center>Carregando...</center>"));
		$("#alunos").fadeIn('slow');
	}
}

$("#imprimir").on("click",function()
{
	//Abre um popup com a versão de impressão.
	window.open("lista_presenca_print.php?turma="+$("#salas-select").val(),null,
"height=600,width=800,status=yes,toolbar=no,menubar=no,location=no");
});