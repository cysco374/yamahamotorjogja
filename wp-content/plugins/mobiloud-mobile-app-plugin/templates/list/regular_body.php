<?php
/**
 * This is a list template: regular_body.php.
 *
 * Is contain html layout for list: block for items, placeholders, loader.
 *
 * @package MobiLoud.
 * @subpackage MobiLoud/templates/list
 * @version 4.2.0
 */

?>
<ons-page id="load-more-page">

	<ons-pull-hook id="pull-hook">
	</ons-pull-hook>

	<ons-list id="article-list" class="article-list">

		<?php
		for ( $i = 0; $i < 8; $i++ ) {
			?>
			<ons-list-item class="article-list__article is-placeholder">
				<div class="center list-item__center">
					<div class="article-list__wrap">
						<figure class="article-list__thumb"></figure>
						<div class="article-list__content">
							<h2></h2>
							<p></p>
						</div>
					</div>
					<div class="article-list__meta">
						<a></a> <span class="author"></span>
					</div>
				</div>
			</ons-list-item>
			<?php
		}

		if ( function_exists( 'mobiloud_list_top' ) ) {
			mobiloud_list_top( $_GET ); // phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification -- no need in nonce here.
		}
		/**
		* Called at the end of placeholders block.
		*
		* @since 4.2.0
		*/
		do_action( 'mobiloud_list_end_of_placeholders' );
		?>

	</ons-list>

	<ons-progress-circular id="loading-more" indeterminate></ons-progress-circular>

</ons-page>
