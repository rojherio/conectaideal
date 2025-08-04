$(document).ready(function() {
  $('select[controller]').change(function() {
    let controller = $(this).attr('controller');
    if ($(this).val() == 1) {
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
  // $('select#nacionalidade_s').change(function(){
  //   var val = $(this).val();
  //   if (val == 1 || val == '') {
  //     $('input#nat_est_cidade_S').val('');
  //     $('input#nat_est_estado_s').val('');
  //     $('input#nat_est_dt_ingresso_s').val('');
  //     $('input#nat_est_cond_trabalho_s').val('');
  //     $('div#div_naturalide_extrangeiro').slideUp();
  //     $('div#div_naturalide_nacional').slideDown();
  //   } else {
  //     $('select#naturalidade_s').val(null).trigger('change');
  //     $('div#div_naturalide_nacional').slideUp();
  //     $('div#div_naturalide_extrangeiro').slideDown();
  //   }
  //   return false;
  // });
});