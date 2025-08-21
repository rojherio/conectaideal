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
      formId:         'form_nivel_ensino',
      urlToSend:      'model/bsc/nivel_ensino/salvar_nivel_ensino',
      urlToGo:        'view/bsc/nivel_ensino/listar'
    };
    ajaxSendCadastrar(params);
  });
});