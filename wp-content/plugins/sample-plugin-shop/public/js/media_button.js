/**
 * Xử lý bật cửa sổ popup chọn được nhiều hình ảnh
 */
jQuery(function () {
    $(document).ready(function () {
        // #fvn-sp-products-button: id của thẻ btn ta click
        $('#fvn-sp-products-button').click(open_media_window);
    });

    /**
     * Dùng để bật popup chọn hình ảnh bằng js
     */
    function open_media_window() {
        if (this.window == undefined) {
            this.window = wp.media({
                title: 'Thêm các hình ảnh cho sản phẩm', // Tiêu đề của popup
                library: {type: 'image'},
                multiple: true, //Có thể chọn nhiều hình ảnh một lúc
                button: {text: 'Thêm hình ảnh'} //Nút btn để thêm
            });
           var self = this;
            // có thay đổi mới chạy hàm này, lấy ra các obj hình ảnh
           this.window.on('select', function () {
                var imgs = self.window.state().get('selection').toJSON();
                // console.log(imgs);
                fvn_sp_insert_image('#zendvn-sp-zsproduct-show-images', imgs);
           })
        }
        this.window.open();
        return false;
    }

    /**
     * Hàm xử lý việc sau khi chọn hình ảnh thì ta thêm vào màn hình js
     * - #zendvn-sp-zsproduct-show-images: Thẻ bọc phần ta thêm hình ảnh bằng js
     */
    function fvn_sp_insert_image(img_content, imgs) {
        if ($(imgs).length > 0) {
            $.each(imgs, function (key, obj) {
                var imgUrl = obj.url;
                var newImg = `<div class="content-img">
                                <img src="${imgUrl}" height="100" width="100">
                                <div>
                                    <a class="remove-img">Remove</a>
                                </div>
                                <div class="div-ordering">
                                    <input value="" class="ordering" name="zendvn-sp-zsproduct-img-ordering[]" type="text"> 
                                    <input name="zendvn-sp-zsproduct-img-url[]" value="<?php echo $arrPicture[$i]; ?>" type="hidden">
                                </div>
                            </div>`;
                $(newImg).insertBefore(img_content + ' .clr');
            })
        }
    }
});