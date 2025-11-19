$(document).ready(function () {
  $('.select2-tags-searchable[load]').on('change', function(){
    let load              = $(this).attr('load');
    let selectId          = $(this).attr('id');
    let selectVal         = $(this).val();
    let selectText        = $(this).find(':selected').text();
    let idDadToSetId      = $(this).parents('form').find('[idtosetname="'+selectId+'"]').attr('id');
    let idxText           = selectText.indexOf(' (');
    if (load == 'true') {
      let idToSetName       = $(this).attr('idtosetname');
      let loadUrl           = 'view/'+$(this).attr('loadurl');
      let loadIdTextGet     = $(this).attr('loadidtextget');
      let loadIdStatusSet   = $(this).attr('loadidstatusset');
      let urlToSendSub      = 'model/'+$(this).attr('urltosendsub');
      let idDadToSetId      = $(this).parents('form').find('[idtosetname="'+selectId+'"]').attr('id');
      if ($.isNumeric(selectVal)) {
        $(new Object()).load(PORTAL_URL+loadUrl+selectVal, function(response, status, xhr){
          $(response).find('[id][name]').each(function(k, elem){
            if ($('#'+elem.id).hasClass('select2-searchable')) {
              let optText = $(elem).find('option[selected]').text();
              var newOption = new Option(optText, elem.value, true, true);
              $('#'+elem.id).append(newOption).trigger('change');
            }
            $(elem).is('select') ? $('#'+elem.id).val(elem.value).trigger('change') : '';
            $(elem).is('input') ? $('#'+elem.id).val(elem.value) : '';
          });
          if (idDadToSetId != undefined) {
            var newOption = new Option(selectText, selectText, true, true);
            $('#'+idDadToSetId).append(newOption).trigger('change');
          }
          if ($('#'+idToSetName).is('select')) {
            $('#'+idToSetName).attr('readonly', 'readonly');
          }
          $('#'+idToSetName).is('input:not([type="hidden"])') ? $('#'+idToSetName).attr('onblur', "setNewOptionSelect('"+selectId+"', this);") : '';
        });
      } else {
        if ($('#'+idToSetName).is('select')) {
          $('#'+idToSetName).removeAttr('readonly');
        }
        $(new Object()).load(PORTAL_URL+loadUrl, function(response, status, xhr){
          $(response).find('[id][name]').each(function(k, elem){
            $(elem).is('select:not(#'+idToSetName+')') ? $('#'+elem.id).val(null).trigger('change') : '';
            $(elem).is('input') ? $('#'+elem.id).val('') : '';
          });
          if ($('#'+idToSetName).is('input:not([type="hidden"])')) {
            $('#'+idToSetName).val(selectText).attr('onblur', "setNewOptionSelect('"+selectId+"', this);");
          } else if ($('#'+idToSetName).is('select')) {
            let optText = $('#'+selectId).find(':selected').text();
            let optVal = $('#'+selectId).val();
            var newOption = new Option(optText, optVal, true, true);
            $('#'+idToSetName).append(newOption).trigger('change');
          }
          if (idDadToSetId != undefined) {
            var newOption = new Option(selectText, selectText, true, true);
            $('#'+idDadToSetId).append(newOption).trigger('change');
          }
        });
      }
      $(this).attr('load', 'false');
    } else if (idDadToSetId != undefined) {
      var newOption = new Option(selectText, selectText, true, true);
      $('#'+idDadToSetId).append(newOption).trigger('change');
    }
  });
  $('select.select2-tags-searchable[load]').on('select2:open', function(){
    $(this).attr('load', 'true');
  });
  $('select.select2-tags-searchable[load]').on('select2:close', function(){
    $(this).attr('load', 'false');
  });
});
//Initialize Select2
$('.select2').select2({
	placeholder: 'Selecione uma opção',
  allowClear: true,
  language: {
    inputTooShort: function(args) {
        // args.minimum is the minimum required length
        // args.input is the  user-typed text
      return "Por favor, digite 3 ou mais caracteres";
    },
    errorLoading: function() {
      return "Erro ao carregar resultados";
    },
    loadingMore: function() {
      return "Carregando mais resultados";
    },
    noResults: function() {
      return "Nenhum resultado encontrado";
    },
    searching: function() {
      return "Carregando...";
    },
    maximumSelected: function(args) {
        // args.maximum is the maximum number of items the user may select
      return "Erro ao carregar resultados";
    }
  }
});
//Initialize Select2-multiple
$('.select2-multiple').select2({
  placeholder: 'Selecione uma ou mais opções',
  language: {
    inputTooShort: function(args) {
        // args.minimum is the minimum required length
        // args.input is the  user-typed text
      return "Por favor, digite 3 ou mais caracteres";
    },
    errorLoading: function() {
      return "Erro ao carregar resultados";
    },
    loadingMore: function() {
      return "Carregando mais resultados";
    },
    noResults: function() {
      return "Nenhum resultado encontrado";
    },
    searching: function() {
      return "Carregando...";
    },
    maximumSelected: function(args) {
        // args.maximum is the maximum number of items the user may select
      return "Erro ao carregar resultados";
    }
  }
});
//Initialize Select2 Pesquisa
$(".select2-searchable").select2({
  placeholder: 'Selecione uma opção',
  minimumInputLength: 3,
  cache: true,
  allowClear: true,
  language: {
    inputTooShort: function(args) {
      return "Por favor, digite 3 ou mais caracteres";
    },
    errorLoading: function() {
      return "Erro ao carregar resultados";
    },
    loadingMore: function() {
      return "Carregando mais resultados";
    },
    noResults: function() {
      return "Nenhum resultado encontrado";
    },
    searching: function() {
      return "Carregando...";
    },
    maximumSelected: function(args) {
      // args.maximum is the maximum number of items the user may select
      return "Erro ao carregar resultados";
    }
  },
  ajax: {
    url: function (params) {
      return PORTAL_URL + "model/" + $(this).attr('searchurl');
    },
    dataType: 'json',
    type: "post",
    delay: 150,
    data: function(params) {
      return {
        nome: params.term
      };
    },
    processResults: function(data, params) {
      return {
        results: data.itens
      };
    }
  }
});
//Initialize Select2 Pesquisa
$(".select2-tags-searchable").select2({
  placeholder: 'Selecione uma opção',
  minimumInputLength: 3,
  cache: true,
  allowClear: false,
  tags: true, 
  createTag: function (params) {
    var term = $.trim(params.term);
    if (term === '' || term === '0') {
      return null;
    }
    return {
      id: term,
      text: term,
      newTag: true // add additional parameters
    }
  },
  language: {
    inputTooShort: function(args) {
      return "Por favor, digite 3 ou mais caracteres";
    },
    errorLoading: function() {
      return "Erro ao carregar resultados";
    },
    loadingMore: function() {
      return "Carregando mais resultados";
    },
    noResults: function() {
      return "Nenhum resultado encontrado";
    },
    searching: function() {
      return "Carregando...";
    },
    maximumSelected: function(args) {
      // args.maximum is the maximum number of items the user may select
      return "Erro ao carregar resultados";
    }
  },
  ajax: {
    url: function (params) {
      return PORTAL_URL + "model/" + $(this).attr('searchurl');
    },
    dataType: 'json',
    type: "post",
    delay: 150,
    data: function(params) {
      return {
        nome: params.term
      };
    },
    processResults: function(data, params) {
      return {
        results: data.itens
      };
    }
  }
});
//função criar Select2 clonado
function createSelect2(elemDiv){
  $(elemDiv).find('select.select2').each(function (k, elem){
    $(elem).select2({
      placeholder: 'Selecione uma opção',
      allowClear: true,
      language: {
        inputTooShort: function(args) {
        // args.minimum is the minimum required length
        // args.input is the  user-typed text
          return "Por favor, digite 3 ou mais caracteres";
        },
        errorLoading: function() {
          return "Erro ao carregar resultados";
        },
        loadingMore: function() {
          return "Carregando mais resultados";
        },
        noResults: function() {
          return "Nenhum resultado encontrado";
        },
        searching: function() {
          return "Carregando...";
        },
        maximumSelected: function(args) {
        // args.maximum is the maximum number of items the user may select
          return "Erro ao carregar resultados";
        }
      }
    });
  });
  $(elemDiv).find('select.select2-multiple').each(function (k, elem){
    $(elem).select2({
      placeholder: 'Selecione uma ou mais opções',
      language: {
        inputTooShort: function(args) {
        // args.minimum is the minimum required length
        // args.input is the  user-typed text
          return "Por favor, digite 3 ou mais caracteres";
        },
        errorLoading: function() {
          return "Erro ao carregar resultados";
        },
        loadingMore: function() {
          return "Carregando mais resultados";
        },
        noResults: function() {
          return "Nenhum resultado encontrado";
        },
        searching: function() {
          return "Carregando...";
        },
        maximumSelected: function(args) {
        // args.maximum is the maximum number of items the user may select
          return "Erro ao carregar resultados";
        }
      }
    });
  });
  $(elemDiv).find('select.select2-searchable').each(function (k, elem){
    $(elem).select2({
      placeholder: 'Selecione uma opção',
      minimumInputLength: 3,
      cache: true,
      allowClear: true,
      language: {
        inputTooShort: function(args) {
          return "Por favor, digite 3 ou mais caracteres";
        },
        errorLoading: function() {
          return "Erro ao carregar resultados";
        },
        loadingMore: function() {
          return "Carregando mais resultados";
        },
        noResults: function() {
          return "Nenhum resultado encontrado";
        },
        searching: function() {
          return "Carregando...";
        },
        maximumSelected: function(args) {
          return "Erro ao carregar resultados";
        }
      },
      ajax: {
        url: function (params) {
          return PORTAL_URL + "model/" + $(this).attr('searchurl');
        },
        dataType: 'json',
        type: "post",
        delay: 150,
        data: function(params) {
          return {
            nome: params.term
          };
        },
        processResults: function(data, params) {
          return {
            results: data.itens
          };
        }
      }
    });
  });
  $(elemDiv).find('select.select2-tags-searchable').each(function (k, elem){
    $(elem).select2({
      placeholder: 'Selecione uma opção',
      minimumInputLength: 3,
      cache: true,
      allowClear: false,
      tags: true, 
      createTag: function (params) {
        var term = $.trim(params.term);
        if (term === '' || term === '0') {
          return null;
        }
        return {
          id: term,
          text: term,
          newTag: true 
        }
      },
      language: {
        inputTooShort: function(args) {
          return "Por favor, digite 3 ou mais caracteres";
        },
        errorLoading: function() {
          return "Erro ao carregar resultados";
        },
        loadingMore: function() {
          return "Carregando mais resultados";
        },
        noResults: function() {
          return "Nenhum resultado encontrado";
        },
        searching: function() {
          return "Carregando...";
        },
        maximumSelected: function(args) {
          return "Erro ao carregar resultados";
        }
      },
      ajax: {
        url: function (params) {
          return PORTAL_URL + "model/" + $(this).attr('searchurl');
        },
        dataType: 'json',
        type: "post",
        delay: 150,
        data: function(params) {
          return {
            nome: params.term
          };
        },
        processResults: function(data, params) {
          return {
            results: data.itens
          };
        }
      }
    });
  });
}
function select2Clear(){
  $('.select2').each(function (k, obj){
    $(obj).val(null).trigger('change');
  });
}

