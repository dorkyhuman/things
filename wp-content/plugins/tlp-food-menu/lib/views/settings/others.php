<?php
	$css = (@$others['css'] ? $others['css'] : null);
?>
<div class="tab-content">
	<div class='field-holder'>
		<div class="label-holder">
			<label for=""><?php _e('Custom CSS', TLP_FOOD_MENU_SLUG); ?></label>
		</div>
		<div class="field">
			<textarea name="others[css]" cols="40" rows="10"><?php echo (@$others['css'] ? @$others['css'] : null); ?></textarea>
		</div>
	</div>

</div>
