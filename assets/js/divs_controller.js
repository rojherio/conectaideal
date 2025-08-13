$(document).ready(function() {
  $('select[controller]').change(function() {
    let controller = $(this).attr('controller');
    if ($(this).val() == '') {
      $('select[controlled="'+controller+'"][control-value="1"]').val(null).trigger('change').prop('disabled', true);
      $('select[controlled="'+controller+'"][control-value="0"]').val(null).trigger('change').prop('disabled', true);
      $('input[controlled="'+controller+'"][control-value="0"]').val('').prop('disabled', true);
      $('[controlled="'+controller+'"][control-value="0"]').slideUp();
      $('[controlled="'+controller+'"][control-value="1"]').slideUp();
    } else if ($(this).val() == 1) {
      $('select[controlled="'+controller+'"][control-value="1"]').prop('disabled', false);
      $('select[controlled="'+controller+'"][control-value="0"]').val(null).trigger('change').prop('disabled', true);
      $('input[controlled="'+controller+'"][control-value="0"]').val('').prop('disabled', true);
      $('[controlled="'+controller+'"][control-value="0"]').slideUp();
      $('[controlled="'+controller+'"][control-value="1"]').slideDown();
    } else {
      $('select[controlled="'+controller+'"][control-value="1"]').val(null).trigger('change').prop('disabled', true);
      $('select[controlled="'+controller+'"][control-value="0"]').prop('disabled', false);
      $('input[controlled="'+controller+'"][control-value="0"]').val('').prop('disabled', false);
      $('[controlled="'+controller+'"][control-value="1"]').slideUp();
      $('[controlled="'+controller+'"][control-value="0"]').slideDown();
    }
    return false;
  });
});