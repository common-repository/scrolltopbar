<?php
/*
Plugin Name: ScrollTopBar
Description: Create your own full-height back to top button. You don't need any knowledge in HTML, CSS or JS: the plug-in has many settings for location and style which you can change in just one click.
Author: Roman Sarvarov
Author URI: https://about.me/sarvaroff
Version: 1.02
Text Domain: scrolltopbar
Domain Path: /languages/
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*  Copyright 2017 Roman Sarvarov (email: roman.sarvarov[at]gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$global_scrolltopbar_version = 1.02;
$global_scrolltopbar_dir_url = str_replace( home_url(), "", plugin_dir_url( __FILE__ ) );
$global_scrolltopbar_base = plugin_basename( __FILE__ );

add_action( 'plugins_loaded', 'scrolltopbar_init' );
function scrolltopbar_init() {
	if ( is_admin() ) {
		require_once( plugin_dir_path( __FILE__ ) . 'includes/scrolltopbar-admin.php' );
	}
	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/scrolltopbar-functions.php' );
}

add_action( 'plugins_loaded', 'scrolltopbar_i18n' );
function scrolltopbar_i18n() {
	global $global_scrolltopbar_base;
	load_plugin_textdomain( 'scrolltopbar', false, dirname( $global_scrolltopbar_base ) . '/languages/' );
}

add_action( 'wp_enqueue_scripts', 'scrolltopbar_front_init' );
function scrolltopbar_front_init()
{
	global $global_scrolltopbar_version, $global_scrolltopbar_dir_url;
	
	$settings = scrolltopbar_get_plugin_settings();
	
	// javascript
	wp_enqueue_script('scrolltopbar', $global_scrolltopbar_dir_url . 'assets/js/scripts.min.js', array('jquery'), $global_scrolltopbar_version, true );
	wp_add_inline_script('scrolltopbar', '
	var scrolltopbar_scroll_offset = '.(int)$settings['scrolltopbar_scroll_offset'].';
	var scrolltopbar_fadein_duration = '.(int)$settings['scrolltopbar_fadein_duration'].';
	var scrolltopbar_fadein_instant_on_load = '.((int)$settings['scrolltopbar_fadein_instant_on_load'] == 1 ? 'true' : 'false').';
	var scrolltopbar_allow_user_back = '.((int)$settings['scrolltopbar_allow_user_back'] == 0 ? 'true' : 'false').';
	var scrolltopbar_fadeout_duration = '.(int)$settings['scrolltopbar_fadeout_duration'].';', 'before' );
	
	// css
	if( apply_filters( 'scrolltopbar_css_output', true ) ) {
		wp_enqueue_style( 'scrolltopbar', $global_scrolltopbar_dir_url . 'assets/css/styles.min.css', array(), $global_scrolltopbar_version );
	
		$scrolltopbar_hover_transition = (int)$settings['scrolltopbar_hover_transition'];
		if(!empty((int)$scrolltopbar_hover_transition) && (int)$scrolltopbar_hover_transition > 0) {
			$hover_transition = 'transition:background '.($scrolltopbar_hover_transition / 1000).'s ease-in-out;-webkit-transition:background '.($scrolltopbar_hover_transition / 1000).'s ease-in-out;-o-transition:background '.($scrolltopbar_hover_transition / 1000).'s ease-in-out;';
		}
		
		// icon settings
		$up = 'f077';
		$down = 'f078';
		
		$scrolltopbar_arrowup_icon = $settings['scrolltopbar_arrowup_icon'];
		if(!empty($scrolltopbar_arrowup_icon))
		{
			$up = $scrolltopbar_arrowup_icon;
		}
		
		$scrolltopbar_arrowdown_icon = $settings['scrolltopbar_arrowdown_icon'];
		if(!empty($scrolltopbar_arrowdown_icon))
		{
			$down = $scrolltopbar_arrowdown_icon;
		}
			
		// custom
		$scrolltopbar_optional_css = ".scrolltopbar{background:".$settings['scrolltopbar_background_color'].";opacity:".($settings['scrolltopbar_opacity'] / 100).";width:".(int)$settings['scrolltopbar_width']."px;color:".$settings['scrolltopbar_color'].";top:".(int)$settings['scrolltopbar_top_offset']."px;".((int)$settings['scrolltopbar_position'] == 0 ? 'left' : 'right').":".(int)$settings['scrolltopbar_horizontal_offset']."px;".$hover_transition."}.scrolltopbar>b>i.icon-up:before{content:'\\".$up."';}.scrolltopbar>b>i.icon-down:before{content:'\\".$down."';}.scrolltopbar b{".((int)$settings['scrolltopbar_text_position'] == 0 ? 'top' : 'bottom').":".(int)$settings['scrolltopbar_text_offset']."px;}.scrolltopbar i{display:".((int)$settings['scrolltopbar_caption_position'] == 0 ? 'block' : 'inline').";font-size:".(int)$settings['scrolltopbar_arrow_size']."px;line-height:".(int)$settings['scrolltopbar_arrow_size']."px;}.scrolltopbar u{margin-".((int)$settings['scrolltopbar_caption_position'] == 0 ? 'top' : 'left').": ".((int)$settings['scrolltopbar_text_distance'] ? (int)$settings['scrolltopbar_text_distance'] : 0)."px;font-family:'".$settings['scrolltopbar_caption_font']."';font-size:".(int)$settings['scrolltopbar_caption_size']."px;display:".((int)$settings['scrolltopbar_caption_position'] == 0 ? 'block' : 'inline;').";}.scrolltopbar:hover{background: ".$settings['scrolltopbar_background_color_on_hover'].";}";

		if(!empty((int)$settings['scrolltopbar_make_smaller']) && (int)$settings['scrolltopbar_make_smaller'] > 0 && !empty((int)$settings['scrolltopbar_make_smaller_width']) && (int)$settings['scrolltopbar_make_smaller_width'] > 0)
		{
			$scrolltopbar_optional_css .= '@media only screen and (max-width:'.(int)$settings['scrolltopbar_make_smaller'].'px){.scrolltopbar{width:75px;}.scrolltopbar u{display: none;}}';
		}

		if(!empty((int)$settings['scrolltopbar_hide']) && (int)$settings['scrolltopbar_hide'] > 0)
		{
			$scrolltopbar_optional_css .= '@media only screen and (max-width:'.(int)$settings['scrolltopbar_hide'].'px){.scrolltopbar{'.((int)$settings['scrolltopbar_hide_lite'] == 0 ? 'display:none!important;' : 'width:50px;height:50px;bottom:20px;right:20px!important;left:auto!important;border-radius: '.(int)$settings['scrolltopbar_hide_lite_border_radius'].'px;top:auto;').'}.scrolltopbar b{bottom:auto;padding:15px;}.scrolltopbar i{font-size:20px;line-height:20px;}}';
		}
		
		if(!empty($settings['scrolltopbar_custom_css']))
		{
			$custom_css = $settings['scrolltopbar_custom_css'];
			
			// minify css
			$minify = apply_filters( 'scrolltopbar_minify_css', true );

			if ( $minify ) {
				$custom_css = str_replace( array("\n","\r"),'', $custom_css );
				$custom_css = preg_replace( '!\s+!',' ', $custom_css );
				$custom_css = str_replace( array(' {',' }','{ ','; '),array('{','}','{',';'), $custom_css );
			}
			
			if( isset( $custom_css ) ) $scrolltopbar_optional_css .= $custom_css;
		}

		wp_add_inline_style( 'scrolltopbar', $scrolltopbar_optional_css );
	}
}

add_action( 'wp_footer', 'scrolltopbar_container', 1);
function scrolltopbar_container() { 

	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_text');

	$container = '<div class="scrolltopbar"><b><i class="icon-up"></i>'.($settings ? '<u>' . $settings . '</u>' : '').'</b></div>';
	
	echo apply_filters( 'scrolltopbar_container_output', $container );

}

add_filter( 'script_loader_tag', function ( $tag, $handle ) {    
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_script_loading');
	
	if ( in_array($settings, array(1, 2)) && !is_admin() && $handle == 'scrolltopbar' ) {
		if($settings == 1)
		{
			return str_replace( ' src', ' async src', $tag );
		}
		elseif($settings == 2)
		{
			return str_replace( ' src', ' defer src', $tag );
		}
	}
	
	return $tag;
}, 10, 2);


add_filter( 'plugin_action_links_' . $global_scrolltopbar_base, 'scrolltopbar_settings_link' );
function scrolltopbar_settings_link( $links ) {
    $page = '<a href="' . admin_url( 'options-general.php?page=scrolltopbar' ) .'">'.esc_html__( 'Settings', 'scrolltopbar' ).'</a>';
    
	array_unshift( $links, $page );
    return $links;
}