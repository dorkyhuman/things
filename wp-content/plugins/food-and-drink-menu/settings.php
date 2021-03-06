<?php

if ( !defined( 'ABSPATH' ) )
	exit;

/**
 * Class to register all settings in the settings panel
 */
class fdmSettings {

	public function __construct() {

		// Call when plugin is initialized on every page load
		add_action( 'init', array( $this, 'load_settings_panel' ) );

		// Add filters on the menu style so we can apply the setting option
		add_filter( 'fdm_menu_args', array( $this, 'set_style' ) );
		add_filter( 'fdm_shortcode_menu_atts', array( $this, 'set_style' ) );
		add_filter( 'fdm_shortcode_menu_item_atts', array( $this, 'set_style' ) );

	}

	/**
	 * Load the admin settings page
	 * @since 1.1
	 * @sa https://github.com/NateWr/simple-admin-pages
	 */
	public function load_settings_panel() {

		require_once('lib/simple-admin-pages/simple-admin-pages.php');

		// Insantiate the Simple Admin Library so that we can add a settings page
		$sap = sap_initialize_library(
			array(
				'version'		=> '2.0.a.7', // Version of the library
				'lib_url'		=> FDM_PLUGIN_URL . '/lib/simple-admin-pages/', // URL path to sap library
			)
		);

		// Create a page for the options under the Settings (options) menu
		$sap->add_page(
			'submenu', 				// Admin menu which this page should be added to
			array(					// Array of key/value pairs matching the AdminPage class constructor variables
				'id'			=> 'food-and-drink-menu-settings',
				'title'			=> __( 'Settings', FDM_TEXTDOMAIN ),
				'menu_title'	=> __( 'Settings', FDM_TEXTDOMAIN ),
				'description'	=> '',
				'capability'	=> 'manage_options',
				'parent_menu'	=> 'edit.php?post_type=fdm-menu'
			)
		);

		// Create a section to choose a default style
		$sap->add_section(
			'food-and-drink-menu-settings',	// Page to add this section to
			array(								// Array of key/value pairs matching the AdminPageSection class constructor variables
				'id'			=> 'fdm-style-settings',
				'title'			=> __( 'Style', FDM_TEXTDOMAIN ),
				'description'	=> __( 'Choose what style you would like to use for your menu.', FDM_TEXTDOMAIN )
			)
		);
		global $fdm_controller;
		$options = array();
		foreach( $fdm_controller->styles as $style ) {
			$options[$style->id] = $style->label;
		}
		$sap->add_setting(
			'food-and-drink-menu-settings',
			'fdm-style-settings',
			'select',
			array(
				'id'			=> 'fdm-style',
				'title'			=> __( 'Style', FDM_TEXTDOMAIN ),
				'description'	=> __( 'Choose the styling for your menus.', FDM_TEXTDOMAIN ),
				'blank_option'	=> false,
				'options'		=> $options
			)
		);

		// Create a section to disable specific features
		$sap->add_section(
			'food-and-drink-menu-settings',	// Page to add this section to
			array(								// Array of key/value pairs matching the AdminPageSection class constructor variables
				'id'			=> 'fdm-enable-settings',
				'title'			=> __( 'Disable Features', FDM_TEXTDOMAIN ),
				'description'	=> __( 'Choose what features of the menu items you wish to disable and hide from the admin interface.', FDM_TEXTDOMAIN )
			)
		);
		$sap->add_setting(
			'food-and-drink-menu-settings',
			'fdm-enable-settings',
			'toggle',
			array(
				'id'			=> 'fdm-disable-price',
				'title'			=> __( 'Price', FDM_TEXTDOMAIN ),
				'label'			=> __( 'Disable all pricing options for menu items.', FDM_TEXTDOMAIN )
			)
		);

		// Create a section for advanced options
		$sap->add_section(
			'food-and-drink-menu-settings',	// Page to add this section to
			array(								// Array of key/value pairs matching the AdminPageSection class constructor variables
				'id'			=> 'fdm-advanced-settings',
				'title'			=> __( 'Advanced Options', FDM_TEXTDOMAIN )
			)
		);
		$sap->add_setting(
			'food-and-drink-menu-settings',
			'fdm-advanced-settings',
			'text',
			array(
				'id'			=> 'fdm-item-thumb-width',
				'title'			=> __( 'Menu Item Photo Width', FDM_TEXTDOMAIN ),
				'description'	=> __( 'The width in pixels of menu item thumbnails automatically generated by WordPress. Leave this field empty to preserve the default (600).', FDM_TEXTDOMAIN )
			)
		);
		$sap->add_setting(
			'food-and-drink-menu-settings',
			'fdm-advanced-settings',
			'text',
			array(
				'id'			=> 'fdm-item-thumb-height',
				'title'			=> __( 'Menu Item Photo Height', FDM_TEXTDOMAIN ),
				'description'	=> __( 'The height in pixels of menu item thumbnails automatically generated by WordPress. Leave this field empty to preserve the default (600).', FDM_TEXTDOMAIN )
			)
		);

		// Create filter so addons can modify the settings page or add new pages
		$sap = apply_filters( 'fdm_settings_page', $sap );
		
		// Backwards compatibility when the sap library went to version 2
		$sap->port_data(2);

		// Register all admin pages and settings with WordPress
		$sap->add_admin_menus();
	}

	/**
	 * Set the style of a menu or menu item before rendering
	 * @since 1.1
	 */
	public function set_style( $args ) {

		$settings = get_option( 'food-and-drink-menu-settings' );
		if ( !$settings['fdm-style'] ) {
			$args['style'] = 'base';
		} else {
			$args['style'] = $settings['fdm-style'];
		}

		return $args;
	}

}
