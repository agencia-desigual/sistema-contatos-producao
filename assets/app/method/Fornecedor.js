import Global from "../global.js";


/**
 * Método responsável por adicionar um novo tema no sistema
 * Enviando as solicitações do formulário para a API.
 */
$("#formAdicionarFornecedor").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera os dados do formulario
    var form = new FormData(this);

    // Bloqueia o form
    $(this).addClass("bloqueiaForm");

    // Url
    var url = Global.config.urlApi + "fornecedor/insert";

    // Recupera o token
    var token = Global.session.get("token");

    // Envia a solicitação para a api
    Global.enviaApi("POST", url, form, token.token, "alertify")
        .then( data => {

            // Avisa que deu certo
            alertify.success(data.mensagem);

            // Limpa o formulário
            setTimeout(() => {
                location.href = Global.config.url + "fornecedor/editar/" + data.objeto.id_fornecedor;
            }, 1500);

        })
        .catch(e => {

            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");

        });

    // Não atualiza mesmo
    return false;

});



/**
 * Método responsável por alterar um tema já existente
 * no sistema. Enviando as solicitações do formulário
 * para a API responsável.
 */
$("#formAlteraFornecedor").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera os dados do formulario
    var form = new FormData(this);
    var id = $(this).data("id");

    // Bloqueia o form
    $(this).addClass("bloqueiaForm");

    // Url
    var url = Global.config.urlApi + "fornecedor/update/" + id;

    // Recupera o token
    var token = Global.session.get("token");

    // Envia a solicitação para a api
    Global.enviaApi("PUT", url, form, token.token, "alertify")
        .then( data => {

            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");

            // Avisa que deu certo
            alertify.success(data.mensagem);
        })
        .catch(e => {

            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");

        });

    // Não atualiza mesmo
    return false;

});



/**
 * Método acionado quando o usuário clicar no botão
 * deletar, o método envia uma solicitação a API para
 * que o item seja deletado.
 */
$(".excluirFornecedor").on("click", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera o id
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "fornecedor/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Deletar Fornecedor',
        text: 'Deseja realmente deletar esse fornecedor?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("DELETE", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Remove da tabela
                    $('#datatable-buttons')
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