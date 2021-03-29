<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Notas Financeira</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>painel"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>financeiros">Notas financeira</a></li>
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

                    <h4 class="mt-0 header-title">Adicionar Nota financeira</h4>
                    <p class="sub-title">Adicione uma nova nota para gestão financeira.</p>

                    <form id="formCadastrarNota">

                        <div class="row">

                            <!-- NOME -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="nome" class="form-control" required="">
                                </div>
                            </div>

                            <!-- EMPRESA -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Empresa</label>
                                    <select name="id_cliente" class="form-control" required="">
                                        <option selected disabled> Selecione </option>
                                        <?php foreach ($empresas as $empresa) : ?>
                                            <option value="<?= $empresa->id_cliente ?>"><?= $empresa->nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- PRODUTO -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Produto</label>
                                    <input type="text" name="produto" placeholder="Ex: Despesa" class="form-control">
                                </div>
                            </div>

                            <!-- DATA -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Data de Vencimento</label>
                                    <input type="date" name="data" class="form-control" required="" value="<?= date('Y-m-d') ?>" >
                                </div>
                            </div>

                            <!-- CARTÃO -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Cartão</label>
                                    <input type="text" name="cartao" class="form-control" placeholder="Ex: 4817 ou Dinheiro">
                                </div>
                            </div>

                            <!-- VALOR -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input type="tel" name="valor" class="form-control maskValor" required="">
                                </div>
                            </div>

                            <!-- DESCRICAO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea name="descricao" rows="5" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- ARQUIVO -->
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Comprovante</label>
                                    <input name="arquivo" type="file" class="dropify">
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
<script>
    $(document).ready(function(){

        // Basic
        $('.dropify').dropify();

    });
</script>

