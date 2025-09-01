function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/bsc/cat_esc_priv/cadastrar', {id: id});
};