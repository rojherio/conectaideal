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
      formId:         'form_cat_esc_priv',
      urlToSend:      'model/bsc/cat_esc_priv/salvar_cat_esc_priv',
      urlToGo:        'view/bsc/cat_esc_priv/listar'
    };
    ajaxSendCadastrar(params);
  });
});