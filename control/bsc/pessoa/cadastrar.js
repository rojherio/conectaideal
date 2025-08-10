//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
// window.onbeforeunload = function (e) {
//   if ($('#nome_uo').val() == '') {
//     window.onbeforeunload = null;
//   } else {
//     return true;
//   }
// };
$(document).ready(function () {
  //SALVANDO DADOS DO FORMULÁRIO DE PROJETO
  $('#form_pessoa').submit(function () {

    // window.onbeforeunload = null;
    // $('div#modalLoading').modal('show');
    // let formValido = formValidatorRMRosas($('#form_pessoa'));
    // // if (formValido) {
    // $('div#modalLoading').modal('show');
    $.ajax({
      url: PORTAL_URL + "model/bsc/pessoa/salvar_pessoa_fisica",
      async: true,
      method: "post",
      beforeSend: divLoading,
      cache: true,
      dataType: "json",
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      data: $('#form_pessoa').serialize(),
      // success: onSuccessSendPessoal,
      // error: onError,
      // complete: onCompleteSendPessoal,
      statusCode: {
        404: function() {
          alert( "page not found" );
        }
      }
    })
    .done(ajaxSuccess)
    .fail(ajaxError)
    .always(ajaxComplete);
    return false;
    // } else {
    //   return false;
    // }
  });
});