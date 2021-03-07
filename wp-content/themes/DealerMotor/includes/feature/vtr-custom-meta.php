<?php
    // Add the Meta Box  
    function add_custom_meta_box() {  
        add_meta_box(  
            'custom_meta_box', // $id  
            'Virtarich Motor', // $title  
            'show_custom_meta_box', // $callback  
            'motor', // $page  
            'normal', // $context  
            'high'); // $priority  
    }  
    add_action('add_meta_boxes', 'add_custom_meta_box');  
            // Field Array  
    $prefix = 'custom_';  
    $custom_meta_fields = array(  
		array(  
            'label'=> 'Label',  
            'desc'  => 'pilih label, PROMO , INDEN , BEST SELLER , SOLD OUT',  
            'id'    => 'label',  
            'type'  => 'select' ,
			 'options' => array (  
						  'one' => array (  
							  'label' => '-',  
							  'value' => ''  
						  ),  
						  'two' => array (  
							  'label' => 'Promo',  
							  'value' => 'promo'  
						  ),  
						  'three' => array (  
							  'label' => 'Best Seller',  
							  'value' => 'best'  
						  ),
						  'four' => array (  
							  'label' => 'Inden',  
							  'value' => 'inden'  
						  ),
						  'five' => array (  
							  'label' => 'Limited',  
							  'value' => 'limited'  
						  ),
						  'six' => array (  
							  'label' => 'Sold Out',  
							  'value' => 'sold'  
						  )   
        ),  	
        ),  	
			array(  
            'label'=> 'Video Youtube',  
            'desc'  => 'contoh : https://www.youtube.com/watch?v=7tIVM1T8DeU , <br/> maka yang di tulis hanya <b>7tIVM1T8DeU</b>',  
            'id'    => 'youtube',  
            'type'  => 'text'  
        ),	
					array(  
            'label'=> 'Harga On the road',  
            'desc'  => 'contoh : Rp 19.500.000',  
            'id'    => 'harga',  
            'type'  => 'text'  
        ),					
    );  
	    // The Callback  
    function show_custom_meta_box() {  
    global $custom_meta_fields, $post;  
    // Use nonce for verification  
    echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
        // Begin the field table and loop  
        echo '<table class="form-table">';  
        foreach ($custom_meta_fields as $field) {  
            // get value of this field if it exists for this post  
            $meta = get_post_meta($post->ID, $field['id'], true);  
            // begin a table row with  
            echo '<tr> 
                    <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                    <td>';  
                    switch($field['type']) {  
    // text  
    case 'text':  
        echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /> 
            <br /><span class="description">'.$field['desc'].'</span>';  
    break;  
	    // textarea  
    case 'textarea':  
        echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea> 
            <br /><span class="description">'.$field['desc'].'</span>';  
    break;  
	    // checkbox  
    case 'checkbox':  
        echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
            <label for="'.$field['id'].'">'.$field['desc'].'</label>';  
    break;  
	
	    // select  
    case 'select':  
        echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';  
        foreach ($field['options'] as $option) {  
            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
        }  
        echo '</select><br /><span class="description">'.$field['desc'].'</span>';  
    break;  
                    } //end switch  
            echo '</td></tr>';  
        } // end foreach  
        echo '</table>'; // end table  
    }  
	    // Save the Data  
    function save_custom_meta($post_id) {  
        global $custom_meta_fields;  
		if ( !isset($_POST['custom_meta_box_nonce']) ) {

	    return $post_id;

	}

        // verify nonce  
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))  
            return $post_id;  
        // check autosave  
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
            return $post_id;  
        // check permissions  
        if ('page' == $_POST['post_type']) {  
            if (!current_user_can('edit_page', $post_id))  
                return $post_id;  
            } elseif (!current_user_can('edit_post', $post_id)) {  
                return $post_id;  
        }  
 // loop through fields and save the data  
    foreach ($custom_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_custom_meta');

// DYNAMIC CUSTOM META
function virtarich_meta_js() {
	wp_enqueue_script('meta', VTR_TEMPLATE_DIR_URI.'/includes/feature/meta.js');
}
add_action('admin_enqueue_scripts', 'virtarich_meta_js');
function virtarich_motor_add_meta_boxes() {
	add_meta_box( 'repeatable-fields', 'Uang muka dan Angsuran Motor', 'virtarich_motor_meta_box_admin', 'motor', 'normal', 'default');
}
add_action('admin_init', 'virtarich_motor_add_meta_boxes', 1);

function virtarich_motor_meta_box_admin() {
	global $post;
	$repeatable_fields = get_post_meta($post->ID, 'repeatable_fields', true);
	wp_nonce_field( 'virtarich_repeatable_meta_box_nonce', 'virtarich_repeatable_meta_box_nonce' );
	?>
	<table id="repeatable-fieldset-one" width="100%">
            <thead>
                <tr>
                <th width="30%">Uang Muka</th>
  <th><?php echo of_get_option('angsuran_1') ?></th>
  <th><?php echo of_get_option('angsuran_2') ?></th>
  <th><?php echo of_get_option('angsuran_3') ?></th>
  <th><?php echo of_get_option('angsuran_4') ?></th>
  <th><?php echo of_get_option('angsuran_5') ?></th>
                <th width="8%"></th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ( $repeatable_fields ) :
            foreach ( $repeatable_fields as $field ) {
            ?>
            <tr>
                <td><input type="text" class="widefat" name="uangmuka[]" value="<?php if($field['uangmuka'] != '') echo esc_attr( $field['uangmuka'] ); ?>" /></td>
                
                <td><input type="text" class="widefat" name="angsuran1[]" value="<?php if ($field['angsuran1'] != '') echo esc_attr( $field['angsuran1'] ); else echo ''; ?>" /></td>
                <td><input type="text" class="widefat" name="angsuran2[]" value="<?php if ($field['angsuran2'] != '') echo esc_attr( $field['angsuran2'] ); else echo ''; ?>" /></td>
                <td><input type="text" class="widefat" name="angsuran3[]" value="<?php if ($field['angsuran3'] != '') echo esc_attr( $field['angsuran3'] ); else echo ''; ?>" /></td>
                <td><input type="text" class="widefat" name="angsuran4[]" value="<?php if ($field['angsuran4'] != '') echo esc_attr( $field['angsuran4'] ); else echo ''; ?>" /></td>
                <td><input type="text" class="widefat" name="angsuran5[]" value="<?php if ($field['angsuran5'] != '') echo esc_attr( $field['angsuran5'] ); else echo ''; ?>" /></td>
                <td><a class="button remove-row" href="#">Hapus</a></td>
            </tr>
            <?php
            }
            else :
            // show a blank one
            ?>
            	<tr>
                        <td><input type="text" class="widefat" name="uangmuka[]" /></td>
                        <td><input type="text" class="widefat" name="angsuran1[]" value="" /></td>
                         <td><input type="text" class="widefat" name="angsuran2[]" value="" /></td>
                          <td><input type="text" class="widefat" name="angsuran3[]" value="" /></td>
                           <td><input type="text" class="widefat" name="angsuran4[]" value="" /></td>
                            <td><input type="text" class="widefat" name="angsuran5[]" value="" /></td>
                        <td><a class="button remove-row" href="#">Hapus</a></td>
            	</tr>
            <?php endif; ?>
            <!-- empty hidden one for jQuery -->
					<tr class="empty-row screen-reader-text">
                        <td><input type="text" class="widefat" name="uangmuka[]" /></td>
                        <td><input type="text" class="widefat" name="angsuran1[]" value="" /></td>
                        <td><input type="text" class="widefat" name="angsuran2[]" value="" /></td>
                        <td><input type="text" class="widefat" name="angsuran3[]" value="" /></td>
                        <td><input type="text" class="widefat" name="angsuran4[]" value="" /></td>
                        <td><input type="text" class="widefat" name="angsuran5[]" value="" /></td>
                        <td><a class="button remove-row" href="#">Hapus</a></td>
					</tr>
            </tbody>
	</table>
<p><a id="add-row" class="button" href="#">Tambah data</a></p>
<?php
}
// save metabox harga
add_action('save_post', 'virtarich_motor_save');
function virtarich_motor_save($post_id) {
		if ( ! isset( $_POST['virtarich_repeatable_meta_box_nonce'] ) ||
		! wp_verify_nonce( $_POST['virtarich_repeatable_meta_box_nonce'], 'virtarich_repeatable_meta_box_nonce' ) )
		return;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
		if (!current_user_can('edit_post', $post_id))
		return;
		$old = get_post_meta($post_id, 'repeatable_fields', true);
		$new = array();
		$uangmukas = $_POST['uangmuka'];
		$angsuran1s = $_POST['angsuran1'];
		$angsuran2s = $_POST['angsuran2'];
		$angsuran3s = $_POST['angsuran3'];
		$angsuran4s = $_POST['angsuran4'];
		$angsuran5s = $_POST['angsuran5'];
		$count = count( $uangmukas );
		for ( $i = 0; $i < $count; $i++ ) {
			  if ( $uangmukas[$i] != '' ) :
			  $new[$i]['uangmuka'] = stripslashes( strip_tags( $uangmukas[$i] ) );	  
			  
			  if ( $angsuran1s[$i] == '' )
			  $new[$i]['angsuran1'] = '';
			  else
			  $new[$i]['angsuran1'] = stripslashes( $angsuran1s[$i] );

			  if ( $angsuran2s[$i] == '' )
			  $new[$i]['angsuran2'] = '';
			  else
			  $new[$i]['angsuran2'] = stripslashes( $angsuran2s[$i] );

			  if ( $angsuran3s[$i] == '' )
			  $new[$i]['angsuran3'] = '';
			  else
			  $new[$i]['angsuran3'] = stripslashes( $angsuran3s[$i] );			  
			  			  

			  if ( $angsuran4s[$i] == '' )
			  $new[$i]['angsuran4'] = '';
			  else
			  $new[$i]['angsuran4'] = stripslashes( $angsuran4s[$i] );
			  
			  if ( $angsuran5s[$i] == '' )
			  $new[$i]['angsuran5'] = '';
			  else
			  $new[$i]['angsuran5'] = stripslashes( $angsuran5s[$i] );
			  
			  			  			  
			  endif;
		}
		if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'repeatable_fields', $new );
		elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'repeatable_fields', $old );
}
// tampilkan metabox harga 
function virtarich_list_harga() {
		global $post;
		$repeatable_fields = get_post_meta($post->ID, 'repeatable_fields', true);
		if ( $repeatable_fields ) :
		foreach ( $repeatable_fields as $field ) { ?>
            <tr>
            <td><?php if($field['uangmuka'] != '') echo esc_attr( $field['uangmuka'] ); ?></td>
			<td><?php if ($field['angsuran1'] != '') echo esc_attr( $field['angsuran1'] );?></td>
            <td><?php if ($field['angsuran2'] != '') echo esc_attr( $field['angsuran2'] );?></td>
            <td><?php if ($field['angsuran3'] != '') echo esc_attr( $field['angsuran3'] );?></td>
            <td><?php if ($field['angsuran4'] != '') echo esc_attr( $field['angsuran4'] );?></td>
            <td><?php if ($field['angsuran5'] != '') echo esc_attr( $field['angsuran5'] );?></td>
            </tr>
		<?php } 
		 endif; 
 }