// var data = new Date();
// var hoje = data.getFullYear()+'-'+(("0"+(data.getMonth()+1)).slice(-2))+'-'+(("0"+(data.getDate())).slice(-2));
$('.mask-cpf').each(function(k, elem){
  new Cleave(elem, {
    numericOnly: true,
    delimiters: ['.', '.', '-'],
    blocks: [3, 3, 3, 2]
  });
});
$('.mask-cnpj').each(function(k, elem){
  new Cleave(elem, {
    numericOnly: true,
    delimiters: ['.', '.', '/', '-'],
    blocks: [2, 3, 3, 4, 2]
  });
});
$('.mask-cep').each(function(k, elem){
  new Cleave(elem, {
    numericOnly: true,
    delimiters: ['.', '-'],
    blocks: [2, 3, 3]
  });
});
$('.mask-tel-resid').each(function(k, elem){
  new Cleave(elem, {
    numericOnly: true,
    delimiters: ['(', ')', '-'],
    blocks: [0, 2, 4, 4]
  });
});
$('.mask-tel-cel').each(function(k, elem){
  new Cleave(elem, {
    numericOnly: true,
    delimiters: ['(', ')', '.' , '-'],
    blocks: [0, 2, 1, 4, 4]
  });
});
$('.mask-tel-geral').each(function(k, elem){
  new Cleave(elem, {
    numericOnly: true,
    delimiters: ['(', ')', '-'],
    blocks: [0, 2, 4, 5]
  });
});
$('.mask-numeros').each(function(k, elem){
  let maxLength = $(this).attr('maxlength');
  new Cleave(elem, {
    numericOnly: true,
    blocks: [maxLength]
  });
});
function maskCleaveApplay(elemDiv){
  $(elemDiv).find('.mask-cpf').each(function(k, elem){
    new Cleave(elem, {
      numericOnly: true,
      delimiters: ['.', '.', '-'],
      blocks: [3, 3, 3, 2]
    });
  });
  $(elemDiv).find('.mask-cnpj').each(function(k, elem){
    new Cleave(elem, {
      numericOnly: true,
      delimiters: ['.', '.', '/', '-'],
      blocks: [2, 3, 3, 4, 2]
    });
  });
  $(elemDiv).find('.mask-cep').each(function(k, elem){
    new Cleave(elem, {
      numericOnly: true,
      delimiters: ['.', '-'],
      blocks: [2, 3, 3]
    });
  });
  $(elemDiv).find('.mask-tel-resid').each(function(k, elem){
    new Cleave(elem, {
      numericOnly: true,
      delimiters: ['(', ')', '-'],
      blocks: [0, 2, 4, 4]
    });
  });
  $(elemDiv).find('.mask-tel-cel').each(function(k, elem){
    new Cleave(elem, {
      numericOnly: true,
      delimiters: ['(', ')', '.' , '-'],
      blocks: [0, 2, 1, 4, 4]
    });
  });
  $(elemDiv).find('.mask-tel-geral').each(function(k, elem){
    new Cleave(elem, {
      numericOnly: true,
      delimiters: ['(', ')', '-'],
      blocks: [0, 2, 4, 5]
    });
  });
  $(elemDiv).find('.mask-numeros').each(function(k, elem){
    let maxLength = $(this).attr('maxlength');
    new Cleave(elem, {
      numericOnly: true,
      blocks: [maxLength]
    });
  });
}
// $('.mask-data').each(function(k, elem){
//   new Cleave(elem, {
//     date: true,
//     dateMin: '1900-01-01',
//     dateMax: hoje,
//     delimter: '/',
//     datePattern: ['d', 'm', 'Y']
//   });
// });

// **------ 1 Date Input**
// new Cleave('.cleave-input-date', {
//     date: true,
//     delimter: '/',
//     datePattern: ['d', 'm', 'Y']
// });
// new Cleave('.month-input', {
//     date: true,
//     datePattern: ['d', 'm']
// });
// new Cleave('.formatting-input', {
//     date: true,
//     delimiter: '-',
//     datePattern: ['Y', 'm', 'd']
// });
// new Cleave('.formatting-delimter', {
//     date: true,
//     delimiter: '.',
//     datePattern: ['d', 'm', 'Y']
// });

// // **------ 2 Time Input**

// new Cleave('.time-input', {
//     time: true,
//     timePattern: ['h', 'm', 's']
// });
// new Cleave('.min-sec-input', {
//     time: true,
//     timePattern: ['h', 'm']
// });
// new Cleave('.hours-min-input', {
//     time: true,
//     timePattern: ['h', 'm']
// });

// //  **------ 3 Custom Input**
// new Cleave('.contact-input', {
//     numeral: true,
//     delimiter: '-',
//     blocks: [3, 3, 4],
// });
// new Cleave('.formatting-contact', {
//     delimiters: ['(', ')', '(', ')', '(', ')'],
//     blocks: [0, 3, 0, 3, 0, 4, 0],
//     uppercase: true
// });
// new Cleave('.credit-input', {
//     creditCard: true,
// });
// var cleave = new Cleave('.nueral-input', {
//     numeral: true,
//     numeralThousandsGroupStyle: 'thousand'
// });
// new Cleave('.price-input', {
//     numeral: true,
//     prefix: '$',
//     signBeforePrefix: true
// });
// new Cleave('.price-formatting', {
//     numeral: true,
//     prefix: '€',
//     tailPrefix: true
// });
// new Cleave('.prefix-input', {
//     blocks: [6, 3, 3, 3],
//     prefix: '253874'
// });
// new Cleave('.prefix-del-input', {
//     prefix: 'PREFIX',
//     delimiters: ['-', '-', '.'],
//     blocks: [6, 3, 3, 3, 2],
//     uppercase: true
// });
