<div class="container mt-5">
    <h2>Nova Ficha de Inscrição</h2>
    <form action="http://<?php echo APP_HOST; ?>/inscricao/salvar" method="POST">
        <label>Produtor:</label>
        <select name="id_produtor" class="form-control">
            <?php foreach($Sessao::retorna('produtores') as $p): ?>
                <option value="<?= $p->id_produtor ?>"><?= $p->nome_produtor ?></option>
            <?php endforeach; ?>
        </select>
        
        <label class="mt-3">Produto:</label>
        <select name="id_produto" class="form-control">
            <?php foreach($Sessao::retorna('produtos') as $pr): ?>
                <option value="<?= $pr->id_produto ?>"><?= $pr->nome_produto ?> (<?= $pr->variedade ?>)</option>
            <?php endforeach; ?>
        </select>

        <label class="mt-3">Tipo de Produto:</label>
        <select name="tipo_produto" class="form-control">
            <option value="organico">Orgânico</option>
            <option value="convencional">Convencional</option>
            <option value="nao_convencional">Não Convencional</option>
        </select>

        <button type="submit" class="btn btn-success mt-4">Gerar Ficha</button>
    </form>
</div>