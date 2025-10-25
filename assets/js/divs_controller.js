$(document).ready(function() {
  $('[controller]').change(function() {
    let controller            = $(this).attr('controller');
    let controllerVal         = $(this).val();
    let controllerValuesParts = $(this).attr('controller-values').split('|');
    $('[controlled*="'+controller+'"]').each(function(k, elem){
      let elemControlValue = $(elem).attr('control-value');
      if ((elemControlValue == controllerVal || (Array.isArray(controllerVal) && controllerVal.indexOf(elemControlValue) >=0 )) || (controllerVal != '' && elemControlValue == 0 && controllerValuesParts.indexOf(controllerVal) < 0 && controllerValuesParts.indexOf('0') >= 0)) {
        if ($(elem).attr('controlled-noshow') != controller) {
          $(elem).is('select') ? $(elem).val(null).trigger('change').attr('disabled', false) : '';
          $(elem).is('input:not(:radio)') ? $(elem).val('').attr('disabled', false) : '';
          $(elem).is('textarea') ? $(elem).text('').attr('disabled', false) : '';
          $(elem).is('div') ? $(elem).slideDown() : '';
        }
      } else {
        $(elem).is('select') ? $(elem).val(null).trigger('change').attr('disabled', true) : '';
        $(elem).is('input:not(:radio)') ? $(elem).val('').attr('disabled', true) : '';
        $(elem).is('input[type="radio"]') ? $(elem).val() == "Não" ? $(elem).prop('checked', 'cheked') : '' : '';
        $(elem).is('input[type="radio"]') ? $(elem).val() == "Sim" ? $(elem).removeProp('checked') : '' : '';
        $(elem).is('textarea') ? $(elem).val('').attr('disabled', true) : '';
        $(elem).is('div') ? $(elem).slideUp() : '';
      }
    });
    return false;
  });
  $('.btn_div_add').on('click', function(){
    let elemClones = $(this).parents('.div_clones');
    let divClonar = $(this).parents('.div_clonar');
    $(elemClones).find('select').select2('destroy');
    let divClone = $(divClonar).clone(true);
    $(divClone).find('input:not(:checkbox)').val('');
    $(divClone).find('input[type="radio"][value="Não"]').prop('checked', 'cheked');
    $(divClone).find('input[type="radio"][value="Sim"]').removeProp('checked');
    $(divClone).find('textarea').val('');
    $(divClone).find('input[type="checkbox"]').each(function (k, elem) { 
      elem.checked = false; 
    });
    $(divClonar).after(divClone);
    divClonada = $(this).parents('.div_clonar').next();
    reorderClones(elemClones);
    $(divClonada).find('select').val(null).trigger('change');
    return false;
  });
  $('.btn_div_remove').on('click', function(){
    let elemClones= $(this).parents('.div_clones');
    let divClonar = $(this).parents('.div_clonar');
    let qtdDiv = $(this).parents('.div_clones').find('.div_clonar').length;
    $(elemClones).find('select').select2('destroy');
    if (qtdDiv>1) {
      $(this).parents('.div_clonar').remove();
    } else {
      $(divClonar).find('select.select2, select.select2-multiple, select2_municipio').val(null).trigger('change');
      $(divClonar).find('input:not(:checkbox)').val('');
      $(divClonar).find('input[type="radio"][value="Não"]').prop('checked', 'cheked');
      $(divClonar).find('input[type="radio"][value="Sim"]').removeProp('checked');
      $(divClonar).find('textarea').val('');
      $(divClonar).find('input[type="checkbox"]').each(function (k, elem) { 
        elem.checked = false; 
      });
    }
    reorderClones(elemClones);
    return false;
  });
  $('.btn_div_n2_add').on('click', function(){
    let elemClonesSub = $(this).parents('.div_clones_sub');
    let divClonarSub = $(this).parents('.div_clonar_sub');
    $(elemClonesSub).find('select').select2('destroy');
    let divCloneSub = $(divClonarSub).clone(true);
    $(divCloneSub).find('input:not(:checkbox)').val('');
    $(divCloneSub).find('input[type="radio"][value="Não"]').prop('checked', 'cheked');
    $(divCloneSub).find('input[type="radio"][value="Sim"]').removeProp('checked');
    $(divCloneSub).find('textarea').val('');
    $(divCloneSub).find('input[type="checkbox"]').each(function (k, elem) { 
      elem.checked = false; 
    });
    $(divClonarSub).after(divCloneSub);
    divClonadaSub = $(this).parents('.div_clonar_sub').next();
    reorderClonesN2(elemClonesSub);
    $(divClonadaSub).find('select').val(null).trigger('change');
    return false;
  });
  $('.btn_div_n2_remove').on('click', function(){
    let elemClones= $(this).parents('.div_clones');
    let divClonar = $(this).parents('.div_clonar');
    let qtdDiv = $(this).parents('.div_clones_sub').find('.div_clonar').length;
    $(elemClones).find('select').select2('destroy');
    if (qtdDiv>1) {
      $(this).parents('.div_clonar').remove();
    } else {
      $(divClonar).find('select.select2, select.select2-multiple, select2_municipio').val(null).trigger('change');
      $(divClonar).find('input:not(:checkbox)').val('');
      $(divClonar).find('input[type="radio"][value="Não"]').prop('checked', 'cheked');
      $(divClonar).find('input[type="radio"][value="Sim"]').removeProp('checked');
      $(divClonar).find('textarea').val('');
      $(divClonar).find('input[type="checkbox"]').each(function (k, elem) { 
        elem.checked = false; 
      });
    }
    reorderClones(elemClones);
    return false;
  });
});
function reorderClones(elemClones){
  $(elemClones).find('.div_clonar').each(function(k, elem){
    let counted = k+1;
    $(elem).find('.span_contador').text(counted);
    $(elem).find('[divcount]').attr('divcount', counted);
    $(elem).find('[idbase]').each(function(j, elem2){
      let idbase = $(elem2).attr('idbase');
      $(elem2).is(':checkbox') ? $(elem2).attr('name', idbase+counted) : '';
      $(elem2).attr('id', idbase+counted);
      $(elem2).parent().find('label').attr('for', idbase+counted);
    });
  });
  maskCleaveApplay(elemClones);
  createSelect2(elemClones);
  return false;
}
function reorderClonesN2(elemClonesSub){
  let countedN1 = $(elemClonesSub).parents('.div_clonar').attr('divcount');
  $(elemClonesSub).find('.div_clonar_sub').each(function(k, elem){
    let countedN2 = k+1;
    $(elem).find('.span_contador_sub').text(countedN2);
    $(this).attr('divcountsub', countedN2);
    let dividbasesub = $(elem).find('.div_controlled_sub').attr('dividbasesub');
    $(elem).find('.div_controlled_sub').attr('controlled', dividbasesub+countedN1+'_'+countedN2);
    $(elem).find('[idbasesub]').each(function(j, elem2){
      let idbasesub = $(elem2).attr('idbasesub');
      $(elem2).attr('controller') != undefined ? $(elem2).attr('controller', idbasesub+countedN1+'_'+countedN2) : '';
      $(elem2).is(':checkbox') ? $(elem2).attr('name', idbasesub+countedN1+'_'+countedN2) : '';
      $(elem2).attr('id', idbasesub+countedN1+'_'+countedN2);
      $(elem2).parent().find('label').attr('for', idbasesub+countedN1+'_'+countedN2);
    });
    $(elem).find('[idbasesubcontrol]').each(function(j, elem2){
      idbasesubcontrol = $(elem2).attr('idbasesubcontrol');
      idcontrol = $(elem2).attr('idcontrol');
      $(elem2).attr('controlled') != undefined ? $(elem2).attr('controlled', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol) : '';
      $(elem2).attr('controller', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
      $(elem2).is(':checkbox') ? $(elem2).attr('name', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol) : '';
      $(elem2).attr('id', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
      $(elem2).parent().parent().find('label').attr('for', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
    });
  });
  maskCleaveApplay(elemClonesSub);
  createSelect2(elemClonesSub);
  return false;
}


































