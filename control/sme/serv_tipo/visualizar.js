function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/sme/serv_tipo/cadastrar/' + id);
};