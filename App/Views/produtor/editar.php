<div class="container mt-4">
    <h2>Editar Produtor Rural</h2>

    <?= $Sessao::retornaMensagem() ?>

    <form action="http://<?php echo APP_HOST; ?>/produtor/salvar/editar" method="POST" class="card p-4 shadow-sm">
        <input type="hidden" name="id_produtor" value="<?= $viewVar['produtor']->getIdProdutor() ?>">

        <div class="form-group">
            <label>Nome do Produtor</label>
            <input type="text" name="nome_produtor" class="form-control" value="<?= htmlspecialchars($viewVar['produtor']->getNomeProdutor()) ?>" required>
        </div>
        <div class="form-group mt-3">
            <label>Município</label>
            <input type="text" name="municipio" class="form-control" value="<?= htmlspecialchars($viewVar['produtor']->getMunicipio()) ?>" required>
        </div>
        <div class="form-group mt-3">
            <label>Bairro</label>
            <input type="text" name="bairro" class="form-control" value="<?= htmlspecialchars($viewVar['produtor']->getBairro()) ?>" required>
        </div>
        <div class="form-group mt-3">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($viewVar['produtor']->getTelefone()) ?>" required>
        </div>

        <button type="submit" class="btn btn-success mt-4">Salvar</button>
        <a href="http://<?php echo APP_HOST; ?>/produtor/index" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
