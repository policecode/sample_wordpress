<?php
global $fvnController, $fvn_sp_settings, $wp_query, $wpQuery, $post;

$modelManafacturer = $fvnController->getModel('ManafacturerFE');

$meta_key = '_fvn_sp_products_';

$session = $fvnController->getHelper('Session');

?>
<?php if (have_posts()) while (have_posts()) : the_post(); ?>

    <?php

    $manufacturer_id = get_post_meta(get_the_ID(), $meta_key . 'manufacturer', true);
    $result = $modelManafacturer->getItem(array('id' => $manufacturer_id));
    $manufacturer = $result['name'];

    $price = get_post_meta(get_the_ID(), $meta_key . 'price', true);
    $price = $price ? $price . ' ' . $fvn_sp_settings['currency_unit'] : null;
    $saleOff = get_post_meta(get_the_ID(), $meta_key . 'sale-off', true);
    if ($saleOff) {
        $saleOff = $saleOff . ' ' . $fvn_sp_settings['currency_unit'];
    }

    $gift = get_post_meta(get_the_ID(), $meta_key . 'gift', true);

    // Lấy danh sách hình ảnh
    $arrOrdering = get_post_meta(get_the_ID(), $meta_key . 'img-ordering', true);
    $arrPicture = get_post_meta(get_the_ID(), $meta_key . 'img-url', true);
    $newPicArray = array();
    foreach ($arrPicture as $key => $value) {
        $newPicArray[$value] = $arrOrdering[$key];
    }
    asort($newPicArray);
    $firstImg = key($newPicArray);

    $linkAddCart = site_url('?fvn-product=' . get_query_var('fvn-product') . '&action=add_cart&id=' . get_the_ID());
    ?>
    <div id="zendvn_sp_product_detail">
        <div class="product_imgs">
            <img class="firstImg" width="480px" height="320px" src="<?php echo $firstImg; ?>" alt="<?php the_title(); ?>">
            <ul class="product-thumbs">
                <?php
                $imgThumbnail = $fvnController->getHelper('ImageThumbnail');
                foreach ($newPicArray as $key => $val) {
                    $imgUrl = $imgThumbnail->resize($key, 80, 53);
                ?>
                    <li><img width="80px" height="53px" src="<?php echo $imgUrl; ?>" alt="" data-img="<?php echo $key; ?>">
                    </li>
                <?php
                }

                ?>

            </ul>
            <div class="clr"></div>
        </div>
        <div class="product_text">
            <ul>
                <li class="title">
                    <h1> <?php the_title(); ?> </h1>
                </li>
                <li class="manufacturer">Manufacturer: <?php echo $manufacturer; ?>
                </li>
                <li class="price" style="<?php echo $cssPrice; ?>">Price: <?php echo $price; ?></li>
                <li class="sale-off">Sale Off: <?php echo $saleOff; ?></li>
                <li class="gift">
                    <div>Gift:<?php echo $gift; ?></div>
                </li>
                <li><a id="add_to_cart" class="order" product-id="<?= get_the_ID() ?>" href="<?= $linkAddCart ?>">Đặt hàng</a></li>
                <li><a href="#" class="r360">Xoay hình 360 độ</a>
                </li>
                <li class="detail-cart">
                    <?php
                    /**
                     * Tính số lượng sản phẩm đang có trong giỏ hàng
                     */
                        $session = $fvnController->getHelper('Session');
                        $ssCart = $session->get('fvn-cart', array());
                        
                        $total_item = 0;
                        if (count($ssCart) > 0) {
                            foreach ($ssCart as $key => $value) {
                                $total_item += $value;
                            }
                        }
                        if ($total_item > 0) {
                            $str_item = $total_item.' products';
                        }
                    ?>
                    <div class="alert-cart">Your cart updated</div>
                    <div>
                        Currently, <span class="number_product"><?= $str_item?></span> in your
                        cart
                    </div>
                    <div>
                        View details of your cart <a href="#">click here</a>
                    </div>

                </li>
            </ul>
        </div>
        <div class="clr"></div>
    </div>
    <?php the_content(); ?>
<?php endwhile; ?>