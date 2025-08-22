function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/porte/cadastrar', {id: id});
};