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
      urlCurrent:     'view/ue/funcao/cadastrar',
      urlToSend:      'model/'+$(this).parents('form').attr('urltosend'),
      urlToGo:        'view/ue/funcao/listar'
    };
    ajaxSendCadastrar(params);
  });
});