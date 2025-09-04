function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/parceria_convenio_forma/cadastrar', {id: id});
};