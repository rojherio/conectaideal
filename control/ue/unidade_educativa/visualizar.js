function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/pessoa_juridica/cadastrar', {id: id});
};