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
  $('button.div-add').on('click', function(){
    let templateId = $(this).attr('template-id');
    let template = $('#'+templateId)[0];
    let templateClone = $(template.content).clone(true);
    $(this).parents('div[template-id="'+templateId+'"]').after(templateClone);
    return false;
  });
  $('.select2-tags[load]').on('change', function(){
    let selectId      = $(this).attr('id');
    let selectVal     = $(this).val();
    let selectText    = $(this).find(':selected').text();
    let selectLoad    = $(this).attr('load');
    let selectLoadUrl = $(this).attr('loadurl');
    let divControlled = $(this).attr('controller');
    let inputTextId   = $(this).attr('gettextinputid');
    if (selectLoad == 'true') {
      if ($.isNumeric(selectVal)) {
        $(new Object()).load(PORTAL_URL+selectLoadUrl+selectVal, function(response, status, xhr){
          $(response).find('[id][name]').each(function(k, elem){
            $(elem).is('select') ? $('#'+elem.id).val(elem.value).trigger('change') : '';
            $(elem).is('input') ? $('#'+elem.id).val(elem.value) : '';
          });
          $('#'+inputTextId).val(selectText).attr('onblur', "setSelect('"+selectId+"', this);");
        });
      } else {
        $(new Object()).load(PORTAL_URL+selectLoadUrl, function(response, status, xhr){
          $(response).find('[id][name]').each(function(k, elem){
            $(elem).is('select') ? $('#'+elem.id).val(null).trigger('change') : '';
            $(elem).is('input') ? $('#'+elem.id).val('') : '';
          });
          $('#'+inputTextId).val(selectText).attr('onblur', "setSelect('"+selectId+"', this);");
        });
      }
      $(this).attr('load', 'false');
    }
  });
  $('.select2-tags[load]').on('select2:open', function(){
    let selectLoad    = $(this).attr('load');
    if (selectLoad == 'false') {
      $(this).attr('load', 'true');
    }
  });
});
function setSelect(elemId, elemInput){
  let inputVal = $(elemInput).val();
  var newOption = new Option(inputVal, inputVal, true, true);
  $('#'+elemId).append(newOption).trigger('change');
}
function setSelectFK(elemId, optionId, text){
  var newOption = new Option(text, optionId, true, true);
  $('#'+elemId).append(newOption).trigger('change');
}
function setInputFK(elemId, value){
  $('#'+elemId).val(value);
}