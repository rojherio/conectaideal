$(document).ready(function() {
  $('select[controller]').change(function() {
    let controller            = $(this).attr('controller');
    let controllerVal         = $(this).val();
    let controllerValuesParts = $(this).attr('controller-values').split('|');
    $('[controlled="'+controller+'"]').each(function(k, elem){
      let elemControlValue = $(elem).attr('control-value');
      if ((elemControlValue == controllerVal) || (controllerVal != '' && elemControlValue == 0 && controllerValuesParts.indexOf(controllerVal) < 0 && controllerValuesParts.indexOf('0') >= 0)) {
        $(elem).is('select') ? $(elem).val(null).trigger('change').attr('disabled', false) : '';
        $(elem).is('input') ? $(elem).val('').attr('disabled', false) : '';
        $(elem).is('div') ? $(elem).slideDown() : '';
      } else {
        $(elem).is('select') ? $(elem).val(null).trigger('change').attr('disabled', true) : '';
        $(elem).is('input') ? $(elem).val('').attr('disabled', true) : '';
        $(elem).is('div') ? $(elem).slideUp() : '';
      }
    });
    return false;
  });
  $('.btn_div_add').on('click', function(){
    let elemClones = $(this).parents('.div_clones');
    let divClonar = $(this).parents('.div_clonar');
    let divCount = $(divClonar).attr('divcount');
    $(divClonar).find('select.select2').select2('destroy');
    let divClone = $(divClonar).clone(true);
    $(divClone).find('input:not(:checkbox)').val('');
    $(divClone).find('input[type="checkbox"]').each(function (k, elem) { 
      elem.checked = false; 
    });
    $(this).parents('.div_clonar').after(divClone);
    reorderClones(elemClones);
    $(elemClones).find('select.select2').each(function (k, elem){
      createSelect2(elem);
    });
    return false;
  });
  $('.btn_div_remove').on('click', function(){
    let elemClones= $(this).parents('.div_clones');
    let divClonar = $(this).parents('.div_clonar');
    let qtdDiv = $(this).parents('.div_clones').find('.div_clonar').length;
    if (qtdDiv>1) {
      $(this).parents('.div_clonar').remove();
    } else {
      $(divClonar).find('select.select2').val(null).trigger('change');
      $(divClone).find('input:not(:checkbox)').val('');
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
  return false;
}