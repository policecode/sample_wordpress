<?php
class Fvn_Sp_ImageThumbnail_Helper {
    public function __construct()
    {
        
    }

    /**
     * - Phương thức lấy hình ảnh thumnail của bài viết
     * $options['type'] = original - thumbnail - resize
     * - original: Hình ảnh gốc
     * - thumbnail: Hình ảnh hệ thống tạo cho
     * - resize: Đưa kích thước hình ảnh cần cắt
     * $options['width'] - $options['height'] === $options['type']=resize
     */
    public function getImage($postID=0, $options =array()) {
        $img = '';
        if ($postID > 0) {
            $imgType = !isset($options['type']) ? 'thumbnail':$options['type'];
            $thumbnail_id = get_post_thumbnail_id($postID);
            if ($imgType == 'thumbnail') {
                $image = wp_get_attachment_image_src($thumbnail_id);
                if (is_array($image)) $img = $image[0];
            } else if ($imgType == 'original') {
                $image = wp_get_attachment_image_src($thumbnail_id, 'single-post-thumbnail');
                if (is_array($image)) $img = $image[0];
            } else if($imgType == 'resize') {
                $image = wp_get_attachment_image_src($thumbnail_id, 'single-post-thumbnail');
                if (is_array($image)) {
                    $img = $this->resize($image[0], $options['width'], $options['height']);
                };

            }
        }
        return $img;
    }

    /**
     * Phương thức tạo hình ảnh mới với kích thước cho trước
     */
    public function resize($imgURL = null, $width = 0, $height = 0) {
        $tmp = explode('/wp-content/', $imgURL);
        // Lấy đường dẫn tuyệt đối
        $imgDir = ABSPATH.'wp-content/'.$tmp[1];
        // Lấy ra tên hình ảnh hiện thời
        preg_match("/[^\/|\\\]+$/", $imgURL, $currentName);
        $currentName = $currentName[0];
        // Tạo đường dẫn lưu hành ảnh
        $storeFolder = FVN_SP_PUBLIC_PATH.DS.'resize'.DS.'p'.$width.'x'.$height.DS;
        if (!file_exists($storeFolder)) {
            mkdir($storeFolder, 0755);
        }
        $newImgPath = $storeFolder.$currentName;
        if (!file_exists($newImgPath)) {
            $wpImageEditor = wp_get_image_editor($imgDir);
            if (!is_wp_error($wpImageEditor)) {
                $wpImageEditor->resize($width, $height, array('center', 'center'));
                $wpImageEditor->save($newImgPath);
            }
        }
        // Trả về đường dẫn url
        $newImageUrl = FVN_SP_RESIZE_URL.'/p'.$width.'x'.$height.'/'.$currentName;
        return $newImageUrl;
    }
}