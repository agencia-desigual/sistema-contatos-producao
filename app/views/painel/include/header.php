<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= SITE_NOME ?> - Sistema de Gerenciamento de Modelos</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="https://desigual.com.br/site/arquivos/assets/img/favicon.png">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/theme/stexoplugins/morris/morris.css">

    <link href="<?= BASE_URL; ?>assets/theme/stexo/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/stexo/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/stexo/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL; ?>assets/theme/stexo/css/style.css" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= BASE_URL; ?>assets/theme/stexo/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


    <!-- Autoload CSS -->
    <?php $this->view("autoload/css"); ?>

</head>

<body>

    <div class="header-bg">

        <!-- NAVIGATION-->
        <header id="topnav">

            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- LOGO -->
                    <div>
                        <a href="<?= BASE_URL ?>painel" class="logo">
                                <span class="logo-light">
                                        <img src="<?= BASE_URL ?>assets/custom/img/logo-branca.png">
                                </span>
                        </a>
                    </div>
                    <!-- FIM >> LOGO -->

                    <!-- INFO -->
                    <div class="menu-extras topbar-custom navbar p-0">

                        <ul class="navbar-right ml-auto list-inline float-right mb-0">

                            <!-- TELA CHEIA -->
                            <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                                <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                    <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                                </a>
                            </li>
                            <!-- FIM >> TELA CHEIA -->

                            <!-- USUARIO -->
                            <li class="dropdown notification-list list-inline-item">
                                <div class="dropdown notification-list nav-pro-img">
                                    <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                                        <img src="<?= BASE_URL; ?>assets/custom/img/avatar/<?= $_SESSION['avatar'] ?>.png" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Meu Perfil</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="<?= BASE_URL; ?>sair"><i class="mdi mdi-power text-danger"></i> Sair</a>
                                    </div>
                                </div>
                            </li>
                            <li class="menu-item dropdown notification-list list-inline-item">
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                            </li>
                            <!-- FIM >> USUARIO -->

                        </ul>

                    </div>
                    <div class="clearfix"></div>
                    <!-- FIM >> INFO -->

                </div>
            </div>

            <!-- MENU -->
            <div class="navbar-custom">
                <div class="container-fluid">

                    <div id="navigation">
                        <ul class="navigation-menu">

                            <!-- DASHBOARD -->
                            <li class="has-submenu">
                                <a href="<?= BASE_URL; ?>painel"><i class="fas fa-chart-pie"></i> Dashboard</a>
                            </li>
                            <!-- FIM >> DASHBOARD -->

                            <!-- CATEGORIAS -->
                            <li class="has-submenu">

                                <a href="#"><i class="fas fa-list"></i> Categorias <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                <ul class="submenu">

                                    <li>
                                        <a href="<?= BASE_URL; ?>categoria/adicionar">Adicionar</a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL ?>categorias">Todas as categorias</a>
                                    </li>

                                </ul>
                            </li>
                            <!-- FIM >> CATEGORIAS -->

                            <!-- FORNECEDORES -->
                            <li class="has-submenu">
                                <a href="#"><i class="fas fa-truck"></i> Fornecedores <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                <ul class="submenu">

                                    <li>
                                        <a href="<?= BASE_URL; ?>fornecedor/adicionar">Adicionar</a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL; ?>fornecedores">Todos os fornecedores</a>
                                    </li>

                                </ul>
                            </li>
                            <!-- FIM >> FORNECEDORES -->

                            <!-- MODELOS -->
                            <li class="has-submenu">

                                <a href="#"><i class="fas fa-user-friends"></i> Modelos <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                <ul class="submenu">

                                    <li>
                                        <a href="<?= BASE_URL; ?>modelo/adicionar">Adicionar</a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL ?>modelos">Todos os modelos</a>
                                    </li>

                                </ul>
                            </li>
                            <!-- FIM >> MODELOS -->

                            <!-- USUÁRIOS -->
                            <li class="has-submenu">

                                <a href="#"><i class="fas fa-user-shield"></i> Usuários <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="<?= BASE_URL; ?>usuario/adicionar">Adicionar</a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL ?>usuarios">Todos os usuários</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- FIM >> USUÁRIOS -->

                        </ul>
                    </div>

                </div>

            </div>
            <!-- FIM >> MENU -->

        </header>
        <!-- FIM >>  NAVIGATION -->

    </div>

    <div class="wrapper">
        <div class="container-fluid">