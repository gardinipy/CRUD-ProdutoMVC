<div class="container mt-4">
    <h2>Gestão de Produtos Agrícolas</h2>
    <a href="http://<?php echo APP_HOST; ?>/produto/cadastrar" class="btn btn-success mb-3">Novo Produto</a>
    
    <?php if(\App\Lib\Sessao::existe('mensagem')): ?>
        <?= \App\Lib\Sessao::retornaValor('mensagem') ?>
    <?php endif; ?>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome do Produto</th>
                <th>Variedade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($viewVar['listaProdutos'] as $produto): ?>
            <tr>
                <td><?= $produto->getIdProduto() ?></td>
                <td><?= $produto->getNomeProduto() ?></td>
                <td><?= $produto->getVariedade() ?></td>
                <td>
                    <form action="http://<?php echo APP_HOST; ?>/produto/excluir" method="POST" class="d-inline">
                        <input type="hidden" name="id_produto" value="<?= $produto->getIdProduto() ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>