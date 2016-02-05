<?php

if(!class_exists('FmPostTypeRegistrations')):

	class FmPostTypeRegistrations {

		public function __construct() {

			add_action( 'init', array( $this, 'register' ) );
			register_activation_hook(TLP_FOOD_MENU_PLUGIN_ACTIVE_FILE_NAME, array($this, 'activate'));
			register_deactivation_hook(TLP_FOOD_MENU_PLUGIN_ACTIVE_FILE_NAME, array($this, 'deactivate'));
		}
		/**
		 * Initiate registrations of post type and taxonomies.
		 *
		 * @uses food_Post_Type_Registrations::register_post_type()
		 * @uses food_Post_Type_Registrations::register_taxonomy_category()
		 */
		public function register() {
			$this->register_post_type();
			$this->register_taxonomy_category();
		}
		public function activate() {
			flush_rewrite_rules();
		}
		/**
		 * Fired for each blog when the plugin is deactivated.
		 *
		 * @since 0.1.0
		 */
		public function deactivate() {
			flush_rewrite_rules();
		}
		/**
		 * Register the custom post type.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		protected function register_post_type() {
			global $TLPfoodmenu;
			$labels = array(
				'name'               => __( 'TLP Food Menu', TLP_FOOD_MENU_SLUG ),
				'singular_name'      => __( 'TLP Food Menu', TLP_FOOD_MENU_SLUG ),
				'all_items'           => __( 'All Foods', TLP_FOOD_MENU_SLUG ),
				'add_new'            => __( 'Add Food', TLP_FOOD_MENU_SLUG ),
				'add_new_item'       => __( 'Add Food', TLP_FOOD_MENU_SLUG ),
				'edit_item'          => __( 'Edit Food', TLP_FOOD_MENU_SLUG ),
				'new_item'           => __( 'New Food', TLP_FOOD_MENU_SLUG ),
				'view_item'          => __( 'View Food', TLP_FOOD_MENU_SLUG ),
				'search_items'       => __( 'Search Food', TLP_FOOD_MENU_SLUG ),
				'not_found'          => __( 'No Food found', TLP_FOOD_MENU_SLUG ),
				'not_found_in_trash' => __( 'No Food in the trash', TLP_FOOD_MENU_SLUG ),
			);
			$supports = array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'page-attributes'
			);
			$args = array(
				'labels'          => $labels,
				'supports'        => $supports,
				'public'          => true,
				'capability_type' => 'post',
				'rewrite'         => array( 'slug' => $TLPfoodmenu->post_type_slug ),
				'menu_position'   => 20,
				'menu_icon'       => $TLPfoodmenu->assetsUrl .'images/icon-16x16.png',
			);
			register_post_type( $TLPfoodmenu->post_type, $args );
		}
		/**
		 * Register a taxonomy for Team Categories.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */
		protected function register_taxonomy_category() {
			global $TLPfoodmenu;
			$labels = array(
				'name'                       => __( 'Food Categories', TLP_FOOD_MENU_SLUG ),
				'singular_name'              => __( 'Food Category', TLP_FOOD_MENU_SLUG ),
				'menu_name'                  => __( 'Categories', TLP_FOOD_MENU_SLUG ),
				'edit_item'                  => __( 'Edit Category', TLP_FOOD_MENU_SLUG ),
				'update_item'                => __( 'Update Category', TLP_FOOD_MENU_SLUG ),
				'add_new_item'               => __( 'Add New Category', TLP_FOOD_MENU_SLUG ),
				'new_item_name'              => __( 'New Category', TLP_FOOD_MENU_SLUG ),
				'parent_item'                => __( 'Parent Category', TLP_FOOD_MENU_SLUG ),
				'parent_item_colon'          => __( 'Parent Category:', TLP_FOOD_MENU_SLUG ),
				'all_items'                  => __( 'All Categories', TLP_FOOD_MENU_SLUG ),
				'search_items'               => __( 'Search Categories', TLP_FOOD_MENU_SLUG ),
				'popular_items'              => __( 'Popular Categories', TLP_FOOD_MENU_SLUG ),
				'separate_items_with_commas' => __( 'Separate categories with commas', TLP_FOOD_MENU_SLUG ),
				'add_or_remove_items'        => __( 'Add or remove categories', TLP_FOOD_MENU_SLUG ),
				'choose_from_most_used'      => __( 'Choose from the most used  categories', TLP_FOOD_MENU_SLUG ),
				'not_found'                  => __( 'No categories found.', TLP_FOOD_MENU_SLUG ),
			);
			$args = array(
				'labels'            => $labels,
				'public'            => true,
				'show_in_nav_menus' => true,
				'show_ui'           => true,
				'show_tagcloud'     => true,
				'hierarchical'      => true,
				'rewrite'           => array( 'slug' => $TLPfoodmenu->taxonomies['category']),
				'show_admin_column' => true,
				'query_var'         => true,
			);
			register_taxonomy( $TLPfoodmenu->taxonomies['category'], $TLPfoodmenu->post_type, $args );
		}
	}

endif;
