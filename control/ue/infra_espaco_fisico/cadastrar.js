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
      formId:         'form_infra_espaco_fisico',
      urlToSend:      'model/ue/infra_espaco_fisico/salvar_infra_espaco_fisico',
      urlToGo:        'view/ue/infra_espaco_fisico/listar'
    };
    ajaxSendCadastrar(params);
  });
});