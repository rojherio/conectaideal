function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/eo/uo_tipo/cadastrar/' + id);
};