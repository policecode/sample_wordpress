<?php
global $fvnController;

$msg = '';
if (count($fvnController->_errors) > 0) {
    $msg .= '<div class="error"><ul>';
    foreach ($fvnController->_errors as $key => $val) {
        $msg .= '<li>'.$val.'</li>';
    }
    $msg .= '</ul> </div>';

}
$htmlObj = new FvnSetupHtml();

$page = $fvnController->getParams('page');

$action = ($fvnController->getParams('action') != '')?$fvnController->getParams('action'):'add';

$lbl = __('Add new a Manufacturer');

$vName = sanitize_text_field($fvnController->_data['name']);
$name = $htmlObj->textbox('name', @$vName, array('class' => 'regular-text'));

$vSlug = sanitize_title($fvnController->_data['slug']);
$slug = $htmlObj->textbox('slug', @$vSlug, array('class' => 'regular-text'));

$options['data'] = array('Inactive', 'Active');
$vStatus = absint($fvnController->_data['status']);
$status = $htmlObj->selectbox('status', @$vStatus, array('class' => 'regular-text'), $options);

?>

<div class="wrap">
    <h2><?= esc_html($lbl); ?></h2>
    <?= $msg; ?>
    <form action="" method="post" id="<?= $page?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?=$action ?>">
        <?php wp_nonce_field($action, 'security_code', true) ?>
        <h3>Information</h3>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for=""><?= __('Manufacturer name').':'?></label>
                    </th>
                    <td><?= $name;?></td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th scope="row">
                        <label for=""><?= __('Slug').':'?></label>
                    </th>
                    <td><?= $slug;?></td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th scope="row">
                        <label for=""><?= __('Status').':'?></label>
                    </th>
                    <td><?= $status;?></td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th scope="row"></th>
                    <td><input type="submit" value="Save" class="button button-primary button-large"></td>
                </tr>
            </tbody>
            
        </table>
    </form>
</div>
