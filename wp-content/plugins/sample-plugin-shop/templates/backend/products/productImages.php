<?php
global $fvnController;
$htmlObj = new FvnSetupHtml();

$controller = $fvnController->_data['controller'];
// Tạo nút btn
$inputId = $controller->create_id('button');
$inputName = $controller->create_id('button');
$inputValue = esc_attr__('Media Library image');
$arr = array('class' => 'button-secondary', 'id' => $inputId);
$options = array('type' => 'button');
$btnMedia = $htmlObj->pTag($htmlObj->button($inputName, $inputValue, $arr, $options));
echo $btnMedia;

?>

<div id="zendvn-sp-zsproduct-show-images">
   

    <div class="clr"></div>
</div>

<?php 
// Tạo phần tử chưa rotate 360
$inputId = $controller->create_id('picture');
$inputName = $controller->create_id('picture');
$inputValue = get_post_meta($post->ID, $controller->create_key('routate360'), true);
$arr = array('id' => $inputId, 'rows' => 6, 'cols' => 200);
$html = $htmlObj->label(__('Routate 360')) . '</br>'
    . $htmlObj->textarea($inputName, $inputValue, $arr);
echo $htmlObj->pTag($html);
?>