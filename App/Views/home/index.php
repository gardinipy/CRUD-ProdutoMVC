<div class="container mt-4">
    <div class="jumbotron">
        <h1 class="display-5">Bem-vindo ao Sistema de Gestão de Exposição Agrícola</h1>
        <p class="lead">Módulo CRUD para manutenção de produtores, produtos, juízes, usuários e fichas de inscrição.</p>
        <hr>
        <p>Usuário logado: <strong><?= \App\Lib\Sessao::retornaValor('nome_usuario'); ?></strong></p>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tractor"></i> Produtores Rurais</h5>
                    <p class="card-text">Cadastre e gerencie produtores com nome, município, bairro e telefone.</p>
                    <a href="http://<?php echo APP_HOST; ?>/produtor/index" class="btn btn-primary btn-sm">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-seedling"></i> Produtos Agrícolas</h5>
                    <p class="card-text">Cadastre produtos com nome e variedade.</p>
                    <a href="http://<?php echo APP_HOST; ?>/produto/listar" class="btn btn-primary btn-sm">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-gavel"></i> Juízes</h5>
                    <p class="card-text">Cadastre os juízes que avaliarão os produtos inscritos.</p>
                    <a href="http://<?php echo APP_HOST; ?>/juiz/index" class="btn btn-primary btn-sm">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Usuários</h5>
                    <p class="card-text">Gerencie usuários do sistema com controle de login e sessão.</p>
                    <a href="http://<?php echo APP_HOST; ?>/usuario/index" class="btn btn-primary btn-sm">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-file-signature"></i> Fichas de Inscrição</h5>
                    <p class="card-text">Vincule produtores a produtos e defina o tipo (orgânico, convencional ou não convencional).</p>
                    <a href="http://<?php echo APP_HOST; ?>/inscricao/index" class="btn btn-primary btn-sm">Acessar</a>
                </div>
            </div>
        </div>
    </div>
</div>
