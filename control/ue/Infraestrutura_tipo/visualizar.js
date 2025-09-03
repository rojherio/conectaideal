function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/infraestrutura_tipo/cadastrar', {id: id});
};