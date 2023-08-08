<?php
global $fvnController, $post;
$htmlObj = new FvnSetupHtml();
$controller = $fvnController->_data['controller'];

// Tạo phần tử chứa price
$inputId = $controller->create_id('price');
$inputName = $controller->create_key('price');
$inputValue = get_post_meta($post->ID, $controller->create_key('price'), true);
$inputValue = filter_var($inputValue, FILTER_VALIDATE_FLOAT);

$arr = array('size' => 25,  'id' => $inputId);
$html = $htmlObj->label(__('Price')). '</br>'
        .$htmlObj->textbox($inputName, $inputValue, $arr);
echo $htmlObj->pTag($html);

// Tạo phần tử chứa sale off
$inputId = $controller->create_id('sale-off');
$inputName = $controller->create_key('sale-off');
$inputValue = get_post_meta($post->ID, $controller->create_key('sale-off'), true);
$inputValue = filter_var($inputValue, FILTER_VALIDATE_FLOAT);

$arr = array('size' => 25,  'id' => $inputId);
$html = $htmlObj->label(__('Sale Off')). '</br>'
        .$htmlObj->textbox($inputName, $inputValue, $arr);
echo $htmlObj->pTag($html);

// Tạo phần tử chứa Manufacturer
$modelManufact = $fvnController->getModel('Manafacturer');
$results = $modelManufact->getItem(array('status' => 1), array('type' => 'all'));
$options['data']= array();
foreach ($results as $key => $val) {
    $options['data'][$val['id']] = $val['name'];
}

$inputId = $controller->create_id('manufacturer');
$inputName = $controller->create_key('manufacturer');
$inputValue = get_post_meta($post->ID, $controller->create_key('manufacturer'), true);
$inputValue = filter_var($inputValue, FILTER_VALIDATE_FLOAT);

$arr = array('id' => $inputId, 'style' => 'width: 150px;');
$html = $htmlObj->label(__('Manufacturer')). '</br>'
        .$htmlObj->selectbox($inputName, $inputValue, $arr, $options);
echo $htmlObj->pTag($html);

// Tạo phần tử chứa Gift
$inputId = $controller->create_id('gift');
$inputName = $controller->create_key('gift');
$inputValue = get_post_meta($post->ID, $controller->create_key('gift'), true);
// $inputValue = filter_var($inputValue, FILTER_VALIDATE_FLOAT);

$arr = array('id' => $inputId, 'rows' => 6, 'style' => 'width: 100%;');
$html = $htmlObj->label(__('Gift for customer')). '</br>'
        .$htmlObj->textarea($inputName, $inputValue, $arr);
echo $htmlObj->pTag($html);

