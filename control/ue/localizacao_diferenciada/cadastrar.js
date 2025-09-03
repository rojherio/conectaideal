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
      formId:         'form_localizacao_diferenciada',
      urlToSend:      'model/ue/localizacao_diferenciada/salvar_localizacao_diferenciada',
      urlToGo:        'view/ue/localizacao_diferenciada/listar'
    };
    ajaxSendCadastrar(params);
  });
});