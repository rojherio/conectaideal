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
      formId:         'form_equip_tecn_administrativo',
      urlToSend:      'model/ue/equipamento_tecnologico_administrativo/salvar_equipamento_tecnologico_administrativo',
      urlToGo:        'view/ue/equipamento_tecnologico_administrativo/listar'
    };
    ajaxSendCadastrar(params);
  });
});