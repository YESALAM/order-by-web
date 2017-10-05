$("#cursos-select").change(function()
{
	Limpar("#salas-select");
	Limpar("#materias-select");
	Limpar("#mes-select");
	//Faz o efeito fade out nos conteúdos.
	$("#btenviar").fadeOut('slow');
	$("#alunos").fadeOut('slow');
	$("#totais").fadeOut('slow');
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#salas-select option[value='selecionar']").text("Carregando...");
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_faltas.php",
			type:"POST",
			data: {
				"tipo": "sala",
				"curso" : $(this).val(),
				"cpf" : $("#cpf_prof").val()
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
	Limpar("#materias-select");
	Limpar("#mes-select");
	//Faz o efeito fade out nos conteúdos.
	$("#btenviar").fadeOut('slow');
	$("#alunos").fadeOut('slow');
	$("#totais").fadeOut('slow');
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#materias-select option[value='selecionar']").text("Carregando...");
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_faltas.php",
			type:"POST",
			data: {
				"tipo": "materia",
				"turma": $(this).val(),
				"cpf" : $("#cpf_prof").val()
			},
			dataType:"json",
			success: function(response) {
				$("#materias-select option[value='selecionar']").text("Selecione uma matéria");
				//Laço responsável por adicionar os resultados no select.
				for(i=0;i<response.length;i++)
				{
					$("#materias-select").append($("<option value='"+response[i].idmateria+"'>"+response[i].sigla+" - "+response[i].nome+"</option>"));	
				}
				$("#materias-select").prop("disabled",false);
				$("#materias-select").focus();
				return;
			}
			
		});
	}
});

$("#materias-select").change(function()
{
	Limpar("#mes-select");
	//Faz o efeito fade out nos conteúdos.
	$("#btenviar").fadeOut('slow');
	$("#alunos").fadeOut('slow');
	$("#totais").fadeOut('slow');
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#mes-select option[value='selecionar']").text("Carregando...");
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_faltas.php",
			type:"POST",
			data: {
				"tipo": "mes"
			},
			dataType:"json",
			success: function(response) {
				$("#mes-select option[value='selecionar']").text("Selecione um mês");
				//Laço responsável por adicionar os resultados no select.
				for(i=0;i<response.length;i++)
				{
					$("#mes-select").append($("<option value='"+response[i].mes+"'>"+response[i].nome+"</option>"));	
				}
				$("#mes-select").prop("disabled",false);
				$("#mes-select").focus();
				return;			
			}
			
		});
	}
});

