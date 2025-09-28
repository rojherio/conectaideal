function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/esfera_administrativa/cadastrar/' + id);
};