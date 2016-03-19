<script>
	$(document).ready(function ()
	{
		$("#mobilpay_public_certificate_form").submit(function (event)
		{
			event.preventDefault();
			var data = $(this).serialize();
			var url = "<?php print api_url( 'mobilpay_up_cert' ); ?>";
			$.ajax({
				type:'POST',
				url: url,
				data: new FormData(this),
				cache: false,
				contentType: false,
				processData: false,
				success:function(data) {
					objData = jQuery.parseJSON( data );
					if (objData.status == 'success') {
						mw.reload_module_parent("shop/payments");

						$("#mobilpay_public_certificate_error").html('');
						$("#mobilpay_public_certificate_success").html(objData.message);
						$("#mobilpay_public_certificate_file").html(objData.filename);
					} else {
						$("#mobilpay_public_certificate_success").html('');
						$("#mobilpay_public_certificate_error").html(objData.message);
					}
				},
				error: function(data) {
				}
			});

		});

		$("#mobilpay_private_key_form").submit(function (event)
		{
			event.preventDefault();
			var data = $(this).serialize();
			var url = "<?php print api_url( 'mobilpay_up_key' ); ?>";
			$.ajax({
				type:'POST',
				url: url,
				data: new FormData(this),
				cache: false,
				contentType: false,
				processData: false,
				success:function(data) {
					objData = jQuery.parseJSON( data );
					if (objData.status == 'success') {
						mw.reload_module_parent("shop/payments");

						$("#mobilpay_private_key_error").html('');
						$("#mobilpay_private_key_success").html(objData.message);
						$("#mobilpay_private_key_file").html(objData.filename);
					} else {
						$("#mobilpay_private_key_success").html('');
						$("#mobilpay_private_key_error").html(objData.message);
					}
				},
				error: function(data) {
				}
			});

		});
	});
</script>

<?php only_admin_access(); ?>

<?php
$mobilpay_public_certificate = json_decode(get_option( 'mobilpay_public_certificate', 'payments' ));
$mobilpay_private_key = json_decode(get_option( 'mobilpay_private_key', 'payments' ));
?>


<label class="mw-ui-label">Identificator cont comerciant: </label>

<input type="text" class="mw-ui-field mw_option_field" name="mobilpay_merchantid"
       placeholder="" data-option-group="payments"
       value="<?php print get_option( 'mobilpay_merchantid', 'payments' ); ?>">

<form id="mobilpay_public_certificate_form" method="post" enctype="multipart/form-data">
	<label class="mw-ui-label">Public certificate: </label>
	<div id="mobilpay_public_certificate_error" style="color: #FF0301"></div>
	<div id="mobilpay_public_certificate_success" style="color: #006a24"></div>
	<div id="mobilpay_public_certificate_file"><?php  echo isset($mobilpay_public_certificate->filename) ?  $mobilpay_public_certificate->filename : ''; ?></div>
	<br/>
	<input type="file" class="mw-ui-field" name="mobilpay_public_certificate" id="mobilpay_public_certificate">

	<input type="submit" name="submit" value="Save" class="mw-ui-btn"/>
</form>


<form id="mobilpay_private_key_form" method="post" enctype="multipart/form-data">
	<label class="mw-ui-label">Private key: </label>
	<div id="mobilpay_private_key_error" style="color: #FF0301"></div>
	<div id="mobilpay_private_key_success" style="color: #006a24"></div>
	<div id="mobilpay_private_key_file"><?php  echo isset($mobilpay_private_key->filename) ?  $mobilpay_private_key->filename : ''; ?></div>
	<br/>
	<input type="file" class="mw-ui-field" name="mobilpay_private_key" id="mobilpay_private_key">

	<input type="submit" name="submit" value="Save" class="mw-ui-btn"/>
</form>


<ul class="mw-ui-inline-list">
	<li><label class="mw-ui-label"><?php _e( "Test mode" ); ?>:</label></li>

	<li><label class="mw-ui-check">
			<input name="mobilpay_testmode" class="mw_option_field" data-option-group="payments" value="1" type="radio" <?php if ( get_option( 'mobilpay_testmode', 'payments' ) == 1 ): ?> checked="checked" <?php endif; ?> >
			<span></span><span><?php _e( "Yes" ); ?></span></label></li>

	<li><label class="mw-ui-check">
			<input name="mobilpay_testmode" class="mw_option_field" data-option-group="payments" value="0" type="radio" <?php if ( get_option( 'mobilpay_testmode', 'payments' ) != 1 ): ?> checked="checked" <?php endif; ?> >
			<span></span><span><?php _e( "No" ); ?></span></label></li>
</ul>




