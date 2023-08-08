<?php
if (!class_exists('FvnSetupHtml')) {
	class FvnSetupHtml{
		
		public function __construct($options = null){
	
		}
		/**
		 * Xử lý việc bật popup chọn một hình ảnh và lấy đường dẫn
		 */
		public function btn_media_script($button_id,$input_id){
			
			// $script = '<script src="'.get_bloginfo('url').'/wp-includes/js/thickbox/thickbox.js"></script>';
			$script = "<script>
						jQuery(document).ready(function($){
						// Xử lý việc tránh trùng lặp khi thêm url với form editor
						var backupSendToEditor = window.send_to_editor;
						// click button_id để hiện popup
						$('#{$button_id}').click(() => {
							tb_show('', 'media-upload.php?type=image&TB_iframe=true');
							// Xử lý việc lấy link và đưa vào $input_id
							window.send_to_editor = function(html) {
								let imageUrl = $('img', html).attr('src');
								$('#{$input_id}').val(imageUrl);
								tb_remove();
								window.send_to_editor = backupSendToEditor;
							}
							return false;
						})
					});
				</script>";
			return $script;
		}
		//Phần tử p
		public function pTag($val = '', $attr = array(), $options = null){
			if (empty($attr['class'])) $attr['class'] = '';
			return '<p class="'.$attr['class'].'">'.$val.'</p>';
		}	
	
		//Phần tử Label
		public function label($val = '', $attr = array(), $options = null){
			if (empty($attr['class'])) $attr['class'] = '';
			if (empty($attr['for'])) $attr['for'] = '';
			return '<label for="'.$attr["for"].'" class="'.$attr["class"].'">'.translate($val).'</label>';
		}	
		
		//Phần tử TEXTBOX
		public function textbox($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlTextbox.php';		
			return HtmlTextbox::create($name, $value, $attr, $options);
		}	
		
		//Phần tử FILEUPLOAD
		public function fileupload($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlFileupload.php';
			return HtmlFileupload::create($name, $value, $attr, $options);
		}
		
		//Phần tử PASSWORD
		public function password($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlPassword.php';
			return HtmlPassword::create($name, $value, $attr, $options);
		}
		
		//Phần tử HIDDEN
		public function hidden($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlHidden.php';
			return HtmlHidden::create($name, $value, $attr, $options);
		}
	
		//Phần tử BUTTON - SUBMIT - RESET
		public function button($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlButton.php';
			return HtmlButton::create($name, $value, $attr, $options);
		}
		
		//Phần tử TEXTAREA
		public function textarea($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlTextarea.php';
			return HtmlTextarea::create($name, $value, $attr, $options);
		}
		
		//Phần tử RADIO
		public function radio($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlRadio.php';
			return HtmlRadio::create($name, $value, $attr, $options);
		}
		
		//Phần tử CHECKBOX
		public function checkbox($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlCheckbox.php';
			return HtmlCheckbox::create($name, $value, $attr, $options);
		}
			
		//Phần tử SELECTBOX
		public function selectbox($name = '', $value = '', $attr = array(), $options = null){
			require_once FVN_SP_INCLUDES_PATH . '/html/HtmlSelectbox.php';
			return HtmlSelectbox::create($name, $value, $attr, $options);
		}
		
	}
}
