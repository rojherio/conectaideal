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
      formId:         'form_parceria_convenio_forma',
      urlToSend:      'model/ue/parceria_convenio_forma/salvar_parceria_convenio_forma',
      urlToGo:        'view/ue/parceria_convenio_forma/listar'
    };
    ajaxSendCadastrar(params);
  });
});