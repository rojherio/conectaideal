function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_agua_abast_tipo/cadastrar', {id: id});
};