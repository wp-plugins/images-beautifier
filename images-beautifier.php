<?php
/*
 * Plugin Name: Images Beautifier
 * Plugin URI: http://wordpress.org/extend/plugins/images-beautifier/
 * Description: The easiest way to beautify your images with simple shortcode.
 * Version: 1.1
 * Author: Satrya
 * Author URI: http://satrya.me
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @author    Satrya
 * @copyright Copyright (c) 2013, Satrya
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Images_Beautifier {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		add_action( 'init', array( &$this, 'init' ) );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 1.0
	 */
	public function constants() {

		define( 'IB_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

	}

	/**
	 * Sets up actions/filters.
	 *
	 * @since 1.0
	 */
	public function init() {

		/* Enqueue stylesheets on 'wp_enqueue_scripts'. */
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_styles' ) );

		/* Register shortcodes. */
		add_shortcode( 'image', array( &$this, 'setup_shortcode' ) );

		/* Make text widgets shortcode aware. */
		add_filter( 'widget_text', 'do_shortcode' );

	}

	/**
	 * Enqueue stylesheet.
	 *
	 * @since 1.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'images-beautifier-style', IB_URI . 'images.css', false, '1.0' );
	}

	/**
	 * Setup the image shortcode.
	 *
	 * @since 1.0
	 */
	public function setup_shortcode( $atts, $content = "" ) {
		extract( shortcode_atts( array(
			'type'   => 'normal'
	    ), $atts) );
	
		return '<span class="img-beautifier img-' . sanitize_html_class( $type ) . '">' . $content . '</span>';
	}

}

new Images_Beautifier();
?>