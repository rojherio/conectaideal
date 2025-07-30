<?php
function createInput($col, $label, $type, $name, $id, $class, $minlength, $maxlength, $placeholder, $title, $value, $required, $prop) {
  $html  = '  <div class="col-'.$col.'">';
  $html .= '    <div class="form-floating mb-3">';
  $html .= '      <input type="'.$type.'" name="'.$name.'" id="'.$id.'" class="'.$class.'" minlength="'.$minlength.'" maxlength="'.$maxlength.'" placeholder="'.$placeholder.'" title="'.$title.'" value="'.$value.'" '. ($required ? 'required' : '' ).' '.$prop.'>';
  $html .= '      <label for="'.$name.'">'.$label.''. ($required ? '<span class="text-danger">*</span>:' : '' ).'</label>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
function createSelect($col, $label, $name, $id, $class, $ariaLabel, $required, $prop, $options) {
  $html    = '  <div class="col-'.$col.'">';
  $html   .= '    <div class="form-floating mb-3">';
  $html   .= '      <select name="'.$name.'" id="'.$id.'" class="'.$class.'" aria-label="'.$ariaLabel.'" title="'.$title.'" '. ($required ? 'required' : '' ).' '.$prop.'>';
  $html   .= '        <option></option>';
  foreach ($options as $kObj => $vObj) {
    $html .= '        <option value="'.$vObj["id"].'">'.$vObj["nome"].'</option>';
  }
  $html   .= '      </select>';
  $html   .= '      <label for="'.$name.'">'.$label.''. ($required ? '<span class="text-danger">*</span>:' : '' ).'</label>';
  $html   .= '    </div>';
  $html   .= '  </div>';
  return $html;
}
function createCheckbox($col, $label, $type, $name, $id, $class, $checked, $value, $prop) {
  $html  = '  <div class="col-'.$col.'">';
  $html .= '    <div class="main-switch main-switch-color mb-3">';
  $html .= '      <div class="switch-info swich-size">';
  $html .= '        <input type="'.$type.'" name="'.$name.'" id="'.$id.'" class="'.$class.'" checked="'.$checked.'" value="'.$value.'" '.$prop.'>';
  $html .= '        <label for="'.$name.'">'.$label.'</label>';
  $html .= '      </div>';
  $html .= '    </div>';
  $html .= '  </div>';
  return $html;
}
function createRadio($col, $colOption, $label, $type, $name, $id, $class, $checked, $value, $required, $prop, $options) {
  $html    = '  <div class="col-'.$col.'">';
  $html   .= '    <div class="check-container form-control delfos-radio mb-3">';
  $html   .= '      <label class="delfos-radio">'.$label.''. ($required ? '<span class="text-danger">*</span>:' : '' ).'</label>';
  $html   .= '      <div class="row">';
  foreach ($value as $kObj => $vObj) {
  $html   .= '        <div class="col-'.$colOption.'">';
    $html .= '          <label class="check-box">';
    $html .= '            <input type="'.$type.'" name="'.$name.'" id="'.$id[$kObj].'" class="" checked="'.($checked == $vObj ? "checked" : "").'" value="'.$value[$kObj].'" '. ($required ? 'required' : '' ).' '.$prop.'>';
    $html .= '            <span class="'.$class.'"></span>';
    $html .= '            <span class="text">'.$options[$kObj].'</span>';
    $html .= '          </label>';
    $html .= '        </div>';
  }
  $html   .= '      </div>';
  $html   .= '    </div>';
  $html   .= '  </div>';
  return $html;
}
?>