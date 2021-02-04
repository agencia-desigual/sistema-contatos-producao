import Global from "../global.js";

/**
 * Método responsável por realizar uma solicitação na api
 */
$("#formCadastraModelo").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Variaveis
    var form = new FormData(this);
    var url = Global.config.urlApi + "modelo/insert";

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Remove o site
    form.delete("website");

    // Realiza a requisição
    Global.enviaApi("POST", url, form, null, "alertify")
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess("Cadastro realizado, em breve entraremos em contato!");

            // Atualiza a página
            setTimeout(() => {
                location.href = Global.config.url;
            }, 3500);

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
$("#formCadastraModeloPainel").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Variaveis
    var form = new FormData(this);
    var url = Global.config.urlApi + "modelo/insert";
    var token = Global.session.get("token");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token, "alertify")
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess("Modelo cadastrado!");

            // Atualiza a página
            setTimeout(() => {
                location.href = Global.config.url + "modelo/editar/" + data.objeto.id_modelo;
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
$("#formCadastraFoto").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Variaveis
    var form = new FormData(this);
    var id = $(this).data("id");
    var url = Global.config.urlApi + "foto/insert/" + id;
    var token = Global.session.get("token");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Realiza a requisição
    Global.enviaApi("POST", url, form, token.token, "alertify")
        .then((data) => {

            // Avisa que deu certo
            alertify.success(data.mensagem);

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
$(".deletarImagem").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "foto/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Excluir o foto',
        text: 'Deseja realmente excluir essa foto?',
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


/**
 * Método responsável por realizar uma solicitação na api
 */
$(".deletarModelo").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "modelo/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Excluir o modelo',
        text: 'Deseja realmente excluir esse modelo?',
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