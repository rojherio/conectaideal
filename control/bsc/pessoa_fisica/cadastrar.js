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
  $('.btn_submit').on('click', function () {
    let params = {
      formId:         $(this).parents('form').attr('id'),
      urlCurrent:     'view/bsc/pessoa_fisica/cadastrar',
      urlToSend:      'model/'+$(this).parents('form').attr('urltosend'),
      urlToGo:        'view/bsc/pessoa_fisica/listar',
      tabPane:        $(this).parents('div.tab-pane').attr('tabindex'),
    };
    ajaxSendCadastrarTabPane(params);
  });
});