function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/nivel_ensino/cadastrar', {id: id});
};