<?php
/**
 * Plugin Name: Arter Plugin
 * Plugin URI: https://bslthemes.com/arter-wp/
 * Description: This plugin it's designed for Arter Theme
 * Version: 1.0.5
 * Author: beshleyua
 * Author URI: https://bslthemes.com/
 * Text Domain: arter-plugin
 * Domain Path: /languages/
 * License: http://www.gnu.org/licenses/gpl.html
 */

/* Load plugin text-domain */
function arter_plugin_load_textdomain() {
	load_plugin_textdomain( 'arter-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'arter_plugin_load_textdomain' );

/* Custom Post Types */
require plugin_dir_path( __FILE__ ) . 'custom-post-types.php';

/* ACF arter fields extention */
require plugin_dir_path( __FILE__ ) . 'acf-ext/acf-ui-google-font/acf-ui-google-font.php';

/**
 * Include Elementor Functions
 */
require_once plugin_dir_path( __FILE__ ) . 'elementor/functions.php';

/* Social Share */
require plugin_dir_path( __FILE__ ) . '/social-share/social-share.php';

/**
 * Enabled Custom Post Type Elementor Supports
 */
function arter_elementor_cpt_support() {
    $cpt_support = get_option( 'elementor_cpt_support' );

	if( ! $cpt_support ) {
	    $cpt_support = [ 'page', 'post', 'portfolio' ];
	    update_option( 'elementor_cpt_support', $cpt_support );
	} else if( ! in_array( 'portfolio', $cpt_support ) ) {
	    $cpt_support[] = 'portfolio';
	    update_option( 'elementor_cpt_support', $cpt_support );
	}
}
function arter_elementor_disable_fonts_and_colors() {
	$color_schemes = get_option( 'elementor_disable_color_schemes' );
	$typography_schemes = get_option( 'elementor_disable_typography_schemes' );
	$global_image_lightbox = get_option( 'elementor_global_image_lightbox' );

	if( ! $color_schemes ) {
	    update_option( 'elementor_disable_color_schemes', 'yes' );
	}
	if( ! $typography_schemes ) {
	    update_option( 'elementor_disable_typography_schemes', 'yes' );
	}
	if( $global_image_lightbox == 'yes' ) {
	    update_option( 'elementor_global_image_lightbox', 'no' );
	}	
}

/* Update permalink structure when plugin is activated */
function arter_plugin_activate() {
	update_option( 'rewrite_rules', '' );
	arter_elementor_cpt_support();
	arter_elementor_disable_fonts_and_colors();
}
function arter_plugin_deactivate() {
	update_option( 'rewrite_rules', '' );
}

register_activation_hook( __FILE__, 'arter_plugin_activate' );
register_deactivation_hook( __FILE__, 'arter_plugin_deactivate' );

?>