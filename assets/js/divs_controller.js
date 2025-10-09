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
  $('button.div-add').on('click', function(){
    let templateId = $(this).attr('template-id');
    let template = $('#'+templateId)[0];
    let templateClone = $(template.content).clone(true);
    $(this).parents('div[template-id="'+templateId+'"]').after(templateClone);
    return false;
  });
});