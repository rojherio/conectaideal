function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_eletrica_fonte/cadastrar/' + id);
};