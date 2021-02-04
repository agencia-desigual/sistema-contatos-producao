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