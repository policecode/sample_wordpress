<?php
if (!class_exists('FvnSetupHtml')) {
	class FvnSetupHtml{
		
		public function __construct($options = null){
	
		}
		public function btn_media_script($button_id,$input_id){
			$script = "<script>
							jQuery(document).ready(function($){
								$('#{$button_id}').fvnBtnMedia('{$input_id}');
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
			return '<label for="'.$attr["for"].'" class="'.$attr["class"].'">'.translate($val).'</label><br>';
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


?>