<?php
	session_start();
	session_destroy();
	
	$informacoes = true;
	include "../info.php";
	include "../conexao.php";
	
	$modo = "aluno";
	$atual = "escola";
	
	if(isset($_GET["modo"]))
		$modo = $_GET["modo"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $info["nome_escola"]; ?> | Informações</title>
<link href="../../recursos/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../../recursos/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet"  />
<link href="../css/index.css" rel="stylesheet"  />
</head>

<body>
<?php include ("../navbar.php"); ?>
<div class="page-row page-row-expanded">
    <div class="container" style="margin-top:30px;">
    	<div class="row">
        	<div class="col-md-3" >
            	<div class="notas-form" style="border-radius:5px;" data-spy="affix" data-offset-top="20">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation" class="active"><a href="#historico" aria-controls="historico" role="tab" data-toggle="tab">Histórico</a></li>
                        <li role="presentation"><a href="#patrono" aria-controls="patrono" role="tab" data-toggle="tab">Patrono</a></li>
                        <li role="presentation"><a href="#missao" aria-controls="missao" role="tab" data-toggle="tab">Missão</a></li>
                        <li role="presentation"><a href="#visao" aria-controls="visao" role="tab" data-toggle="tab">Visão</a></li>
                        <li role="presentation"><a href="#equipemultidisciplinar" aria-controls="equipemultidisciplinar" role="tab" data-toggle="tab">Equipe Multidisciplinar</a></li>
                        <li role="presentation"><a href="#diretor" aria-controls="diretor" role="tab" data-toggle="tab">Diretora</a></li>
                        <li role="presentation"><a href="#corpodocente" aria-controls="corpodocente" role="tab" data-toggle="tab">Corpo Docente</a></li>
                    </ul>
                </div>
			</div>
            <div class="col-sm-9">
            	<div class="tab-content informacoes">
                    <div role="tabpanel" class="tab-pane active" id="historico">
                    	<p>Nascida dos ideais de grandes homens, tendo à frente o saudoso Lauro Gomes, e calcada nas necessidades da região do grande ABC, a Escola Técnica Industrial de São Bernardo do Campo foi criada pela Lei nº. 3734, de 15 de janeiro de 1957, que aprovou o Convênio celebrado em 11 de junho de 1956, entre o Governo do Estado, Ministério da Educação e Cultura e a Prefeitura Municipal de São Bernardo do Campo, objetivando a criação, instalação e funcionamento de uma escola de ensino técnico-industrial.</p>
						<p>Citando, e forma resumida, as responsabilidades assumidas pelas partes nesse Convênio, coube à preifetura a doação de terrenos necessários à construção da escola (cerca de 162000 m2), obrigou-se o Governo do Estado conceder anualmente subvenções destinadas à manutenção da escola e o Ministério da Educação e Cultura obrigou-se, por seu turno, a construir os edifícios e provê-los com as instalações e materiais permanentes em geral, necessários ao bom funcionamento dos cursos mantidos pela escola. As atividades didáticas foram iniciadas em março de 1965 com o curso Técnico Industrial de Construção de Máquinas e Motores (atualmente Técnico em Mecânica).</p>
                        <img src="../../fotos/site/informacoes/image009.gif" width="100%" height="auto" />
                        <img src="../../fotos/site/informacoes/image011.jpg" width="100%" height="auto" />
                        <p>Por força do Decreto nº. 48896, de 12 de outubro de 1966, esta escola teve a sua denominação alterada de Escola Técnica Industrial de São Bernardo do Campo para Escola Técnica Industrial "Lauro Gomes", em homenagem ao Prefeito Lauro Gomes que durante a sua vida pública esteve inteiramente devotado à criação deste estabelecimento de ensino.</p>
                        <p>Em virtude dos compromissos assumidos pelo MEC, no Convênio sopracitado, firmou o Governo da União com o Governo da República Federal da Alemanha, em 30 de novembro de 1963, um Acordo Básico de Cooperação Técnica, mediante o qual a ETI recebeu, na fase inicial de seu funcionamento, equipamentos para instalações de inúmeros laboratórios doados pelo Governo da RFA, e uma Missão Técnica Alemã que auxiliou na instalação dos equipamentos e ministrou orientação para o ensino técnico dos cursos de Mecânica e de Eletrotécnica.</p>
                        <p>Em fevereiro de 1971 entram em funcionamento as habilitações de Técnico em Eletrônica e Eletrotécnica. Com o advento da lei nº. 5692, de 11 de agosto de 1971, foram instaladas, no período noturno, as habilitações de Desenhistas de Projetos de Ferramentas e Dispositivos e Laboratorista Industrial, ambas em 1972, e a de Desenhista de Projetos de Mecânica, em 1973.</p>
                        <p>Quando a escola iniciou as suas atividades escolares, em março de 1965, apenas o bloco 6, apesar de inacabado, estava em condições de uso. Ali foram instaladas as salas de aula, no pavimento superior, e a oficina da prática profissional e o refeitório no pavimento inferior, ficando a parte administrativa instalada no bloco central. Todas as demais modificações (bloco 2A, 2B, 3, 4 e 5) estavam dependendo de trabalhos onerosos de pisos, alvenaria, instalações elétricas e hidráulicas e demais acabamentos. Outros acabamentos como calçadas, escadas, muros, etc., também a serem concluídos, completavam o quadro pouco animador da situação da escola em 1965.</p>
                        <p>Em dezembro de 1978 a escola concluiu a ala direita do bloco 5, última dependência importante ligada ao ensino, que fazia parte de uma extensa relação de obras a serem atendidas, conforme as prioridades estabelecidas e na medida dos recursos recebidos do Governo da União, da Prefeitura Municipal de São Bernardo do Campo e, inclusive, da Associação de Pais e Mestres.</p>
                        <p>Foram necessários portanto, longos anos para a ETI atingir a situacão em que hoje se encontra, com os blocos de ensino 2A, 2B, 3, 4 e 5 inteiramente acabados e é importante frisar que, paralelamente a essa fase, sempre estavam presentes, nas cogitações da direção da escola, da APM e dos alunos, como uma das grandes aspirações a serem atendidas, as obras da Praça de Esportes, nome posteriormente alterado para Centro Esportivo.</p>
                        <p>A partir de 1º. de janeiro de 1981, por força do Decreto nº. 16309, de 04 de dezembro de 1980, a ETI, juntamente com outras escolas profissionalizantes de 2º. grau, de convênios similares, foi integrada ao Centro Estadual de Educação Tecnológica "Paula Souza" (CEETEPS).
Em fevereiro de 1985 entrou em funcionamento a habilitação de Técnico em Processamento de Dados e as habilitações de Desenhista de Projetos de Ferramentas e Dispositivos, Desenhista de Projetos de Mecânica e de Laboratorista Industrial, reestruturadas, passaram para plenas com a denominação de Técnico em Desenho de Projetos de Mecânica e Técnico Laboratorista Industrial.</p>            
                    </div>
                    <div role="tabpanel" class="tab-pane" id="patrono">
                    	<p>Lauro Gomes de Almeida nasceu em Rochedo, Estado de Minas Gerais, no dia 27 de fevereiro de 1895. Era casado com a Sra. Lavínia Rudge Ramos Gomes. Iniciou a sua vida pública em 1952, quando foi empossado no cargo de Prefeito de São Bernardo do Campo.
A educação foi sempre a preocupação maior desse grande administrador e sua atuação marcada por inúmeras realizações no setor educacional, principalmente no tocante à necessidade de ensino profissionalizante na região.</p>
						<p>Conduzido a uma cadeira do Congresso Nacional, em 1955, lutou pela criação e instalação de uma escola técnica em São Bernardo do Campo e viu os seus esforços coroados de êxito, quando, em 11 de maio de 1956, firmou-se o Convênio entre o Governo do Estado, Ministério da Educação e Cultura e Prefeitura Municipal de São Bernardo do Campo, ponto de partida para a concretização de um empreendimento que representou o grande ideal de sua vida.
Como Deputado Federal redobrou os seus esforços empenhando-se ativamente junto aos órgãos competentes, no sentido de que fossem destinados recursos financeiros à grande obra. Esta sua dedicação valeu-lhe, entre os seus pares no Congresso, o epíteto de "O Deputado da Escola Técnica".</p>
						<p>Em janeiro de 1960 Lauro Gomes voltou a ocupar a chefia do Executivo Municipal em São Bernardo do Campo e, como Prefeito, continuou trabalhando em favor do prosseguimento e acelaramento das obras da escola técnica, chegando mesmo em várias oportunidades, a levar a Municipalidade a colaborar com serviços de elevado custo.</p>
                        <p>Em outubro de 1962 foi eleito Deputado Estadual e, em outubro de 1963, foi conduzido à Prefeitura Municipal de Santo André, vindo a falecer no exercício desde mandato, em 20 de maio de 1964.</p>
                        <p>Pela sua vida pública, sempre voltada para o campo da educação, e pela sua grande dedicação em prol da Escola Técnica Industrial de São Bernardo do Campo, foi com grande júblio que se recebeu a perpetuação do nome de Lauro Gomes como Patrono desta instituição.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="missao">
                    	<blockquote style="margin-bottom:0;">Formar o cidadão técnico de nível médio com competência técnica e consciência ética, promovendo a sua autonomia profissional ensinando-o a pensar e a fazer, visando à sua inserção no mercado de trabalho.</blockquote>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="visao">
                    	<blockquote style="margin-bottom:0;">Continuar sendo um Centro de Formação Técnica de nível médio, preocupados com a qualidade da educação técnica pública, buscando atender às necessidades dos setores produtivos.</blockquote>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="equipemultidisciplinar">
                    	<table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><b>Equipe disciplinar</b></td>
                                </tr>
                                <tr>
                                	<td>Diretoria – Das 8h00 às 22h00 –  Bloco 2</td>
                                </tr>
                                <tr>
                                	<td><b>Diretora</b></td>
                                </tr>
                                <tr>
                                	<td>Marly de  Oliveira Moraes</td>
                                </tr>
                                <tr>
                                	<td><b>Diretora Pedagógica</b></td>
                                </tr>
                                <tr>
                                	<td>Aparecida Damergian Bobotis</td>
                                </tr>
                                <tr>
                                	<td><b>Assistente de Direção</b></td>
                                </tr>
                                <tr>
                                	<td>Morgana Gabriela Tito Passos</td>
                                </tr>
                                <tr>
                                	<td>Adriano Di Gregório</td>
                                </tr>
                            </tbody>                        
                        </table>
                        <table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><b>Orientação Educacional – Bloco Central</b></td>
                                </tr>
                                <tr>
                                	<td>Profª. Ângela de Fátima Torres</td>
                                </tr>
                            </tbody>                        
                        </table>
                        <table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><b>Secretaria Escolar – Bloco 2</b></td>
                                </tr>
                                <tr>
                                	<td>Secretaria – Das 9h00 às 21h00 – De Segunda a Sexta-Feira</td>
                                </tr>
                                <tr>
                                	<td><b>Secretária</b></td>
                                </tr>
                                <tr>
                                	<td>Maria Ironete de Souza Moreira</td>
                                </tr>
                            </tbody>                        
                        </table>
                        <table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><b>Estágios – Diretoria</b></td>
                                </tr>
                                <tr>
                                	<td>Secretaria – Das 14h00 às 21h00</td>
                                </tr>
                                <tr>
                                	<td><b>Responsável</b></td>
                                </tr>
                                <tr>
                                	<td>Adriano Di Gregório</td>
                                </tr>
                            </tbody>                        
                        </table>
                        <table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><b>Escritório da APM – Bloco Central</b></td>
                                </tr>
                                <tr>
                                	<td>Atendimento ao aluno:</td>
                                </tr>
                                <tr>
                                	<td>
										8h30 às 11h30<br/>
										13h30 às 16h30<br/>
										16h30 às 21h00 – Bloco 6 – na Gráfica
                                    </td>
                                </tr>
                            </tbody>                        
                        </table>
                        <table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><b>Biblioteca – Bloco 2</b></td>
                                </tr>
                                <tr>
                                	<td>
										8h00 às 16h30<br/>
										18h00 às 21h30
                                    </td>
                                </tr>
                            </tbody>                        
                        </table>
                        <table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><b>Gráfica Escolar – Bloco 6</b></td>
                                </tr>
                                <tr>
                                	<td>8h15 às 21h30</td>
                                </tr>
                            </tbody>                        
                        </table>
                        <table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><b>Restaurante – Bloco 3</b></td>
                                </tr>
                                <tr>
                                	<td>11h30 às 13h15</td>
                                </tr>
                            </tbody>                        
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="diretor">
                    	<table class="table table-bordered table-condensed">
                        	<tbody>
                            	<tr>
                                	<td><h3 style="padding:0;margin:0;">Marly de Oliveira Moraes</h3></td>
                                </tr>
                                <tr>
                                	<td>Nascida em São Paulo – SP em 29/04/1955.</td>
                                </tr>
                                <tr>
                                	<td>Formada em Biologia – Modalidade Médica e Biologia.</td>
                                </tr>
                                <tr>
                                	<td>Professora de Biologia da Secretaria de Educação de 1982 a 2009.</td>
                                </tr>
                                <tr>
                                	<td>Professora de Biologia do CEETEPS desde julho de 1985.</td>
                                </tr>
                                <tr>
                                	<td>Coordenadora do Ensino Médio e de Classe Descentralizada.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="corpodocente" style="padding:0;">
                    	<table class="table table-striped">
                        	<thead>
                            	<tr>
                                	<th>Professor</th>
                                    <th style="text-align:center;" width="60">Sigla</th>
                                </tr>
                            </thead>
                        	<tbody>
                            	<?php
									$res = mysql_query("select * from professores order by nome_professores asc;",$conexao);
									while($row = mysql_fetch_array($res)) :
								?>
                                	<tr>
                                    	<td><?php echo $row["nome_professores"]; ?></td>
                                        <td style="text-align:center;"><?php echo $row["sigla_professores"]; ?></td>
                                    </tr>
                                <?php endwhile; 
									mysql_free_result($res);
								?>
                            </tbody>
                        </table>
                    </div>
				</div>
            </div>
        </div>
    </div>
</div>
<?php include ("../footer.php"); ?>
<script src="../../recursos/jquery-2.1.4.min.js" type="text/javascript"></script> 
<script src="../../recursos/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<script src="../../recursos/jquery.mask.js" type="text/javascript"></script>
<script src="../js/index.js"></script>
</body>
</html>