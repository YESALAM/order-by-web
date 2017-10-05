$("#cursos-select").change(function()
{
	Limpar("#salas-select");
	Limpar("#materias-select");
	Limpar("#bimestre-select");
	//Faz o efeito fade out nos conteúdos.
	$("#btenviar").fadeOut('slow');
	$("#alunos").fadeOut('slow');
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#salas-select option[value='selecionar']").text("Carregando...");
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_notas.php",
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
	Limpar("#bimestre-select");
	//Faz o efeito fade out nos conteúdos.
	$("#btenviar").fadeOut('slow');
	$("#alunos").fadeOut('slow');
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#materias-select option[value='selecionar']").text("Carregando...");
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_notas.php",
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
	Limpar("#bimestre-select");
	//Faz o efeito fade out nos conteúdos.
	$("#btenviar").fadeOut('slow');
	$("#alunos").fadeOut('slow');
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#bimestre-select option[value='selecionar']").text("Carregando...");
		//Faz a requisição ajax para a página específica.
		$.ajax({
			url: "ger_notas.php",
			type:"POST",
			data: {
				"tipo": "bimestre"
			},
			dataType:"json",
			success: function(response) {
				$("#bimestre-select option[value='selecionar']").text("Selecione um bimestre");
				//Laço responsável por adicionar os resultados no select.
				for(i=0;i<response.length;i++)
				{
					$("#bimestre-select").append($("<option value='"+response[i].bimestre+"'>"+response[i].nome+"</option>"));	
				}
				$("#bimestre-select").prop("disabled",false);
				$("#bimestre-select").focus();
				return;			
			}
			
		});
	}
});

$("#bimestre-select").change(function()
{
	//Faz o efeito fade out nos conteúdos.
	$("#btenviar").fadeOut('slow');
	$("#alunos").fadeOut("slow");
	//Verifica se o valor é diferente do placeholder
	if($(this).val()!="selecionar")
	{
		$("#alunos").fadeOut('slow',function(){
			Limpar("#alunos");
			//Faz a requisição ajax para a página específica.
			$.ajax({
				url: "ger_notas.php",
				type:"POST",
				data: {
					"tipo": "alunos",
					"turma": $("#salas-select").val(),
					"materia" : $("#materias-select").val(),
					"bimestre": $("#bimestre-select").val()
				},
				dataType:"json",
				success: function(response) {
					$("#alunos").fadeIn('slow');
					
					//Verifica se houve resposta.
					if(response.length>0)
					{
						$("#alunos").addClass("sem-borda");
						$a = "<table class='table table-striped table-condensed' style='margin:0;' id='alunos'><thead></th><th width='70'>RM</th><th width='70'>Número</th><th>Nome</th><th width='70' style='text-align:center;'>Nota</th></tr></thead><tbody>";
						//Laço responsável por montar a página de acordo com os resultados.
						for(i=0;i<response.length;i++)
						{
							if(response[i].nota)
							$a+="<tr><td>"+response[i].rm+"</td><td style='text-align:center;'>"+response[i].numero+"</td><td>"+response[i].nome+"</td><td style='padding:0;'><div class='form-group' style='padding:0;margin:0;'><input type='text' style='text-transform: uppercase;border-bottom: none;border-right: none;border-top: none;border-radius: 0px;text-align: center;' class='form-control nota-input' name='nota"+(i+1)+"' id='nota"+(i+1)+"' onkeyup='ValidarIndividual("+(i+1)+");' value='"+response[i].nota.nota+"'/><input type='hidden' name='aluno"+(i+1)+"' id='aluno"+(i+1)+"' value='"+response[i].rm+"'/><input type='hidden' name='idnota"+(i+1)+"' value='"+response[i].nota.id_nota+"' /></div></td></tr>";
							else
							$a+="<tr><td>"+response[i].rm+"</td><td style='text-align:center;'>"+response[i].numero+"</td><td>"+response[i].nome+"</td><td style='padding:0;'><div class='form-group' style='padding:0;margin:0;'><input type='text' style='text-transform: uppercase;border-bottom: none;border-right: none;border-top: none;border-radius: 0px;text-align: center;' class='form-control nota-input' name='nota"+(i+1)+"' id='nota"+(i+1)+"' onkeyup='ValidarIndividual("+(i+1)+");'/><input type='hidden' name='aluno"+(i+1)+"' id='aluno"+(i+1)+"' value='"+response[i].rm+"'/></div></td></tr>";
						}
						$a+="</tbody></table><input type='hidden' name='quantnotas' id='quantnotas' value='"+response.length+"' />";
						$("#btenviar").fadeIn('slow');
					}
					else
					{
						$a = "<center>Nenhum aluno cadastrado na sala escolhida.</center>";	
						$("#alunos").removeClass("sem-borda");
					}
					
					$("#alunos").html($a);
					$("#alunos").fadeIn('slow');
					return;			
				}
				
			});
		});
	}
});

function ValidarIndividual(i)
{
	$input = $("#nota"+i);

	$input.parent().addClass("has-error");
	//Verifica se é uma nota válida
	if($input.val()!="MB" && $input.val()!="B" && $input.val()!="R" && $input.val()!="I" && $input.val()!="mb" && $input.val()!="b" && $input.val()!="r" && $input.val()!="i" && $input.val()!="")
	{
		$input.parent().addClass("has-error");
	}
	else
		
		$input.parent().removeClass("has-error");
}

function ValidarTudo()
{
	$first=0;
	//Laço que percorrerá cada input
	for(i=1;i<=$("#quantnotas").val();i++)
	{
		//Verifica se é uma nota válida
		if($("#nota"+i).val()!="MB" && $("#nota"+i).val()!="B" && $("#nota"+i).val()!="R" && $("#nota"+i).val()!="I" && $("#nota"+i).val()!="mb" && $("#nota"+i).val()!="b" && $("#nota"+i).val()!="r" && $("#nota"+i).val()!="i" && $("#nota"+i).val()!="")
		{
			$first = ($first==0 ? i : $first);
			if($first!=0) $("#nota"+$first).focus();
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
	for(i=0;i<$("#quantnotas").val();i++)
	{
		$("#nota"+(i+1)).val("");	
	}
	$("#nota1").focus();
});

$("#okExcel").on("click",function()
{
	//Verifica se há conteúdo na variável
	if($("#notasExcel").val()!="")
	{
		//Percorre todos os inputs e os preenche.
		for(i=0;i<$("#quantnotas").val();i++)
		{
			$("#nota"+(i+1)).val($("#notasExcel").val().split("\n")[i]);
		}
	}
});