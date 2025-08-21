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
      formId:         'form_esfera_administrativa',
      urlToSend:      'model/bsc/esfera_administrativa/salvar_esfera_administrativa',
      urlToGo:        'view/bsc/esfera_administrativa/listar'
    };
    ajaxSendCadastrar(params);
  });
});