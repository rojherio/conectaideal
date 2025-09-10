function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_acessib_recurso/cadastrar', {id: id});
};