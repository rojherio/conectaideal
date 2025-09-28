function btnEditar(){
  let id = $('input#edit_id').val();
  postToURL(PORTAL_URL + 'view/ue/equip_acesso_internet_aluno/cadastrar/' + id);
};