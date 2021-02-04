<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Categorias</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>categorias">Categorias</a></li>
                    <li class="breadcrumb-item active">Todas</li>
                </ol>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- FIM >> BREADCRUMB -->

    <!-- TABELA -->
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Todas as Categorias</h4>
                    <p class="sub-title../plugins">
                        Abaixo estão todas as categorias que você pode vincular no cadastro do fornecedor.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="text-center">Acôes</th>
                        </tr>
                        </thead>


                        <tbody>
                            <?php if (!empty($categorias)) : ?>
                                <?php foreach ($categorias as $categoria) : ?>
                                    <tr id="tb_<?= $categoria->id_categoria ?>">
                                        <td><?= $categoria->nome ?></td>
                                        <td class="text-center">
                                            <a href="<?= BASE_URL ?>categoria/editar/<?= $categoria->id_categoria ?>"
                                               class="btn btn-primary btn-sm"
                                               style="padding: 10px;font-size: 13px;font-weight: 800;margin-right: 10px">EDITAR <i class="far fa-edit"></i></a>

                                            <a href="#" data-id="<?= $categoria->id_categoria ?>"
                                               class="btn btn-danger btn-sm excluirCategoria"
                                               style="padding: 10px;font-size: 13px;font-weight: 800">EXCLUIR <i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Sem Categorias</p>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>