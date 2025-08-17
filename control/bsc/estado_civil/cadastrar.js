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
      formId:         'form_estado_civil',
      urlToSend:      'model/bsc/estado_civil/salvar_estado_civil',
      urlToGo:        'view/bsc/estado_civil/listar'
    };
    ajaxSendCadastrar(params);
  });
});