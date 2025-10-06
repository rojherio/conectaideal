function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/sme/rh_serv_situacao/cadastrar/' + id);
};