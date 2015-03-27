<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class instagram_master_admin_settings_wide_table_options extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
//Set Activate TechGasp Instagram System and ON
add_option ( 'instagram_master_system_wide', "true" );
//Save Options
if ( $_POST) {
if ( isset($_POST['instagram_master_system_wide']) )
update_option('instagram_master_system_wide', $_POST['instagram_master_system_wide'] );
else
update_option('instagram_master_system_wide', 'false' );

if ( isset($_POST['instagram_master_system_wide_username']) )
update_option('instagram_master_system_wide_username', $_POST['instagram_master_system_wide_username'] );
else
update_option('instagram_master_system_wide_username', '' );

if ( isset($_POST['instagram_master_system_wide_token']) )
update_option('instagram_master_system_wide_token', $_POST['instagram_master_system_wide_token'] );
else
update_option('instagram_master_system_wide_token', '' );

?>
<div id="message" class="updated fade">
<p><strong><?php _e('Settings Saved!', 'instagram_master'); ?></strong></p>
</div>
<?php
}
?>
<form method="post" width='1'>
<fieldset class="options">

<table class="widefat fixed" cellspacing="0">
	<thead>
		<tr>
			<th id="cb" class="manage-column column-cb check-column" scope="col" style="vertical-align:middle"><input type="checkbox"></th>
			<th id="columnname" class="manage-column column-columnname" scope="col" width="250"><legend><h3><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" /><?php _e('&nbsp;System Wide Settings', 'instagram_master'); ?></h3></legend></th>
			<th id="columnname" class="manage-column column-columnname" scope="col"></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th class="manage-column column-cb check-column" scope="col"></th>
			<th class="manage-column column-columnname" scope="col" width="250"></th>
			<th class="manage-column column-columnname" scope="col"></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<th class="check-column" scope="row">
<input name="instagram_master_system_wide" id="instagram_master_system_wide" value="true" type="checkbox" <?php echo get_option('instagram_master_system_wide') == 'true' ? 'checked="checked"':''; ?> />
			</th>
			<td class="column-columnname" width="250">
<label for="instagram_master_system_wide"><b><?php _e('Activate TechGasp instagram System', 'instagram_master'); ?></b></label>
			</td>
			<td class="column-columnname" style="vertical-align:middle">Default is <b>On</b>, if off no shortcodes or widgets will be loaded.</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td class="column-columnname" width="250">
<label for="instagram_master_system_wide_username"><?php _e('insert Instagram Username:', 'instagram_master'); ?></label>
			</td>
			<td class="column-columnname" style="vertical-align:middle">
<input id="instagram_master_system_wide_username" name="instagram_master_system_wide_username" type="text" size="22" value="<?php echo get_option('instagram_master_system_wide_username'); ?>">
			</td>
		</tr>
		<tr class="alternate">
			<th class="check-column" scope="row"></th>
			<td class="column-columnname" width="250">
<label for="instagram_master_system_wide_token"><?php _e('insert Instagram Access Token:', 'instagram_master'); ?></label>
			</td>
			<td class="column-columnname" style="vertical-align:middle">
<input id="instagram_master_system_wide_token" name="instagram_master_system_wide_token" type="text" size="22" value="<?php echo get_option('instagram_master_system_wide_token'); ?>">
			</td>
		</tr>
		<tr>
			<th class="check-column" scope="row"></th>
			<td class="column-columnname" width="250">
<a href="http://www.techgasp.com/31-news/94-instagram-master-authentication" target="_blank"><b>Get Your Token</b></a>
			</td>
			<td class="column-columnname">
<p>Follow the instructions, copy your Token... paste it inside the above Instagram Access Token field.</p>
			</td>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update' value='<?php _e("Save Settings", 'instagram_master'); ?>' id='submitbutton' /></p>
</fieldset>
</form>
<?php
	}
//CLASS ENDS
}