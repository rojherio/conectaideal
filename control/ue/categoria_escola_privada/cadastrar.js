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
      formId:         'form_categoria_escola_privada',
      urlToSend:      'model/ue/categoria_escola_privada/salvar_categoria_escola_privada',
      urlToGo:        'view/ue/categoria_escola_privada/listar'
    };
    ajaxSendCadastrar(params);
  });
});