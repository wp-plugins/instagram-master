<?php
//Hook Widget
add_action( 'widgets_init', 'instagram_master_widget_embed_basic' );
//Register Widget
function instagram_master_widget_embed_basic() {
register_widget( 'instagram_master_widget_embed_basic' );
}
add_action( 'wp_enqueue_scripts', 'instagram_master_wbecss' );
//load css for shortcode
function instagram_master_wbecss() {
if ( is_active_widget( false, false, 'instagram_master_widget_embed_basic', true ) ) {
	wp_register_style( 'instagram_master_wbecss', plugins_url('instagram-master-style.css', __FILE__) );
	wp_enqueue_style( 'instagram_master_wbecss' );
}
}

class instagram_master_widget_embed_basic extends WP_Widget {
	function instagram_master_widget_embed_basic() {
	$widget_ops = array( 'classname' => 'Instagram Master Basic Responsive Embed Widget', 'description' => __('Instagram Basic Responsive Embed Widget is light fast loading widget to manually display an Instagram video or image.', 'instagram_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'instagram_master_widget_embed_basic' );
	$this->WP_Widget( 'instagram_master_widget_embed_basic', __('Instagram Basic Responsive Embed Widget', 'instagram_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $instagram_master_size;
		extract( $args );
		//Our variables from the widget settings.
		$instagram_title = isset( $instance['instagram_title'] ) ? $instance['instagram_title'] :false;
		$instagram_title_new = isset( $instance['instagram_title_new'] ) ? $instance['instagram_title_new'] :false;
		$show_instagram_embed_adv = isset( $instance['show_instagram_embed_adv'] ) ? $instance['show_instagram_embed_adv'] :false;
		$instagram_embed_adv_link = $instance['instagram_embed_adv_link'];
		echo $before_widget;
		
		// Display the widget title
	if ( $instagram_title ){
		if (empty($instagram_title_new)){
			if(is_multisite()){
			$instagram_title_new = get_site_option('instagram_master_name');
			}
			else{
			$instagram_title_new = get_option('instagram_master_name');
			}
		echo $before_title . $instagram_title_new . $after_title;
		}
		else{
		echo $before_title . $instagram_title_new . $after_title;
		}
	}
	else{
	}
		//Display Instagram Photos
		if ( $show_instagram_embed_adv ){
			echo '<div class="photojs-container">' .
			'<iframe src="'.$instagram_embed_adv_link.'embed/" width="300" height="300" frameborder="0" scrolling="no" allowtransparency="true"></iframe>' .
			'</div>';
		}
		else {
		}
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['instagram_title'] = strip_tags( $new_instance['instagram_title'] );
		$instance['instagram_title_new'] = $new_instance['instagram_title_new'];
		$instance['show_instagram_embed_adv'] = $new_instance['show_instagram_embed_adv'];
		$instance['instagram_embed_adv_link'] = $new_instance['instagram_embed_adv_link'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'instagram_title_new' => __('Instagram Master', 'instagram_master'), 'instagram_title' => true, 'instagram_title_new' => false, 'show_instagram_embed_adv' => false, 'instagram_embed_adv_link' => false );
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
	<input type="checkbox" <?php checked( (bool) $instance['show_instagram_embed_adv'], true ); ?> id="<?php echo $this->get_field_id( 'show_instagram_embed_adv' ); ?>" name="<?php echo $this->get_field_name( 'show_instagram_embed_adv' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_instagram_embed_adv' ); ?>"><b><?php _e('Activate Instagram Embed', 'instagram_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'instagram_embed_adv_link' ); ?>"><b><?php _e('Instagram Manual Embed:', 'instagram_master'); ?></b></label></br>
	<input id="<?php echo $this->get_field_id( 'instagram_embed_adv_link' ); ?>" name="<?php echo $this->get_field_name( 'instagram_embed_adv_link' ); ?>" value="<?php echo $instance['instagram_embed_adv_link']; ?>" style="width:auto;" />
	</p>
	<div class="description">Navigate to any Instagram photo or image page.</div>
	<div class="description">Copy the browser link and paste it above.</div>
	<div class="description">Example:</div>
	<div class="description">http://instagram.com/p/n9bpTRIhA9/</div>
	<br>
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