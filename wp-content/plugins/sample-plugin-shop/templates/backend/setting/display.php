<?php
global $fvnController;
$lbl = __('Fvn Shopping Settings');
$option_name = 'fvn_sp_setting';

$htmlObj = new FvnSetupHtml();

$settingConfig = $fvnController->getConfig('Setting');
$data = get_option($option_name, array());
if (count($data) == 0 ) {
    $data = $settingConfig->get();
}
// Tạo phần tử chứa productNumber
$inputId = $option_name . '_product_number';
$inputName = $option_name . '[product_number]';
$inputValue = $data['product_number'];
$arr = array('size' => '20', 'id' => $inputId);
$productNumber = $htmlObj->textbox($inputName, $inputValue, $arr)
?>

<div class="wrap">
    <h2><?= $lbl; ?></h2>
    <form id="<?= $option_name ?>" name="<?= $option_name ?>" action="" method="post" enctype="multipart/form-data">
        <h3 class="title">
            <?= __('Show product in frontend') ?>
        </h3>
        <div class="fvn-sp-form-table">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="mailserver_url"><?= __('Product in a page') ?>:</label>
                        </th>
                        <td><?= $productNumber ?></td>
                    </tr>
                </tbody>
            </table>
        </div>


<?php
    // Tạo phần tử chứa curency
    $inputId = $option_name . '_currency_unit';
    $inputName = $option_name . '[currency_unit]';
    $inputValue = $data['currency_unit'];
    $arr = array('size' => '20', 'id' => $inputId);
    $currencyUnit = $htmlObj->textbox($inputName, $inputValue, $arr);

    // Tạo phần tử chứa payment
    $inputId = $option_name . '_payment';
    $inputName = $option_name . '[payment][]';
    $inputValue = $data['payment'];
    $arr = array('id' => $inputId, 'multiple' => 'multiple');
    $options['data'] = array(
        'send_mail' => __('Send Mail'),
        'paypal' => __('Paypal'),
        'vcb' => __('Vietcombank pay online'),
        'vietin' => __('Vietinbank pay online')
    );
    $payment = $htmlObj->selectbox($inputName, $inputValue, $arr, $options);
?>
        <h3 class="title">
            <?= __('Currency & Payment') ?>
        </h3>
        <div class="fvn-sp-form-table">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="mailserver_url"><?= __('Currency unit') ?>:</label>
                        </th>
                        <td><?= $currencyUnit ?></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="mailserver_url"><?= __('Method ò Payment') ?>:</label>
                        </th>
                        <td><?= $payment ?></td>
                    </tr>
                </tbody>
            </table>
        </div>


