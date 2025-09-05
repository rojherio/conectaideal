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
      formId:         'form_infra_local_funcionam',
      urlToSend:      'model/ue/infra_local_funcionam/salvar_infra_local_funcionam',
      urlToGo:        'view/ue/infra_local_funcionam/listar'
    };
    ajaxSendCadastrar(params);
  });
});