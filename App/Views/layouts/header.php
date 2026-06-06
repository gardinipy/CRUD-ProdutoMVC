<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="http://<?php echo APP_HOST; ?>/public/css/navbar.css" rel="stylesheet">
    <link href="http://<?php echo APP_HOST; ?>/public/fontawesome/css/all.css" rel="stylesheet">

    <title><?php echo TITLE; ?></title>
  </head>
  <body class="d-flex flex-column h-100">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>">Expo Agrícola</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
              <?php
                $ctrl = $viewVar['nameController'] ?? '';
                $act  = $viewVar['nameAction'] ?? '';
              ?>

              <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= ($ctrl == 'HomeController') ? 'active' : '' ?>">
                  <a class="nav-link" href="http://<?php echo APP_HOST; ?>"><i class="fas fa-home"></i> Home</a>
                </li>

                <li class="nav-item dropdown <?= ($ctrl == 'ProdutorController') ? 'active' : '' ?>">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Produtores</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/produtor/index">Listar</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/produtor/cadastrar">Cadastrar</a>
                  </div>
                </li>

                <li class="nav-item dropdown <?= ($ctrl == 'ProdutoController') ? 'active' : '' ?>">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Produtos</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/produto/listar">Listar</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/produto/cadastrar">Cadastrar</a>
                  </div>
                </li>

                <li class="nav-item dropdown <?= ($ctrl == 'JuizController') ? 'active' : '' ?>">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Juízes</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/juiz/index">Listar</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/juiz/cadastrar">Cadastrar</a>
                  </div>
                </li>

                <li class="nav-item dropdown <?= ($ctrl == 'UsuarioController') ? 'active' : '' ?>">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Usuários</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuario/index">Listar</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuario/cadastrar">Cadastrar</a>
                  </div>
                </li>

                <li class="nav-item dropdown <?= ($ctrl == 'InscricaoController') ? 'active' : '' ?>">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i class="fas fa-file-signature"></i> Inscrições</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/inscricao/index">Listar Fichas</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/inscricao/cadastrar">Nova Ficha</a>
                  </div>
                </li>
              </ul>

              <ul class="navbar-nav ml-auto">
                <?php if(\App\Lib\Sessao::existe('usuario_logado')): ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fas fa-user-circle fa-lg"></i> &nbsp;<span class="d-sm-inline font-weight-bold"><?= \App\Lib\Sessao::retornaValor('nome_usuario'); ?></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow">
                        <span class="dropdown-item-text text-muted">Papel: <?= \App\Lib\Sessao::retornaValor('papel_usuario'); ?></span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="http://<?php echo APP_HOST; ?>/login/sair"><i class="fas fa-sign-out-alt"></i> Sair</a>
                      </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm mt-1" href="http://<?php echo APP_HOST; ?>/login">
                            <i class="fas fa-sign-in-alt"></i> Entrar
                        </a>
                    </li>
                <?php endif; ?>
              </ul>
            </div>
        </div>
      </nav>
    </header>
    <main role="main" class="flex-shrink-0" style="margin-top: 80px;">
