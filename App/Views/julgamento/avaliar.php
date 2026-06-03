<div class="container mt-4">
    <h2>Avaliação e Julgamento</h2>
    <hr>
    
    <?php if(\App\Lib\Sessao::existe('mensagemSucesso')): ?>
        <div class="alert alert-success"><?= \App\Lib\Sessao::retornaMensagem('mensagemSucesso') ?></div>
    <?php endif; ?>

    <form action="http://<?php echo APP_HOST; ?>/julgamento/salvarAvaliacao" method="POST">
        <div class="row">
            <div class="col-md-7 mb-3">
                <label>Ficha de Inscrição</label>
                <select name="id_inscricao" class="form-select" required>
                    <option value="">Selecione a ficha...</option>
                    <?php foreach($viewVar['fichas'] as $ficha): ?>
                        <option value="<?= $ficha->getNumeroInscricao() ?>">
                            Inscrição Nº <?= $ficha->getNumeroInscricao() ?> - <?= $ficha->getNomeProduto() ?> (Produtor: <?= $ficha->getNomeProdutor() ?>) - <?= ucfirst($ficha->getTipoProduto()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-5 mb-3">
                <label>Juiz</label>
                <select name="id_juiz" class="form-select" required>
                    <option value="">Selecione o juiz...</option>
                    <?php foreach($viewVar['juizes'] as $juiz): ?>
                        <option value="<?= $juiz->getIdJuiz() ?>"><?= $juiz->getNomeJuiz() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <h5 class="mt-4">Lançamento de Notas (6 Critérios)</h5>
        <div class="row bg-light p-3 border rounded">
            <?php for($i = 1; $i <= 6; $i++): ?>
                <div class="col-md-4 mb-3">
                    <label>Nota - Critério <?= $i ?></label>
                    <input type="number" step="0.1" min="0" max="10" name="nota<?= $i ?>" class="form-control" placeholder="0.0 a 10.0" required>
                </div>
            <?php endfor; ?>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Salvar Julgamento</button>
            <a href="http://<?php echo APP_HOST; ?>/home" class="btn btn-secondary">Voltar ao Painel</a>
        </div>
    </form>
</div>