//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
// window.onappendunload = function(e) {
//   if ($('#nome_s').val() == '' && $('#dt_nasc_s').val() == '' && $('#cpf_s').val() == '') {
//     window.onappendunload = null;
//   } else {
//     return true;
//   }
// };
var msgInputRequired = '<span class="text-danger error_validator required">O preenchimento deste campo é obrigatório!<br/></span>';
var msgInputMinLength = '<span class="text-danger error_validator minlength">Digite no mínimo ## caracteres!<br/></span>';
var msgInputMimData = '<span class="text-danger error_validator mindata">A data não pode ser menor que dd/mm/aaaa!<br/></span>';
var msgInputMaxData = '<span class="text-danger error_validator maxdata">A data não pode ser maior que dd/mm/aaaa!<br/></span>';
var msgSelect = '<span class="text-danger error_validator required">A escolha de uma opção é obrigatória!<br/></span>';
var msgRadio = '<span class="text-danger error_validator required">A escolha de uma opção é obrigatória!<br/></span>';
var msgCnpj = '<span class="text-danger error_validator required cnpj">O CNPJ informado não é válido!<br/></span>';
var msgCpf = '<span class="text-danger error_validator required cpf">O CPF informado não é válido!<br/></span>';
var msgEmail = '<span class="text-danger error_validator required email">O E-mail informado não é válido!<br/></span>';
var msgSite = '<span class="text-danger error_validator required site">O site informado não é válido!<br/></span>';
// FUNCAO PARA VALIDAR EMAIL
function IsEmail(email) {
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!expr.test(email)) {
    return false;
  } else {
    return true;
  }
}
function IsSite(site) {
  expr = /^([a-zA-Z0-9_\.\-])+\.([a-zA-Z0-9\-])+$/;
  if (!expr.test(site)) {
    return false;
  } else {
    return true;
  }
}
$(document).ready(function() {
  $('input[type="text"][required], input[type="date"][required], input[type="number"][required], input[type="email"][required], textarea[required]').keyup(function(){
    var valLength = $(this).val().length;
    $(this).parents('div.div-validate').find('span.required').remove();
    if (valLength == 0) {
      $(this).parents('div.div-validate').append(msgInputRequired);
    }
  });
  $('input[type="date"][max]').keyup(function(){
    let textVal = $(this).val();
    let textLength = textVal.length;
    $(this).parents('div.div-validate').find('span.mindata').remove();
    $(this).parents('div.div-validate').find('span.maxdata').remove();
    if (textLength > 0) {
      let textParts = textVal.split("-");
      let minVal = $(this).attr('min');
      let minParts = minVal.split("-");
      let maxVal = $(this).attr('max');
      let maxParts = maxVal.split("-");
      if (Number(textParts[0])>=Number(maxParts[0])) {
        textParts[0] = maxParts[0];
        if (Number(textParts[1])>=Number(maxParts[1])) {
          textParts[1] = maxParts[1];
          if (Number(textParts[2])>Number(maxParts[2])) {
            textParts[2] = maxParts[2];
          }
        }
        $(this).val(textParts[0]+'-'+textParts[1]+'-'+textParts[2]);
        $(this).parents('div.div-validate').append(msgInputMaxData.replace('dd', maxParts[2]).replace('mm', maxParts[1]).replace('aaaa', maxParts[0]));
      }
      if (Number(textParts[0])<=Number(minParts[0])) {
        $(this).parents('div.div-validate').append(msgInputMimData.replace('dd', minParts[2]).replace('mm', minParts[1]).replace('aaaa', minParts[0]));
      }
    }
  });
  $('input[type="date"][max]').blur(function(){
    $(this).parents('div.div-validate').find('span.mindata').remove();
    $(this).parents('div.div-validate').find('span.maxdata').remove();
    let textVal = $(this).val();
    let textLength = textVal.length;
    if (textLength > 0) {
      let textParts = textVal.split("-");
      let textAnoLength = String(parseInt(textParts[0],10)).length;
      let minVal = $(this).attr('min');
      let minParts = minVal.split("-");
      let minAnoLength = String(parseInt(minParts[0],10)).length;
      if (Number(textParts[0])<=Number(minParts[0])) {
        textParts[0] = minParts[0];
        if (Number(textParts[1])<=Number(minParts[1])) {
          textParts[1] = minParts[1];
          if (Number(textParts[2])<Number(minParts[2])) {
            textParts[2] = minParts[2];
          }
        }
        $(this).val(textParts[0]+'-'+textParts[1]+'-'+textParts[2]);
      }
    }
  });
  $('input[type="number"][maxlength]').keyup(function(){
    let textVal = $(this).val();
    let maxLength = $(this).attr('maxlength');
    let textLength = textVal.length;
    if (textLength >= maxLength) {
      textVal = textVal.substring(0, maxLength);
      $(this).val(textVal);
      if ($(this).hasClass('mask-ano')) {
        let yearToday = new Date().getFullYear();
        if (parseInt(textVal) < 1900) {
          $(this).val('1900');
        } else if ($(this).hasClass('max-today') && parseInt(textVal) > yearToday) {
          $(this).val(''+yearToday);
        }
      }
    }
  });
  $('input[minlength]').keyup(function(){
    var valMinLength = $(this).attr('minlength');
    var textLength = $(this).val().length;
    $(this).parents('div.div-validate').find('span.minlength').remove();
    if (textLength > 0 && textLength < valMinLength) {
      $(this).parents('div.div-validate').append(msgInputMinLength.replace('##', valMinLength));
    }
  });
  $('select[required]').change(function(){
    var val = $(this).val();
    $(this).parents('div.div-validate').find('span.required').remove();
    if (val == 0 || val == '') {
      $(this).parents('div.div-validate').append(msgSelect);
    }
  });
  $('input[type="radio"]').on('ifChecked', function(event){
    $(this).parents('div.div-validate').find('span.required').remove();
  });
  $('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').keyup(function(){
    var valLength = $(this).val().length;
    var body = $(this).parents('div.row').parent();
    if (valLength > 0) {
      $(body).find('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
      $(body).find('select[allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
      $(body).find('input[type="radio"][allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
    } else {
      listenValidatorRMRosas(body);
    }
  });
  $('select[allempty]').change(function(){
    var val = $(this).val();
    var body = $(this).parents('div.row').parent();
    if (val == 0 || val == '') {
      $(body).find('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
      $(body).find('select[allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
      $(body).find('input[type="radio"][allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
    } else {
      listenValidatorRMRosas(body);
    }
  });
  $('input[type="radio"][allempty]').on('ifChecked', function(event){
    var body = $(this).parents('div.row').parent();
    $(body).find('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
    $(body).find('select[allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
    $(body).find('input[type="radio"][allempty]').attr('required', 'required').parents('div.div-validate').find('span.text-danger[validator]').text('*');
  });
  $('input.mask-cnpj').keyup(function(){
    var valMinLength = $(this).attr('minlength');
    var inputVal = $(this).val();
    $(this).parents('div.div-validate').find('span.cnpj').remove();
    if (inputVal.length == valMinLength && !validaCNPJ(inputVal)) {
      $(this).parents('div.div-validate').append(msgCnpj);
    }
  });
  $('input.mask-cpf').keyup(function(){
    var valMinLength = $(this).attr('minlength');
    var inputVal = $(this).val();
    $(this).parents('div.div-validate').find('span.cpf').remove();
    if (inputVal.length == valMinLength && !validaCPF(inputVal)) {
      $(this).parents('div.div-validate').append(msgCpf);
    }
  });
  $('input[type="email"]').keyup(function(){
    var valMinLength = $(this).attr('minlength');
    var inputVal = $(this).val();
    $(this).parents('div.div-validate').find('span.email').remove();
    if (inputVal.length > valMinLength && !IsEmail(inputVal)) {
      $(this).parents('div.div-validate').append(msgEmail);
    }
  });
  $('input.site').keyup(function(){
    var valMinLength = $(this).attr('minlength');
    var inputVal = $(this).val();
    $(this).parents('div.div-validate').find('span.site').remove();
    if (inputVal.length > valMinLength && !IsSite(inputVal)) {
      $(this).parents('div.div-validate').append(msgSite);
    }
  });
});
function listenValidatorRMRosas(elem){
  var notEmpty = false;
  $(elem).find('input[type="text"][allempty], input[type="number"][allempty], input[type="email"][allempty], textarea[allempty]').each(function(){
    var valLength = $(this).val().length;
    if (valLength > 0) {
      notEmpty = true;
    }
  });
  $(elem).find('select[allempty]').each(function(){
    var val = $(this).val();
    if (val != 0 || val != '') {  
      notEmpty = true;
    }
  });
  if (!notEmpty) {
    $(elem).find('[allempty]').removeAttr('required').parents('div.div-validate').find('span.text-danger').text('');
    $(elem).find('span.error_validator').remove();
  }
}
function cleanValidatorRMRosas(elem){
  $(elem).find('[allempty]').removeAttr('required').parents('div.div-validate').find('span.text-danger').text('');
  $(elem).find('span.error_validator').remove();
}
function formValidatorRMRosas(form){
  valido = true;
  $(form).find('span.error_validator').remove();
  $(form).find('input[type="text"][required], input[type="date"][required], input[type="number"][required], input[type="email"][required], textarea[allempty]').each(function(){
    if ($(this).is(':visible')) {
      var valLength = $(this).val().length;
      if (valLength == 0) {
        $(this).parents('div.div-validate').append(msgInputRequired);
      }
    }
  });
  $(form).find('input[minlength]').each(function(){
    if ($(this).is(':visible')) {
      var valMinLength = $(this).attr('minlength');
      var textLength = $(this).val().length;
      if (textLength > 0 && textLength < valMinLength) {
        $(this).parents('div.div-validate').append(msgInputMinLength.replace('##', valMinLength));
      }
    }
  });
  $(form).find('select[required]').each(function(){
    if ($(this).is(':visible')) {
      var val = $(this).val();
      if (val == 0 || val == '') {
        $(this).parents('div.div-validate').append(msgSelect);
      }
    }
  });
  $(form).find('input[type="radio"][required]').each(function(){
    if ($(this).is(':visible')) {
      var val = $('input[name="'+$(this).attr('name')+'"]').is(':checked');
      if (!val) {
        $(this).parents('div.div-validate').last().append(msgRadio);

      }
    }
  });
  $(form).find('input.mask-cnpj').each(function(){
    if ($(this).is(':visible')) {
      var valMinLength = $(this).attr('minlength');
      var inputVal = $(this).val().length;
      if (inputVal.length == valMinLength && !validaCNPJ(inputVal)) {
        $(this).parents('div.div-validate').append(msgCnpj);
      }
    }
  });
  $(form).find('input.mask-cpf').each(function(){
    if ($(this).is(':visible')) {
      var valMinLength = $(this).attr('minlength');
      var inputVal = $(this).val().length;
      if (inputVal.length == valMinLength && !validaCPF(inputVal)) {
        $(this).parents('div.div-validate').append(msgCpf);
      }
    }
  });
  $(form).find('input[type="email"]').each(function(){
    if ($(this).is(':visible')) {
      var valMinLength = $(this).attr('minlength');
      var inputVal = $(this).val();
      if (inputVal.length > valMinLength && !IsEmail(inputVal)) {
        $(this).parents('div.div-validate').append(msgEmail);
      }
    }
  });
  $(form).find('input.site').each(function(){
    if ($(this).is(':visible')) {
      var valMinLength = $(this).attr('minlength');
      var inputVal = $(this).val();
      if (inputVal.length > valMinLength && !IsSite(inputVal)) {
        $(this).parents('div.div-validate').append(msgSite);
      }
    }
  });
  if ($(form).find('span.error_validator').length > 0) {
    valido = false;
    swal.fire({title: 'Atenção', text: "Todos os campos devem ser preenchidos corretamente, inclusive os campos obrigatórios!", icon: 'warning', confirmButtonText: 'Ok'})
    .then((result) => {
      var offsetTop = $('span.error_validator').parents('.div-validate').find('label').offset().top - 90;
      $('html').animate({
        scrollTop: offsetTop
      }, 500);
    });
    // swal.fire('Atenção', "Todos os campos devem ser preenchidos corretamente!", 'warning');
  }
  return valido;
}
function formValidatorRMRosasClean(){
  $('form').find('span.required').remove();
  $('form').find('span.minlength').remove();
  $('form').find('span.cnpj').remove();
  $('form').find('span.cpf').remove();
}