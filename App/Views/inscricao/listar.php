<div class="container mt-4">
    <h2>Fichas de Inscrição</h2>
    <a href="http://<?php echo APP_HOST; ?>/inscricao/cadastrar" class="btn btn-success mb-3">Nova Ficha</a>

    <?= $Sessao::retornaMensagem() ?>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nº Inscrição</th>
                <th>Produtor</th>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($viewVar['inscricoes'] as $inscricao): ?>
            <tr>
                <td><?= $inscricao->getNumeroInscricao() ?></td>
                <td><?= htmlspecialchars($inscricao->getNomeProdutor()) ?></td>
                <td><?= htmlspecialchars($inscricao->getNomeProduto()) ?></td>
                <td>
                    <?php
                        $tipos = [
                            'organico' => 'Orgânico',
                            'convencional' => 'Convencional',
                            'nao_convencional' => 'Não Convencional'
                        ];
                        echo $tipos[$inscricao->getTipoProduto()] ?? $inscricao->getTipoProduto();
                    ?>
                </td>
                <td>
                    <a href="http://<?php echo APP_HOST; ?>/inscricao/editar/<?= $inscricao->getNumeroInscricao() ?>" class="btn btn-warning btn-sm">Editar</a>
                    <form action="http://<?php echo APP_HOST; ?>/inscricao/excluir" method="POST" class="d-inline">
                        <input type="hidden" name="numero_inscricao" value="<?= $inscricao->getNumeroInscricao() ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
