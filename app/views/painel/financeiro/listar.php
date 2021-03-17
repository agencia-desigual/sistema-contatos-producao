<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Notas Financeira</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>financeiros">Notas financeira</a></li>
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

                    <h4 class="mt-0 header-title">Todas as notas financeiras</h4>
                    <p class="sub-title../plugins">
                        Abaixo estão todos as notas financeiras que você pode gerenciar no sistema.
                    </p>

                    <button data-toggle="modal" data-target=".bs-example-modal-center" style="margin-bottom:20px;font-weight: bold; background-color: #CB245E; border: 2px solid #CB245E" type="submit" class="btn btn-primary waves-effect waves-light">
                        RELATÓRIO
                    </button>

                    <table id="aaa" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Arquivo</th>
                            <th>Data Lançamento</th>
                            <th>Data Cadastro</th>
                            <th class="text-center">Acôes</th>
                        </tr>
                        </thead>


                        <tbody>
                            <?php if (!empty($notas)) : ?>
                                <?php foreach ($notas as $nota) : ?>
                                    <tr id="tb_<?= $nota->id_financeiro ?>">
                                        <td><?= $nota->empresa ?></td>
                                        <td>R$<?= $nota->valor ?></td>
                                        <td>
                                            <?php if (!empty($nota->arquivo)) : ?>
                                                <a target="_blank" href="<?= $nota->arquivo ?>">acessar</a>
                                            <?php else : ?>
                                                <p>sem aquivo</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date("d/m/Y", strtotime($nota->data)) ?></td>

                                        <td><span class="d-none"><?= date("YmdHis",strtotime($nota->data_cadastro)) ?></span><?= date("d/m/Y H:i:s", strtotime($nota->data_cadastro)) ?></td>

                                        <td class="text-center">
                                            <a href="<?= BASE_URL ?>financeiro/editar/<?= $nota->id_financeiro ?>"
                                               class="btn btn-primary btn-sm"
                                               style="padding: 10px;font-size: 13px;font-weight: 800;margin-right: 10px">EDITAR <i class="far fa-edit"></i></a>

                                            <a href="#" data-id="<?= $nota->id_financeiro ?>"
                                               class="btn btn-danger btn-sm deletarNota"
                                               style="padding: 10px;font-size: 13px;font-weight: 800">EXCLUIR <i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Sem Notas financeira</p>
                            <?php endif; ?>
                        </tbody>

                    </table>

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
                    <h5 class="modal-title mt-0">Relatório Financeiro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="relatorio">

                        <div class="row">

                            <!-- DATA INICIO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Data Início</label>
                                    <input type="date" name="data_inicio" class="form-control" required="" value="" >
                                </div>
                            </div>

                            <!-- DATA FIM -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Data Fim</label>
                                    <input type="date" name="data_fim" class="form-control" required="" value="<?= date('Y-m-d') ?>" >
                                </div>
                            </div>

                            <!-- EMPRESAS -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Empresas</label>
                                    <select name="id_empresa" class="form-control">
                                        <option value="0" selected>Todas</option>
                                        <?php foreach ($empresas as $empresa) : ?>
                                            <option value="<?= $empresa->id_cliente ?>"><?= $empresa->nome ?></option>
                                        <?php endforeach; ?>
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
            "order": [[ 4, "desc" ]]
        } );
    } );
</script>