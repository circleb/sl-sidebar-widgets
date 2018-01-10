<?php
/*
Plugin Name: SustainLife Sidebar Widgets
Description: Widgets for display in sidebars on the front-end
Version: 1.0.2
Author: Matthew Pressly
*/

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (is_admin()) {
	// require_once dirname(__FILE__) . '/includes/somefile.php';
}

require_once('include/teacher-bio.php');
require_once('include/testimonials.php');

add_action( 'widgets_init', 'slsw_register_widgets' );
function slsw_register_widgets() {
	register_widget( 'SLSW_Teacher_Bio' );
	register_widget( 'SLSW_Class_Testimonials' );
}

add_action('wp_enqueue_scripts', 'slsw_add_css');
function slsw_add_css() {
	wp_register_style('slsw-style', plugins_url('style.css', __FILE__));
	wp_enqueue_style('slsw-style');
}


?>
