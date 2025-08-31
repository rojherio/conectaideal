function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/categoria_escola_privada/cadastrar', {id: id});
};