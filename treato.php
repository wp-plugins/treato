<?php
/*
Plugin Name: Treato WordPress Plugin
Plugin URI: http://treato.com/
Description: Treato travels around the Web to collect and analyze patient written forum and blog posts. The plugin gives access to this new aggregated information.
Version: 1.0.3
Author: Treato
Author URI: http://treato.com/
Author Email: roee@treato.com
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class Treato extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * The widget constructor. Specifies the classname and description, instantiates
	 * the widget, loads localization files, and includes necessary scripts and
	 * styles.
	 */
	function Treato() {
		// Define constnats used throughout the plugin
		$this->init_plugin_constants();
		
		$widget_opts = array (
			'classname' => PLUGIN_NAME, 
			'description' => __('Seek medical information and share personal experiences and insights.', PLUGIN_LOCALE )
		);	
		
		$this->WP_Widget(PLUGIN_SLUG, __(PLUGIN_NAME, PLUGIN_LOCALE), $widget_opts);
		load_plugin_textdomain(PLUGIN_LOCALE, false, dirname(plugin_basename( __FILE__ ) ) . '/lang/' );
		
		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();
		
	} // end constructor

	/*--------------------------------------------------*/
	/* API Functions
	/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance
	 */
	function widget($args, $instance) {
		
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		
		$treato_title = empty($instance['treato_title']) ? '' : apply_filters('treato_title', $instance['treato_title']);
		$treato_search = empty($instance['treato_search']) ? '' : apply_filters('treato_search', $instance['treato_search']);
		$treato_content = empty($instance['treato_content']) ? '' : apply_filters('treato_content', $instance['treato_content']);
		$treato_poweredby = empty($instance['treato_poweredby']) ? '' : apply_filters('treato_poweredby', $instance['treato_poweredby']);
		
		// Display the widget
		include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/widget.php');
		
		echo $after_widget;
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
		$instance['treato_title'] = strip_tags(stripslashes($new_instance['treato_title']));
		$instance['treato_search'] = strip_tags(stripslashes($new_instance['treato_search']));
		$instance['treato_content'] = strip_tags(stripslashes($new_instance['treato_content']));
		$instance['treato_poweredby'] = strip_tags(stripslashes($new_instance['treato_poweredby']));
		
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form($instance) {
		
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'treato_title' => 'Treato',
				'treato_content' => 'search',
				'treato_search' => '',
				'treato_poweredby' => 'false'
			)
		);
		
		$treato_title = strip_tags(stripslashes($new_instance['treato_title']));
		$treato_search = strip_tags(stripslashes($new_instance['treato_search']));
		$treato_content = strip_tags(stripslashes($new_instance['treato_content']));
		$treato_poweredby = strip_tags(stripslashes($new_instance['treato_poweredby']));
		
		// Display the admin form
		include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/admin.php');
		
	} // end form
	
	/*--------------------------------------------------*/
	/* Private Functions
	/*--------------------------------------------------*/
	
	/**
	 * Initializes constants used for convenience throughout 
	 * the plugin.
	 */
	private function init_plugin_constants() {
		
		/**
		* This provides the unique identifier for your plugin used in
		 * localizing the strings used throughout.
		 */
		if(!defined('PLUGIN_LOCALE')) {
			define('PLUGIN_LOCALE', 'treato');
		} // end if
		
		/**
		 * Define this as the name of your plugin. This is what shows
		 * in the Widgets area of WordPress.
		 */
		if(!defined('PLUGIN_NAME')) {
			define('PLUGIN_NAME', 'Treato');
		} // end if
		
		/**
		 * This is the slug of your plugin used in initializing it with
		 * the WordPress API.
		 *
		 * This should also be the directory in which your plugin
		 * resides. Use hyphens.
		 */
		if(!defined('PLUGIN_SLUG')) {
			define('PLUGIN_SLUG', 'treato');
		} // end if
		
	} // end init_plugin_constants
	
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if(is_admin()) {
			//$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/js/admin.js', true);
			$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/admin.css', false);
		} else { 
			//$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/js/widget.js', true);
			//$this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/widget.css', false);
		}
	} // end register_scripts_and_styles
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name			The ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file($name, $file_path, $is_script = false) {
		
		$url = WP_PLUGIN_URL . $file_path;
		$file = WP_PLUGIN_DIR . $file_path;
		
		if(file_exists($file)) {
			if($is_script) {
				wp_register_script($name, $url);
				wp_enqueue_script($name);
			} else {
				wp_register_style($name, $url);
				wp_enqueue_style($name);
			} // end if
		} // end if
		
	} // end load_file
	
} // end class
add_action('widgets_init', create_function('', 'register_widget("Treato");'));
?>