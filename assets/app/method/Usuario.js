import Global from "../global.js"


/**
 * Método responsável por cadastrar um determinádo usuário
 * administrador, enviado seus dados para a API correspondente.
 * ---------------------------------------------------------
 * @author igorcacerez
 */
$("#formInserirUsuario").on("submit", function(){

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Recupera o url
    var url = Global.config.urlApi + "usuario/insert";

    var token = Global.session.get("token");

    // Realiza a requisição
    Global.enviaApi("POST", url, form,token.token)
        .then((data) => {

            // Avisa que deu certo
            alertify.success("Usuário cadastrado !");

            // Limpa o formulário
            Global.limparFormulario("#formInserirUsuario");

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



/**
 * Método responsável por receber os dados os dados
 * e solicitar um requisição para que seja feio o login
 * do usuário.
 * ---------------------------------------------------------
 */
$("#formLogin").on("submit", function () {

    // Não atualiza
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Dados de login
    var email = form.get("email");
    var senha = form.get("senha");

    // Realiza a requisição
    realizaLogin(email,senha)
        .then(function(data){

            // Salva a session
            Global.session.set("usuario", data.objeto.usuario);
            Global.session.set("token", data.objeto.token);

            // Avisa que deu certo
            alertify.success(data.mensagem);

            // Atualiza a página
            setTimeout(() => {

                // Verifica qual é o usuario
                location.href = Global.config.url + "painel";

            }, 600);
        })
        .catch(e => {
            console.log(e);
        });

    // Desbloqueia o formulário
    $(this).removeClass("bloqueiaForm");

    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por alterar as informações de um
 * determinado clientes. E enviar os dados via PUT
 * para a APi
 * ----------------------------------------------------------
 */
$("#formAlteraUsuario").on("submit", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);
    var id = $(this).data("id");
    var refresh = $(this).data("refresh");
    var tipoAlerta = $(this).data("alerta");

    // Bloqueia o formulário
    $(this).addClass("bloqueiaForm");

    // Monta a url
    var url = Global.config.urlApi + "usuario/update/" + id;

    // Recupera o token
    var token = Global.session.get("token");

    console.log(url)

    // Realiza a requisição
    Global.enviaApi("PUT", url, form, token.token, tipoAlerta)
        .then((data) => {

            // Avisa que deu certo
            alertify.success("Usuário alterado !");


            // Verifica se deve atualizar a página
            if(refresh === 1)
            {
                // Url
                url = Global.config.urlApi + "usuario/session-refresh";

                // Atualiza a session
                Global.enviaApi("POST", url, null, token.token)
                    .then((data) => {
                        // Salva a session
                        Global.session.set("usuario", data.objeto.usuario);
                    });
            }

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
$(".deletarUsuario").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "usuario/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Excluir o Usuário',
        text: 'Deseja realmente excluir esse usuário?',
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
 * Método responsável por deletar uma determinada
 * categoria.Enviando a solicitação para a API
 * ----------------------------------------------------------
 */
$(".alteraStatusUsuario").on("click", function () {

    // Não atualiza a página
    event.preventDefault();

    // Recupera as informações
    var id = $(this).data("id");

    // Url e Token
    var url = Global.config.urlApi + "usuario/delete/" + id;
    var token = Global.session.get("token");

    // Pergunta se realmente quer deletar
    Swal.fire({
        title: 'Alterar Status',
        text: 'Deseja realmente alterar o status?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, altere!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("DELETE", url, null, token.token)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Remove da tabela
                    setTimeout(() => {
                        location.href = window.location.href;
                    }, 500);


                });
        }
    });


    // Não atualiza mesmo
    return false;
});



/**
 * Método responsável por realizar o login
 * --------------------------------------------------
 * @param user string
 * @param senha string
 * */
function realizaLogin(user, senha)
{
    return new Promise(function (resolve, reject) {

        // Configura o Header a ser enviado
        $.ajaxSetup({
            async: false,
            headers:{
                'Authorization': "Basic " + window.btoa(user + ":" + senha)
            }
        });

        // Faz o envio do post
        $.post(Global.config.urlApi + "usuario/login", null, (data) => {

            if(data.tipo === true)
            {
                resolve(data);
            }
            else
            {
                // Avisa que deu merda
                alertify.error(data.mensagem);

                reject(true);
            }

        }, "json");
    });

} // End >> Fun::realizaLogin()