<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Fornecedores</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><?= SITE_NOME ?></a></li>
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

                    <h4 class="mt-0 header-title">Adicionar Fornecedor</h4>
                    <p class="sub-title">Adicione um novo fornecedor ao sistema</p>

                    <form id="formAdicionarFornecedor">

                        <!-- Nome e Telefone -->
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="id_categoria" class="form-control" required>
                                        <option selected disabled>Selecione</option>
                                        <?php foreach ($categorias as $categoria): ?>
                                            <option value="<?= $categoria->id_categoria; ?>"><?= $categoria->nome; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="nome" class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <!-- Cidade e Email -->
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" name="telefone" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-6 pt-2">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 pt-2">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" name="cidade" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-12 pt-2">
                                <div class="form-group">
                                    <label>Observação</label>
                                    <textarea class="form-control" name="observacao" rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" style="background-color: #CB245E; border-color: #CB245E;" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>