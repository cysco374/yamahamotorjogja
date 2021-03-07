<?php ini_set( 'display_errors', E_ALL ); ?>
<?php wp_nonce_field( 'tab_menu_config', 'ml_nonce' ); ?>
<?php wp_nonce_field( 'load_ajax', 'ml_nonce_load_ajax' ); ?>
<div class="ml2-block app-v2-only-feature">
	<div class="ml2-header"><h2>Menu Structure</h2></div>
	<div class="ml2-body">

		<div class='ml-col-row'>

			<div class='ml-col-row'>

				<?php
				// Get all registered nav menus.
				$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
				?>

				<h4>Hamburger Navigation</h4>
				<div class="ml-form-row">
					<p>Select a WordPress menu to use for the App's hamburger navigation</p>
					<select name="ml-hamburger-nav" class="ml-select">
						<option value="">Select Menu</option>
						<?php
						foreach ( $menus as $menu ) {
							$selected = '';
							if ( Mobiloud::get_option( 'ml_hamburger_nav' ) == $menu->slug ) {
								$selected = 'selected="selected"';
							}
							echo "<option value='" . esc_attr( $menu->slug ) . "' " . esc_attr( $selected ) . '>' . esc_html( $menu->name ) . '</option>';
						}
						?>
					</select>
				</div>

				<h4 class="item-horizontal-navigation" <?php echo Mobiloud::get_option( 'ml_tabbed_navigation_enabled' ) ? ' style="display:none;"' : ''; ?>>Horizontal Navigation</h4>
				<div class="ml-form-row item-horizontal-navigation" <?php echo Mobiloud::get_option( 'ml_tabbed_navigation_enabled' ) ? ' style="display:none;"' : ''; ?>>
					<p>Select a WordPress menu to use for the App's horizontal navigation</p>
					<select name="ml-horizontal-nav" class="ml-select">
						<option value="">Select Menu</option>
						<?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); ?>
						<?php
						foreach ( $menus as $menu ) {
							$selected = '';
							if ( Mobiloud::get_option( 'ml_horizontal_nav' ) == $menu->slug ) {
								$selected = 'selected="selected"';
							}
							echo "<option value='" . esc_attr( $menu->slug ) . "' " . esc_attr( $selected ) . '>' . esc_html( $menu->name ) . '</option>';
						}
						?>
					</select>
				</div>

				<h4>Sections Menu</h4>
				<div class="ml-form-row">
					<p>Select a WordPress menu to use the App's Sections menu</p>
					<select name="ml-sections-menu" class="ml-select">
						<option value="">Select Menu</option>
						<?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); ?>
						<?php
						foreach ( $menus as $menu ) {
							$selected = '';
							if ( Mobiloud::get_option( 'ml_sections_menu' ) == $menu->slug ) {
								$selected = 'selected="selected"';
							}
							echo "<option value='" . esc_attr( $menu->slug ) . "' " . esc_attr( $selected ) . '>' . esc_html( $menu->name ) . '</option>';
						}
						?>
					</select>
				</div>

				<?php
				/*
				* Custom menu selectors for extensions
				*/
				do_action( 'ml-menu-form-section' );

				?>

				<h4>Tabbed Navigation</h4>

				<?php
				$tn_data = Mobiloud::get_option( 'ml_tabbed_navigation', [] );
				?>

				<div class="ml-form-row">
					<div class="ml-form-row ml-checkbox-wrap">
						<input type="checkbox" id="ml_tabbed_navigation_enabled" name="ml_tabbed_navigation_enabled"
							value="true" <?php echo Mobiloud::get_option( 'ml_tabbed_navigation_enabled' ) ? 'checked' : ''; ?> />
						<label for="ml_tabbed_navigation_enabled">Enabled</label>
					</div>

					<div id="tabbed_navigation_settings" <?php echo Mobiloud::get_option( 'ml_tabbed_navigation_enabled' ) ? 'class="active"' : ''; ?>>

						<div class="ml-form-row tab-color">
							<label>Active Icon Color</label>
							<input class="color-picker" value="<?php echo esc_attr( $tn_data['active_icon_color'] ); ?>" name="ml_tabbed_navigation[active_icon_color]" type="text" />
						</div>

						<div class="ml-form-row tab-color">
							<label>Inactive Icon Color</label>
							<input class="color-picker" value="<?php echo esc_attr( $tn_data['inactive_icon_color'] ); ?>" name="ml_tabbed_navigation[inactive_icon_color]" type="text" />
						</div>

						<div class="ml-form-row tab-color">
							<label>Tab Background Color</label>
							<input class="color-picker" value="<?php echo esc_attr( $tn_data['background_color'] ); ?>" name="ml_tabbed_navigation[background_color]" type="text" />
						</div>

						<br/> <br/>

						<small>Drag items to reorder</small>
						<h2 class="nav-tab-wrapper" id="ml-tabnav-tabs">

							<?php
							$ml_tabnav_tabs = $tn_data['tabs'];
							$count          = 0;
							foreach ( $ml_tabnav_tabs as $tab ) {
								?>
								<a id="<?php echo esc_attr( "tabnav-tab-$count" ); ?>" href="<?php echo esc_attr( "#tabnav-$count" ); ?>" class="nav-tab <?php echo ( $count == 0 ) ? 'nav-tab-active' : ''; ?>">
									<div><?php echo esc_html( $tab['label'] ); ?></div>
								</a>
								<?php
								$count++;
							}
							?>
						</h2>

						<input type="hidden" name="ml_tabbed_navigation[taborder]" id="ml-tabnav-order" value="0,1,2,3,4" />

						<div id="ml-navtab-contents">
							<?php
							$tab_types = array(
								'homescreen',
								'list',
								'link',
								'favorites',
								'settings',
								'sections',
							);
							$count     = 0;
							foreach ( $ml_tabnav_tabs as $tab ) {
								?>

								<div class="tabnav-content <?php echo ( $count == 0 ) ? 'active' : ''; ?>" id="tabnav-<?php echo intval( $count ); ?>" style="background-color: <?php echo esc_attr( $tab['webview_background_color'] ); ?>">
									<div class="ml-form-row ml-checkbox-wrap">
										<label>
											<input type="checkbox" name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][enabled]"
												value="1" <?php echo ( $tab['enabled'] == '1' ) ? 'checked' : ''; ?> />
											Enabled
										</label>
									</div>
									<div class="ml-form-row">
										<label>Label</label>
										<input type="text" class="ml-tab-label" name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][label]" value="<?php echo esc_attr( $tab['label'] ); ?>" />
									</div>

									<div class="ml-form-row ml-iconbox">
										<label>Tab Icon</label>
										<input class="ml-tab-icon-url icon-input" value="<?php echo esc_attr( $tab['icon_url'] ); ?>" name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][icon_url]" type="text" />
										<button type="button" class="browser button icon-default">Pick from Library</button>
										<button type="button" class="browser button icon-load">Upload icon</button>

										<div class="icon-line">
											<div class="icon-wrap"><img src="" class="icon-view" /></div>
											<button type="button" class="browser button icon-clean">Remove icon</button>
										</div>
									</div>

									<div class="ml-form-row">
										<label>Tab type</label>
										<select class="ml-tab-type" name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][type]">
											<?php
											foreach ( $tab_types as $type ) {
												echo '<option value="' . esc_attr( $type ) . '" ' . selected( $tab['type'], $type, false ) . '>' . esc_html( $type ) . '</option>';
											}
											?>
										</select>
									</div>

									<div class="ml-form-row ml-tabnav-conditional show-list">
										<label>Taxonomy type</label>

										<select name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][taxonomy_type]" class="ml-select ml-select-taxonomy-ajax">
											<?php $taxes = get_taxonomies( array( 'public' => true ) ); ?>
											<?php
											foreach ( $taxes as $tax ) {
												echo "<option value='" . esc_attr( $tax ) . "' " . selected( isset( $tab['taxonomy_type'] ) && ( $tab['taxonomy_type'] == $tax ), true, false ) . '>' . esc_html( $tax ) . '</option>';
											}
											?>
										</select>
									</div>

									<div class="ml-form-row ml-tabnav-conditional show-list">
										<label>Taxonomy term</label>

										<select name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][taxonomy_id]" class="ml-select ml-select-terms-ajax">
											<?php
											if ( ! isset( $tab['taxonomy_type'] ) ) {
												$tab['taxonomy_type'] = 'category';
											}
											$terms = get_terms(
												array(
													'taxonomy' => $tab['taxonomy_type'],
													'hide_empty' => true,
													'hierarchical' => false,
												)
											);

											foreach ( $terms as $term ) {
												echo "<option value='" . esc_attr( $term->term_id ) . "' " . selected( isset( $tab['taxonomy_id'] ) && ( $tab['taxonomy_id'] == $term->term_id ), true, false ) . '>' . esc_html( $term->name ) . '</option>';
											}
											?>
										</select>
									</div>

									<div class="ml-form-row ml-tabnav-conditional show-list">
										<label>Taxonomy Order</label>
										<select name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][taxonomy_order]" class="ml-select">
											<option value="ASC" <?php echo ( isset( $tab['taxonomy_order'] ) && ( $tab['taxonomy_order'] == 'ASC' ) ) ? 'selected' : ''; ?>>ASC</option>
											<option value="DESC" <?php echo ( isset( $tab['taxonomy_order'] ) && ( $tab['taxonomy_order'] == 'DESC' ) ) ? 'selected' : ''; ?>>DESC</option>
										</select>
									</div>

									<div class="ml-form-row ml-tabnav-conditional show-list">
										<label>Taxonomy Order BY</label>
										<select name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][taxonomy_orderby]" class="ml-select">
											<option value="date" <?php echo ( isset( $tab['taxonomy_orderby'] ) && ( $tab['taxonomy_orderby'] == 'date' ) ) ? 'selected' : ''; ?>>Date</option>
											<option value="name" <?php echo ( isset( $tab['taxonomy_orderby'] ) && ( $tab['taxonomy_orderby'] == 'name' ) ) ? 'selected' : ''; ?>>Name</option>
										</select>
									</div>

									<div class="ml-form-row ml-tabnav-conditional show-link">
										<label>URL</label>
										<input value="<?php echo esc_attr( $tab['url'] ); ?>" name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][url]" type="text" />
									</div>

									<div class="ml-form-row ml-tabnav-conditional show-list show-link show-sections show-homescreen">
										<label>Horizontal Navigation</label>

										<select name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][horizontal_navigation]" class="ml-select">
											<option value="">Select Menu</option>
											<?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); ?>
											<?php
											foreach ( $menus as $menu ) {
												echo "<option value='" . esc_attr( $menu->slug ) . "' " . selected( $tab['horizontal_navigation'], $menu->slug, false ) . '>' . esc_html( $menu->name ) . '</option>';
											}
											?>
										</select>
									</div>

									<div class="ml-form-row ml-tabnav-conditional show-list show-link show-sections show-homescreen">
										<label>First Item Label</label>
										<input value="<?php echo esc_attr( $tab['first_item_label'] ); ?>" name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][first_item_label]" type="text" />
									</div>

									<div class="ml-form-row">
										<label>Webview Background Color</label>
										<input class="color-picker" value="<?php echo esc_attr( $tab['webview_background_color'] ); ?>" name="ml_tabbed_navigation[tabs][<?php echo intval( $count ); ?>][webview_background_color]" type="text" />
									</div>

								</div>

								<?php
								$count++;
							}
							?>


						</div>

					</div>

				</div>
			</div>


			<h3>Settings screen configuration</h3>

			<div class='ml-col-row'>
				<h4>Push notifications</h4>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_push_notification_settings_enabled" name="ml_push_notification_settings_enabled"
						value="true" <?php echo ( Mobiloud::get_option( 'ml_push_notification_settings_enabled', '0' ) === '1' ) ? 'checked' : ''; ?>/>
					<label for="ml_push_notification_settings_enabled">Enable Push Notification Settings</label>
				</div>

				<?php
				// Get all registered nav menus.
				$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
				?>

				<div class="ml-form-row">
					<p>Select a WordPress menu to use for Push Notification Categories</p>
					<select name="ml_push_notification_menu" class="ml-select">
						<option value="">Select Menu</option>
						<?php
						$selected_option = Mobiloud::get_option( 'ml_push_notification_menu', '' );
						foreach ( $menus as $ml_menu ) {
							$selected = '';
							if ( $selected_option === $ml_menu->slug ) {
								$selected = 'selected="selected"';
							}
							echo "<option value='" . esc_attr( $ml_menu->slug ) . "' " . esc_attr( $selected ) . '>' . esc_html( $ml_menu->name ) . '</option>';
						}
						?>
					</select>
				</div>

				<h4>General Settings</h4>
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_general_settings_enabled" name="ml_general_settings_enabled"
						value="true" <?php echo ( Mobiloud::get_option( 'ml_general_settings_enabled', '0' ) === '1' ) ? 'checked' : ''; ?>/>
					<label for="ml_general_settings_enabled">Enable General Settings</label>
				</div>

				<div class="ml-form-row">
					<p>Select a WordPress menu to use for General Settings</p>
					<select name="ml_general_settings_menu" class="ml-select">
						<option value="">Select Menu</option>
						<?php
						$selected_option = Mobiloud::get_option( 'ml_general_settings_menu', '' );
						foreach ( $menus as $ml_menu ) {
							$selected = '';
							if ( $selected_option === $ml_menu->slug ) {
								$selected = 'selected="selected"';
							}
							echo "<option value='" . esc_attr( $ml_menu->slug ) . "' " . esc_attr( $selected ) . '>' . esc_html( $ml_menu->name ) . '</option>';
						}
						?>
					</select>
				</div>

				<div class="ml-form-row ml-color">
					<label>Title Color</label>
					<?php
					$def_color = Mobiloud::get_option( 'ml_settings_title_color', '#444444' );
					?>
					<input class="color-picker" value="<?php echo esc_attr( $def_color ); ?>" name="ml_settings_title_color" type="text" />
				</div>

				<div class="ml-form-row ml-color">
					<label>Active Switch Color</label>
					<?php
					$def_color = Mobiloud::get_option( 'ml_settings_active_switch_color', '#4CD964' );
					?>
					<input class="color-picker" value="<?php echo esc_attr( $def_color ); ?>" name="ml_settings_active_switch_color" type="text" />
				</div>

				<div class="ml-form-row ml-color">
					<label>Active Switch Background Color</label>
					<?php
					$def_color = Mobiloud::get_option( 'ml_settings_active_switch_background_color', '#b4ffc1' );
					?>
					<input class="color-picker" value="<?php echo esc_attr( $def_color ); ?>" name="ml_settings_active_switch_background_color" type="text" />
				</div>

				<div class="ml-form-row ml-color">
					<label>Inactive Switch Color</label>
					<?php
					$def_color = Mobiloud::get_option( 'ml_settings_inactive_switch_color', '#A3A3A3' );
					?>
					<input class="color-picker" value="<?php echo esc_attr( $def_color ); ?>" name="ml_settings_inactive_switch_color" type="text" />
				</div>

				<div class="ml-form-row ml-color">
					<label>Inactive Switch Background Color</label>
					<?php
					$def_color = Mobiloud::get_option( 'ml_settings_inactive_switch_background_color', '#d4d4d4' );
					?>
					<input class="color-picker" value="<?php echo esc_attr( $def_color ); ?>" name="ml_settings_inactive_switch_background_color" type="text" />
				</div>

			</div>


		</div>
	</div>
