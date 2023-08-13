/**
 * product_fe
 */
jQuery(document).ready(function ($) {
   $('.product_imgs ul.product-thumbs img').on('click', function (e) {
        const data_img = $(this).attr('data-img');
        $('.product_imgs img.firstImg').attr('src', data_img);
   })
});