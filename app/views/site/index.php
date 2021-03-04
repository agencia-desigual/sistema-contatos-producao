<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Potenza - Job Application Form Wizard with Resume upload and Branch feature">
    <meta name="author" content="Ansonika">
    <title>Potenza | Job Application Form Wizard by Ansonika</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="<?= BASE_URL; ?>assets/theme/potenza/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?= BASE_URL; ?>assets/theme/potenza/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?= BASE_URL; ?>assets/theme/potenza/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?= BASE_URL; ?>assets/theme/potenza/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?= BASE_URL; ?>assets/theme/potenza/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="<?= BASE_URL; ?>assets/theme/potenza/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL; ?>assets/theme/potenza/css/menu.css" rel="stylesheet">
    <link href="<?= BASE_URL; ?>assets/theme/potenza/css/style.css" rel="stylesheet">
    <link href="<?= BASE_URL; ?>assets/theme/potenza/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="<?= BASE_URL; ?>assets/theme/potenza/css/custom.css" rel="stylesheet">

    <!-- MODERNIZR MENU -->
    <script src="<?= BASE_URL; ?>assets/theme/potenza/js/modernizr.js"></script>

    <?php $this->view("autoload/css"); ?>

</head>

<body>

<div id="preloader">
    <div data-loader="circle-side"></div>
</div><!-- /Preload -->

<div id="loader_form">
    <div data-loader="circle-side-2"></div>
</div><!-- /loader_form -->


