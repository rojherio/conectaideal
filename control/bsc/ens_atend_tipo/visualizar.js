function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/ens_atend_tipo/cadastrar', {id: id});
};