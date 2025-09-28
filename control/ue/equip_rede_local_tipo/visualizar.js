function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/equip_rede_local_tipo/cadastrar/' + id);
};