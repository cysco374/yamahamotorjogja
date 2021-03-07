<!-- step 5 -->
<?php
$next_step = add_query_arg( [ 'tab' => 'welcome-close' ], remove_query_arg( [ 'step', 'tab' ] ) );
?>
<div class="ml2-block ml2-welcome-block welcome-step-5">
	<div class="ml2-body text-left">
		<form action="<?php echo esc_attr( $next_step ); ?>" method="post" class="contact-form">
			<?php wp_nonce_field( 'ml-form-design' ); // same nonce as Design tab uses. ?>
			<input type="hidden" name="step" value="5">
			<div class="ml-form-row">
				<label>Upload Your Logo</label>
				<input id="ml_preview_upload_image" type="text" size="36" name="ml_preview_upload_image"
					value="<?php echo esc_url( get_option( 'ml_preview_upload_image' ) ); ?>"/>
				<input id="ml_preview_upload_image_button" type="button" value="Upload Image" class="browser button"/>
			</div>
			<?php $logoPath = Mobiloud::get_option( 'ml_preview_upload_image' ); ?>
			<div
				class="ml-form-row ml-preview-upload-image-row" <?php echo ( strlen( $logoPath ) === 0 ) ? 'style="display:none;"' : ''; ?>>
				<div class='ml-preview-image-holder'>
					<img src='<?php echo esc_url( $logoPath ); ?>'/>
				</div>
				<a href='#' class='ml-preview-image-remove-btn'>Remove logo</a>
			</div>
			<div class="ml-form-row">
				<label>Navigation bar color</label>
				<input name="ml_preview_theme_color" id="ml_preview_theme_color" type="text"
					value="<?php echo esc_attr( get_option( 'ml_preview_theme_color' ) ); ?>"/>
			</div>
			<div class='ml-col-row ml-init-button'>
				<button type="submit" name="submit" id="submit" class="button button-hero button-primary ladda-button" data-style="zoom-out">Save and Finish</button>
			</div>
		</form>

	</div>
</div>
