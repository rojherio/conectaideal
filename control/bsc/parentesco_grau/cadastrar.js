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
      formId:         'form_parentesco_grau',
      urlToSend:      'model/bsc/parentesco_grau/salvar_parentesco_grau',
      urlToGo:        'view/bsc/parentesco_grau/listar'
    };
    ajaxSendCadastrar(params);
  });
});