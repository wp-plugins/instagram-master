<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class instagram_master_admin_widgets_table extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
?>
<table class="widefat fixed" cellspacing="0">
	<thead>
		<tr>
			<th id="columnname" class="manage-column column-columnname" scope="col" width="300"><legend><h3><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:16px; vertical-align:middle;" /><?php _e('&nbsp;Screenshot', 'instagram_master'); ?></h3></legend></th>
			<th id="columnname" class="manage-column column-columnname" scope="col"><h3><img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:16px; vertical-align:middle;" /><?php _e('&nbsp;Description', 'instagram_master'); ?></h3></legend></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th class="manage-column column-columnname" scope="col" width="300"><a class="button-primary" href="<?php echo get_site_url(); ?>/wp-admin/widgets.php" title="To Widgets Page" style="float:left;">To Widgets Page</a></p></th>
			<th class="manage-column column-columnname" scope="col"><a class="button-primary" href="<?php echo get_site_url(); ?>/wp-admin/widgets.php" title="To Widgets Page" style="float:right;">To Widgets Page</a></p></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td class="column-columnname" width="300" style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-instagrammaster-admin-widget-buttons.png', dirname(__FILE__)); ?>" alt="<?php echo get_option('instagram_master_name'); ?>" align="left" width="300px" height="135px" style="padding:5px;"/></td>
			<td class="column-columnname"style="vertical-align:middle"><h3>Instagram Advanced Buttons Widget</h3><p>The perfect widget to connect your wordpress website to your instagram profile and collect a bunch of photo likes, comments, shares, etc. Packed with the default View on Instagram button and the Sleek Small sized Instagram button, icon.</p><p>The Advanced Instagram Master Buttons Widget looks great when published under the photos widget, remember you can always hide the widget title to get the button closer to your photos.</p><p>Navigate to your wordpress widgets page and start using it.</p></td>
		</tr>
		
		
		<tr>
			<td class="column-columnname" width="300" style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-instagrammaster-admin-widget-embed-basic.png', dirname(__FILE__)); ?>" alt="<?php echo get_option('instagram_master_name'); ?>" align="left" width="300px" height="135px" style="padding:5px;"/></td>
			<td class="column-columnname"style="vertical-align:middle"><h3>Instagram Basic Responsive Embed Widget</h3><p>Light, Fast Loading widget to manually display a single Instagram video or image.</p><p>Displays Follow, Likes and Comments for max "viralness".</p><p>Navigate to your wordpress widgets page and start using it.</p></td>
		</tr>
		
		
		
		<tr class="alternate">
			<td class="column-columnname" width="300" style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-instagrammaster-admin-widget-photos.png', dirname(__FILE__)); ?>" alt="<?php echo get_option('instagram_master_name'); ?>" align="left" width="300px" height="135px" style="padding:5px;"/></td>
			<td class="column-columnname"style="vertical-align:middle"><h3>Instagram Advanced Photos Widget</h3><p>This is the "Top of the Line" Instagram Photos Display Widget. The Advanced Instagram Master Photos Widget is a Fast clean html5 that makes <b>NO USE</b> of nasty Javascipt or Ajax.</p><p>Beautiful Full Adaptive Photos display in html5 and CSS gives full control over the number of photo thumbnails to display and their sizes. Each thumbnail displays username and tag labels, perfect for Instagram Photo Comments, Love and Share.</p><p>Check Add-ons Page.</p></td>
		</tr>
		
		
		<tr>
			<td class="column-columnname" width="300" style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-instagrammaster-admin-widget-embed-advanced.png', dirname(__FILE__)); ?>" alt="<?php echo get_option('instagram_master_name'); ?>" align="left" width="300px" height="135px" style="padding:5px;"/></td>
			<td class="column-columnname"style="vertical-align:middle"><h3>Instagram Advanced Responsive Embed Widget</h3><p>This advanced responsive embed widget includes 2 displays options. Automatically retrieve your latest Instagram video, image or manually select a single Instagram image or video.</p><p>Displays Follow, Likes and Comments for max "viralness".</p><p>Check Add-ons Page.</p></td>
		</tr>
		
		
		<tr class="alternate">
			<td class="column-columnname" width="300" style="vertical-align:middle"><img src="<?php echo plugins_url('images/techgasp-admin-widget-blank.png', dirname(__FILE__)); ?>" alt="<?php echo get_option('amazon_master_name'); ?>" align="left" width="300px" height="135px" style="padding:5px;"/></td>
			<td class="column-columnname"style="vertical-align:middle"><h3>Suggest a Widget</h3><p>Would you like to see your widget idea added to this plugin? Just drop us a line and we will make sure it gets included in the next release.</p><p>Get in touch with TechGasp.</p></td>
		</tr>
	</tbody>
</table>
<?php
		}
}