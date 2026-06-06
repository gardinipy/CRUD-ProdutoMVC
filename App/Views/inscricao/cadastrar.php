<div class="container mt-4">
    <h2>Nova Ficha de Inscrição</h2>

    <?= $Sessao::retornaMensagem() ?>

    <form action="http://<?php echo APP_HOST; ?>/inscricao/salvar/novo" method="POST" class="card p-4 shadow-sm">
        <div class="form-group">
            <label>Produtor Rural *</label>
            <select name="id_produtor" class="form-control" required>
                <option value="">Selecione o produtor...</option>
                <?php foreach($viewVar['produtores'] as $p): ?>
                    <option value="<?= $p->getIdProdutor() ?>"><?= htmlspecialchars($p->getNomeProdutor()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label>Produto Agrícola *</label>
            <select name="id_produto" class="form-control" required>
                <option value="">Selecione o produto...</option>
                <?php foreach($viewVar['produtos'] as $pr): ?>
                    <option value="<?= $pr->getIdProduto() ?>"><?= htmlspecialchars($pr->getNomeProduto()) ?> (<?= htmlspecialchars($pr->getVariedade()) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label>Tipo de Produto *</label>
            <select name="tipo_produto" class="form-control" required>
                <option value="organico">Orgânico</option>
                <option value="convencional">Convencional</option>
                <option value="nao_convencional">Não Convencional</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-4">Gerar Ficha</button>
        <a href="http://<?php echo APP_HOST; ?>/inscricao/index" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
