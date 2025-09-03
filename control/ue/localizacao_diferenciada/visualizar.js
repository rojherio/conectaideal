function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/localizacao_diferenciada/cadastrar', {id: id});
};