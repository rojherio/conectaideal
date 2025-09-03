function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/ensino_atendimento_tipo/cadastrar', {id: id});
};