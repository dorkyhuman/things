<?php

/**
 * @package TPL_FOOD_MENU
 * @version 1.0
 */

/*
Plugin Name: TLP Food Menu
Plugin URI: http://demo.radiustheme.com/wordpress/plugins/food-menu/
Description: Fully responsive and mobile friendly WP food menu display plugin for restaurant, cafes, bars, coffee house, fast food.
Author: RadiusTheme
Version: 1.1
Author URI: https://radiustheme.com/
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
define('TLP_FOOD_MENU_VERSION', '1.0');
define('TLP_FOOD_MENU_TITLE', 'TLP Food Menu');
define('TLP_FOOD_MENU_SLUG', 'tlp-food-menu');
define('TLP_FOOD_MENU_PLUGIN_PATH', dirname(__FILE__));
define('TLP_FOOD_MENU_PLUGIN_ACTIVE_FILE_NAME', __FILE__);
define('TLP_FOOD_MENU_PLUGIN_URL', plugins_url('', __FILE__));
define('TLP_FOOD_MENU_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages');

require ('lib/init.php');

