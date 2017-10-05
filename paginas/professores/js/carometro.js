$("#cursos-select").change(function()
{
	Limpar("#salas-select");
	//Faz o efeito fade out nos conte�dos.
	$("#alunos").fadeOut('slow');
	$("#acoes").fadeOut('slow');
	//Verifica se o valor � diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#salas-select option[value='selecionar']").text("Carregando...");
		//Faz a requisi��o ajax para a p�gina espec�fica.
		$.ajax({
			url: "ger_carometro.php",
			type:"POST",
			data: {
				"tipo": "sala",
				"curso" : $(this).val()
			},
			dataType:"json",
			success: function(response) {
				$("#salas-select option[value='selecionar']").text("Selecione uma turma");
				//La�o respons�vel por adicionar os resultados no select.
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

$alunos = "";

$("#salas-select").change(function()
{
	//Faz o efeito fade out nos conte�dos.
	$("#alunos").fadeOut('slow');	
	$("#acoes").fadeOut('slow');
	
	//Verifica se o valor � diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#alunos").fadeOut('slow',function(){
			Limpar("#alunos");
			//Faz a requisi��o ajax para a p�gina espec�fica.
			$.ajax({
				url: "ger_carometro.php",
				type:"POST",
				data: {
					"tipo": "carometro",
					"turma" : $("#salas-select").val(),
					"colunas" : $("#quant-colunas").val()
				},
				success: function(response) {
					$("#alunos").fadeIn('slow');
					
					//Verifica se houve resposta.
					if(response!="")
					{
						$("#acoes").fadeIn('slow');
						$("#alunos").addClass("sem-borda-total").addClass("sem-borda");
						$a = response;
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
		});
	}
});

$("#quant-colunas").change(function()
{
	if($("#quant-colunas").val()>=5 && $("#quant-colunas").val()<=10)
	{
		$("#alunos").fadeOut('slow',function(){Limpar("#alunos");
			$("#acoes").fadeOut('slow');
			//Faz a requisi��o ajax para a p�gina espec�fica.
			$.ajax({
				url: "ger_carometro.php",
				type:"POST",
				data: {
					"tipo": "carometro",
					"turma" : $("#salas-select").val(),
					"colunas" : $("#quant-colunas").val()
				},
				success: function(response) {	
					//Verifica se houve resposta.
					if(response!="")
					{
						$("#acoes").fadeIn('slow');
						$("#alunos").addClass("sem-borda-total").addClass("sem-borda");
						$a = response;
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
		});
	}
});


function Limpar(elemento)
{
	//Verifica o tipo do elemento, se for aluno limpa de uma maneira, caso contr�rio somente define o texto no select.
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
	//Abre um popup com a vers�o de impress�o.
	window.open("carometro_print.php?turma="+$("#salas-select").val()+"&colunas="+$("#quant-colunas").val(),null,
"height=600,width=800,status=yes,toolbar=no,menubar=no,location=no");
});