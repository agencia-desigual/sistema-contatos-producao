<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Modelos</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>modelos">Modelos</a></li>
                    <li class="breadcrumb-item active">Todos</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- FIM >> BREADCRUMB -->

    <!-- TABELA -->
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Todas os Modelos</h4>
                    <p class="sub-title../plugins">
                        Abaixo estão todos os modelos que você pode gerenciar no sistema.
                    </p>

                    <button data-toggle="modal" data-target=".bs-example-modal-center" style="margin-bottom:20px;font-weight: bold; background-color: #CB245E; border: 2px solid #CB245E" type="submit" class="btn btn-primary waves-effect waves-light">
                        RELATÓRIO
                    </button>

                    <div class="row">
                        <?php if (!empty($modelos)) : ?>
                            <?php foreach ($modelos as $modelo) : ?>

                                <div class="col-lg-4 col-md-6 col-12 mb-2">
                                    <div class="card faq-box <?= ($modelo->sexo == 'masculino') ? 'border-primary' : 'border-danger' ?>">
                                        <div class="card-body">
                                            <div class="faq-icon float-right">
                                                <?php if ($modelo->canal == "sistema") : ?>
                                                    <span style=" font-weight: 600;margin-top: 10px;padding: 5px;font-size: 13px;font-weight: 600;" class="badge badge-primary">SISTEMA</span>
                                                <?php else : ?>
                                                    <span style="padding: 5px;margin-top: 10px;font-size: 13px;font-weight: 600;" class="badge badge-success">SITE</span>
                                                <?php endif; ?>
                                            </div>
                                            <h5 style="text-transform: capitalize;color: #fff !important;max-width: 300px !important;" class="text-primary"><?= $modelo->nome ?></h5>
                                            <h5 class="font-13 mb-3 mt-4">CPF:<?= (!empty($modelo->cpf)) ? $modelo->cpf : 'não informado' ?> - CONTATO: <?= (!empty($modelo->telefone)) ? $modelo->telefone : 'não informado' ?></h5>
                                            <p class="text-muted mb-0">
                                                <?= $modelo->idade ?> anos, <?= $modelo->etnia ?>, Manequim: <?= $modelo->manequim ?>, Calçado: <?= $modelo->calcado ?>, Altura <?= $modelo->altura ?>, <?= $modelo->cidade.'/'.$modelo->estado ?>.
                                                <br>
                                                <b>Atuação:</b> <?= $modelo->atuacao ?>
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">


                                                <?php if (!empty($modelo->imagem)) : ?>
                                                    <div style="padding: 5px;" class="<?= (empty($modelo->imagem)) ? 'col-md-6' : 'col-md-4'  ?>">
                                                        <a href="#" class="btn btn-primary btn-sm" style="font-size: 13px;padding: 10px;font-weight: 800;width: 100%" data-toggle="modal" data-target="#modelo-<?= $modelo->id_modelo ?>">IMAGENS <i class="far fa-file-image"></i></a>
                                                    </div>
                                                <?php endif; ?>

                                                <div style="padding: 5px;" class="<?= (empty($modelo->imagem)) ? 'col-md-6' : 'col-md-4'  ?>">
                                                    <a href="<?= BASE_URL ?>modelo/editar/<?= $modelo->id_modelo ?>" class="btn btn-primary btn-sm" style="font-size: 13px;padding: 10px;font-weight: 800;width: 100%">EDITAR <i class="far fa-edit"></i></a>
                                                </div>
                                                <div style="padding: 5px;" class="<?= (empty($modelo->imagem)) ? 'col-md-6' : 'col-md-4'  ?>">
                                                    <a href="#" data-id="<?= $modelo->id_modelo ?>" class="btn btn-danger btn-sm deletarModelo" style="font-size: 13px;padding: 10px;font-weight: 800;width: 100%">EXCLUIR <i class="far fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($modelo)) : ?>
                                    <div class="modal fade" id="modelo-<?= $modelo->id_modelo ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"><?= $modelo->nome ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <?php foreach ($modelo->imagem as $imagem) : ?>
                                                            <div class="col-md-6">
                                                                <img style="width: 100%" src="<?= BASE_STORAGE ?>fotos/<?= $imagem->imagem ?>">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Sem Modelos</p>
                        <?php endif; ?>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

    <!-- MODAL -->
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Relatório de Modelos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="relatorioModelos">

                        <div class="row">

                            <!-- SEXO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Sexo</label>
                                    <select name="sexo" class="form-control">
                                        <option selected value="0">Todas</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ETNIA -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Etnia</label>
                                    <select name="etnia" class="form-control">

                                        <?php if (!empty($etnias)) : ?>

                                            <option selected value="0">Todas</option>
                                            <?php foreach ($etnias as $etnia) : ?>
                                                <option value="<?= $etnia->etnia ?>"><?= $etnia->etnia ?></option>
                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </select>
                                </div>
                            </div>

                            <!-- MANEQUIM -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Manequim</label>
                                    <select name="manequim" class="form-control">

                                        <?php if (!empty($manequins)) : ?>

                                            <option selected value="0">Todas</option>
                                            <?php foreach ($manequins as $manequim) : ?>

                                                <?php if ($manequim != "-") : ?>
                                                    <option value="<?= $manequim->manequim ?>"><?= $manequim->manequim ?></option>
                                                <?php endif; ?>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </select>
                                </div>
                            </div>

                            <!-- ALTURA -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Altura</label>
                                    <select name="altura" class="form-control">
                                        <?php if (!empty($alturas)) : ?>

                                            <option selected value="0">Todas</option>
                                            <?php foreach ($alturas as $altura) : ?>
                                                <option value="<?= $altura->altura ?>"><?= $altura->altura ?></option>
                                            <?php endforeach; ?>

                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- CALCADO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Calçado</label>
                                    <select name="calcado" class="form-control">
                                        <?php if (!empty($calcados)) : ?>

                                            <option selected value="0">Todas</option>
                                            <?php foreach ($calcados as $calcado) : ?>
                                                <option value="<?= $calcado->calcado ?>"><?= $calcado->calcado ?></option>
                                            <?php endforeach; ?>

                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="mt-3">
                                <button style="width: 100%;font-weight: bold; background-color: #CB245E; border: 2px solid #CB245E" type="submit" class="btn btn-primary waves-effect waves-light">
                                    GERAR
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> MODAL -->

<?php $this->view("painel/include/footer"); ?>

<script>
    $(document).ready(function() {
        $('#aaa').DataTable( {
            "order": [[ 5, "desc" ]]
        } );
    } );
</script>