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
      formId:         'form_infra_local_ocupacao_forma',
      urlToSend:      'model/ue/infra_local_ocupacao_forma/salvar_infra_local_ocupacao_forma',
      urlToGo:        'view/ue/infra_local_ocupacao_forma/listar'
    };
    ajaxSendCadastrar(params);
  });
});