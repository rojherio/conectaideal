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
    $(this).parents('form').find('select[urltosendsub]').each(function(k, elem){
      params.urlsToSendSub[k] = {
        urlToSendSub:           $(elem).attr('urltosendsub'),
        selectId:               $(elem).attr('id'),
        selectVal:              $(elem).val(),
        selectText:             $('#'+$(elem).attr('gettextinputid')).val()
      }
      params.formSerialized +=  '&'+($(elem).attr('setstatusinputid'))+'=1';
      // setSelectFK(selectId, selectVal, selectText);
    });
    ajaxSendCadastrarSub(params);
    return false;
  });

// 'name' => 'ue_id',    'id' => 'ue_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['id'],    'required' => true
// 'name' => 'ue_status',    'id' => 'ue_status',    'maxlength' => 1,    'value' => $rsRegistroUEIdent['status'],    'required' => true
// 'name' => 'ue_dt_cadastro',    'id' => 'ue_dt_cadastro',    'maxlength' => ,    'value' => $rsRegistroUEIdent['dt_cadastro'],    'required' => true
// 'name' => 'ue_bsc_pessoa_id',    'id' => 'ue_bsc_pessoa_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['bsc_pessoa_id'],    'required' => true
// 'name' => 'ue_inep_cod',    'id' => 'ue_inep_cod',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['inep_cod'],    'required' => false
// 'name' => 'ue_ue_funcionam_situacao_id',    'id' => 'ue_ue_funcionam_situacao_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['ue_funcionam_situacao_id'],    'required' => false
// 'name' => 'ue_bsc_zona_id',    'id' => 'ue_bsc_zona_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['bsc_zona_id'],    'required' => false
// 'name' => 'ue_ue_localizacao_diferenciada_id',    'id' => 'ue_ue_localizacao_diferenciada_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['ue_localizacao_diferenciada_id'],    'required' => false
// 'name' => 'ue_bsc_esfera_administrativa_id_dependencia',    'id' => 'ue_bsc_esfera_administrativa_id_dependencia',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['bsc_esfera_administrativa_id_dependencia'],    'required' => false
// 'name' => 'ue_ue_cat_esc_priv_id',    'id' => 'ue_ue_cat_esc_priv_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['ue_cat_esc_priv_id'],    'required' => false
// 'name' => 'ue_bsc_esfera_administrativa_id_regulam',    'id' => 'ue_bsc_esfera_administrativa_id_regulam',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['bsc_esfera_administrativa_id_regulam'],    'required' => false
// 'name' => 'ue_ue_regulam_situacao_id',    'id' => 'ue_ue_regulam_situacao_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['ue_regulam_situacao_id'],    'required' => false
// 'name' => 'ue_ue_ue_vinculada_tipo_id',    'id' => 'ue_ue_ue_vinculada_tipo_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['ue_ue_vinculada_tipo_id'],    'required' => false
// 'name' => 'ue_ue_ue_id_vinculada',    'id' => 'ue_ue_ue_id_vinculada',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['ue_ue_id_vinculada'],    'required' => false
// 'name' => 'ue_regional_cod',    'id' => 'ue_regional_cod',    'maxlength' => 30,    'value' => $rsRegistroUEIdent['regional_cod'],    'required' => false
// 'name' => 'ue_entidade_superior_acesso',    'id' => 'ue_entidade_superior_acesso',    'maxlength' => 100,    'value' => $rsRegistroUEIdent['entidade_superior_acesso'],    'required' => false
// 'name' => 'ue_ue_infra_local_ocupacao_forma_id',    'id' => 'ue_ue_infra_local_ocupacao_forma_id',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['ue_infra_local_ocupacao_forma_id'],    'required' => false
// 'name' => 'ue_fornece_agua_potavel',    'id' => 'ue_fornece_agua_potavel',    'maxlength' => 1,    'value' => $rsRegistroUEIdent['fornece_agua_potavel'],    'required' => false
// 'name' => 'ue_sala_aula_qtd',    'id' => 'ue_sala_aula_qtd',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['sala_aula_qtd'],    'required' => false
// 'name' => 'ue_sala_aula_climatizada_qtd',    'id' => 'ue_sala_aula_climatizada_qtd',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['sala_aula_climatizada_qtd'],    'required' => false
// 'name' => 'ue_sala_aula_acessibilidade_qtd',    'id' => 'ue_sala_aula_acessibilidade_qtd',    'maxlength' => 11,    'value' => $rsRegistroUEIdent['sala_aula_acessibilidade_qtd'],    'required' => false
// 'name' => 'ue_internet_banda_larga_velocidade',    'id' => 'ue_internet_banda_larga_velocidade',    'maxlength' => 50,    'value' => $rsRegistroUEIdent['internet_banda_larga_velocidade'],    'required' => false
// 'name' => 'alimentacao_pnae_fnde_oferece',    'id' => 'alimentacao_pnae_fnde_oferece',    'maxlength' => 1,    'value' => $rsRegistroUEIdent['alimentacao_pnae_fnde_oferece'],    'required' => false



  $('.select2-tags[load]').on('change', function(){
    let selectId      = $(this).attr('id');
    let selectVal     = $(this).val();
    let selectText    = $(this).find(':selected').text();
    let selectLoad    = $(this).attr('load');
    let selectLoadUrl = $(this).attr('loadurl');
    let divControlled = $(this).attr('controller');
    let inputId       = $(this).attr('gettextinputid');
    if (selectLoad == 'true') {
      if ($.isNumeric(selectVal)) {
        $('div[controlled="'+divControlled+'"]').load(PORTAL_URL+selectLoadUrl+selectVal, function(response, status, xhr){
          $('#'+inputId).val(selectText).attr('onblur', "setSelect('"+selectId+"', this);");
        });
      } else {
        $('div[controlled="'+divControlled+'"]').load(PORTAL_URL+selectLoadUrl, function(response, status, xhr){
          $('#'+inputId).val(selectText).attr('onblur', "setSelect('"+selectId+"', this);");
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
function setSelect(selectId, elemInput){
  let inputVal = $(elemInput).val();
  var newOption = new Option(inputVal, inputVal, true, true);
  $('#'+selectId).append(newOption).trigger('change');
}
function setSelectFK(selectId, optionId, text){
  var newOption = new Option(text, optionId, true, true);
  $('#'+selectId).append(newOption).trigger('change');
}