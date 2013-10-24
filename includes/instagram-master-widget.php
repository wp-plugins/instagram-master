<?php
//Load Helper class

//Hook Widget
add_action( 'widgets_init', 'instagram_master_widget' );
//Register Widget
function instagram_master_widget() {
register_widget( 'instagram_master_widget' );
}

class instagram_master_widget extends WP_Widget {
	function instagram_master_widget() {
	$widget_ops = array( 'classname' => 'Intagram Master', 'description' => __('Instagram Master lets your show your latest Instagram photos and View on Instagram Button inside any widget position. ', 'instagram_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'instagram_master_widget' );
	$this->WP_Widget( 'instagram_master_widget', __('Instagram Master', 'instagram_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $instagram_master_size;
		extract( $args );
		//Our variables from the widget settings.
		$name = "Instagram Master";
		$title = isset( $instance['title'] ) ? $instance['title'] :false;
		$show_instagrambutton = isset( $instance['show_instagrambutton'] ) ? $instance['show_instagrambutton'] :false;
		$username = $instance['username'];
		echo $before_widget;
		
		// Display the widget title
	if ( $title )
		echo $before_title . $name . $after_title;
		//Display Instagram Photos

		//Display View on Instagram Button
	if ( $show_instagrambutton )
		echo '<a href="http://instagram.com/'.$username.'?ref=badge" class="ig-b- ig-b-v-24" target="_blank"><img src="//badges.instagram.com/static/images/ig-badge-view-24.png" alt="Instagram" /></a>';
	
	echo '<style>.ig-b- { display: inline-block; }'.
		'.ig-b- img { visibility: hidden; }'.
		'.ig-b-:hover { background-position: 0 -60px; } .ig-b-:active { background-position: 0 -120px; }'.
		'.ig-b-v-24 { width: 137px; height: 24px; background: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24.png) no-repeat 0 0; }'.
		'@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {'.
		'.ig-b-v-24 { background-image: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24@2x.png); background-size: 160px 178px; } }</style>' .
	$after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_instagrambutton'] = $new_instance['show_instagrambutton'];
		$instance['username'] = $new_instance['username'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Instagram Master', 'instagram_master'), 'title' => true, 'show_instagrambutton' => false, 'username' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'instagram_master'); ?></b></label></br>
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_instagrambutton'], true ); ?> id="<?php echo $this->get_field_id( 'show_instagrambutton' ); ?>" name="<?php echo $this->get_field_name( 'show_instagrambutton' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_instagrambutton' ); ?>"><b><?php _e('View on Instagram Button', 'instagram_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'username' ); ?>"><b><?php _e('Instagram Username:', 'instagram_master'); ?></b></label></br>
	<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:auto;" />
	</p>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Instagram Token:</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Display Instagram Photos:</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Instagram Photo Count:</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Instagram Photo Size:</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Instagram Master Website</b>
	</p>
	<p><a class="button-secondary" href="http://wordpress.techgasp.com/instagram-master/" target="_blank" title="Instagram Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/instagram-master-documentation/" target="_blank" title="Instagram Master Documentation">Documentation</a> <a class="button-primary" href="http://wordpress.techgasp.com/instagram-master/" target="_blank" title="Instagram Master Wordpress">Advanced Version</a></p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
		<p>
		<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
		&nbsp;
		<b>Advanced Version Updater:</b>
		</p>
		<div class="description">The advanced version updater allows to automatically update your advanced plugin. Only available in advanced version.</div>
	<?php
	}
 }
?>