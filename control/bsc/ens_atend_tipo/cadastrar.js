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
  $('#submit').on('click', function () {
    let params = {
      formId:         'form_ens_atend_tipo',
      urlToSend:      'model/bsc/ens_atend_tipo/salvar_ens_atend_tipo',
      urlToGo:        'view/bsc/ens_atend_tipo/listar'
    };
    ajaxSendCadastrar(params);
  });
});