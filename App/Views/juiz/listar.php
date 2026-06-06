<div class="container mt-4">
    <h2>Juízes</h2>
    <a href="http://<?php echo APP_HOST; ?>/juiz/cadastrar" class="btn btn-success mb-3">Novo Juiz</a>

    <?= $Sessao::retornaMensagem() ?>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($viewVar['juizes'] as $juiz): ?>
            <tr>
                <td><?= $juiz->getIdJuiz() ?></td>
                <td><?= htmlspecialchars($juiz->getNomeJuiz()) ?></td>
                <td><?= htmlspecialchars($juiz->getEmail() ?? '-') ?></td>
                <td>
                    <a href="http://<?php echo APP_HOST; ?>/juiz/editar/<?= $juiz->getIdJuiz() ?>" class="btn btn-warning btn-sm">Editar</a>
                    <form action="http://<?php echo APP_HOST; ?>/juiz/excluir" method="POST" class="d-inline">
                        <input type="hidden" name="id_juiz" value="<?= $juiz->getIdJuiz() ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
