<?php

// prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Plugin Name: Thirty8 simple "put things on map" plugin
 * Plugin URI: http://thirty8.co.uk
 * Description: Adds a custom post type and other stuff to display items on a map
 * Version: 0.1
 * Author: Mike Ellis / Thirty8 Digital
 */

/* 

DO THIS FIRST: REPLACE each of these with your actual plugin. 
YOU ONLY NEED TO DO THIS ON THIS PAGE - this is a SIMPLE boilerplate!

Thirty8SimpleMap = the friendly plugin name for instance -> Some New Plugin
thirty8-simple-map = the codey plugin name for instance -> some-new-plugin
thirty8_simple_map = codey 2 for instance -> some_new_plugin

THEN: make your ACF fields as you normally would, using the GUI. 

Note that in functions.php is the option to turn off the ACF menu if you need.

Finally, make sure you change the Plugin Name above ^^^ 

GET CODING, MOTHERFUCKER!
	
*/

// Include ACF
if (!class_exists('ACF')) {		
	// ACF not installed already
	require_once('lib/acf/acf.php');
}

// Include ACF fields - add more as needed

include_once('data/acf_plugin_general_settings.php');

// Include functions
include_once('includes/functions.php');
//add_filter('acf/settings/show_admin', '__return_false');

class Thirty8SimpleMap
{

	public function __construct() 
	{
		// Build the settings pages
		add_action( 'admin_menu', array( $this, 'create_thirty8_simple_map_settings_pages' ) );
						
	}
		
	
	//---------------------------------------
	//----- Stuff for plugin menu items -----
		
		public function create_thirty8_simple_map_settings_pages() 
		{
	
			// Add the menu item and page
			$page_title = 'ThePageTitle';	// shown in page title field only 
			$menu_title = 'TheMenuTitle'; 	// visible in menu
			$capability = 'manage_options';
			$slug = 'thirty8-simple-map';
			$callback = array( $this, 'thirty8_simple_map_homepage' );
			$icon = 'dashicons-admin-plugins';
			$position = 100;
		
			// Main menu	
			//add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
			
			// Sub menus - add more as needed
			//add_submenu_page('thirty8-simple-map', 'settings', 'Settings', 'manage_options', 'thirty8-simple-map_settings_page','thirty8_simple_map_settings_page');
			
			//add_submenu_page('theslug', 'thepagetitle', 'submenutitle', 'manage_options', 'subpage_name','subpage_name1');		
			//add_submenu_page('theslug', 'thepagetitle2', 'submenutitle2', 'manage_options', 'subpage_name2','subpage_name2');
	
			// Functions to include sub pages - add more as needed
			function thirty8_simple_map_settings_page()
			{
				//include('admin/settings.php');
			}
			
			/*
			// Additional Pages here
			
				function subpage_name1()
				{
					include('admin/page1.php');
				}
		
				function subpage_name2()
				{
					include('admin/page2.php');
				}
			*/
		
	
		}	
		
		public function thirty8_simple_map_homepage()
		{		
			//include('admin/index.php');
		}		
	
	//-------- End menu items ------------
	
		
	
}

new Thirty8SimpleMap();
?>