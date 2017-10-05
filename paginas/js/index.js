
//Inicia o carousel do site, através do método do Bootstrap
$('.carousel').carousel()

//Especifica o evento "on click" do link "aluno"
$("#aluno").on("click",function()
{
	//Faz o efeito fade out no formulário do professor,
	//e logo em seguida faz o fade in no formulário do aluno.
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
	//Faz o efeito fade out no formulário do aluno,
	//e logo em seguida faz o fade in no formulário do professor.
	$("#formaluno").fadeOut('fast',function()
	{
		$("#formprof").fadeIn('fast').removeClass("hidden");
	});
	//Especifica a classe como "active"
	$(this).addClass("active");
	//Remove a classe "active" do aluno
	$("#aluno").removeClass("active");
});

//Define a máscara para o campo CPF do professor.
$('#cpf_prof').mask('000.000.000-00', {reverse: true, placeholder: "Digite o CPF"});