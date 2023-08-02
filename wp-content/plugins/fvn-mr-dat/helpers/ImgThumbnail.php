<?php
class Fvn_Sp_ImgThumbnail_Helper {
    public function __construct() {
        
    }

    /**
     * $options['type']: original - thumbnail - resize
     * $options['type'] = resize => $options['width'] & $options['height']
     */
    public function get_image($post_id = 0, $options = array()) {
        global $fvnController;
        $img = $fvnController->get_image_url('No-Image-Placeholder.svg.png');;
        if ($post_id > 0) {
            $imgType = (!isset($options['type']))? 'thumbnail' : $options['type'];
            $thumbnail_id = get_post_thumbnail_id($post_id);
            if ($imgType == 'thumbnail') {
                $image = wp_get_attachment_image_src( $thumbnail_id);
                if (is_array($image)) $img = $image[0];
            } else if($imgType == 'original') {
                $image = wp_get_attachment_image_src( $thumbnail_id, 'single-post-thumbnail');
                if (is_array($image)) $img = $image[0];
            } else if($imgType == 'resize') {
                $image = wp_get_attachment_image_src( $thumbnail_id, 'single-post-thumbnail');
                if (!is_array($image)){
                    return $img;
                } else {
                    $img = $this->resize($image[0], $options['width'], $options['height']);
                }
            }
        }
        return $img;
    }

    public function resize($imgURL = null, $width = 0, $height = 0) {
        // http://localhost/wordpress/booking-bus/wp-content/uploads/2023/03/dien-thoai-chinh-hang-1.jpeg
        $tmp = explode('/wp-content/', $imgURL);
        // Đường dẫn tuyệt đối tới ảnh gốc
        $imgDir = ABSPATH.'wp-content/'.$tmp[1];
        // Lấy ra tên của hình ảnh hiện thời
        preg_match("/[^\/|\\\]+$/", $imgURL, $currentName);
        $currentName = $currentName[0];
        // Tạo Đường dẫn tuyệt đối thư mục ảnh mới cùng kích cỡ FVN_IMAGE_PATH
        $storeFolder = FVN_IMAGE_PATH.'resize'.DS.'p'.$width.'x'.$height;
        if (!file_exists($storeFolder)) {
            // Nếu chưa tồn tại thư mục sẽ được tạo mới
            mkdir($storeFolder, 0755); //CMOD
        }
        // Đường dẫn tuyệt đối tới ảnh mới
        $newImgPath =  $storeFolder.DS.$currentName;
        if (!file_exists($newImgPath)) {
            // Nếu ảnh mới chưa được tạo sẽ được thực hiện  trong này bằng đối tượng wp_get_image_editor()
            $wpImageEditor = wp_get_image_editor($imgDir);
            if (!is_wp_error($wpImageEditor)) {
                $wpImageEditor->resize($width, $height, array('center', 'center'));
                $wpImageEditor->save($newImgPath);
            }
        }
        // Lấy đường dẫn url tới ảnh mới
        $newImageUrl = FVN_PLUGIN_IMAGE_URL.'resize'.DS.'p'.$width.'x'.$height.'/'.$currentName;

        return $newImageUrl;
    }
}