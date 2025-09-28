function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_local_ocupacao_forma/cadastrar/' + id);
};