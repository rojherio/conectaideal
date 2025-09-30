$(document).ready(function() {
  $('select[controller]').change(function() {
    let controller            = $(this).attr('controller');
    let controllerVal         = $(this).val();
    let controllerValues      = $(this).attr('controller-values');
    let controllerValuesParts = $(this).attr('controller-values');
    $('[controlled="'+controller+'"]').each(function(k, elem){
      let elemControlValue = $(elem).attr('control-value');
      if ((elemControlValue == controllerVal) || (elemControlValue == 0 && controllerValuesParts.indexOf(controllerVal) < 0 && controllerValuesParts.indexOf('0') >= 0)) {
        $(elem).is('select') ? $(elem).val(null).trigger('change').prop('disabled', false) : '';
        $(elem).is('input') ? $(elem).val('').prop('disabled', false) : '';
        $(elem).is('div') ? $(elem).slideDown() : '';
      } else {
        $(elem).is('select') ? $(elem).val(null).trigger('change').prop('disabled', true) : '';
        $(elem).is('input') ? $(elem).val('').prop('disabled', true) : '';
        $(elem).is('div') ? $(elem).slideUp() : '';
      }
    });
    return false;
  });
});