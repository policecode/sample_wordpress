<?php 
global $fvnController, $fvn_sp_settings, $wp_query, $wpQuery;

?>

<?php if (have_posts()) while(have_posts()): the_post();?>
<h1 class="entry-title"><?php the_title() ?></h1>
<div class="entry-content">
    <p> <?php the_content() ?> </p>

    <?php 
    /**
     * Lấy list sản phẩm
     */
        $modelProduct = $fvnController->getModel('Products');
        $imageHelper = $fvnController->getHelper('ImageThumbnail');
        $product_query = $modelProduct->getAllProduct();
        $wpQuery = $product_query;
    ?>
    <ul id="zendvn_sp_products">
        <?php 
            while($product_query->have_posts()): $product_query->the_post(); 
            $title = get_the_title();
            // $thumnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $thumnail_url = $imageHelper->getImage(get_the_ID());
            $meta_key = '_fvn_sp_products_';
            // Giá
            $price = get_post_meta(get_the_ID(), $meta_key.'price', true);
            $price = $price ? $price.' '.$fvn_sp_settings['currency_unit']:null;
            $sale_off = get_post_meta(get_the_ID(), $meta_key.'sale-off', true);
            if ($sale_off) {
                $sale_off = $sale_off.' '.$fvn_sp_settings['currency_unit'];
            } else {
                $sale_off = $price;
                $price = null;
            }
            // Quà tặng
            $gilf = get_post_meta(get_the_ID(), $meta_key.'gift', true);
            // Link
            $linkProduct = get_permalink();
        ?>
        <li>
            <div class="product">
                <a href="<?= $linkProduct;?>">
                    <img src="<?= $thumnail_url;?>" alt="">
                    <div class="name"><?= $title ?></div>
                </a>
                <div class="price">
                    <span class="plft" style="text-decoration: line-through;"><?= $price ?></span>
                    <span class="plft"><?= $sale_off ?></span>

                </div>
                <div class="gift clr"><?= $gilf ?></div>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
    <div class="clr"></div>
</div>

<?php endwhile; ?>
<?php 
$fvnController->getView('paging', DS.'frontend');
?>

