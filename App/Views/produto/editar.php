<div class="container mt-4">
    <h2>Editar Produto Agrícola</h2>

    <?= $Sessao::retornaMensagem() ?>

    <form action="http://<?php echo APP_HOST; ?>/produto/salvar/editar" method="POST" class="card p-4 shadow-sm">
        <input type="hidden" name="id_produto" value="<?= $viewVar['produto']->getIdProduto() ?>">

        <div class="mb-3">
            <label>Nome do Produto</label>
            <input type="text" name="nome_produto" class="form-control" value="<?= htmlspecialchars($viewVar['produto']->getNomeProduto()) ?>" required>
            <div class="text-danger"><?= $Sessao::retornaErro('erronome') ?></div>
        </div>

        <div class="mb-3">
            <label>Variedade</label>
            <input type="text" name="variedade" class="form-control" value="<?= htmlspecialchars($viewVar['produto']->getVariedade()) ?>" required>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="http://<?php echo APP_HOST; ?>/produto/listar" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
