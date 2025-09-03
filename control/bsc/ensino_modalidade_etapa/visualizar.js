function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/ensino_modalidade_etapa/cadastrar', {id: id});
};