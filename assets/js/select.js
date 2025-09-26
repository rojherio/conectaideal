
//Initialize Select2 Elements
$('.select2').select2({
	placeholder: 'Selecione uma opção',
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
$(".select2_naturalidade, .select2_conjuge_naturalidade, .select2_eleitor_cidade, .select2_reg_civ_cidadae, .select2_averbacao_cidade").select2({
	// placeholder: 'Selecione uma opção',
  minimumInputLength: 3,
  cache: true,
  language: {
    inputTooShort: function(args) {
      // args.minimum is the minimum required length
      // args.input is the user-typed text
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
    url: PORTAL_URL + "model/bsc/municipio/get_municipios_estados",
    dataType: 'json',
    type: "post",
    delay: 150,
    data: function(params) {
      return {
        nome: params.term // search term
      };
    },
    processResults: function(data, params) {
      return {
        results: data.itens
      };
    }
  }
});
$('.select2-tags').select2({
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
  placeholder: 'Selecione uma opção',
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
function select2Clear(){
  $('.select2').each(function (k, obj){
    $(obj).val(null).trigger('change');
  });
}

