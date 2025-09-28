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
      formId:         'form_setor_publico',
      urlToSend:      'model/bsc/setor_publico/salvar_setor_publico',
      urlToGo:        'view/bsc/setor_publico/listar'
    };
    ajaxSendCadastrar(params);
  });
});