<div>
	<p class="alert alert-info"><small><strong> *<?php _e("Note"); ?> </strong>You will be redirected to the Mobilpay.ro website to complete your payment.</small> </p>
</div>
<?php
$mobilpay_is_test = (get_option('mobilpay_testmode', 'payments')) == '1';
if($mobilpay_is_test == true and is_admin()) {
	print notif("You are using Mobilpay in test mode!");
}

//include(dirname(__DIR__).DS.'lib'.DS.'omnipay'.DS.'cc_form_fields.php');
