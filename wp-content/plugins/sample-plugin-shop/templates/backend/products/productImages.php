<?php
global $fvnController, $post;
$htmlObj = new FvnSetupHtml();
$controller = $fvnController->_data['controller'];

// Tạo nút btn
$inputId = $controller->create_id('button');
$inputName = $controller->create_key('button');
$inputValue = esc_attr__('Media Library image');
$arr = array('class' => 'button-secondary', 'id' => $inputId);
$options = array('type' => 'button');
$btnMedia = $htmlObj->pTag($htmlObj->button($inputName, $inputValue, $arr, $options));
echo $btnMedia;


$arrOrdering = get_post_meta($post->ID, $controller->create_key('img-ordering'), true);
$arrPicture = get_post_meta($post->ID, $controller->create_key('img-url'), true);
?>

<div id="zendvn-sp-zsproduct-show-images">
    <?php if (is_array($arrPicture) && count($arrPicture) > 0) :
        for ($i = 0; $i < count($arrPicture); $i++) : ?>
            <div class="content-img">
                <img src="<?= $arrPicture[$i]; ?>" height="100" width="100">
                <div>
                    <a class="remove-img">Remove</a>
                </div>
                <div class="div-ordering">
                    <input value="<?= $arrOrdering[$i]; ?>" class="ordering" name="_fvn_sp_products_img-ordering[]" type="text">
                    <input name="_fvn_sp_products_img-url[]" value="<?= $arrPicture[$i];?>" type="hidden">
                </div>
            </div>

    <?php endfor; endif; ?>

    <div class="clr"></div>
</div>

<?php
// Tạo phần tử chưa rotate 360
$inputId = $controller->create_id('routate360');
$inputName = $controller->create_key('routate360');
$inputValue = get_post_meta($post->ID, $controller->create_key('routate360'), true);
$arr = array('id' => $inputId, 'rows' => 6, 'style' => 'width: 100%;');
$html = $htmlObj->label(__('Routate 360')) . '</br>'
    . $htmlObj->textarea($inputName, $inputValue, $arr);
echo $htmlObj->pTag($html);
?>