<div class="container-fluid">
    <div class="row row-height">
        <div class="col-xl-4 col-lg-4 content-left">
            <div class="content-left-wrapper">
                <a href="https://desigual.com.br" id="logo"><img src="<?= BASE_URL; ?>assets/custom/img/desigual.png" style="padding-top: 6px;" alt="Desigual Logo"></a>
                <div id="social">
                    <ul>
                        <li><a href="https://www.facebook.com/agenciadesigual" target="_blank"><i class="icon-facebook"></i></a></li>
                        <li><a href="https://www.youtube.com/user/agenciadesigual" target="_blank"><i class="icon-youtube-play"></i></a></li>
                        <li><a href="https://www.instagram.com/agenciadesigual/" target="_blank"><i class="icon-instagram"></i></a></li>
                    </ul>
                </div>
                <!-- /social -->
                <div>
                    <figure><img src="<?= BASE_URL; ?>assets/custom/img/icone.png" alt="" class="img-fluid" width="370"></figure>
                    <h2>Queremos Você!</h2>
                    <p>Quer fazer parte e abrilhantar ainda mais as nossas produções? Preencha o formulário ao lado. Caso seu perfil se encaixe em alguns de nossos jobs entraremos em contato. Boa Sorte!</p>
                </div>
                <div class="copy">© <?= date("Y"); ?> - Desigual</div>
            </div>
            <!-- /content-left-wrapper -->
        </div>
        <!-- /content-left -->


        <div class="col-xl-8 col-lg-8 content-right" id="start">
            <div id="wizard_container">
                <div id="top-wizard">
                    <span id="location"></span>
                    <div id="progressbar"></div>
                </div>
                <!-- /top-wizard -->
                <form id="formCadastraModelo">
                    <input id="website" name="website" type="text" value="">

                    <input name="canal" type="hidden" value="site" />

                    <!-- Leave for security protection, read docs for details -->
                    <div id="middle-wizard">
                        <div class="step">
                            <h2 class="section_title">Cadastro de Modelo</h2>
                            <h3 class="main_question">Informações Pessoais</h3>

                            <div class="form-group add_top_30">
                                <label>Seu nome *</label>
                                <input type="text" name="nome" class="form-control" placeholder="Seu nome">
                            </div>

                            <div class="form-group pt-1">
                                <label>CPF *</label>
                                <input type="text" name="cpf" class="form-control maskCPF" placeholder="XXX.XXX.XXX-XX">
                            </div>

                            <div class="form-group pt-1">
                                <label>Data de nascimento *</label>
                                <input type="date" name="dataNascimento" class="form-control">
                            </div>


                            <label>Sexo *</label>
                            <div class="form-group radio_input">
                                <label class="container_radio mr-3">Masculino
                                    <input type="radio" name="sexo" value="masculino">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container_radio">Feminino
                                    <input type="radio" name="sexo" value="feminino">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                        <!-- /step-->

                        <!-- /Start Branch ============================== -->
                        <div class="step">
                            <h2 class="section_title">Cadastro de Modelo</h2>
                            <h3 class="main_question">Mais alguns dados sobre você</h3>

                            <div class="form-group pt-1">
                                <label>Sua etnia</label>
                                <input type="text" name="etnia" class="form-control" placeholder="ex: Parda">
                            </div>

                            <div class="form-group pt-1">
                                <label>Seu manequim</label>
                                <input type="text" name="manequim" placeholder="ex: M" class="form-control">
                            </div>

                            <div class="form-group pt-1">
                                <label>Sua altura</label>
                                <input type="text" name="altura" placeholder="ex: 1.76" class="form-control maskAltura">
                            </div>

                            <div class="form-group pt-1">
                                <label>Numero que calça</label>
                                <input type="text" name="calcado" placeholder="ex: 37" class="form-control">
                            </div>
                        </div>


                        <!-- /Start Branch ============================== -->
                        <div class="step">
                            <h2 class="section_title">Cadastro de Modelo</h2>
                            <h3 class="main_question">Informações para contato</h3>

                            <div class="form-group pt-1">
                                <label>Atuação *</label>
                                <input type="text" name="atuacao" class="form-control" placeholder="ex: Modelo, Atriz, Locução...">
                            </div>

                            <div class="form-group pt-1">
                                <label>Estado *</label>
                                <select name="estado" class="form-control">
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>

                            <div class="form-group pt-1">
                                <label>Cidade *</label>
                                <input type="text" name="cidade" placeholder="ex: São Paulo" class="form-control">
                            </div>

                            <div class="form-group pt-1">
                                <label>Telefone (WhatsApp) *</label>
                                <input type="text" name="telefone" placeholder="ex: (xx) xxxxx-xxxx" class="form-control maskCel">
                            </div>
                        </div>

                        <div class="submit step" id="end">
                            <div class="summary">
                                <h2 class="section_title">Cadastro de Modelo</h2>
                                <h3 class="main_question">Queremos conhecer você</h3>

                                <div class="form-group add_bottom_30 add_top_20">
                                    <label>Envia a sua melhor foto *<br><small>(Formatos Aceitos: .jpg, .png, .jpeg - Tamanho máximo de 5MB)</small></label>
                                    <div class="fileupload">
                                        <input type="file" name="arquivo" accept=".jpg,.png,jpeg" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /step last-->

                    </div>
                    <!-- /middle-wizard -->
                    <div id="bottom-wizard">
                        <button type="button" name="backward" class="backward">Voltar</button>
                        <button type="button" name="forward" class="forward">Continuar</button>
                        <button type="submit" name="process" class="submit">Cadastrar</button>
                    </div>
                    <!-- /bottom-wizard -->
                </form>
            </div>
            <!-- /Wizard container -->
        </div>
        <!-- /content-right-->
    </div>
    <!-- /row-->
</div>
<!-- /container-fluid -->

<div class="cd-overlay-nav">
    <span></span>
</div>
<!-- /cd-overlay-nav -->

<div class="cd-overlay-content">
    <span></span>
</div>
<!-- /cd-overlay-content -->


<!-- COMMON SCRIPTS -->
<script src="<?= BASE_URL; ?>assets/theme/potenza/js/jquery-3.5.1.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/potenza/js/common_scripts.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/potenza/js/velocity.min.js"></script>
<script src="<?= BASE_URL; ?>assets/theme/potenza/js/common_functions.js"></script>

<!-- Wizard script-->
<script src="<?= BASE_URL; ?>assets/theme/potenza/js/func_1.js"></script>

<?php $this->view("autoload/js"); ?>

</body>
</html>