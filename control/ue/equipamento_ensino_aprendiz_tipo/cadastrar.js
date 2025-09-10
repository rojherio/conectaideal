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
      formId:         'form_equipamento_ensino_aprendiz_tipo',
      urlToSend:      'model/ue/equipamento_ensino_aprendiz_tipo/salvar_equipamento_ensino_aprendiz_tipo',
      urlToGo:        'view/ue/equipamento_ensino_aprendiz_tipo/listar'
    };
    ajaxSendCadastrar(params);
  });
});