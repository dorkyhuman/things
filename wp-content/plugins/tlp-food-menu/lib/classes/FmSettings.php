<?php
if(!class_exists('FmSettings')):
	/**
	*
	*/
	class FmSettings
	{

		function __construct()
		{
			add_action( 'init', array($this, 'tlp_pluginInit') );
			add_action( 'admin_menu' , array($this, 'tlp_food_menu_register'));
			add_action(	'wp_ajax_tlpFmSettingsUpdate', array($this, 'tlpFmSettingsUpdate'));
		}

		function tlp_pluginInit(){
			$this->load_plugin_textdomain();
		}



		function tlpFmSettingsUpdate(){
			global $TLPfoodmenu;

			$error = true;
			if($TLPfoodmenu->verifyNonce()){

				$data = array();
				if($_REQUEST['general']){
					$general['slug'] = (isset($_REQUEST['general']['slug']) ? ($_REQUEST['general']['slug'] ? sanitize_title_with_dashes( $_REQUEST['general']['slug']) : 'food-menu') : 'food-menu');
					$general['character_limit'] = (isset($_REQUEST['general']['character_limit']) ? ($_REQUEST['general']['character_limit'] ? intval( $_REQUEST['general']['character_limit']) : 150) : 150);
					$general['em_display_col'] = ($_REQUEST['general']['em_display_col'] ? esc_attr( $_REQUEST['general']['em_display_col'] ) : 2);
					$general['currency'] = ($_REQUEST['general']['currency'] ? esc_attr( $_REQUEST['general']['currency'] ) : null);
					$general['currency_position'] = ($_REQUEST['general']['currency_position'] ? esc_attr( $_REQUEST['general']['currency_position'] ) : null);
					$data['general'] = $general;
					$TLPfoodmenu->activate();
				}
				if($_REQUEST['others']){
					$others['css'] = ($_REQUEST['others']['css'] ? esc_attr( $_REQUEST['others']['css'] ) : null);
					$data['others'] = $others;
				}
				update_option( $TLPfoodmenu->options['settings'], $data );
				$error = false;
				$msg = __('Settings successfully updated',TLP_FOOD_MENU_SLUG);
			}else{
				$msg = __('Security Error !!',TLP_FOOD_MENU_SLUG);
			}
			$response = array(
				'error'=> $error,
				'msg' => $msg
			);
			wp_send_json( $response );
			die();

		}


		function tlp_food_menu_register() {
			global $TLPfoodmenu;
			$page = add_submenu_page( 'edit.php?post_type='.$TLPfoodmenu->post_type, __('TLP food menu settings',TLP_FOOD_MENU_SLUG), __('Settings',TLP_FOOD_MENU_SLUG), 'administrator', 'tlp_food_menu_settings', array($this, 'tlp_food_menu_settings') );

			add_action('admin_print_styles-' . $page, array( $this,'tlp_style'));
			add_action('admin_print_scripts-'. $page, array( $this,'tlp_script'));

		}

		function tlp_style(){
			global $TLPfoodmenu;
			wp_enqueue_style( 'tlp_fm_jquery_ui_css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' );
			wp_enqueue_style( 'tlp_fm_select_ui_css', $TLPfoodmenu->assetsUrl . 'css/select2.css');
			wp_enqueue_style( 'tpl_port_css_settings', $TLPfoodmenu->assetsUrl . 'css/settings.css');
		}

		function tlp_script(){
			global $TLPfoodmenu;
			wp_enqueue_script( 'tlp_fm_select_ui_js',  $TLPfoodmenu->assetsUrl. 'js/select2.min.js', array('jquery','jquery-ui-tabs',), '', true );
			wp_enqueue_script( 'tpl_port_js_settings',  $TLPfoodmenu->assetsUrl. 'js/settings.js', array('jquery','jquery-ui-tabs',), '', true );
			$nonce = wp_create_nonce( $TLPfoodmenu->nonceText() );
			wp_localize_script( 'tpl_port_js_settings', 'tpl_fm_var', array('tlp_fm_nonce' => $nonce) );
		}

		function tlp_food_menu_settings(){

			global $TLPfoodmenu;

			$TLPfoodmenu->render('settings.settings');
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since 0.1.0
		 */
		public function load_plugin_textdomain() {

			load_plugin_textdomain( TLP_FOOD_MENU_SLUG, FALSE,  TLP_FOOD_MENU_LANGUAGE_PATH );

		}

	}
endif;
