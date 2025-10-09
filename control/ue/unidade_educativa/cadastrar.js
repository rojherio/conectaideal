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
      formSerialized: $(this).parents('form').serialize(),
      urlCurrent:     'view/ue/unidade_educativa/cadastrar',
      urlToSend:      'model/'+$(this).parents('form').attr('urltosend'),
      urlToGo:        'view/ue/unidade_educativa/listar',
      tabPane:        $(this).parents('div.tab-pane').attr('tabindex'),
      urlsToSendSub:  []
    };
    $(this).parents('form').find('[urltosendsub]').each(function(k, elem){
      params.urlsToSendSub[k] = {
        urlToSendSub:         $(elem).attr('urltosendsub'),
        elemId:               $(elem).attr('id'),
        elemVal:              $(elem).val(),
        elemText:             $('#'+$(elem).attr('gettextinputid')).val()
      }
      params.formSerialized +=  '&'+($(elem).attr('setstatusinputid'))+'=1';
    });
    if (params.urlsToSendSub.length > 0) {
      ajaxSendCadastrarSub(params);
    }else{
      ajaxSendCadastrarTabPane(params);
    }
    return false;
  });
});