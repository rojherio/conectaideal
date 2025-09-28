function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/equipamento_computador_tipo/cadastrar/' + id);
};