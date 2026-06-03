<!DOCTYPE html>
<html lang="pt-br" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css">
    <link href="http://<?php echo APP_HOST; ?>/public/css/navbar.css" rel="stylesheet"> 
    <link href="http://<?php echo APP_HOST; ?>/public/fontawesome/css/all.css" rel="stylesheet"> 
    
    <title><?php echo TITLE; ?></title> 
  </head>
  <body class="d-flex flex-column h-100">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>">Expo Agrícola</a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarCollapse">
              
              <?php 
                // Variáveis auxiliares para limpar e corrigir a lógica do botão ativo (evita saltos no layout)
                $ctrl = $viewVar['nameController'] ?? '';
                $act  = $viewVar['nameAction'] ?? '';
              ?>

              <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= ($ctrl == 'HomeController') ? 'active' : '' ?>">
                  <a class="nav-link" href="http://<?php echo APP_HOST; ?>"><i class="fas fa-home"></i> Home</a>
                </li>
                
                <li class="nav-item <?= ($ctrl == 'ProdutoController' && $act == 'listar') ? 'active' : '' ?>">
                  <a class="nav-link" href="http://<?php echo APP_HOST; ?>/produto/listar">Listar Produtos</a>
                </li>
                
                <li class="nav-item <?= ($ctrl == 'ProdutoController' && $act == 'cadastrar') ? 'active' : '' ?>">
                    <a class="nav-link" href="http://<?php echo APP_HOST; ?>/produto/cadastrar">Cadastrar Produto</a>
                </li>

                <li class="nav-item <?= ($ctrl == 'JulgamentoController' && $act == 'inscricao') ? 'active' : '' ?>">
                    <a class="nav-link text-warning" href="http://<?php echo APP_HOST; ?>/julgamento/inscricao"><i class="fas fa-file-signature"></i> Recepção (Inscrição)</a>
                </li>
                
                <li class="nav-item <?= ($ctrl == 'JulgamentoController' && $act == 'avaliar') ? 'active' : '' ?>">
                    <a class="nav-link text-warning" href="http://<?php echo APP_HOST; ?>/julgamento/avaliar"><i class="fas fa-gavel"></i> Julgamento</a>
                </li>
              </ul>

              <ul class="navbar-nav ml-auto">
                <?php if(\App\Lib\Sessao::existe('usuario_logado')): ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fas fa-user-circle fa-lg"></i> &nbsp;<span class="d-sm-inline font-weight-bold"><?= \App\Lib\Sessao::retornaValor('nome_usuario'); ?></span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow">
                        <a class="dropdown-item" href="#">Meu Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="http://<?php echo APP_HOST; ?>/login/sair"><i class="fas fa-sign-out-alt"></i> Sair do Sistema</a>
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