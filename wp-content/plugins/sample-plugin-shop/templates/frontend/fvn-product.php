<?php get_header() ?>
<style>
     #content {
        margin-right: 20px;
     }
</style>
<?php 
    global $post, $fvnController;

    $fvnController->getController('Product', DS.'frontend');
?>

<?php get_footer() ?>