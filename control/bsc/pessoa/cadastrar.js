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
      beforeSend: loading,
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
    .done(onSuccessSendPessoal)
    .fail(onError)
    .always(onCompleteSendPessoal);
    return false;
    // } else {
    //   return false;
    // }
  });
});
function loading(){
  console.log("loading");
  $('div#modalLoading').modal('show');
  console.log("loading 2");
}
function loaded(){
  console.log("loaded");
  // $('div#modalLoading').modal('hide');
}
function onSuccessSendPessoal(data, status, obj) {
  console.log('success');
  console.log(data);
  console.log(status);
  console.log(obj);
  return false;
  // if (obj.terno == 'success') {
  //   $('input.servidor_id').val(obj.id);
  //   swal.fire('Sucesso', obj.retorno, 'success');
  //   // postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
  //   return false;
  // } else if (obj.msg == 'error') {
  //   if (obj.tipo == 'cpf') {
  //     swal.fire('Erro', obj.retorno, 'error');
  //   } else {
  //     swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
  //     console.log('Error: ' + obj.retorno);
  //   }
  //   return false;
  // }
}
function onCompleteSendPessoal(data, status) {
  loaded();
  setTimeout(function() {
    // $('div#modalLoading').modal('hide');
    console.log("teste");
  }, 5000);
  return false;
  // if (obj.terno == 'success') {
  //   $('input.servidor_id').val(obj.id);
  //   swal.fire('Sucesso', obj.retorno, 'success');
  //   // postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
  //   return false;
  // } else if (obj.msg == 'error') {
  //   if (obj.tipo == 'cpf') {
  //     swal.fire('Erro', obj.retorno, 'error');
  //   } else {
  //     swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
  //     console.log('Error: ' + obj.retorno);
  //   }
  //   return false;
  // }
}
function onError(data, status, errorThrown) {
  console.log('erro');
  console.log(data);
  console.log(status);
  console.log(errorThrown);
  return false;
  // if (obj.terno == 'success') {
  //   $('input.servidor_id').val(obj.id);
  //   swal.fire('Sucesso', obj.retorno, 'success');
  //   // postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar');
  //   return false;
  // } else if (obj.msg == 'error') {
  //   if (obj.tipo == 'cpf') {
  //     swal.fire('Erro', obj.retorno, 'error');
  //   } else {
  //     swal.fire('Erro inesperado', "Houve um erro no sistema ao tentar realizar esta ação! Por favor, tente novamente ou informe esse erro ao suporte.", 'error');
  //     console.log('Error: ' + obj.retorno);
  //   }
  //   return false;
  // }
}