<?php
    // Tạo phần tử chứa alertToEmail
    $inputId = $option_name . '_alert_to_email';
    $inputName = $option_name . '[alert_to_email]';
    $inputValue = $data['alert_to_email'];
    $arr = array('size' => '20', 'id' => $inputId);
    $alertToEmail = $htmlObj->textbox($inputName, $inputValue, $arr);

    // Tạo phần tử chứa select
    $inputId = $option_name . '_select_type';
    $inputName = $option_name . '[select_type]';
    $inputValue = $data['select_type'];
    $arr = array('id' => $inputId);
    $options['data'] = array(
        'system' => __('System'),
        'fvnshopping' => __('Fvn Shopping')
    );
    $selectType = $htmlObj->selectbox($inputName, $inputValue, $arr, $options);

    //Tao phan tu chua $emailAddress
    $inputID 		= $option_name . '_email_address';
    $inputName 		= $option_name . '[email_address]';
    $inputValue 	= $data['email_address'];
    $arr 			= array('size' =>'25','id' => $inputID);
    $emailAddress	= $htmlObj->textbox($inputName,$inputValue,$arr);
    
    
    //Tao phan tu chua $fromName
    $inputID 	= $option_name . '_from_name';
    $inputName 	= $option_name . '[from_name]';
    $inputValue = $data['from_name'];
    $arr 		= array('size' =>'25','id' => $inputID);
    $fromName	= $htmlObj->textbox($inputName,$inputValue,$arr);
    
    //Tao phan tu chua $smtpHost
    $inputID 	= $option_name . '_smtp_host';
    $inputName 	= $option_name . '[smtp_host]';
    $inputValue = $data['smtp_host'];
    $arr 		= array('size' =>'25','id' => $inputID);
    $smtpHost	= $htmlObj->textbox($inputName,$inputValue,$arr);
    
    //Tao phan tu chua $smtpHost
    $inputID 	= $option_name . '_encription';
    $inputName 	= $option_name . '[encription]';
    $inputValue = $data['encription'];
    $options	= array('data' => array('none'=> 'None','ssl'=>'SSL','tls'=>'TLS'),
                    'separator' => ' ');
    $arr 		= array('size' =>'25','id' => $inputID);
    $encription	= $htmlObj->radio($inputName,$inputValue,$arr,$options);
    
    //Tao phan tu chua $smptPort
    $inputID 	= $option_name . '_smpt_port';
    $inputName 	= $option_name . '[smpt_port]';
    $inputValue = $data['smpt_port'];
    $arr 		= array('size' =>'25','id' => $inputID);
    $smptPort	= $htmlObj->textbox($inputName,$inputValue,$arr);
    
    //Tao phan tu chua $smtpAuth
    $inputID 	= $option_name . '_smtp_auth';
    $inputName 	= $option_name . '[smtp_auth]';
    $inputValue = $data['smtp_auth'];
    $options	= array('data' => array('no'=> 'No','yes'=>'Yes'),
                        'separator' => ' ');
    $arr 		= array('size' =>'25','id' => $inputID);
    $smtpAuth	= $htmlObj->radio($inputName,$inputValue,$arr,$options);
    
    //Tao phan tu chua $smtpAuth
    $inputID 	= $option_name . '_smtp_password';
    $inputName 	= $option_name . '[smtp_password]';
    $inputValue = $data['smtp_password'];
    $arr 		= array('size' =>'25','id' => $inputID);
    $smtpPassword	= $htmlObj->textbox($inputName,$inputValue,$arr);
    
    //Tao phan tu chua $smtpAuth
    $inputID 	= $option_name . '_smtp_username';
    $inputName 	= $option_name . '[smtp_username]';
    $inputValue = $data['smtp_username'];
    $arr 		= array('size' =>'25','id' => $inputID);
    $smtpUsername	= $htmlObj->password($inputName,$inputValue,$arr);
?>
<!--Send mail -->
<h3 class="title">
			<?php echo __('Email configs')?>
		</h3>
		<div class="zendvn-sp-form-table">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('Alert to email')?> : </label>
					</th>
					<td><?php echo $alertToEmail;?></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('Select email type')?> : </label>
					</th>
					<td><?php echo $selectType;?></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('From Email Address')?> : </label>
					</th>
					<td><?php echo $emailAddress;?></td>
				</tr>
				
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('From Name')?> : </label>
					</th>
					<td><?php echo $fromName;?></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('SMTP Host')?> : </label>
					</th>
					<td><?php echo $smtpHost;?></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('Type of Encription')?> : </label>
					</th>
					<td><?php echo $encription;?></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('SMTP Port')?> : </label>
					</th>
					<td><?php echo $smptPort;?></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('SMTP Authentication')?> : </label>
					</th>
					<td><?php echo $smtpAuth;?></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('SMTP password')?> : </label>
					</th>
					<td><?php echo $smtpPassword;?></td>
				</tr>
				
				<tr>
					<th scope="row">
						<label for="mailserver_url"><?php echo __('SMTP username')?> : </label>
					</th>
					<td><?php echo $smtpUsername;?></td>
				</tr>
			</tbody>
			
		</table>
		</div>
		<!--Send mail - End -->
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
    </form>
</div>