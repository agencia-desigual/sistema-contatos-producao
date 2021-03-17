<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Fornecedores</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>fornecedores">Fornecedores</a></li>
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

                    <h4 class="mt-0 header-title">Todas as Empresas</h4>
                    <p class="sub-title../plugins">
                        Abaixo estão todas as empresas que você pode gerenciar no sistema.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CNPJ / CPF</th>
                            <th class="text-center">Acôes</th>
                        </tr>
                        </thead>


                        <tbody>
                            <?php if (!empty($empresas)) : ?>
                                <?php foreach ($empresas as $empresa) : ?>
                                    <tr id="tb_<?= $empresa->id_cliente; ?>">
                                        <td><?= $empresa->nome ?></td>
                                        <td><?= (!empty($empresa->cnpj)) ? $empresa->cnpj : $empresa->cpf ?></td>
                                        <td class="text-center">
                                            <a href="<?= BASE_URL ?>empresa/editar/<?= $empresa->id_cliente ?>"
                                               class="btn btn-primary btn-sm"
                                               style="padding: 10px;font-size: 13px;font-weight: 800;margin-right: 10px">EDITAR <i class="far fa-edit"></i></a>

                                            <a href="#" data-id="<?= $empresa->id_cliente ?>"
                                               class="btn btn-danger btn-sm excluirEmpresa"
                                               style="padding: 10px;font-size: 13px;font-weight: 800">EXCLUIR <i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Sem Empresas</p>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>