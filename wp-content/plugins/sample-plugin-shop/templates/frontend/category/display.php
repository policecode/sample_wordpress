<?php 
global $fvnController, $fvn_sp_settings, $wp_query, $wpQuery;

// Thay đổi lại câu truy vấn mặc định của trang cat - phần lấy số lượng phần tử
$args = $wp_query->query;
$args['posts_per_page'] = $fvn_sp_settings['product_number'];
$wp_query->query($args);

$imageHelper = $fvnController->getHelper('ImageThumbnail');
$wpQuery = $wp_query;
?>

<?php if (have_posts()):?>
<h1 class="entry-title"><?php single_cat_title() ?></h1>
<div class="entry-content">
    <p> <?= category_description() ?> </p>
    
    <ul id="zendvn_sp_products">
        <?php 
            while(have_posts()): the_post(); 
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
    <?php wp_reset_postdata();?>
    <div class="clr"></div>
</div>

<?php endif; ?>
<?php 
$fvnController->getView('paging', DS.'frontend');
?>

