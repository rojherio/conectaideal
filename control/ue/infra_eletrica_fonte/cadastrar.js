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
      formId:         'form_infra_eletrica_fonte',
      urlToSend:      'model/ue/infra_eletrica_fonte/salvar_infra_eletrica_fonte',
      urlToGo:        'view/ue/infra_eletrica_fonte/listar'
    };
    ajaxSendCadastrar(params);
  });
});