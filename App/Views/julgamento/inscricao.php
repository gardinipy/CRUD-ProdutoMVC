<div class="container mt-4">
    <h2>Recepção e Inscrição de Produto</h2>
    <hr>
    
    <?php if(\App\Lib\Sessao::existe('mensagemSucesso')): ?>
        <div class="alert alert-success"><?= \App\Lib\Sessao::retornaMensagem('mensagemSucesso') ?></div>
    <?php endif; ?>
    <?php if(\App\Lib\Sessao::existe('mensagemErro')): ?>
        <div class="alert alert-danger"><?= \App\Lib\Sessao::retornaMensagem('mensagemErro') ?></div>
    <?php endif; ?>

    <form action="http://<?php echo APP_HOST; ?>/julgamento/salvarInscricao" method="POST">
        <div class="mb-3">
            <label>Produtor Rural</label>
            <select name="id_produtor" class="form-select" required>
                <option value="">Selecione o produtor...</option>
                <?php foreach($viewVar['produtores'] as $produtor): ?>
                    <option value="<?= $produtor->getIdProdutor() ?>"><?= $produtor->getNomeProdutor() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Produto</label>
            <select name="id_produto" class="form-select" required>
                <option value="">Selecione o produto...</option>
                <?php foreach($viewVar['produtos'] as $produto): ?>
                    <option value="<?= $produto->getIdProduto() ?>"><?= $produto->getNomeProduto() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo (Categoria)</label>
            <select name="tipo_produto" class="form-select" required>
                <option value="organico">Orgânico</option>
                <option value="convencional">Convencional</option>
                <option value="nao_convencional">Não Convencional</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Inscrição</button>
        <a href="http://<?php echo APP_HOST; ?>/home" class="btn btn-secondary">Voltar</a>
    </form>
</div>