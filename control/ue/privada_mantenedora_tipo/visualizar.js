function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/privada_mantenedora_tipo/cadastrar', {id: id});
};