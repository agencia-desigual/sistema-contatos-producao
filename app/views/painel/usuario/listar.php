<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Usuários</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>usuarios">Usuários</a></li>
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

                    <h4 class="mt-0 header-title">Todas os usuários</h4>
                    <p class="sub-title../plugins">
                        Abaixo estão todos os usuários que tem acesso ao sistema.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Nível</th>
                            <th class="text-center">Acôes</th>
                        </tr>
                        </thead>


                        <tbody>
                            <?php if (!empty($usuarios)) : ?>
                                <?php foreach ($usuarios as $usuario) : ?>
                                    <tr>
                                        <td><?= $usuario->nome ?></td>
                                        <td><?= $usuario->email ?></td>
                                        <td class="text-center">
                                            <?php if ($usuario->status == 1) : ?>
                                                <span style="padding: 10px;font-size: 15px;font-weight: 600;" class="badge badge-success">ATIVO</span>
                                            <?php else : ?>
                                                <span style="padding: 10px;font-size: 15px;font-weight: 600;" class="badge badge-danger">DESATIVADO</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span style="padding: 10px;font-size: 15px;font-weight: 600;" class="badge badge-primary">ADMIN</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= BASE_URL ?>usuario/editar/<?= $usuario->id_usuario ?>"
                                               class="btn btn-primary btn-sm"
                                               style="padding: 10px;font-size: 13px;font-weight: 800;margin-right: 10px">EDITAR <i class="far fa-edit"></i></a>

                                            <?php if ($user->id_usuario != $usuario->id_usuario) : ?>
                                                <a href="#" data-id="<?= $usuario->id_usuario ?>"
                                                   class="btn btn-danger btn-sm excluirUsuario"
                                                   style="padding: 10px;font-size: 13px;font-weight: 800">EXCLUIR <i class="far fa-trash-alt"></i></a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Sem Usuários</p>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>