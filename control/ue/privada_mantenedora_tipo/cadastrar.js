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
      formId:         'form_privada_mantenedora_tipo',
      urlToSend:      'model/ue/privada_mantenedora_tipo/salvar_privada_mantenedora_tipo',
      urlToGo:        'view/ue/privada_mantenedora_tipo/listar'
    };
    ajaxSendCadastrar(params);
  });
});