$("#mes-select").change(function()
{
	//Faz o efeito fade out nos conteúdos.
	$("#btenviar").fadeOut('slow');
	$("#totais").fadeOut('slow');
	$("#alunos").fadeOut('slow',function(){
		
		$("#aulasdadas").val("");
		$("#aulasprevistas").val("");
	
		//Verifica se o valor é diferente do placeholder
		if($("#mes-select").val()!="selecionar")
		{
			Limpar("#alunos");
			//Faz a requisição ajax para a página específica.
			$.ajax({
				url: "ger_faltas.php",
				type:"POST",
				data: {
					"tipo": "alunos",
					"turma": $("#salas-select").val(),
					"materia" : $("#materias-select").val(),
					"mes": $("#mes-select").val()
				},
				dataType:"json",
				success: function(response) {
					$("#alunos").fadeIn('slow');
					
					//Verifica se houve resposta.
					if(response.alunos.length>0)
					{
						$("#alunos").addClass("sem-borda");
						$a = "<table class='table table-striped table-condensed' style='margin:0;' id='alunos'><thead><tr><th width='70'>RM</th><th width='70'>Número</th><th>Nome</th><th width='80' style='text-align:center;'>Faltas</th></tr></thead><tbody>";
						//Laço responsável por montar a página de acordo com os resultados.
						for(i=0;i<response.alunos.length;i++)
						{
							if(response.alunos[i].falta)
							$a+="<tr><td>"+response.alunos[i].rm+"</td><td style='text-align:center;'>"+response.alunos[i].numero+"</td><td>"+response.alunos[i].nome+"</td><td style='padding:0;'><div class='form-group' style='padding:0;margin:0;'><input style='border-bottom: none;border-right: none;border-top: none;border-radius: 0px;text-align: center;' type='text' style='text-transform: uppercase;' class='form-control falta-input' name='falta"+(i+1)+"' id='falta"+(i+1)+"' onkeyup='ValidarIndividual("+(i+1)+");' value='"+response.alunos[i].falta.falta+"'/><input type='hidden' name='aluno"+(i+1)+"' id='aluno"+(i+1)+"' value='"+response.alunos[i].rm+"'/><input type='hidden' name='idfalta"+(i+1)+"' value='"+response.alunos[i].falta.id_falta+"' /></div></td></tr>";
							else
							$a+="<tr><td>"+response.alunos[i].rm+"</td><td style='text-align:center;'>"+response.alunos[i].numero+"</td><td>"+response.alunos[i].nome+"</td><td style='padding:0;'><div class='form-group' style='margin:0;'><input style='border-bottom: none;border-right: none;border-top: none;border-radius: 0px;text-align: center;' type='text' style='text-transform: uppercase;' class='form-control falta-input' name='falta"+(i+1)+"' id='falta"+(i+1)+"' onkeyup='ValidarIndividual("+(i+1)+");'/><input type='hidden' name='aluno"+(i+1)+"' id='aluno"+(i+1)+"' value='"+response.alunos[i].rm+"'/></div></td></tr>";
						}
						$a+="</tbody></table><input type='hidden' name='quantfaltas' id='quantfaltas' value='"+response.alunos.length+"' />";
						//Verifica se há os dados específicos do cadastramento
						if(response.dados)
						{
							$("#id_controle").val(response.dados.id_controle);
							$("#aulasdadas").val(response.dados.aulas_dadas);
							$("#aulasprevistas").val(response.dados.aulas_previstas);
						}
						$("#btenviar").fadeIn('slow');
						$("#totais").fadeIn('slow');
					}
					else
					{
						$a = "<center>Nenhum aluno cadastrado na sala escolhida.</center>";	
						$("#alunos").removeClass("sem-borda");
					}
					
					//$a = response;
					
					$("#alunos").html($a);
					$("#alunos").fadeIn('slow');
					
					return;			
				}
				
			});
		}
	});
});

function ValidarIndividual(i)
{
	$input = $("#falta"+i);
	$input.parent().addClass("has-error");
	//Verifica se é numérico
	if(!isNumeric($input.val()) && $input.val()!="")
	{
		$input.parent().addClass("has-error");
	}
	else
		
		$input.parent().removeClass("has-error");
}

$('#aulasdadas').keypress(function(event) {
	//Impede a digitação de valores não numéricos
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
});

$('#aulasprevistas').keypress(function(event) {
	//Impede a digitação de valores não numéricos
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
});

function ValidarTudo()
{
	$first=0;
	//Laço que percorrerá cada input
	for(i=1;i<=$("#quantfaltas").val();i++)
	{
		//Verifica se é numérico
		if(!isNumeric($("#falta"+i).val()) && $("#falta"+i).val()!="")
		{
			$first = ($first==0 ? i : $first);
			if($first!=0) $("#falta"+$first).focus();
			return false;
		}
	}
}

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

$("#limpar").on("click",function()
{	
	//Laço que percorrerá cada input
	for(i=0;i<$("#quantfaltas").val();i++)
	{
		$("#falta"+(i+1)).val("");	
	}
	$("#aulasdadas").val("");
	$("aulasprevistas").val("");
	$("#falta1").focus();
});

//Função que verifica se é numérico.
function isNumeric(value) {
   return value==Number(value);
}