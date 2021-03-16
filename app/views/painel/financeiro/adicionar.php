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
                    <li class="breadcrumb-item active">Adicionar</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- FIM >> BREADCRUMB -->

    <!-- TABELA -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Adicionar Modelo</h4>
                    <p class="sub-title">Adicione um novo modelo.</p>

                    <form id="formCadastraModeloPainel">
                        <input type="hidden" name="canal" value="sistema">
                        <div class="row">

                            <!-- NOME -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>NOME</label>
                                    <input type="text" name="nome" class="form-control" required="">
                                </div>
                            </div>

                            <!-- CPF -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input type="tel" name="cpf" class="form-control maskCPF" required="">
                                </div>
                            </div>

                            <!-- TELEFONE / CELULAR -->
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label>TELEFONE / CELULAR</label>
                                    <input type="tel" name="telefone" class="form-control maskTelCel" required="">
                                </div>
                            </div>

                            <!-- DATA NASCIMENTO -->
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label>DATA NASCIMENTO</label>
                                    <input type="date" name="dataNascimento" class="form-control" required="">
                                </div>
                            </div>

                            <!-- SEXO -->
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label>SEXO</label>
                                    <select class="form-control" name="sexo">
                                        <option selected disabled>Selecione</option>
                                        <option value="feminino">Feminino</option>
                                        <option value="masculino">Masculino</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ETNIA -->
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>ETNIA</label>
                                    <input type="text" name="etnia" class="form-control">
                                </div>
                            </div>

                            <!-- MANEQUIM -->
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>MANEQUIM</label>
                                    <input type="text" name="manequim" class="form-control">
                                </div>
                            </div>

                            <!-- CALÇADO -->
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>CALÇADO</label>
                                    <input type="tel" name="calcado" class="form-control maskCalcado">
                                </div>
                            </div>

                            <!-- ALTURA -->
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>ALTURA</label>
                                    <input type="tel" name="altura" class="form-control maskAltura">
                                </div>
                            </div>

                            <!-- CIDADE -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>CIDADE</label>
                                    <input type="text" name="cidade" class="form-control" required="">
                                </div>
                            </div>

                            <!-- ESTADO -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>ESTADO</label>
                                    <select name="estado" class="form-control" required>
                                        <option selected disabled>Selecione</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="DF">Distrito Federal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ATUAÇÃO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>ATUAÇÃO</label>
                                    <textarea class="form-control" rows="4" name="atuacao"></textarea>
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