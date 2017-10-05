
//Inicia o carousel do site, atrav�s do m�todo do Bootstrap
$('.carousel').carousel()

//Especifica o evento "on click" do link "aluno"
$("#aluno").on("click",function()
{
	//Faz o efeito fade out no formul�rio do professor,
	//e logo em seguida faz o fade in no formul�rio do aluno.
	$("#formprof").fadeOut('fast',function()
	{
		$("#formaluno").fadeIn('fast').removeClass("hidden");
	});
	//Especifica a classe como "active"
	$(this).addClass("active");
	//Remove a classe "active" do professor
	$("#prof").removeClass("active");
});

//Especifica o evento "on click" do link "prof"
$("#prof").on("click",function()
{
	//Faz o efeito fade out no formul�rio do aluno,
	//e logo em seguida faz o fade in no formul�rio do professor.
	$("#formaluno").fadeOut('fast',function()
	{
		$("#formprof").fadeIn('fast').removeClass("hidden");
	});
	//Especifica a classe como "active"
	$(this).addClass("active");
	//Remove a classe "active" do aluno
	$("#aluno").removeClass("active");
});

//Define a m�scara para o campo CPF do professor.
$('#cpf_prof').mask('000.000.000-00', {reverse: true, placeholder: "Digite o CPF"});