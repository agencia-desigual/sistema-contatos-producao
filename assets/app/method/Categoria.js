import Global from "../global.js";



/**
 * Método responsável por realizar uma solicitação na api
 */
$("#formCadastrarCategoria").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Variaveis
    var form = new FormData(this);
    var url = Global.config.urlApi + "categoria/insert";
    var token = Global.session.get("token");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token, "alertify")
        .then((data) => {

            // Avisa que deu certo
            alertify.success("Cadastro realizado !");

            // Atualiza a página
            setTimeout(() => {
                location.reload();
            }, 1500);

        })
        .catch((e) => {
            // Remove o bloqueio do formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;

});



/**
 * Método responsável por realizar uma solicitação na api
 */
$("#formEditarCategoria").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Variaveis
    var form = new FormData(this);
    var id = $(this).data("id");
    var url = Global.config.urlApi + "categoria/update/" + id;
    var token = Global.session.get("token");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Realiza a requisição
    Global.enviaApi("PUT", url, form, token.token, "alertify")
        .then((data) => {

            // Avisa que deu certo
            alertify.success("Categoria atualizada !");

            // Atualiza a página
            setTimeout(() => {
                location.reload();
            }, 1500);

        })
        .catch((e) => {
            // Remove o bloqueio do formulário
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;

});



/**
 * Método responsável por realizar uma solicitação na api
 */
$(".excluirCategoria").on("click", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera o id
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "categoria/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Excluir categoria',
        text: 'Deseja realmente excluir essa categoria?',
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