function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/ue_vinculada_tipo/cadastrar/' + id);
};