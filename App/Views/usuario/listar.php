<div class="container mt-4">
    <h2>Usuários do Sistema</h2>
    <a href="http://<?php echo APP_HOST; ?>/usuario/cadastrar" class="btn btn-success mb-3">Novo Usuário</a>

    <?= $Sessao::retornaMensagem() ?>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Papel</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($viewVar['usuarios'] as $usuario): ?>
            <tr>
                <td><?= $usuario->getIdUsuario() ?></td>
                <td><?= htmlspecialchars($usuario->getNome()) ?></td>
                <td><?= htmlspecialchars($usuario->getEmail()) ?></td>
                <td><?= htmlspecialchars($usuario->getPapel()) ?></td>
                <td>
                    <a href="http://<?php echo APP_HOST; ?>/usuario/editar/<?= $usuario->getIdUsuario() ?>" class="btn btn-warning btn-sm">Editar</a>
                    <form action="http://<?php echo APP_HOST; ?>/usuario/excluir" method="POST" class="d-inline">
                        <input type="hidden" name="id_usuario" value="<?= $usuario->getIdUsuario() ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
