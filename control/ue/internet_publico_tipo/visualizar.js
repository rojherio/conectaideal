function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/internet_publico_tipo/cadastrar', {id: id});
};