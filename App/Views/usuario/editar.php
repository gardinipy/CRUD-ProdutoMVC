<div class="container mt-4">
    <h2>Editar Usuário</h2>

    <?= $Sessao::retornaMensagem() ?>

    <form action="http://<?php echo APP_HOST; ?>/usuario/salvar/editar" method="POST" class="card p-4 shadow-sm">
        <input type="hidden" name="id_usuario" value="<?= $viewVar['usuario']->getIdUsuario() ?>">

        <div class="form-group">
            <label>Nome *</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($viewVar['usuario']->getNome()) ?>" required>
        </div>
        <div class="form-group mt-3">
            <label>E-mail *</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($viewVar['usuario']->getEmail()) ?>" required>
        </div>
        <div class="form-group mt-3">
            <label>Senha *</label>
            <input type="password" name="senha" class="form-control" value="<?= htmlspecialchars($viewVar['usuario']->getSenha()) ?>" required>
        </div>
        <div class="form-group mt-3">
            <label>Papel *</label>
            <select name="papel" class="form-control" required>
                <option value="cadastro" <?= $viewVar['usuario']->getPapel() == 'cadastro' ? 'selected' : '' ?>>Cadastro</option>
                <option value="juiz" <?= $viewVar['usuario']->getPapel() == 'juiz' ? 'selected' : '' ?>>Juiz</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-4">Salvar</button>
        <a href="http://<?php echo APP_HOST; ?>/usuario/index" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>
