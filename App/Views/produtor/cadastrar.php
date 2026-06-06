<div class="container mt-5">
    <h2>Cadastrar Produtor Rural</h2>
    <?= $Sessao::retornaMensagem() ?>

    <form action="http://<?php echo APP_HOST; ?>/produtor/salvar/novo" method="POST" class="card p-4 shadow-sm">
        <div class="form-group mt-3">
            <label>Nome do Produtor</label>
            <input type="text" name="nome_produtor" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label>Município</label>
            <input type="text" name="municipio" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label>Bairro</label>
            <input type="text" name="bairro" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-4">Salvar Produtor</button>
        <a href="http://<?php echo APP_HOST; ?>/produtor" class="btn btn-secondary mt-4">Voltar</a>
    </form>
</div>