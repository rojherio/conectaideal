function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/eo/seg_submodulo/cadastrar/' + id);
};