function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_lixo_resid_trat_tipo/cadastrar', {id: id});
};