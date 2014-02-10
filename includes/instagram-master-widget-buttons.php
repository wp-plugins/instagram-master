<?php
//Load Helper class
require_once( dirname( __FILE__ ) . '/instagram-master-helper.php');
//Hook Widget
add_action( 'widgets_init', 'instagram_master_widget_buttons' );
//Register Widget
function instagram_master_widget_buttons() {
register_widget( 'instagram_master_widget_buttons' );
}

class instagram_master_widget_buttons extends WP_Widget {
	function instagram_master_widget_buttons() {
	$widget_ops = array( 'classname' => 'Intagram Master Buttons', 'description' => __('Instagram Master Advanced Buttons Widget lets you show 2 sizes of your View on Instagram Button inside any widget position. ', 'instagram_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'instagram_master_widget_buttons' );
	$this->WP_Widget( 'instagram_master_widget_buttons', __('Instagram Master Buttons', 'instagram_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $instagram_master_size;
		extract( $args );
		//Our variables from the widget settings.
		$instagram_title = isset( $instance['instagram_title'] ) ? $instance['instagram_title'] :false;
		$instagram_title_new = isset( $instance['instagram_title_new'] ) ? $instance['instagram_title_new'] :false;
		$show_instagrambutton = isset( $instance['show_instagrambutton'] ) ? $instance['show_instagrambutton'] :false;
		$username = $instance['username'];
		$show_instagrambutton_small = isset( $instance['show_instagrambutton_small'] ) ? $instance['show_instagrambutton_small'] :false;
		echo $before_widget;

// Display the widget title
	if ( $instagram_title ){
		if (empty ($instagram_title_new)){
		$instagram_title_new = get_option('instagram_master_name');
		}
		echo $before_title . $instagram_title_new . $after_title;
	}
	else{
	}
//Display View on Instagram Button
	if ( $show_instagrambutton ){
		if ( $show_instagrambutton_small ){
			echo '<style>.ig-b- { display: inline-block; }' .
				'.ig-b- img { visibility: hidden; }' .
				'.ig-b-:hover { background-position: 0 -60px; } .ig-b-:active { background-position: 0 -120px; }' .
				'.ig-b-24 { width: 24px; height: 24px; background: url(//badges.instagram.com/static/images/ig-badge-sprite-24.png) no-repeat 0 0; }' .
				'@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {' .
				'.ig-b-24 { background-image: url(//badges.instagram.com/static/images/ig-badge-sprite-24@2x.png); background-size: 60px 178px; } }</style>' .
				'<a href="http://instagram.com/'.$username.'?ref=badge" class="ig-b- ig-b-24"><img src="//badges.instagram.com/static/images/ig-badge-24.png" alt="Instagram" /></a>';
		}
		else{
		echo '<style>.ig-b- { display: inline-block; }'.
			'.ig-b- img { visibility: hidden; }'.
			'.ig-b-:hover { background-position: 0 -60px; } .ig-b-:active { background-position: 0 -120px; }'.
			'.ig-b-v-24 { width: 137px; height: 24px; background: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24.png) no-repeat 0 0; }'.
			'@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {'.
			'.ig-b-v-24 { background-image: url(//badges.instagram.com/static/images/ig-badge-view-sprite-24@2x.png); background-size: 160px 178px; } }</style>' .
			'<a href="http://instagram.com/'.$username.'?ref=badge" class="ig-b- ig-b-v-24" target="_blank"><img src="//badges.instagram.com/static/images/ig-badge-view-24.png" alt="Instagram" /></a>';
		}
	}
	else{
	}

	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['instagram_title'] = strip_tags( $new_instance['instagram_title'] );
		$instance['instagram_title_new'] = $new_instance['instagram_title_new'];
		$instance['show_instagrambutton'] = $new_instance['show_instagrambutton'];
		$instance['username'] = $new_instance['username'];
		$instance['show_instagrambutton_small'] = $new_instance['show_instagrambutton_small'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'instagram_title_new' => __('Instagram Master', 'instagram_master'), 'instagram_title' => true, 'instagram_title_new' => false, 'show_instagrambutton' => false, 'username' => false, 'show_instagrambutton_small' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['instagram_title'], true ); ?> id="<?php echo $this->get_field_id( 'instagram_title' ); ?>" name="<?php echo $this->get_field_name( 'instagram_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'instagram_title' ); ?>"><b><?php _e('Display Widget Title', 'instagram_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'instagram_title_new' ); ?>"><?php _e('Change Title:', 'instagram_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'instagram_title_new' ); ?>" name="<?php echo $this->get_field_name( 'instagram_title_new' ); ?>" value="<?php echo $instance['instagram_title_new']; ?>" style="width:auto;" />
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
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_instagrambutton_small'], true ); ?> id="<?php echo $this->get_field_id( 'show_instagrambutton_small' ); ?>" name="<?php echo $this->get_field_name( 'show_instagrambutton_small' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_instagrambutton_small' ); ?>"><b><?php _e('Activate Small Instagram Button', 'instagram_master'); ?></b></label></br>
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Instagram Master Website</b>
	</p>
	<p><a class="button-secondary" href="http://wordpress.techgasp.com/instagram-master/" target="_blank" title="Instagram Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/instagram-master-documentation/" target="_blank" title="Instagram Master Documentation">Documentation</a> <a class="button-primary" href="http://wordpress.techgasp.com/instagram-master/" target="_blank" title="Visit Website">Get Add-ons</a></p>
	<?php
	}
 }
?>