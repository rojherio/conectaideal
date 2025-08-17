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
      formId:         'form_unidade_medida',
      urlToSend:      'model/bsc/unidade_medida/salvar_unidade_medida',
      urlToGo:        'view/bsc/unidade_medida/listar'
    };
    ajaxSendCadastrar(params);
  });
});