<?php
// createInput(array(
//   /*int 1-12*/  'col'         => 12,
//   /*string*/    'label'       => 'Nome',
//   /*string*/    'type'        => 'text',
//   /*string*/    'name'        => 'p_nome',
//   /*string*/    'id'          => 'p_nome',
//   /*string*/    'class'       => 'form-control',
//   /*int*/       'minlength'   => 3,
//   /*int*/       'maxlength'   => 254,
//   /*string*/    'placeholder' => 'Digite o nome da pessoa',
//   /*string*/    'value'       => $rsPessoa['nome'],
//   /*bool*/      'required'    => true,
//   /*string*/    'prop'        => ''
// );
// createInputDate(array(
//   /*int 1-12*/  'col'         => 12,
//   /*string*/    'label'       => 'Nome',
//   /*string*/    'name'        => 'p_nome',
//   /*string*/    'id'          => 'p_nome',
//   /*string*/    'class'       => 'form-control',
//   /*int*/       'min'         => 1900-01-01,
//   /*int*/       'maxToday'    => true,
//   /*string*/    'placeholder' => 'Digite o nome da pessoa',
//   /*string*/    'value'       => $rsPessoa['nome'],
//   /*bool*/      'required'    => true,
//   /*string*/    'prop'        => ''
// );
// createSelect(array(
//   /*int 1-12*/  'col'         => 12,
//   /*string*/    'label'       => 'Nacionalidade',
//   /*string*/    'name'        => 'p_natural_bsc_pais_id',
//   /*string*/    'id'          => 'p_natural_bsc_pais_id',
//   /*string*/    'class'       => 'select2 form-control form-select select-basic', //'select2_naturalidade form-control form-select select-basic',
//   /*string*/    'value'       => $rsPessoa['natural_bsc_pais_id'],
//   /*array()*/   'options'     => $rsPaises,
//   /*string*/    'ariaLabel'   => 'Selecione um país',
//   /*bool*/      'required'    => true,
//   /*string*/    'prop'        => ''
// );
// createCheckbox(array(
//   /*int 1-12*/  'col'         => 12,
//   /*string*/    'label'       => 'Ativo',
//   /*string*/    'type'        => 'checkbox',
//   /*string*/    'name'        => 'p_status',
//   /*string*/    'id'          => 'p_status',
//   /*string*/    'class'       => 'toggle',
//   /*string*/    'value'       => 1,
//   /*string*/    'checked'     => $rsPessoa['status'],
//   /*string*/    'prop'        => ''
// );
// createRadio(array(
//   /*int 1-12*/  'col'         => 6,
//   /*int 1-12*/  'colOption'   => 6,
//   /*string*/    'label'       => 'Sexo',
//   /*string*/    'type'        => 'radio',
//   /*string*/    'name'        => 'p_sexo',
//   /*array()*/   'id'          => array("p_sexo_F", "p_sexo_M"),
//   /*string*/    'class'       => 'radiomark outline-info ms-2',
//   /*string*/    'value        => '$rsPessoa['sexo']',
//   /*array()*/   'values'      => array("Feminino", "Masculino"),
//   /*array()*/   'options'     => array("Feminino", "Masculino"),
//   /*bool*/      'required'    => true,
//   /*string*/    'prop'        => ''
// );
function createInput($params) {
  $html  = '  <div class="col-'.$params['col'].'">';
  $html .= '    <div class="div-validate form-floating mb-3">';
  $html .= '      <input type="'.$params['type'].'" name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" minlength="'.$params['minlength'].'" maxlength="'.$params['maxlength'].'" placeholder="'.$params['placeholder'].'" value="'.$params['value'].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>';
  $html .= '      <label for="'.$params['name'].'">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
function createInputDate($params) {
  $html  = '  <div class="col-'.$params['col'].'">';
  $html .= '    <div class="div-validate form-floating mb-3">';
  $html .= '      <input type="date" name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" minlength="10" maxlength="10" min="'.$params['min'].'" '.($params['maxToday'] ? 'max="'.date('Y-m-d').'"' : '' ).'  placeholder="'.$params['placeholder'].'" value="'.$params['value'].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>';
  $html .= '      <label for="'.$params['name'].'">'.date('Y-m-d').''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
function createSelect($params) {
  $html    = '  <div class="col-'.$params['col'].'" '.$params['prop'].' '.(!$params['display'] ? 'style="display: none;"' : '').'>';
  $html   .= '    <div class="div-validate form-floating mb-3">';
  $html   .= '      <select name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" aria-label="'.$params['ariaLabel'].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>';
  $html   .= '        <option></option>';
  if (is_array($params['options'])) {
    foreach ($params['options'] as $kObj => $vObj) {
      $html .= '        <option value="'.$vObj['id'].'" '.($params['value'] == $vObj['id'] ? 'selected="selected"' : "").'">'.$vObj['nome'].'</option>';
    }
  }
  $html   .= '      </select>';
  $html   .= '      <label for="'.$params['name'].'">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html   .= '    </div>';
  $html   .= '  </div>';
  return $html;
}
function createCheckbox($params) {
  $html  = '  <div class="col-'.$params['col'].'">';
  $html .= '    <div class="div-validate main-switch main-switch-color">';
  $html .= '      <div class="switch-info swich-size">';
  $html .= '        <input type="'.$params['type'].'" name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" '.($params['value'] == $params['checked'] ? 'checked="checked"' : "").' value="'.$params['value'].'" '.$params['prop'].'>';
  $html .= '        <label for="'.$params['name'].'">'.$params['label'].'</label>';
  $html .= '      </div>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
function createRadio($params) {
  $html    = '  <div class="div-validate col-'.$params['col'].'">';
  $html   .= '    <div class="check-container form-control delfos-radio">';
  $html   .= '      <label class="delfos-radio">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html   .= '      <div class="row">';
  if (is_array($params['options'])) {
    foreach ($params['values'] as $kObj => $vObj) {
      $html   .= '        <div class="col-'.$params['colOption'].'">';
      $html .= '          <label class="check-box">';
      $html .= '            <input type="'.$params['type'].'" name="'.$params['name'].'" id="'.$params['id'][$kObj].'" class="" '.($params['value'] == $vObj ? 'checked="checked"' : "").'" value="'.$params['values'][$kObj].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>';
      $html .= '            <span class="'.$params['class'].'"></span>';
      $html .= '            <span class="text">'.$params['options'][$kObj].'</span>';
      $html .= '          </label>';
      $html .= '        </div>';
    }
  }
  $html   .= '      </div>';
  $html   .= '    </div>';
  $html   .= '  </div>';
  return $html;
}
?>