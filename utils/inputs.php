<?php
function createInput($params) {
  $html  = '  <div class="col-md-'.$params['col'].'">';
  $html .= '    <div class="div-validate form-floating mb-3">';
  $html .= '      <input type="'.$params['type'].'" name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" '.($params['type'] == 'number' ? 'min="0"' : '' ).' minlength="'.$params['minlength'].'" maxlength="'.$params['maxlength'].'" placeholder="'.$params['placeholder'].'" value="'.$params['value'].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>';
  $html .= '      <label for="'.$params['id'].'">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
function createInputDate($params) {
  $html  = '  <div class="col-md-'.$params['col'].'">';
  $html .= '    <div class="div-validate form-floating mb-3">';
  $html .= '      <input type="date" name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" minlength="10" maxlength="10" min="'.$params['min'].'" '.($params['maxToday'] ? 'max="'.date('Y-m-d').'"' : 'max="'.date('Y-m-d', strtotime('+10 years')).'"' ).'  placeholder="'.$params['placeholder'].'" value="'.$params['value'].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>';
  $html .= '      <label for="'.$params['id'].'">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
function createSelect($params) {
  $html    = '  <div class="col-md-'.$params['col'].'">';
  $html   .= '    <div class="div-validate form-floating mb-3">';
  $html   .= '      <select name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" data-placeholder="'.$params['ariaLabel'].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>';
  $html   .= '        <option></option>';
  if (is_array($params['options'])) {
    foreach ($params['options'] as $kObj => $vObj) {
      $html .= '        <option value="'.$vObj['id'].'" '.($params['value'] == $vObj['id'] ? 'selected="selected"' : "").'>'.$vObj['nome'].'</option>';
    }
  }
  $html   .= '      </select>';
  $html   .= '      <label for="'.$params['id'].'">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html   .= '    </div>';
  $html   .= '  </div>';
  return $html;
}
function createSelectMultiple($params) {
  $html    = '  <div class="select_primary col-md-'.$params['col'].'">';
  $html   .= '    <div class="div-validate form-floating mb-3">';
  $html   .= '      <select multiple name="'.$params['name'].'[]" id="'.$params['id'].'" class="select_primary '.$params['class'].'" data-placeholder="'.$params['ariaLabel'].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>';
  $html   .= '        <option></option>';
  if (is_array($params['options'])) {
    foreach ($params['options'] as $kObj => $vObj) {
      $html .= '        <option value="'.$vObj['id'].'" '.(in_array($vObj['id'], $params['value']) ? 'selected="selected"' : "").'>'.$vObj['nome'].'</option>';
    }
  }
  $html   .= '      </select>';
  $html   .= '      <label for="'.$params['id'].'">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html   .= '    </div>';
  $html   .= '  </div>';
  return $html;
}
function createCheckbox($params) {
  $html  = '  <div class="col-md-'.$params['col'].'">';
  $html .= '    <div class="div-validate main-switch main-switch-color">';
  $html .= '      <div class="switch-info swich-size">';
  $html .= '        <input type="checkbox" name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" '.($params['value'] == $params['checked'] ? 'checked="checked"' : "").' value="'.$params['value'].'" '.$params['prop'].'>';
  $html .= '        <label for="'.$params['id'].'">'.$params['label'].'</label>';
  $html .= '      </div>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
function createRadio($params) {
  $html    = '  <div class="div-validate mb-3 col-md-'.$params['col'].'">';
  $html   .= '    <div class="check-container form-control conectaideal-radio">';
  $html   .= '      <label class="conectaideal-radio">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html   .= '      <div class="row">';
  if (is_array($params['options'])) {
    foreach ($params['values'] as $kObj => $vObj) {
      $html   .= '        <div class="col-md-'.$params['colOption'].'">';
      $html .= '          <label class="check-box">';
      $html .= '            <input type="'.$params['type'].'" name="'.$params['name'].'" id="'.$params['id'][$kObj].'" '.($params['value'] == $vObj ? 'checked="checked"' : "").' value="'.$params['values'][$kObj].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].' '.(isset($params['prop_aux']) ? (is_array($params['prop_aux']) ? $params['prop_aux'][$kObj] : '' ) : '') .'>';
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
function createTextArea($params) {
  $html  = '  <div class="col-md-'.$params['col'].'">';
  $html .= '    <div class="div-validate form-floating mb-3">';
  $html .= '      <textarea name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" minlength="'.$params['minlength'].'" maxlength="'.$params['maxlength'].'" placeholder="'.$params['placeholder'].'" '.($params['required'] ? 'required' : '' ).' '.$params['prop'].'>'.$params['value'].'</textarea>';
  $html .= '      <label for="'.$params['id'].'">'.$params['label'].''. ($params['required'] ? '<span class="text-danger">*</span>' : '' ).':</label>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
?>