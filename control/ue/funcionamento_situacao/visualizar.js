function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/funcionamento_situacao/cadastrar', {id: id});
};