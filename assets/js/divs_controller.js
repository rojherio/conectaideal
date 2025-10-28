$(document).ready(function() {
  $('[controller]').change(function() {
    let controller            = $(this).attr('controller');
    let controllerVal         = $(this).val();
    let controllerValuesParts = $(this).attr('controller-values').split('|');
    $('[controlled="'+controller+'"], [controlled-noshow="'+controller+'"]').each(function(k, elem){
      let elemControlValue = $(elem).attr('control-value');
      if ((elemControlValue == controllerVal || (Array.isArray(controllerVal) && controllerVal.indexOf(elemControlValue) >=0 )) || (controllerVal != '' && elemControlValue == 0 && controllerValuesParts.indexOf(controllerVal) < 0 && controllerValuesParts.indexOf('0') >= 0)) {
        if ($(elem).attr('controlled-noshow') != controller) {
          $(elem).is('select') ? $(elem).val(null).trigger('change').attr('disabled', false) : '';
          $(elem).is('input:not(:checkbox, :radio)') ? $(elem).val('').attr('disabled', false) : '';
          $(elem).is('textarea') ? $(elem).text('').attr('disabled', false) : '';
          $(elem).is('div') ? $(elem).slideDown() : '';
        }
      } else {
        $(elem).is('select') ? $(elem).val(null).trigger('change').attr('disabled', true) : '';
        $(elem).is('input:not(:radio)') ? $(elem).val('').attr('disabled', true) : '';
        $(elem).is(':radio') ? $(elem).val() == "Sim" ? $(elem).removeAttr('checked') : '' : '';
        $(elem).is(':radio') ? $(elem).val() == "Não" ? $(elem).prop('checked', 'checked') : '' : '';
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
    $(divClone).find('input:not(:checkbox, :radio)').val('');
    $(divClone).find('input[type="radio"][value="Sim"]').each(function(k, radio){
      $(radio).attr('id', 'id_aux_sim_'+k).attr('name', 'name_aux_'+k);
    });
    $(divClone).find('input[type="radio"][value="Não"]').each(function(k, radio){
      $(radio).attr('id', 'id_aux_nao_'+k).attr('name', 'name_aux_'+k);
    });
    $(divClone).find('input[type="radio"][value="Sim"]').removeAttr('checked');
    $(divClone).find('input[type="radio"][value="Não"]').prop('checked', 'checked');
    $(divClone).find('textarea').val('');
    $(divClone).find(':checkbox').each(function (k, elem) { 
      elem.checked = false; 
    });
    $(divClonar).after(divClone);
    reorderClones(elemClones);
    divClonada = $(this).parents('.div_clonar').next();
    $(divClonada).find('select').val(null).trigger('change');
    $(divClonada).find('[controlled]').each(function(k, elem){
      $(elem).is('select') ? $(elem).attr('disabled', true) : '';
      $(elem).is('input:not(:checkbox, :radio)') ? $(elem).attr('disabled', true) : '';
      $(elem).is('textarea') ? $(elem).attr('disabled', true) : '';
      $(elem).is('div') ? $(elem).slideUp() : '';
    });
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
      $(divClonar).find('input:not(:checkbox, :radio)').val('');
      $(divClonar).find('input[type="radio"][value="Sim"]').removeAttr('checked');
      $(divClonar).find('input[type="radio"][value="Não"]').prop('checked', 'checked');
      $(divClonar).find('textarea').val('');
      $(divClonar).find(':checkbox').each(function (k, elem) { 
        elem.checked = false; 
      });
    }
    reorderClones(elemClones);
    return false;
  });
  $('.btn_div_n1_add').on('click', function(){
    let elemClones = $(this).parents('.div_clones');
    let divClonar = $(this).parents('.div_clonar');
    $(elemClones).find('select').select2('destroy');
    let divClone = $(divClonar).clone(true);
    $(divClone).find('.div_clonar_sub:not(:first)').remove();
    $(divClone).find('input:not(:checkbox, :radio)').val('');
    $(divClone).find('input[type="radio"][value="Sim"]').each(function(k, radio){
      $(radio).attr('id', 'id_aux_sim_'+k).attr('name', 'name_aux_'+k);
    });
    $(divClone).find('input[type="radio"][value="Não"]').each(function(k, radio){
      $(radio).attr('id', 'id_aux_nao_'+k).attr('name', 'name_aux_'+k);
    });
    $(divClone).find('input[type="radio"][value="Sim"]').removeAttr('checked');
    $(divClone).find('input[type="radio"][value="Não"]').prop('checked', 'checked');
    $(divClone).find('textarea').val('');
    $(divClone).find(':checkbox').each(function (k, elem) { 
      elem.checked = false; 
    });
    $(divClonar).after(divClone);
    reorderClonesN1(elemClones);
    divClonada = $(this).parents('.div_clonar').next();
    $(divClonada).find('select').val(null).trigger('change');
    return false;
  });
  $('.btn_div_n1_remove').on('click', function(){
    let elemClones = $(this).parents('.div_clones');
    let divClonar = $(this).parents('.div_clonar');
    let qtdDiv = $(this).parents('.div_clones').find('.div_clonar').length;
    $(elemClones).find('select').select2('destroy');
    if (qtdDiv>1) {
      $(this).parents('.div_clonar').remove();
    } else {
      $(divClonar).find('.div_clonar_sub:not(:first)').remove();
      $(divClonar).find('select.select2, select.select2-multiple, select2_municipio').val(null).trigger('change');
      $(divClonar).find('input:not(:checkbox, :radio)').val('');
      $(divClonar).find('input[type="radio"][value="Sim"]').removeAttr('checked');
      $(divClonar).find('input[type="radio"][value="Não"]').prop('checked', 'checked');
      $(divClonar).find('textarea').val('');
      $(divClonar).find(':checkbox').each(function (k, elem) { 
        elem.checked = false; 
      });
    }
    reorderClonesN1(elemClones);
    return false;
  });
  $('.btn_div_n2_add').on('click', function(){
    let elemClonesSub = $(this).parents('.div_clones_sub');
    let divClonarSub = $(this).parents('.div_clonar_sub');
    $(elemClonesSub).find('select').select2('destroy');
    let divCloneSub = $(divClonarSub).clone(true);
    $(divCloneSub).find('input:not(:checkbox, :radio)').val('');
    $(divCloneSub).find('input[type="radio"][value="Sim"]').each(function(k, radio){
      $(radio).attr('id', 'id_aux_sim_'+k).attr('name', 'name_aux_'+k);
    });
    $(divCloneSub).find('input[type="radio"][value="Não"]').each(function(k, radio){
      $(radio).attr('id', 'id_aux_nao_'+k).attr('name', 'name_aux_'+k);
    });
    $(divCloneSub).find('input[type="radio"][value="Sim"]').removeAttr('checked');
    $(divCloneSub).find('input[type="radio"][value="Não"]').prop('checked', 'checked');
    $(divCloneSub).find('textarea').val('');
    $(divCloneSub).find(':checkbox').each(function (k, elem) { 
      elem.checked = false; 
    });
    $(divClonarSub).after(divCloneSub);
    reorderClonesN2(elemClonesSub);
    divClonadaSub = $(this).parents('.div_clonar_sub').next();
    $(divClonadaSub).find('select').val(null).trigger('change');
    return false;
  });
  $('.btn_div_n2_remove').on('click', function(){
    let elemClonesSub = $(this).parents('.div_clones_sub');
    let divClonarSub = $(this).parents('.div_clonar_sub');
    let qtdDivSub = $(this).parents('.div_clones_sub').find('.div_clonar_sub').length;
    $(elemClonesSub).find('select').select2('destroy');
    if (qtdDivSub>1) {
      $(this).parents('.div_clonar_sub').remove();
    } else {
      $(divClonarSub).find('select.select2, select.select2-multiple, select2_municipio').val(null).trigger('change');
      $(divClonarSub).find('input:not(:checkbox, :radio)').val('');
      $(divClonarSub).find('input[type="radio"][value="Sim"]').removeAttr('checked');
      $(divClonarSub).find('input[type="radio"][value="Não"]').prop('checked', 'checked');
      $(divClonarSub).find('textarea').val('');
      $(divClonarSub).find(':checkbox').each(function (k, elem) { 
        elem.checked = false; 
      });
    }
    reorderClonesN2(elemClonesSub);
    return false;
  });
});
function reorderClones(elemClones){
  $(elemClones).find('.div_clonar').each(function(k, elem){
    let counted = k+1;
    $(elem).find('.span_contador').text(counted);
    $(elem).attr('divcount', counted);
    $(elem).find('[idbase]').each(function(j, elem2){
      let idbase = $(elem2).attr('idbase');
      $(elem2).is(':checkbox') ? $(elem2).attr('name', idbase+counted) : '';
      $(elem2).is(':radio') ? $(elem2).attr('name', $(elem2).attr('namebase')+counted) : '';
      $(elem2).attr('id', idbase+counted);
      $('#'+elem2.id+':not([type="hidden"])').parent().find('label').attr('for', idbase+counted);
    });
    $(elem).find('[controller]').each(function(j, elem2){
      let controllerBase = $(elem2).attr('controllerbase') != undefined ? $(elem2).attr('controllerbase') : $(elem2).attr('controller');
      let controllerOld = $(elem2).attr('controller');
      $(elem2).attr('controller', controllerBase+counted);
      $(elem).find($('[controlled="'+controllerOld+'"]')).attr('controlled', controllerBase+counted);
      $(elem).find($('[controlled-noshow="'+controllerOld+'"]')).attr('controlled-noshow', controllerBase+counted);
    });
  });
  maskCleaveApplay(elemClones);
  createSelect2(elemClones);
  return false;
}
function reorderClonesN1(elemClones){
  $(elemClones).find('.div_clonar').each(function(k, elem){
    let counted = k+1;
    $(elem).find('.span_contador').text(counted);
    $(elem).attr('divcount', counted);
    $(elem).find('[idbase]').each(function(j, elem2){
      let idbase = $(elem2).attr('idbase');
      $(elem2).is(':checkbox') ? $(elem2).attr('name', idbase+counted) : '';
      $(elem2).is(':radio') ? $(elem2).attr('name', $(elem2).attr('namebase')+counted) : '';
      $(elem2).attr('id', idbase+counted);
      $('#'+elem2.id+':not([type="hidden"])').parent().find('label').attr('for', idbase+counted);
    });
    $(elem).find('[idbase][controller]').each(function(j, elem2){
      let controllerBase = $(elem2).attr('controllerbase') != undefined ? $(elem2).attr('controllerbase') : $(elem2).attr('controller');
      let controllerOld = $(elem2).attr('controller');
      $(elem2).attr('controller', controllerBase+counted);
      $(elem).find($('[controlled="'+controllerOld+'"]')).attr('controlled', controllerBase+counted);
      $(elem).find($('[controlled-noshow="'+controllerOld+'"]')).attr('controlled-noshow', controllerBase+counted);
    });
     $(elem).find('.div_clones_sub').each(function(j, elemClonesSub){
      reorderClonesN2(elemClonesSub);
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
    $(elem).find('[divcountsub', countedN2);
    $(elem).find('[idbasesub]').each(function(j, elem2){
      let idbasesub = $(elem2).attr('idbasesub');
      $(elem2).is(':checkbox') ? $(elem2).attr('name', idbasesub+countedN1+'_'+countedN2) : '';
      $(elem2).is(':radio') ? $(elem2).attr('name', $(elem2).attr('namebase')+countedN1+'_'+countedN2) : '';
      $(elem2).attr('name', idbasesub+countedN1+'_'+countedN2);
      $(elem2).attr('id', idbasesub+countedN1+'_'+countedN2);
      $('#'+elem2.id+':not([type="hidden"])').parent().find('label').attr('for', idbasesub+countedN1+'_'+countedN2);
    });
    $(elem).find('[idbasesub][controller]').each(function(j, elem2){
      let controllerBase = $(elem2).attr('controllerbase') != undefined ? $(elem2).attr('controllerbase') : $(elem2).attr('controller');
      let controllerOld = $(elem2).attr('controller');
      $(elem2).attr('controller', controllerBase+countedN1+'_'+countedN2);
      $(elem).find($('[controlled="'+controllerOld+'"]')).attr('controlled', controllerBase+countedN1+'_'+countedN2);
      $(elem).find($('[controlled-noshow="'+controllerOld+'"]')).attr('controlled-noshow', controllerBase+countedN1+'_'+countedN2);
    });
    $(elem).find('[idbasesubcontrol]').each(function(j, elem2){
      idbasesubcontrol = $(elem2).attr('idbasesubcontrol');
      idcontrol = $(elem2).attr('idcontrol');
      $(elem2).attr('name', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
      $(elem2).attr('id', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
      $('#'+elem2.id+':not([type="hidden"])').parent().parent().find('label').attr('for', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
    });
  });
  maskCleaveApplay(elemClonesSub);
  createSelect2(elemClonesSub);
  return false;
}







  // let countedN1 = $(elemClonesSub).parents('.div_clonar').attr('divcount');
  // $(elemClonesSub).find('.div_clonar_sub').each(function(k, elem){
  //   let countedN2 = k+1;
  //   $(elem).find('.span_contador_sub').text(countedN2);
  //   $(this).attr('divcountsub', countedN2);
  //   let dividbasesub = $(elem).find('.div_controlled_sub').attr('dividbasesub');
  //   $(elem).find('.div_controlled_sub').attr('controlled', dividbasesub+countedN1+'_'+countedN2);
  //   $(elem).find('[idbasesub]').each(function(j, elem2){
  //     let idbasesub = $(elem2).attr('idbasesub');
  //     $(elem2).attr('[idbasesub]controller') != undefined ? $(elem2).attr('controller', idbasesub+countedN1+'_'+countedN2) : '';
  //     $(elem2).attr('name', idbasesub+countedN1+'_'+countedN2);
  //     $(elem2).attr('id', idbasesub+countedN1+'_'+countedN2);
  //     $('#'+elem2.id+':not([type="hidden"])').parent().find('label').attr('for', idbasesub+countedN1+'_'+countedN2);
  //   });
  //   $(elem).find('[idbasesubcontrol]').each(function(j, elem2){
  //     idbasesubcontrol = $(elem2).attr('idbasesubcontrol');
  //     idcontrol = $(elem2).attr('idcontrol');
  //     $(elem2).attr('controlled') != undefined ? $(elem2).attr('controlled', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol) : '';
  //     $(elem2).attr('name', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
  //     $(elem2).attr('id', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
  //     $('#'+elem2.id+':not([type="hidden"])').parent().parent().find('label').attr('for', idbasesubcontrol+countedN1+'_'+countedN2+'_'+idcontrol);
  //   });
  // });
















































