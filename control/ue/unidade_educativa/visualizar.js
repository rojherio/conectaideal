function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/pessoa_juridica/cadastrar', {id: id});
};