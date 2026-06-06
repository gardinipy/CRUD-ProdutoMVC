<div class="container mt-4">
    <h2>Cadastrar Produto Agrícola</h2>
    
    <?= $Sessao::retornaMensagem() ?>

    <form action="http://<?php echo APP_HOST; ?>/produto/salvar/novo" method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label>Nome do Produto (Ex: Tomate, Alface)</label>
            <input type="text" name="nome_produto" class="form-control" required>
            <div class="text-danger"><?= \App\Lib\Sessao::retornaErro('erronome') ?></div>
        </div>
        
        <div class="mb-3">
            <label>Variedade (Ex: Cereja, Crespa)</label>
            <input type="text" name="variedade" class="form-control" required>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Salvar Produto</button>
            <a href="http://<?php echo APP_HOST; ?>/produto/listar" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>