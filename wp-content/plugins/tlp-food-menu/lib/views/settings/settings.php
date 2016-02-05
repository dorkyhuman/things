<?php
	global $TLPfoodmenu;
	$settings = get_option($TLPfoodmenu->options['settings']);
?>
<div class="wrap">
	<div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
	<h2><?php _e('TLP Food Menu Settings', TLP_FOOD_MENU_SLUG); ?></h2>
	<form id="tlp-settings" onsubmit="tlpFmSettingsUpdate(this); return false;">

		<div id="tabs">
		  <ul>
		    <li><a href="#general"><?php _e('General', TLP_FOOD_MENU_SLUG); ?></a></li>
		    <li><a href="#others"><?php _e('Others', TLP_FOOD_MENU_SLUG); ?></a></li>
		  </ul>
		  <div id="general">
		    <?php
		    	 $TLPfoodmenu->render('settings.general', array('general' => @$settings['general']));
		    ?>
		  </div>
		  <div id="others">
		    <?php
		    	 $TLPfoodmenu->render('settings.others', array('others' => @$settings['others']));
		    ?>
		  </div>
		</div>
		<p class="submit"><input type="submit" name="submit" id="tlpSaveButton" class="button button-primary" value="<?php _e('Save Changes', TLP_FOOD_MENU_SLUG); ?>"></p>

		<?php wp_nonce_field( $TLPfoodmenu->nonceText(), 'tlp_fm_nonce' ); ?>
	</form>
		<div id="response" class="updated"></div>

	<div class="tlp-help">
		<p style="font-weight: bold"><?php _e('Short Code', TLP_FOOD_MENU_SLUG );?> :</p>
		<code>[foodmenu]</code><br>
		<code>[foodmenu cat="29,24,30"]</code><br>
		<code>[foodmenu orderby="title" order="ASC"]</code><br>
		<code>[foodmenu cat="29" orderby="title" order="ASC"]</code><br>
		<p><?php _e('cat = category id eg. (7,8,95)', TLP_FOOD_MENU_SLUG );?></p>
		<p><?php _e('orderby = title, date, menu_order', TLP_FOOD_MENU_SLUG );?></p>
		<p><?php _e('order = ASC, DESC', TLP_FOOD_MENU_SLUG );?></p>
		<p class="tlp-help-link"><a class="button-primary" href="http://demo.radiustheme.com/wordpress/plugins/food-menu/" target="_blank"><?php _e('Demo', TLP_FOOD_MENU_SLUG );?></a> <a class="button-primary" href="https://radiustheme.com/how-to-setup-and-configure-tlp-food-menu-free-version-for-wordpress/" target="_blank"><?php _e('Documentation', TLP_FOOD_MENU_SLUG );?></a> </p>

	</div>
</div>