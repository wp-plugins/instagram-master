<?php
/**
Plugin Name: Instagram Master
Plugin URI: http://wordpress.techgasp.com/instagram-master/
Version: 4.3.6
Author: TechGasp
Author URI: http://wordpress.techgasp.com
Text Domain: instagram-master
Description: Instagram Master let's your show your latest Instagram photos and View on Instagram Button inside any widget position.
License: GPL2 or later
*/
/*
Copyright 2013 TechGasp  (email : info@techgasp.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('instagram_master')) :
///////DEFINE ID//////
define('INSTAGRAM_MASTER_ID', 'instagram-master');
///////DEFINE VERSION///////
define( 'instagram_master_VERSION', '4.3.6' );
global $instagram_master_version, $instagram_master_name;
$instagram_master_version = "4.3.6"; //for other pages
$instagram_master_name = "Instagram Master"; //pretty name
if( is_multisite() ) {
update_site_option( 'instagram_master_installed_version', $instagram_master_version );
update_site_option( 'instagram_master_name', $instagram_master_name );
}
else{
update_option( 'instagram_master_installed_version', $instagram_master_version );
update_option( 'instagram_master_name', $instagram_master_name );
}
// HOOK ADMIN
require_once( dirname( __FILE__ ) . '/includes/instagram-master-admin.php');
// HOOK ADMIN IN & UN SHORTCODE
require_once( dirname( __FILE__ ) . '/includes/instagram-master-admin-shortcodes.php');
// HOOK ADMIN WIDGETS
require_once( dirname( __FILE__ ) . '/includes/instagram-master-admin-widgets.php');
// HOOK ADMIN ADDONS
require_once( dirname( __FILE__ ) . '/includes/instagram-master-admin-addons.php');
// HOOK ADMIN UPDATER
require_once( dirname( __FILE__ ) . '/includes/instagram-master-admin-updater.php');
// HOOK WIDGET INSTAGRAM BUTTONS
require_once( dirname( __FILE__ ) . '/includes/instagram-master-widget-buttons.php');

class instagram_master{
//REGISTER PLUGIN
public static function instagram_master_register(){
register_setting(INSTAGRAM_MASTER_ID, 'tsm_quote');
}
public static function content_with_quote($content){
$quote = '<p>' . get_option('tsm_quote') . '</p>';
	return $content . $quote;
}
//SETTINGS LINK IN PLUGIN MANAGER
public static function instagram_master_links( $links, $file ) {
	if ( $file == plugin_basename( dirname(__FILE__).'/instagram-master.php' ) ) {
		$links[] = '<a href="' . admin_url( 'admin.php?page=instagram-master' ) . '">'.__( 'Settings' ).'</a>';
	}

	return $links;
}

public static function instagram_master_updater_version_check(){
global $instagram_master_version;
//CHECK NEW VERSION
$instagram_master_slug = basename(dirname(__FILE__));
$current = get_site_transient( 'update_plugins' );
$instagram_plugin_slug = $instagram_master_slug.'/'.$instagram_master_slug.'.php';
@$r = $current->response[ $instagram_plugin_slug ];
if (empty($r)){
$r = false;
$instagram_plugin_slug = false;
if( is_multisite() ) {
update_site_option( 'instagram_master_newest_version', $instagram_master_version );
}
else{
update_option( 'instagram_master_newest_version', $instagram_master_version );
}
}
if (!empty($r)){
$instagram_plugin_slug = $instagram_master_slug.'/'.$instagram_master_slug.'.php';
@$r = $current->response[ $instagram_plugin_slug ];
if( is_multisite() ) {
update_site_option( 'instagram_master_newest_version', $r->new_version );
}
else{
update_option( 'instagram_master_newest_version', $r->new_version );
}
}
}

//END CLASS
}
if ( is_admin() ){
	add_action('admin_init', array('instagram_master', 'instagram_master_register'));
	add_action('init', array('instagram_master', 'instagram_master_updater_version_check'));
}
add_filter('the_content', array('instagram_master', 'content_with_quote'));
add_filter( 'plugin_action_links', array('instagram_master', 'instagram_master_links'), 10, 2 );
endif;