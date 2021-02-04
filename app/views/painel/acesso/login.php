<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso ao Sistema | <?= SITE_NOME; ?></title>

    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/iofrm/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/iofrm/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/iofrm/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/theme/iofrm/css/iofrm-theme19.css">
</head>
<body>

    <div class="form-body without-side">
        <div class="row">
            <div class="img-holder">
                <div class="bg" style="background-color: #34133d;"></div>
                <div class="info-holder">
                    <img src="<?= BASE_URL; ?>assets/theme/iofrm/images/graphic3.svg" alt="Gráfico <?= SITE_NOME; ?>" />
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="text-center pb-5">
                            <a href="<?= BASE_URL; ?>">
                                 <img style="width: 120px;" class="logo-size" src="<?= BASE_URL; ?>assets/custom/img/logo.png" alt="Logo <?= SITE_NOME; ?>">
                            </a>
                        </div>

                        <h3>Acesso ao sistema</h3>
                        <p>Informe suas credencias de acesso.</p>

                        <form id="formLogin">
                            <input class="form-control" type="text" name="email" placeholder="E-mail" required>
                            <input class="form-control" type="password" name="senha" placeholder="Senha" required>

                            <div class="form-button">
                                <button id="submit" style="background-color: #da256d;" type="submit" class="ibtn">Acessar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <script src='<?= BASE_URL; ?>assets/plugins/jquery/jquery-3.4.1.min.js'></script>

    <!-- Autoload JS ================================================== -->
    <?php $this->view("autoload/js"); ?>

    <script src="<?= BASE_URL; ?>assets/theme/iofrm/js/popper.min.js"></script>
</body>
</html>