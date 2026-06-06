<div class="container mt-4">
    <h2>Editar Ficha de Inscrição #<?= $viewVar['inscricao']->getNumeroInscricao() ?></h2>

    <?= $Sessao::retornaMensagem() ?>

    <form action="http://<?php echo APP_HOST; ?>/inscricao/salvar/editar" method="POST" class="card p-4 shadow-sm">
        <input type="hidden" name="numero_inscricao" value="<?= $viewVar['inscricao']->getNumeroInscricao() ?>">

        <div class="form-group">
            <label>Produtor Rural *</label>
            <select name="id_produtor" class="form-control" required>
                <?php foreach($viewVar['produtores'] as $p): ?>
                    <option value="<?= $p->getIdProdutor() ?>" <?= $p->getIdProdutor() == $viewVar['inscricao']->getIdProdutor() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p->getNomeProdutor()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label>Produto Agrícola *</label>
            <select name="id_produto" class="form-control" required>
                <?php foreach($viewVar['produtos'] as $pr): ?>
                    <option value="<?= $pr->getIdProduto() ?>" <?= $pr->getIdProduto() == $viewVar['inscricao']->getIdProduto() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($pr->getNomeProduto()) ?> (<?= htmlspecialchars($pr->getVariedade()) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label>Tipo de Produto *</label>
            <select name="tipo_produto" class="form-control" required>
                <option value="organico" <?= $viewVar['inscricao']->getTipoProduto() == 'organico' ? 'selected' : '' ?>>Orgânico</option>
                <option value="convencional" <?= $viewVar['inscricao']->getTipoProduto() == 'convencional' ? 'selected' : '' ?>>Convencional</option>
                <option value="nao_convencional" <?= $viewVar['inscricao']->getTipoProduto() == 'nao_convencional' ? 'selected' : '' ?>>Não Convencional</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-4">Salvar</button>
        <a href="http://<?php echo APP_HOST; ?>/inscricao/index" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
