<?php
//Load Helper class

//Load Shortcode Framework

//Hook Widget
add_action( 'widgets_init', 'techgasp_instagrammaster_widget' );
//Register Widget
function techgasp_instagrammaster_widget() {
register_widget( 'techgasp_instagrammaster_widget' );
}

class techgasp_instagrammaster_widget extends WP_Widget {
	function techgasp_instagrammaster_widget() {
	$widget_ops = array( 'classname' => 'Intagram Master', 'description' => __('Instagram Master lets your show your latest Instagram photos and View on Instagram Button inside any widget position. ', 'Instagram Master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'techgasp_instagrammaster_widget' );
	$this->WP_Widget( 'techgasp_instagrammaster_widget', __('Instagram Master', 'instagram master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $instagramsize;
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

		//Display View on Instagram Button
	if ( $show_instagrambutton )
		echo '<a href="http://instagram.com/'.$username.'?ref=badge" class="ig-b- ig-b-v-24" target="_blank"><img src="//badges.instagram.com/static/images/ig-badge-view-24.png" alt="Instagram" /></a>';
	
	echo $after_widget;
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
	$defaults = array( 'name' => __('Instagram Master', 'instagram master'), 'title' => true, 'show_instagrambutton' => false, 'username' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
	<hr>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'instagram master'); ?></b></label></br>
	</p>
	<hr>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['show_instagrambutton'], true ); ?> id="<?php echo $this->get_field_id( 'show_instagrambutton' ); ?>" name="<?php echo $this->get_field_name( 'show_instagrambutton' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_instagrambutton' ); ?>"><b><?php _e('View on Instagram Button', 'instagram master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Instagram Username:', 'instagram master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:auto;" />
	</p>
	<hr>
	<p>Instagram Photo Display Options. Upgrade to Advanced Version.</p>
	<hr>
	<p>You have <b>Instagram Master Lite Version</b>. Upgrade to Advanced Version.</p>
	<p><a class="button-primary" href="http://wordpress.techgasp.com/instagram-master/" target="_blank" title="Instagram Master Advanced Version">Instagram Master Advanced Version</a></p>
	<?php
	}
 }
?>
