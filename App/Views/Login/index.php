<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Expo Agrícola</title>
    <link href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 350px;">
        <h3 class="text-center mb-4">Gestão Expo Agrícola</h3>
        
        <?php if(\App\Lib\Sessao::existe('mensagemErro')): ?>
            <div class="alert alert-danger"><?= \App\Lib\Sessao::retornaMensagem('mensagemErro') ?></div>
        <?php endif; ?>

        <form action="http://<?php echo APP_HOST; ?>/login/autenticar" method="POST">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required placeholder="cadastro@example.com">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" required placeholder="senha123">
            </div>
            <button type="submit" class="btn btn-success w-100">Acessar</button>
        </form>
    </div>
</div>
</body>
</html>