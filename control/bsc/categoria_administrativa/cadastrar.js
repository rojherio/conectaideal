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
      formId:         'form_categoria_administrativa',
      urlToSend:      'model/bsc/categoria_administrativa/salvar_categoria_administrativa',
      urlToGo:        'view/bsc/categoria_administrativa/listar'
    };
    ajaxSendCadastrar(params);
  });
});