</div>

<div class="ml2-block app-v1-only-feature">
	<div class="ml2-header"><h2>Menu Structure</h2></div>
	<div class="ml2-body">

		<p>Drag each item into the order you prefer. Any questions or need some help with the app's menu configuration?
			<a class="contact" href="mailto:support@mobiloud.com">Send us a message</a>.</p>
		<div class='ml-col-row'>
			<div class="ml-col-row">
				<h4>Categories</h4>
				<div class="ml-form-row">
					<?php Mobiloud_Admin::load_ajax_insert( 'menu_cat' ); ?>
					<a href="#" class="button-secondary ml-add-category-btn" style="display: none">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-categories-holder">
				</ul>
				<h4>Custom Taxonomies</h4>
				<div class="ml-form-row">
					<select name="ml-tax-group" class="ml-select-add">
						<option value="">Select Taxonomy</option>
						<?php $taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' ); ?>
						<?php
						foreach ( $taxonomies as $tax ) {
							echo "<option value=' " . esc_attr( $tax->query_var ) . "'>" . esc_html( $tax->label ) . '</option>';
						}
						?>
					</select>
				</div>
				<div class="ml-form-row ml-tax-group-row" style="display:none;">
					<select name="ml-terms" class="ml-select-add">
						<option value="">Select Term</option>
					</select>
					<a href="#" class="button-secondary ml-add-term-btn">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-terms-holder">
					<?php
					$menu_terms = Mobiloud::get_option( 'ml_menu_terms', array() );
					foreach ( $menu_terms as $menu_term_data ) {
						$menu_term_data_ex = explode( '=', $menu_term_data );
						$menu_term_object  = get_term_by( 'id', $menu_term_data_ex[1], $menu_term_data_ex[0] );

						?>
						<li rel="<?php echo esc_attr( $menu_term_object->term_id ); ?>">
							<span
								class="dashicons-before dashicons-menu"></span><?php echo( isset( $menu_term_object->name ) ? esc_html( $menu_term_object->name ) : '' ); ?>
							<input type="hidden" name="ml-menu-terms[]" value="<?php echo esc_attr( $menu_term_data ); ?>"/>
							<a href="#" class="dashicons-before dashicons-trash ml-item-remove"></a>
						</li>
						<?php

					}
					?>
				</ul>

				<h4>Tags</h4>
				<div class="ml-form-row">
					<?php Mobiloud_Admin::load_ajax_insert( 'menu_tags' ); ?>
					<a href="#" class="button-secondary ml-add-tag-btn" style="display: none">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-tags-holder">
				</ul>

				<h4>Pages</h4>
				<div class="ml-form-row">
					<?php Mobiloud_Admin::load_ajax_insert( 'menu_page' ); ?>
					<a href="#" class="button-secondary ml-add-page-btn" style="display: none">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-pages-holder">
				</ul>

				<h4>Links</h4>
				<div class="ml-form-row">
					<input type="text" placeholder="Menu Title" id="ml_menu_url_title" name="ml_menu_url_title"/>
					<input type="text" placeholder="http://www.domain.com/" size="32" id="ml_menu_url" name="ml_menu_url"/>
					<a href="#" class="button-secondary ml-add-link-btn">Add</a>
				</div>
				<ul class="ml-menu-holder ml-menu-links-holder">
					<?php
					$menu_urls = get_option( 'ml_menu_urls', array() );
					foreach ( $menu_urls as $menu_url ) {
						?>
						<li rel="<?php echo esc_attr( $menu_url['url'] ); ?>">
							<span
								class="dashicons-before dashicons-menu"></span><?php echo esc_html( $menu_url['urlTitle'] ); ?>
							- <span
								class="ml-sub-title"><?php echo esc_html( Mobiloud::trim_string( esc_html( $menu_url['url'] ), 50 ) ); ?></span>
							<input type="hidden" name="ml-menu-links[]"
								value="<?php echo esc_attr( $menu_url['urlTitle'] ) . ':=:' . esc_attr( $menu_url['url'] ); ?>"/>
							<a href="#" class="dashicons-before dashicons-trash ml-item-remove"></a>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>

	</div>
</div>
<div class="ml2-block">
	<div class="ml2-header"><h2>Menu Settings</h2></div>
	<div class="ml2-body">

		<div class='ml-col-row'>
			<div class="ml-col-half">
				<p>Customise your app menu by adjusting what it should display.</p>
			</div>
			<div class="ml-col-half">
				<div class="ml-form-row ml-checkbox-wrap">
					<input type="checkbox" id="ml_menu_show_favorites" name="ml_menu_show_favorites"
						value="true" <?php echo Mobiloud::get_option( 'ml_menu_show_favorites' ) ? 'checked' : ''; ?>/>
					<label for="ml_menu_show_favorites">Show Favourites in the app menu</label>
				</div>
			</div>
		</div>
	</div>
</div>
