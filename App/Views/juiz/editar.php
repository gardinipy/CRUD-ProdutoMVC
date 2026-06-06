<div class="container mt-4">
    <h2>Editar Juiz</h2>

    <?= $Sessao::retornaMensagem() ?>

    <form action="http://<?php echo APP_HOST; ?>/juiz/salvar/editar" method="POST" class="card p-4 shadow-sm">
        <input type="hidden" name="id_juiz" value="<?= $viewVar['juiz']->getIdJuiz() ?>">

        <div class="form-group">
            <label>Nome do Juiz *</label>
            <input type="text" name="nome_juiz" class="form-control" value="<?= htmlspecialchars($viewVar['juiz']->getNomeJuiz()) ?>" required>
        </div>
        <div class="form-group mt-3">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($viewVar['juiz']->getEmail() ?? '') ?>">
        </div>
        <div class="form-group mt-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" value="<?= htmlspecialchars($viewVar['juiz']->getSenha() ?? '') ?>">
        </div>

        <button type="submit" class="btn btn-success mt-4">Salvar</button>
        <a href="http://<?php echo APP_HOST; ?>/juiz/index" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
