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
      formId:         'form_infra_lixo_dest_tipo',
      urlToSend:      'model/ue/infra_lixo_dest_tipo/salvar_infra_lixo_dest_tipo',
      urlToGo:        'view/ue/infra_lixo_dest_tipo/listar'
    };
    ajaxSendCadastrar(params);
  });
});