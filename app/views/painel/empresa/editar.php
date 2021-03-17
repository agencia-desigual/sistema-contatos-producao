<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Empresas</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>empresas">Empresas</a></li>
                    <li class="breadcrumb-item active">Editar</li>
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

                    <h4 class="mt-0 header-title">Editar Empresa</h4>
                    <p class="sub-title">Editar empresa ao sistema</p>

                    <form id="formEditarEmpresa" data-id="<?= $empresa->id_cliente ?>">

                        <!-- NOME e SITE -->
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="nome" value="<?= $empresa->nome ?>" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>Site</label>
                                    <input type="text" name="site" class="form-control" value="<?= $empresa->site ?>" />
                                </div>
                            </div>
                        </div>

                        <!-- CNPJ e CPF -->
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>CNPJ</label>
                                    <input type="tel" name="cnpj" class="form-control maskCNPJ" value="<?= $empresa->cnpj ?>" />
                                </div>
                            </div>
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input type="tel" name="cpf" class="form-control maskCPF" value="<?= $empresa->cpf ?>" />
                                </div>
                            </div>

                        </div>

                        <div class="row pt-2">
                            <div class="col-md-12">
                                <button type="submit" style="background-color: #CB245E; border-color: #CB245E;" class="btn btn-primary">EDITAR</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>