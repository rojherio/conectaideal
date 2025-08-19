function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/banco_conta_tipo/cadastrar', {id: id});
};