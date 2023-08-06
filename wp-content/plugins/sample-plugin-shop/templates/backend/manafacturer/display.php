<?php
global $fvnController;
/**
 * Gọi Model để tạo bảng
 */
$tblManafacturer = $fvnController->getModel('Manafacturer');
$tblManafacturer->prepare_items();

$lbl = 'Manafacturer List';

$page = $fvnController->getParams('page');

$linkAdd = admin_url('admin.php?page='.$page.'&action=add');
$lblAdd = 'Manafacturer Add';

if ($fvnController->getParams('msg') == 1) {
    $msg = '<div class="updated"><p>Update Finish</p></div>';
}
?>

<div class="wrap">
    <h2><?= esc_html($lbl); ?></h2>
    <p>
        <a href="<?= esc_html($linkAdd); ?>" class="add-new-h2"><?= esc_html($lblAdd); ?></a>
    </p>
    <?= $msg; ?>
    <form action="" method="post" name="<?= $page; ?>" id="<?= $page; ?>">
        <?php $tblManafacturer->search_box('search', 'search_id'); ?>
        <?php $tblManafacturer->display(); ?>
    </form>
</div>

