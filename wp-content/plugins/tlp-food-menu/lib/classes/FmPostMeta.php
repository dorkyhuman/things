<?php
if (!class_exists('FmPostMeta')):

    /**
     *
     */
    class FmPostMeta
    {

        function __construct() {
            add_action('add_meta_boxes', array($this, 'food_menu_meta_boxs'));
            add_action('save_post', array($this, 'save_food_meta_data'), 10, 3);
            add_action('admin_print_scripts-post-new.php', array($this, 'tpl_portfolio_script'), 11);
            add_action('admin_print_scripts-post.php', array($this, 'tpl_portfolio_script'), 11);
        }

        function food_menu_meta_boxs() {
            global $TLPfoodmenu;
            add_meta_box('tlp_food_menu_meta_details', __('Food Details', TLP_FOOD_MENU_SLUG), array($this, 'food_menu_meta_option'), $TLPfoodmenu->post_type, 'normal', 'high');
        }

        function food_menu_meta_option($post) {
            global $TLPfoodmenu;
            wp_nonce_field($TLPfoodmenu->nonceText(), 'tlp_fm_nonce');
            $meta = get_post_meta($post->ID);
            $price = !isset($meta['price'][0]) ? '' : $meta['price'][0];

            ?>
			<table class="form-table">

				<tr>
					<td class="team_meta_box_td" colspan="2">
						<label for="price"><?php _e('Price', TLP_FOOD_MENU_SLUG); ?></label>
					</td>
					<td colspan="4">
                        <input min="0" step="0.01" type="number" name="price" id="price" class="tlpfield" value="<?php echo sprintf("%.2f",$price); ?>">
						<p class="description"><?php _e('Insert the price, leave blank if it is free', TLP_FOOD_MENU_SLUG); ?></p>
					</td>
				</tr>
			</table>
			<?php
        }

        function save_food_meta_data($post_id, $post, $update) {

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

            global $TLPfoodmenu;

            if (!wp_verify_nonce(@$_REQUEST['tlp_fm_nonce'], $TLPfoodmenu->nonceText())) return;

            // Check permissions
            if ($_GET['post_type']) {
                if (!current_user_can('edit_' . $_GET['post_type'], $post_id)) return;
            }

            if ($TLPfoodmenu->post_type != $post->post_type) return;

            $meta['price'] = (isset($_POST['price']) ? sanitize_text_field(esc_attr($_POST['price'])) : '');

            foreach ($meta as $key => $value) {
                update_post_meta($post->ID, $key, $value);
            }
        }

        function tpl_portfolio_script() {
            global $post_type, $TLPfoodmenu;
            if ($post_type == $TLPfoodmenu->post_type) {
                $TLPfoodmenu->tlp_style();
                $TLPfoodmenu->tlp_script();
            }
        }
    }
endif;
