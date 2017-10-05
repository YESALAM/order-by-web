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
			url: "ger_horario.php",
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
	$("#acoes").fadeOut("slow");
	//Verifica se o valor é diferente do placeholder
	if($("#salas-select").val()!="selecionar")
	{
		$("#alunos").fadeOut('slow',function(){Limpar("#alunos");
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_horario.php",
			type:"POST",
			data: {
				"tipo": "horario",
				"turma": $("#salas-select").val()
			},
			dataType:"json",
			success: function(response) {
				$("#alunos").fadeIn('slow');
				
				//Verifica se há resposta
				if(response.horarios)
				{				
					$("#alunos").addClass("sem-borda").addClass("sem-borda-total");
					$a = '<table class="table table-condensed table-bordered" style="margin:0;"><thead><tr><th style="text-align:center;width:100px;">HORÁRIO</th><th colspan="3" style="text-align:center;">SEGUNDA-FEIRA</th><th colspan="3" style="text-align:center;">TERÇA-FEIRA</th><th colspan="3" style="text-align:center;">QUARTA-FEIRA</th><th colspan="3" style="text-align:center;">QUINTA-FEIRA</th><th colspan="3" style="text-align:center;">SEXTA-FEIRA</th></tr><tr><th></th><th style="text-align:center;">DISC</th><th style="text-align:center;">PROF</th><th style="text-align:center;">SALA</th><th style="text-align:center;">DISC</th><th style="text-align:center;">PROF</th><th style="text-align:center;">SALA</th><th style="text-align:center;">DISC</th><th style="text-align:center;">PROF</th><th style="text-align:center;">SALA</th><th style="text-align:center;">DISC</th><th style="text-align:center;">PROF</th><th style="text-align:center;">SALA</th><th style="text-align:center;">DISC</th><th style="text-align:center;">PROF</th><th style="text-align:center;">SALA</th></tr></thead><tbody>';
					//Laço responsável por adicionar os resultados na tabela.
					for(i=0;i<response.horarios.length;i++)
					{
						$a+='<tr><td style="font-weight:bold;">'+response.horarios[i].inicio.slice(0,-3)+" - "+response.horarios[i].fim.slice(0,-3)+'</td><td style="text-align:center;">'+(response.aulas.SEGUNDA[i] ? response.aulas.SEGUNDA[i].materia : "")+'</td><td style="text-align:center;">'+(response.aulas.SEGUNDA[i] ? response.aulas.SEGUNDA[i].professores.join("/") : "")+'</td><td style="text-align:center;">'+(response.aulas.SEGUNDA[i] ? response.aulas.SEGUNDA[i].sala : "")+'</td><td style="text-align:center;">'+(response.aulas.TERÇA[i] ? response.aulas.TERÇA[i].materia : "")+'</td><td style="text-align:center;">'+(response.aulas.TERÇA[i] ? response.aulas.TERÇA[i].professores.join("/") : "")+'</td><td style="text-align:center;">'+(response.aulas.TERÇA[i] ? response.aulas.TERÇA[i].sala : "")+'</td><td style="text-align:center;">'+(response.aulas.QUARTA[i] ? response.aulas.QUARTA[i].materia : "")+'</td><td style="text-align:center;">'+(response.aulas.QUARTA[i] ? response.aulas.QUARTA[i].professores.join("/") : "")+'</td><td style="text-align:center;">'+(response.aulas.QUARTA[i] ? response.aulas.QUARTA[i].sala : "")+'</td><td style="text-align:center;">'+(response.aulas.QUINTA[i] ? response.aulas.QUINTA[i].materia : "")+'</td><td style="text-align:center;">'+(response.aulas.QUINTA[i] ? response.aulas.QUINTA[i].professores.join("/") : "")+'</td><td style="text-align:center;">'+(response.aulas.QUINTA[i] ? response.aulas.QUINTA[i].sala : "")+'</td><td style="text-align:center;">'+(response.aulas.SEXTA[i] ? response.aulas.SEXTA[i].materia : "")+'</td><td style="text-align:center;">'+(response.aulas.SEXTA[i] ? response.aulas.SEXTA[i].professores.join("/") : "")+'</td><td style="text-align:center;">'+(response.aulas.SEXTA[i] ? response.aulas.SEXTA[i].sala : "")+'</td></tr>';	
					}
					
					$a+="</tbody></table>";
					$("#acoes").fadeIn("slow");
				}
				else
				{
					$a = "<center>Horário não cadastrado para a sala escolhida.</center>";	
					$("#alunos").removeClass("sem-borda-total").removeClass("sem-borda");
				}
				
				$("#alunos").html($a);
				$("#alunos").fadeIn('slow');
				
				return;			
			}
			
		});});
	}
	else
	{
		$("#alunos").fadeOut("slow");	
	}
});


function Limpar(elemento)
{	
	//Limpa o elemento selecionado
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
	//Abre um popup de impressão.
	window.open("horario_print.php?turma="+$("#salas-select").val(),null,
"height=600,width=900,status=yes,toolbar=no,menubar=no,location=no");
});