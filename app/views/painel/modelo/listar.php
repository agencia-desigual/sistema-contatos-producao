<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Modelos</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
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
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Idade</th>
                            <th>Cidade / Estado</th>
                            <th class="text-center">Canal</th>
                            <th class="text-center">Acôes</th>
                        </tr>
                        </thead>


                        <tbody>
                            <?php if (!empty($modelos)) : ?>
                                <?php foreach ($modelos as $modelo) : ?>
                                    <tr>
                                        <td><?= $modelo->nome ?></td>
                                        <td><?= $modelo->cpf ?></td>
                                        <td><?= $modelo->telefone ?></td>
                                        <td><?= $modelo->idade ?></td>
                                        <td><?= $modelo->cidade.' / '.$modelo->estado ?></td>

                                        <td class="text-center">
                                            <?php if ($modelo->canal == "sistema") : ?>
                                                <span style="padding: 10px;font-size: 15px;font-weight: 600;" class="badge badge-primary">SISTEMA</span>
                                            <?php else : ?>
                                                <span style="padding: 10px;font-size: 15px;font-weight: 600;" class="badge badge-success">SITE</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <a href="<?= BASE_URL ?>fornecedor/editar/<?= $fornecedor->id_fornecedor ?>"
                                               class="btn btn-primary btn-sm"
                                               style="padding: 10px;font-size: 13px;font-weight: 800;margin-right: 10px">EDITAR <i class="far fa-edit"></i></a>

                                            <a href="#" data-id="<?= $fornecedor->id_fornecedor ?>"
                                               class="btn btn-danger btn-sm excluirModelo"
                                               style="padding: 10px;font-size: 13px;font-weight: 800">EXCLUIR <i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Sem Modelos</p>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>