<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Usuários</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>usuarios">Usuários</a></li>
                    <li class="breadcrumb-item active">Adicionar</li>
                </ol>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- FIM >> BREADCRUMB -->

    <!-- TABELA -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Adicionar Usuário</h4>
                    <p class="sub-title">Adicione um novo usuário para te ajudar com o gerenciamento do sistema.</p>

                    <form id="formInserirUsuario">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>NOME</label>
                                    <input type="text" name="nome" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>E-MAIL</label>
                                    <input type="email" name="email" class="form-control" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>SENHA</label>
                                    <input type="password" name="senha" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>STATUS</label>
                                    <select name="status" required class="form-control">
                                        <option selected value="1">ATIVO</option>
                                        <option value="0">DESATIVADO</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="mt-3">
                                <button style="font-weight: bold; background-color: #CB245E; border: 2px solid #CB245E" type="submit" class="btn btn-primary waves-effect waves-light">
                                    CADASTRAR
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>