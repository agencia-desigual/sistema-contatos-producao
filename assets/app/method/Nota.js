import Global from "../global.js"


/**
 * Método responsável por cadastrar um determinádo usuário
 * administrador, enviado seus dados para a API correspondente.
 * ---------------------------------------------------------
 * @author igorcacerez
 */
$("#formCadastrarNota").on("submit", function(){

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Recupera o url
    var url = Global.config.urlApi + "financeiro/insert";

    var token = Global.session.get("token");

    // Realiza a requisição
    Global.enviaApi("POST", url, form,token.token)
        .then((data) => {

            // Avisa que deu certo
            alertify.success("Nota financeira cadastrada !");

            setTimeout(function () {
                location.reload();
            },1500)

            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");

        })
        .catch((error) => {
            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;
});
$("#relatorio").on("submit", function(){

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);
    var data_inico = form.get('data_inicio');
    var data_fim = form.get('data_fim');
    var id_empresa = form.get('id_empresa');

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Recupera o url
    var url = Global.config.url + "financeiro/relatorio/"+data_inico+"/"+data_fim+"/"+id_empresa;
    console.log(url);

    // Avisa que deu certo
    alertify.success("Aguarde o redirecionamento !!!");

    // Desbloqueia o formulário
    $(this).removeClass("bloqueiaForm");

    // Redireciona
    window.open(url,'_blank');

    $('.bs-example-modal-center').modal('hide')

    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por alterar as informações de um
 * determinado clientes. E enviar os dados via PUT
 * para a APi
 * ----------------------------------------------------------
 */
$("#formEditarNota").on("submit", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);
    var id = $(this).data("id");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Monta a url
    var url = Global.config.urlApi + "financeiro/update/" + id;

    // Recupera o token
    var token = Global.session.get("token");

    console.log(url)

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token)
        .then((data) => {

            // Avisa que deu certo
            alertify.success("Nota Financeira alterada !");

            setTimeout(function () {
                location.reload();
            },1500)

            // Desbloqueia
            $(this).removeClass("bloqueiaForm");

        })
        .catch((error) => {
            // Desbloqueia
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por deletar uma determinada
 * categoria.Enviando a solicitação para a API
 * ----------------------------------------------------------
 */
$(".deletarNota").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "financeiro/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Excluir o Nota Finceira',
        text: 'Deseja realmente excluir essa nota financeira?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("DELETE", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Remove da tabela
                    $('#aaa')
                        .DataTable()
                        .row("#tb_" + id)
                        .remove()
                        .draw(false);


                });
        }
    });


    // Não atualiza mesmo
    return false;
});