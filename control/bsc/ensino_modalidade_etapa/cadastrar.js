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
      formId:         'form_ensino_modalidade_etapa',
      urlToSend:      'model/bsc/ensino_modalidade_etapa/salvar_ensino_modalidade_etapa',
      urlToGo:        'view/bsc/ensino_modalidade_etapa/listar'
    };
    ajaxSendCadastrar(params);
  });
});