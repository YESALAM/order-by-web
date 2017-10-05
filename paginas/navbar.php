<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: <?php echo $info["cor_navbar"]; ?>;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-<?php echo ($info["nome_abreviado"]!="" ? "brand" : "logo"); ?>" href="<?php echo ($informacoes ? "../index.php" : "index.php"); ?>"><?php echo ($info["nome_abreviado"]!="" ? $info["nome_abreviado"] : '<img src="'.($informacoes ? "../" : "").'../fotos/site/'.$info["logo_principal"].'" />'); ?></a> </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown <?php echo ($atual=="escola" ? "active" : ""); ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Escola <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo (!$informacoes ? "informacoes/" : ""); ?>informacoes.php">Informações</a></li>
            <li><a href="#">Cursos</a></li>
            <li><a href="#">Processo Seletivo</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Avaliação</li>
            <li><a href="#">WEBSAI</a></li>
            <li><a href="#">ENEM</a></li>
          </ul>
        </li>
        <li class="dropdown <?php echo ($atual=="servicosalunos" ? "active" : ""); ?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Serviços / Alunos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Serviços</li>
            <li><a href="#">Secretaria</a></li>
            <li><a href="#">Download de Documentos</a></li>
            <li><a href="#">EMTU - Cartão BOM</a></li>
            <li><a href="#">Convênio Microsoft</a></li>
            <li><a href="#">Mural de Estágios</a></li>
            <li><a href="#">Aprendiz Paulista</a></li>
            <li><a href="#">Estágios - NUBE</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Alunos</li>
            <li><a href="#">Manual do Aluno</a></li>
            <li><a href="<?php echo (!$informacoes ? "informacoes/" : ""); ?>horario.php">Horário de Aula</a></li>
            <li><a href="#">Calendário Escolar</a></li>
            <li><a href="#">Boletim Escolar</a></li>
            <li><a href="#">Intercâmbio</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vestibulinho <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Vestibular</a></li>
            <li><a href="#">Informações</a></li>
            <li><a href="#">Matrícula</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Biblioteca <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Regulamento</a></li>
            <li><a href="#">Acervo</a></li>
          </ul>
        </li>
        <li class="visible-xs"><a href="login.php">Login</a></li>
      </ul>
      
      <div class="hidden-xs">
      <ul class="nav navbar-nav navbar-right">
        <li <?php echo ($modo=="aluno" ? 'class="active"' : "") ?> id="aluno"><a style="padding-bottom: 21px;" href="#"><i class="fa fa-user"></i></a></li>
        <li <?php echo ($modo=="professor" ? 'class="active"' : "") ?> id="prof"><a style="padding-bottom: 21px;" href="#"><i class="fa fa-book"></i></a></li>
      </ul>
      
      <form class="navbar-form navbar-right <?php echo ($modo=="aluno" ? '' : "hidden") ?>" role="search" id="formaluno" method="post" action="<?php echo ($informacoes ? "../" : ""); ?>validar.php">
        <div class="form-group">
        <input type="hidden" name="tipo" value="aluno"  />
          <input type="text" class="form-control" name="rm" placeholder="Digite seu RM" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-default">Consultar</button>
      </form>
      <form class="navbar-form navbar-right <?php echo ($modo=="professor" ? '' : "hidden") ?>" role="search" id="formprof"  method="post" action="<?php echo ($informacoes ? "../" : ""); ?>validar.php">
        <div class="form-group">
        <input type="hidden" name="tipo" value="professor"  />
          <input type="text" class="form-control" name="cpf" id="cpf_prof" placeholder="Digite o CPF" autocomplete="off">
          <input type="password" class="form-control" name="senha_prof" placeholder="Senha" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-default">Login</button>
      </form>
      </div>
    </div>
  </div>
</nav>
