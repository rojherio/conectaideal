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
      formId:         'form_modalidade_ensino',
      urlToSend:      'model/bsc/modalidade_ensino/salvar_modalidade_ensino',
      urlToGo:        'view/bsc/modalidade_ensino/listar'
    };
    ajaxSendCadastrar(params);
  });
});