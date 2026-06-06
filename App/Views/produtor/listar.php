<div class="container mt-4">
    <h2>Produtores Rurais</h2>
    <a href="http://<?php echo APP_HOST; ?>/produtor/cadastrar" class="btn btn-success mb-3">Novo Produtor</a>

    <?= $Sessao::retornaMensagem() ?>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Município</th>
                <th>Bairro</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($viewVar['produtores'] as $produtor): ?>
            <tr>
                <td><?= $produtor->getIdProdutor() ?></td>
                <td><?= htmlspecialchars($produtor->getNomeProdutor()) ?></td>
                <td><?= htmlspecialchars($produtor->getMunicipio()) ?></td>
                <td><?= htmlspecialchars($produtor->getBairro()) ?></td>
                <td><?= htmlspecialchars($produtor->getTelefone()) ?></td>
                <td>
                    <a href="http://<?php echo APP_HOST; ?>/produtor/editar/<?= $produtor->getIdProdutor() ?>" class="btn btn-warning btn-sm">Editar</a>
                    <form action="http://<?php echo APP_HOST; ?>/produtor/excluir" method="POST" class="d-inline">
                        <input type="hidden" name="id_produtor" value="<?= $produtor->getIdProdutor() ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
