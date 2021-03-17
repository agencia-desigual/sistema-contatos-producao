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
                    <li class="breadcrumb-item active">Adicionar</li>
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

                    <h4 class="mt-0 header-title">Adicionar Empresa</h4>
                    <p class="sub-title">Adicione uma nova empresa ao sistema</p>

                    <form id="formAdicionarEmpresa">

                        <!-- NOME e SITE -->
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="nome" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>Site</label>
                                    <input type="text" name="site" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <!-- CNPJ e CPF -->
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>CNPJ</label>
                                    <input type="tel" name="cnpj" class="form-control maskCNPJ" />
                                </div>
                            </div>
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input type="tel" name="cpf" class="form-control maskCPF" />
                                </div>
                            </div>

                        </div>

                        <div class="row pt-2">
                            <div class="col-md-12">
                                <button type="submit" style="background-color: #CB245E; border-color: #CB245E;" class="btn btn-primary">CADASTRAR</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>