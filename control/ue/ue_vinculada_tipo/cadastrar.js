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
      formId:         'form_ue_vinculada_tipo',
      urlToSend:      'model/ue/ue_vinculada_tipo/salvar_ue_vinculada_tipo',
      urlToGo:        'view/ue/ue_vinculada_tipo/listar'
    };
    ajaxSendCadastrar(params);
  });
});