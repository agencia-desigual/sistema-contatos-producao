<!doctype html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Contrato</title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
<style>
    body,html{padding: 0px; margin: 0px; font-family: 'Lato', sans-serif;}

    #conteudo
    {
        width: 600px;
        display: block;
        margin: 0 auto;
    }
    p span
    {
        font-weight: bold;
    }
</style>

<div id="conteudo">

    <?php foreach ($modelos as $modelo): ?>
        <div class="pg" style="page-break-after: always;">
            <h4>Informações Pessoas</h4>
            <p>
                NOME: <span><?= $modelo->nome; ?></span> <br>
                IDADE: <span><?= $modelo->idade; ?></span> <br>
                CONTATO: <span><?= $modelo->telefone; ?></span> <br>
                CIDADE: <span><?= $modelo->cidade; ?> / <?= $modelo->estado; ?></span> <br>
                ATUAÇÃO: <span><?= $modelo->atuacao; ?></span>
            </p>

            <br>
            <h4>Caracteristicas</h4>
            <p>
                ETNIA: <span><?= $modelo->etnia; ?></span> <br>
                ALTURA: <span><?= $modelo->altura; ?></span> <br>
                MANEQUIM: <span><?= $modelo->manequim; ?></span> <br>
                CALÇADO: <span><?= $modelo->calcado; ?></span>
            </p>

            <?php if(!empty($modelo->foto)): ?>
                <br>
                <img src="<?= $modelo->foto; ?>" style="max-height: 400px;">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

</div>
</body>
</html>