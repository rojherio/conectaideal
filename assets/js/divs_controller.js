$(document).ready(function() {
  $('[controller]').change(function() {
    let controller            = $(this).attr('controller');
    let controllerVal         = $(this).val();
    let controllerValuesParts = $(this).attr('controller-values').split('|');
    $('[controlled*="'+controller+'"]').each(function(k, elem){
      let elemControlValue = $(elem).attr('control-value');
      if ((elemControlValue == controllerVal) || (controllerVal != '' && elemControlValue == 0 && controllerValuesParts.indexOf(controllerVal) < 0 && controllerValuesParts.indexOf('0') >= 0)) {
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
    let divCount = $(divClonar).attr('divcount');
    // $(divClonar).find('select.select2, select.select2-multiple, select2_municipio').select2('destroy');
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
});
function reorderClones(elemClones){
  $(elemClones).find('.div_clonar').each(function(k, elem){
    let counted = k+1;
    $(elem).find('.span_contador').text(counted);
    $(elem).find('[divcount]').attr('divcount', counted);
    $(elem).find('[idbase]').each(function(j, elem2){
      idbase = $(elem2).attr('idbase');
      $(elem2).is(':checkbox') ? $(elem2).attr('name', idbase+counted) : '';
      $(elem2).attr('id', idbase+counted);
      $(elem2).parent().find('label').attr('for', idbase+counted);
    });
  });
  maskCleaveApplay(elemClones);
  createSelect2(elemClones);
  return false;
}