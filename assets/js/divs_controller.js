$(document).ready(function() {
  $('select[controller]').change(function() {
    let controller          = $(this).attr('controller');
    let controllerVal       = $(this).val();
    let controllerValues    = $(this).attr('controller-values');
    console.log(controllerValues);
    controllerValues.split('|').forEach((controlValue, k) => {
      console.log(controllerVal+'-'+controlValue);
      if (controllerVal != controlValue || (controllerVal != controlValue && controlValue == 0)) {
        $('select[controlled="'+controller+'"][control-value="'+controlValue+'"]').val(null).trigger('change').prop('disabled', true);
        $('input[controlled="'+controller+'"][control-value="'+controlValue+'"]').val('').prop('disabled', true);
        $('[controlled="'+controller+'"][control-value="'+controlValue+'"]').slideUp();
      }
      if (controllerVal == controlValue || (controllerVal != controlValue && controlValue == 0)) {
        $('select[controlled="'+controller+'"][control-value="'+controlValue+'"]').prop('disabled', false);
        $('input[controlled="'+controller+'"][control-value="'+controlValue+'"]').val('').prop('disabled', false);
        $('[controlled="'+controller+'"][control-value="'+controlValue+'"]').slideDown();
        console.log('igual');
      }
    });

    // if ($(this).val() == '') {
    //   $('select[controlled="'+controller+'"][control-value="1"]').val(null).trigger('change').prop('disabled', true);
    //   $('select[controlled="'+controller+'"][control-value="0"]').val(null).trigger('change').prop('disabled', true);
    //   $('input[controlled="'+controller+'"][control-value="0"]').val('').prop('disabled', true);
    //   $('[controlled="'+controller+'"][control-value="0"]').slideUp();
    //   $('[controlled="'+controller+'"][control-value="1"]').slideUp();
    // } else if ($(this).val() == 1) {
    //   $('select[controlled="'+controller+'"][control-value="1"]').prop('disabled', false);
    //   $('select[controlled="'+controller+'"][control-value="0"]').val(null).trigger('change').prop('disabled', true);
    //   $('input[controlled="'+controller+'"][control-value="0"]').val('').prop('disabled', true);
    //   $('[controlled="'+controller+'"][control-value="0"]').slideUp();
    //   $('[controlled="'+controller+'"][control-value="1"]').slideDown();
    // } else {
    //   $('select[controlled="'+controller+'"][control-value="1"]').val(null).trigger('change').prop('disabled', true);
    //   $('select[controlled="'+controller+'"][control-value="0"]').prop('disabled', false);
    //   $('input[controlled="'+controller+'"][control-value="0"]').val('').prop('disabled', false);
    //   $('[controlled="'+controller+'"][control-value="1"]').slideUp();
    //   $('[controlled="'+controller+'"][control-value="0"]').slideDown();
    // }
    return false;
  });
});