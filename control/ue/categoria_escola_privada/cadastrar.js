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
      formId:         $(this).parents('form').attr('id'),
      urlCurrent:     'view/ue/categoria_escola_privada/cadastrar',
      urlToSend:      'model/'+$(this).parents('form').attr('urltosend'),
      urlToGo:        'view/ue/categoria_escola_privada/listar'
    };
    ajaxSendCadastrar(params);
  });
});