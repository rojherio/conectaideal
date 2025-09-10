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
      formId:         'form_equip_acesso_internet_aluno',
      urlToSend:      'model/ue/equip_acesso_internet_aluno/salvar_equip_acesso_internet_aluno',
      urlToGo:        'view/ue/equip_acesso_internet_aluno/listar'
    };
    ajaxSendCadastrar(params);
  });
});