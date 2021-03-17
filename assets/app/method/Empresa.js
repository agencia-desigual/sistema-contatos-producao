import Global from "../global.js";


/**
 * Método responsável por adicionar uma nova empresa no sistema
 * Enviando as solicitações do formulário para a API.
 */
$("#formAdicionarEmpresa").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera os dados do formulario
    var form = new FormData(this);

    // Bloqueia o form
    $(this).addClass("bloqueiaForm");

    // Url
    var url = Global.config.urlApi + "empresa/insert";

    // Recupera o token
    var token = Global.session.get("token");

    // Envia a solicitação para a api
    Global.enviaApi("POST", url, form, token.token, "alertify")
        .then( data => {

            // Avisa que deu certo
            alertify.success(data.mensagem);

            // Limpa o formulário
            setTimeout(() => {
                location.reload();
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
 * Método responsável por alterar uma empresa já existente
 * no sistema. Enviando as solicitações do formulário
 * para a API responsável.
 */
$("#formEditarEmpresa").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera os dados do formulario
    var form = new FormData(this);
    var id = $(this).data("id");

    // Bloqueia o form
    $(this).addClass("bloqueiaForm");

    // Url
    var url = Global.config.urlApi + "empresa/update/" + id;

    // Recupera o token
    var token = Global.session.get("token");

    // Envia a solicitação para a api
    Global.enviaApi("POST", url, form, token.token, "alertify")
        .then( data => {

            // Desbloqueia o formulário
            $(this).removeClass("bloqueiaForm");

            // Avisa que deu certo
            alertify.success(data.mensagem);

            setTimeout(function () {
                location.reload();
            },1500)

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
$(".excluirEmpresa").on("click", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera o id
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "empresa/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Deletar empresa',
        text: 'Deseja realmente excluir essa empresa?',
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