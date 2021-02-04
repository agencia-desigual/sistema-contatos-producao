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
        <div class="col-md-7">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Editar Modelo</h4>
                    <p class="sub-title">Edite os dados da modelo.</p>

                    <form id="formAlterarModeloPainel" data-id="<?= $modelo->id_modelo ?>">
                        <input type="hidden" name="canal" value="sistema">
                        <div class="row">

                            <!-- NOME -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>NOME</label>
                                    <input type="text" name="nome" class="form-control" value="<?= $modelo->nome ?>" required="">
                                </div>
                            </div>

                            <!-- CPF -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input type="tel" name="cpf" class="form-control maskCPF" value="<?= $modelo->cpf ?>" required="">
                                </div>
                            </div>

                            <!-- TELEFONE / CELULAR -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>TELEFONE / CELULAR</label>
                                    <input type="tel" name="telefone" class="form-control maskTelCel" value="<?= $modelo->telefone ?>" required="">
                                </div>
                            </div>

                            <!-- DATA NASCIMENTO -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>DATA NASCIMENTO</label>
                                    <input type="date" name="dataNascimento" class="form-control" value="<?= $modelo->dataNascimento ?>" required="">
                                </div>
                            </div>

                            <!-- SEXO -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>SEXO</label>
                                    <select class="form-control" name="sexo">
                                        <option selected disabled>Selecione</option>
                                        <option <?= ($modelo->sexo == "feminino") ? 'selected' : '' ?> value="feminino">Feminino</option>
                                        <option <?= ($modelo->sexo == "masculino") ? 'selected' : '' ?> value="masculino">Masculino</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ETNIA -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>ETNIA</label>
                                    <input type="text" name="etnia" class="form-control" value="<?= $modelo->etnia ?>">
                                </div>
                            </div>

                            <!-- MANEQUIM -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>MANEQUIM</label>
                                    <input type="text" name="manequim" class="form-control" value="<?= $modelo->manequim ?>">
                                </div>
                            </div>

                            <!-- CALÇADO -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>CALÇADO</label>
                                    <input type="tel" name="calcado" class="form-control maskCalcado" value="<?= $modelo->calcado ?>">
                                </div>
                            </div>

                            <!-- ALTURA -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>ALTURA</label>
                                    <input type="tel" name="altura" class="form-control maskAltura" value="<?= $modelo->altura ?>">
                                </div>
                            </div>

                            <!-- CIDADE -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>CIDADE</label>
                                    <input type="text" name="cidade" class="form-control" required="" value="<?= $modelo->cidade ?>">
                                </div>
                            </div>

                            <!-- ESTADO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>ESTADO</label>
                                    <select name="estado" class="form-control" required>
                                        <option selected disabled>Selecione</option>
                                        <option <?= ($modelo->estado == "AC") ? 'selected' : '' ?> value="AC">Acre</option>
                                        <option <?= ($modelo->estado == "AL") ? 'selected' : '' ?> value="AL">Alagoas</option>
                                        <option <?= ($modelo->estado == "AP") ? 'selected' : '' ?> value="AP">Amapá</option>
                                        <option <?= ($modelo->estado == "AM") ? 'selected' : '' ?> value="AM">Amazonas</option>
                                        <option <?= ($modelo->estado == "BA") ? 'selected' : '' ?> value="BA">Bahia</option>
                                        <option <?= ($modelo->estado == "CE") ? 'selected' : '' ?> value="CE">Ceará</option>
                                        <option <?= ($modelo->estado == "ES") ? 'selected' : '' ?> value="ES">Espírito Santo</option>
                                        <option <?= ($modelo->estado == "GO") ? 'selected' : '' ?> value="GO">Goiás</option>
                                        <option <?= ($modelo->estado == "MA") ? 'selected' : '' ?> value="MA">Maranhão</option>
                                        <option <?= ($modelo->estado == "MT") ? 'selected' : '' ?> value="MT">Mato Grosso</option>
                                        <option <?= ($modelo->estado == "MS") ? 'selected' : '' ?> value="MS">Mato Grosso do Sul</option>
                                        <option <?= ($modelo->estado == "MG") ? 'selected' : '' ?> value="MG">Minas Gerais</option>
                                        <option <?= ($modelo->estado == "PA") ? 'selected' : '' ?> value="PA">Pará</option>
                                        <option <?= ($modelo->estado == "PB") ? 'selected' : '' ?> value="PB">Paraíba</option>
                                        <option <?= ($modelo->estado == "PR") ? 'selected' : '' ?> value="PR">Paraná</option>
                                        <option <?= ($modelo->estado == "PE") ? 'selected' : '' ?> value="PE">Pernambuco</option>
                                        <option <?= ($modelo->estado == "PI") ? 'selected' : '' ?> value="PI">Piauí</option>
                                        <option <?= ($modelo->estado == "RJ") ? 'selected' : '' ?> value="RJ">Rio de Janeiro</option>
                                        <option <?= ($modelo->estado == "RN") ? 'selected' : '' ?> value="RN">Rio Grande do Norte</option>
                                        <option <?= ($modelo->estado == "RS") ? 'selected' : '' ?> value="RS">Rio Grande do Sul</option>
                                        <option <?= ($modelo->estado == "RO") ? 'selected' : '' ?> value="RO">Rondônia</option>
                                        <option <?= ($modelo->estado == "SC") ? 'selected' : '' ?> value="RR">Roraima</option>
                                        <option <?= ($modelo->estado == "AC") ? 'selected' : '' ?> value="SC">Santa Catarina</option>
                                        <option <?= ($modelo->estado == "SP") ? 'selected' : '' ?> value="SP">São Paulo</option>
                                        <option <?= ($modelo->estado == "SE") ? 'selected' : '' ?> value="SE">Sergipe</option>
                                        <option <?= ($modelo->estado == "TO") ? 'selected' : '' ?> value="TO">Tocantins</option>
                                        <option <?= ($modelo->estado == "DF") ? 'selected' : '' ?> value="DF">Distrito Federal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- ATUAÇÃO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>ATUAÇÃO</label>
                                    <textarea class="form-control" rows="4" name="atuacao"><?= $modelo->atuacao ?></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="mt-3">
                                <button style="font-weight: bold; background-color: #CB245E; border: 2px solid #CB245E" type="submit" class="btn btn-primary waves-effect waves-light">
                                    EDITAR
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Adicionar Fotos</h4>
                    <p class="sub-title">Adicione quantas fotos quiser do modelo.</p>

                    <form id="formCadastraFoto" data-id="<?= $modelo->id_modelo ?>">
                        <div class="row">

                            <!-- FOTOS -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>FOTO</label>
                                    <input name="arquivo" type="file" class="dropify">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="mt-3">
                                <button style="width: 100%; font-weight: bold; background-color: #CB245E; border: 2px solid #CB245E" type="submit" class="btn btn-primary waves-effect waves-light">
                                    CADASTRAR
                                </button>
                            </div>
                        </div>
                    </form>

                    <?php if (!empty($fotos)) : ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Imagem</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            </thead>


                            <tbody>
                            <?php if (!empty($fotos)) : ?>
                                <?php foreach ($fotos as $foto) : ?>
                                    <tr id="tb_<?= $foto->id_foto ?>">
                                        <td><img width="100%" src="<?= $foto->imagem ?>"></td>
                                        <td class="text-center">
                                            <a href="<?= $foto->imagem ?>" target="_blank" class="btn btn-primary btn-sm" style="padding: 10px;font-size: 13px;font-weight: 800;margin-right: 10px"><i class="fas fa-eye"></i></a>

                                            <a href="#" data-id="<?= $foto->id_foto ?>"
                                               class="btn btn-danger btn-sm deletarImagem"
                                               style="padding: 10px;font-size: 13px;font-weight: 800"><i class="far fa-trash-alt"></i></a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Sem Usuários</p>
                            <?php endif; ?>
                            </tbody>

                        </table>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <!-- FIM >> TABELA -->

<?php $this->view("painel/include/footer"); ?>

<script>
    $(document).ready(function(){

        // Basic
        $('.dropify').dropify();

    });
</script>
