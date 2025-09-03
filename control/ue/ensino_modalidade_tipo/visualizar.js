function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/ensino_modalidade_tipo/cadastrar', {id: id});
};