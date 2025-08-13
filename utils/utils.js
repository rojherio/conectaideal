const PORTAL_URL = 'http://localhost/delfos/';

$(document).ready(function () {
  // $('#modalLoading').modal({
  //   backdrop: 'static',
  //   keyboard: false
  // })
});
$('button[type="reset"]').on('click', function(){
  $('button#submit').attr('disabled', false);
  select2Clear();
  formValidatorRMRosasClean();
  $('html').animate({
    scrollTop: 0
  }, 500);
});
function divLoading(){
  $('button#submit').attr('disabled', true);
  $.blockUI({
    message:  $('div#modalLoading').html(), 
    draggable: true,
    css: { 
      border: 0, 
      backgroundColor: '#fff', 
      'border-radius': '1.8rem'
    }, 
  });
}
function divLoaded(){
  $.unblockUI();
  $('button#submit').attr('disabled', false);
}
function ajaxSend(params){
  let formToSend = $('#'+params.formId);
  let formValido = formValidatorRMRosas($(formToSend));
  if (formValido) {
    Swal.fire({
      title: 'Você confirma o registro destas novas informações?',
      text: "Se você confirmar, os dados informados serão registrados no banco de dados do sistema",
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sim, Cadastre',
      cancelButtonText: 'Não, Cancele!'
    }).then((result) => {
      if (result.isConfirmed) {
        divLoading();
        $.ajax({
          url: PORTAL_URL + params.urlToSend,
          async: true,
          method: "post",
          beforeSend: divLoading,
          cache: true,
          dataType: "json",
          contentType: "application/x-www-form-urlencoded; charset=UTF-8",
          data: $(formToSend).serialize(),
          statusCode: {
            404: function() {
              alert( "Página não encontrada" );
            }
          }
        })
        .done(function (data, status, obj){
          ajaxSuccess(data, status, obj, params.urlDashboard);
        })
        .fail(function (data, status, errorThrown){
          ajaxError(data, status, errorThrown);
        })
        .always(function (data, status){
          ajaxComplete(data, status, params.urlDashboard);
        })
      } else {
        divLoaded();
        return false;
      }
    });
  } else {
    return false;
  }
}
function ajaxSuccess(data, status, obj, urlDashboard) {
  // if (data.status == 'success') {
  //   setTimeout(function() {
  //     divLoaded();
  //     Swal.fire('Sucesso', data.msg, 'success');
  //   }, 500);
  // } else if (data.status == 'error') {
  //   setTimeout(function() {
  //     divLoaded();
  //     Swal.fire('Houve um Erro', data.msg, 'error');
  //     console.log('Error: ' + data.msg);
  //   }, 500);
  // }
  return true;
}
function ajaxError(data, status, errorThrown) {
  setTimeout(function() {
    divLoaded();
    Swal.fire('Erro inesperado', "Houve um erro inesperado ao tentar registrar as novas informações! Por favor, tente novamente ou informe ao suporte o erro a seguir: " + data.msg + ' - Ajax: ' + errorThrown, 'error');
    // console.log('Error: ' + data.msg + ' - Ajax: ' + errorThrown);
    return false
  }, 500);
}
function ajaxComplete(data, status, urlDashboard) {
  setTimeout(function() {
    divLoaded();
    if (data.status == 'success') {
      swal.fire('Sucesso', data.msg, 'success');
      Swal.fire({
        title: 'Sucesso',
        text: data.msg,
        icon: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        // allowOutsideClick: false,
        // allowEscapeKey: false
      }).then((result) => {
        Swal.fire({
          title: 'Você deseja realizar um novo cadastro?',
          text: "Se você confirmar, você permanecerá nesta página para efetuar um novo cadastro",
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Sim, realizar novo cadastro',
          cancelButtonText: 'Não, quero sair da página de cadastro!'
        }).then((result) => {
          if (result.isConfirmed) {
            $('button[type="reset"]').click();
            return false;
          } else {
            postToURL(PORTAL_URL + urlDashboard);
          }
        });
      });
    } else if (data.status == 'error') {
      Swal.fire('Erro inesperado', "Houve um erro inesperado ao tentar registrar as novas informações! Por favor, tente novamente ou informe ao suporte o erro a seguir: " + data.msg, 'error');
      // console.log('Error: ' + data.msg);
    }
  }, 1000);
}
function postToURL(path, params, method, target) {
  method = method || "post"; // Set method to post by default, if not specified.
  target = target || "_self"; // Set target to post by default, if not specified.
  var form = document.createElement("form");
  form.setAttribute("method", method);
  form.setAttribute("action", path);
  form.setAttribute("target", target);
  var addField = function (key, value) {
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", key);
    hiddenField.setAttribute("value", value);
    form.appendChild(hiddenField);
  };
  for (var key in params) {
    if (params.hasOwnProperty(key)) {
      if (params[key] instanceof Array) {
        for (var i = 0; i < params[key].length; i++) {
          addField(key, params[key][i])
        }
      }
      else {
        addField(key, params[key]);
      }
    }
  }
  document.body.appendChild(form);
  form.submit();
}