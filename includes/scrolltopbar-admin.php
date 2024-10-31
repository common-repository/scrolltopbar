<?php
add_action('admin_menu', 'scrolltopbar_admin_menu');

function scrolltopbar_admin_menu()
{
	$settings = add_options_page( esc_html__( 'ScrollTopBar Settings', 'scrolltopbar' ), 'ScrollTopBar', 'manage_options', 'scrolltopbar', 'scrolltopbar_settings');
	if (!$settings) {
		return;
	}

	add_action('load-' . $settings, 'scrolltopbar_admin_styles');
}

function scrolltopbar_admin_styles()
{
	global $global_scrolltopbar_version, $global_scrolltopbar_dir_url;
	wp_enqueue_style('scrolltopbar', $global_scrolltopbar_dir_url . 'assets/css/admin-styles.css', array() , $global_scrolltopbar_version);
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('wp-color-picker-alpha', $global_scrolltopbar_dir_url . 'assets/js/wp-color-picker-alpha.min.js', array(
		'wp-color-picker'
	) , '1.0.0', true);
}

add_action('admin_init', 'scrolltopbar_register_settings');

function scrolltopbar_register_settings()
{
	register_setting('scrolltopbar_settings', 'scrolltopbar_plugin_settings', 'scrolltopbar_plugin_settings_validate');
}

function scrolltopbar_settings()
{ ?>
	<div class="wrap">

		<h2 class="scrolltopbar-title"><?php esc_html_e( 'ScrollTopBar Settings', 'scrolltopbar' ); ?></h2>
		
		<div id="post-body">

			<div id="post-body-content" class="scrolltopbar-settings">
				<form method="post" action="options.php">
					<?php
	settings_fields('scrolltopbar_settings'); ?>
					<?php
	do_settings_sections('scrolltopbar'); ?>
					<?php
	submit_button(); ?>
				</form>
			</div>

		</div>

		<br class="clear">

	</div>
	

	<?php
}

add_action('admin_init', 'scrolltopbar_setting_sections_fields');

function scrolltopbar_setting_sections_fields()
{
	add_settings_section('ctb_general', esc_html__( 'General Settings', 'scrolltopbar' ), '__return_false', 'scrolltopbar');
	add_settings_field('scrolltopbar_position', esc_html__( 'Position', 'scrolltopbar' ), 'scrolltopbar_position_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_text_position', esc_html__( 'Position of elements', 'scrolltopbar' ), 'scrolltopbar_text_position_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_top_offset', esc_html__( 'Top offset', 'scrolltopbar' ), 'scrolltopbar_top_offset_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_horizontal_offset', esc_html__( 'Horizontal offset', 'scrolltopbar' ), 'scrolltopbar_horizontal_offset_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_scroll_offset', esc_html__( 'Scroll distance', 'scrolltopbar' ), 'scrolltopbar_scroll_offset_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_text', esc_html__( 'Text', 'scrolltopbar' ), 'scrolltopbar_text_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_text_distance', esc_html__( 'Distance between text & arrow', 'scrolltopbar' ), 'scrolltopbar_text_distance_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_fadein_duration', esc_html__( 'Fade-in duration', 'scrolltopbar' ), 'scrolltopbar_fadein_duration_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_fadeout_duration', esc_html__( 'Fade-out duration', 'scrolltopbar' ), 'scrolltopbar_fadeout_duration_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_allow_user_back', esc_html__( 'Back to bottom', 'scrolltopbar' ), 'scrolltopbar_allow_user_back_field', 'scrolltopbar', 'ctb_general');
	add_settings_field('scrolltopbar_script_loading', esc_html__( 'Script loading', 'scrolltopbar' ), 'scrolltopbar_script_loading_field', 'scrolltopbar', 'ctb_general');
	add_settings_section('ctb_visual', esc_html__( 'Style Settings', 'scrolltopbar' ), '__return_false', 'scrolltopbar');
	add_settings_field('scrolltopbar_width', esc_html__( 'Width', 'scrolltopbar' ), 'scrolltopbar_width_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_opacity', esc_html__( 'Opacity', 'scrolltopbar' ), 'scrolltopbar_opacity_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_arrowup_icon', esc_html__( 'Up arrow', 'scrolltopbar' ), 'scrolltopbar_arrowup_icon_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_arrowdown_icon', esc_html__( 'Down arrow', 'scrolltopbar' ), 'scrolltopbar_arrowdown_icon_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_background_color', esc_html__( 'Background color & opacity', 'scrolltopbar' ), 'scrolltopbar_background_color_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_hover_transition', esc_html__( 'Smooth hover duration', 'scrolltopbar' ), 'scrolltopbar_hover_transition_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_text_offset', esc_html__( 'Elements offset', 'scrolltopbar' ), 'scrolltopbar_text_offset_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_color', esc_html__( 'Elements color', 'scrolltopbar' ), 'scrolltopbar_color_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_arrow_size', esc_html__( 'Arrow size', 'scrolltopbar' ), 'scrolltopbar_arrow_size_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_caption_size', esc_html__( 'Text size', 'scrolltopbar' ), 'scrolltopbar_caption_size_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_caption_position', esc_html__( 'Text position', 'scrolltopbar' ), 'scrolltopbar_caption_position_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_caption_font', esc_html__( 'Text font', 'scrolltopbar' ), 'scrolltopbar_caption_font_field', 'scrolltopbar', 'ctb_visual');
	add_settings_field('scrolltopbar_custom_css', esc_html__( 'Custom CSS styles', 'scrolltopbar' ), 'scrolltopbar_custom_css_field', 'scrolltopbar', 'ctb_visual');
	add_settings_section('ctb_responsive', esc_html__( 'Responsive Settings', 'scrolltopbar' ), '__return_false', 'scrolltopbar');
	add_settings_field('scrolltopbar_make_smaller', esc_html__( 'Make smaller', 'scrolltopbar' ), 'scrolltopbar_make_smaller_field', 'scrolltopbar', 'ctb_responsive');
	add_settings_field('scrolltopbar_hide', esc_html__( 'Hide', 'scrolltopbar' ), 'scrolltopbar_hide_field', 'scrolltopbar', 'ctb_responsive');
	add_settings_field('scrolltopbar_hide_lite', esc_html__( 'Show button', 'scrolltopbar' ), 'scrolltopbar_hide_lite_field', 'scrolltopbar', 'ctb_responsive');
}

function scrolltopbar_position_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_position');
?>
	<fieldset>
		<p>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_position]" value="0" <?php
	checked(0, $settings); ?> />
				<?php esc_html_e( 'Left', 'scrolltopbar' ); ?>
			</label>
			<br/>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_position]" value="1" <?php
	checked(1, $settings); ?> />
				<?php esc_html_e( 'Right', 'scrolltopbar' ); ?>
			</label>
		</p>
	</fieldset>

<?php
}

function scrolltopbar_text_position_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_text_position');
?>
	<fieldset>
		<p>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_text_position]" value="0" <?php
	checked(0, $settings); ?> />
				<?php esc_html_e( 'Top', 'scrolltopbar' ); ?>
			</label>
			<br/>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_text_position]" value="1" <?php
	checked(1, $settings); ?> />
				<?php esc_html_e( 'Bottom', 'scrolltopbar' ); ?>
			</label>
		</p>
	</fieldset>

<?php
}

function scrolltopbar_top_offset_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_top_offset');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_top_offset]" type="number" min="0" id="scrolltopbar_top_offset" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	
<?php
}

function scrolltopbar_horizontal_offset_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_horizontal_offset');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_horizontal_offset]" type="number" min="0" id="scrolltopbar_horizontal_offset" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	
<?php
}

function scrolltopbar_scroll_offset_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_scroll_offset');
?>

	<label><?php esc_html_e( 'Show ScrollTopBar after scrolling', 'scrolltopbar' ); ?>
	<input name="scrolltopbar_plugin_settings[scrolltopbar_scroll_offset]" type="number" min="0" id="scrolltopbar_scroll_offset" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	</label>
	<p class="description"><?php esc_html_e( '0 – is always visible', 'scrolltopbar' ); ?></p>
<?php
}

function scrolltopbar_text_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_text');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_text]" type="text" id="scrolltopbar_text" value="<?php
	echo $settings; ?>" />
<?php
}

function scrolltopbar_text_distance_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_text_distance');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_text_distance]" type="number" min="0" id="scrolltopbar_text_distance" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
<?php
}

function scrolltopbar_fadein_duration_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_fadein_duration');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_fadein_duration]" type="number" min="0" step="100" max="1000" id="scrolltopbar_fadein_duration" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'ms', 'scrolltopbar' ); ?>
	<p class="description"><?php esc_html_e( '0 – disable fade-in effect', 'scrolltopbar' ); ?></p>
<?php
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_fadein_instant_on_load');
?>
	
	<label class="scrolltopbar_margin_top_15px">
	<input name="scrolltopbar_plugin_settings[scrolltopbar_fadein_instant_on_load]" type="checkbox" id="scrolltopbar_fadein_instant_on_load" value="1" <?php
	checked(1, $settings); ?> /><?php esc_html_e( 'Disable fade-in effect on page load', 'scrolltopbar' ); ?>
	</label>
	
<?php
}

function scrolltopbar_fadeout_duration_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_fadeout_duration');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_fadeout_duration]" type="number" min="0" step="100" max="1000" id="scrolltopbar_fadeout_duration" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'ms', 'scrolltopbar' ); ?>
	<p class="description"><?php esc_html_e( '0 – disable fade-out effect', 'scrolltopbar' ); ?></p>
<?php
}

function scrolltopbar_allow_user_back_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_allow_user_back');
?>
	<fieldset>
		<p>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_allow_user_back]" value="0" <?php
	checked(0, $settings); ?> />
				<?php esc_html_e( 'Yes', 'scrolltopbar' ); ?>
			</label>
			<br/>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_allow_user_back]" value="1" <?php
	checked(1, $settings); ?> />
				<?php esc_html_e( 'No', 'scrolltopbar' ); ?>
			</label>
		</p>
	</fieldset>

<?php
}

function scrolltopbar_script_loading_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_script_loading');
?>

	<select name="scrolltopbar_plugin_settings[scrolltopbar_script_loading]" id="scrolltopbar_script_loading">
		<option value="0" <?php
	selected(0, $settings); ?>><?php esc_html_e( 'Normal', 'scrolltopbar' ); ?></option>
		<option value="1" <?php
	selected(1, $settings); ?>><?php esc_html_e( 'Async', 'scrolltopbar' ); ?></option>
		<option value="2" <?php
	selected(2, $settings); ?>><?php esc_html_e( 'Defer', 'scrolltopbar' ); ?></option>
	</select>
	<p class="description"><?php esc_html_e( "Do not change this unless you know what you're doing", 'scrolltopbar' ); ?></p>
<?php
}

function scrolltopbar_width_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_width');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_width]" type="number" min="75" id="scrolltopbar_width" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	
<?php
}

function scrolltopbar_opacity_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_opacity');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_opacity]" type="number" min="5" max="100" step="5" id="scrolltopbar_opacity" value="<?php
	echo (int)$settings; ?>" class="small-text" /> %
	
<?php
}

function scrolltopbar_arrowup_icon_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_arrowup_icon');
?>
	<fieldset class="arrow-icon-select">
		<p>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="f077" <?php
	checked('f077', $settings); ?> />
				<i class="arrow-style-icon f077"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="e800" <?php
	checked('e800', $settings); ?> />
				<i class="arrow-style-icon e800"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="f0aa" <?php
	checked('f0aa', $settings); ?> />
				<i class="arrow-style-icon f0aa"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="f148" <?php
	checked('f148', $settings); ?> />
				<i class="arrow-style-icon f148"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="e802" <?php
	checked('e802', $settings); ?> />
				<i class="arrow-style-icon e802"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="e804" <?php
	checked('e804', $settings); ?> />
				<i class="arrow-style-icon e804"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="e805" <?php
	checked('e805', $settings); ?> />
				<i class="arrow-style-icon e805"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="e807" <?php
	checked('e807', $settings); ?> />
				<i class="arrow-style-icon e807"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="e809" <?php
	checked('e809', $settings); ?> />
				<i class="arrow-style-icon e809"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="e80b" <?php
	checked('e80b', $settings); ?> />
				<i class="arrow-style-icon e80b"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowup_icon]" value="e80d" <?php
	checked('e80d', $settings); ?> />
				<i class="arrow-style-icon e80d"></i>
			</label>
		</p>
	</fieldset>
<?php
}

function scrolltopbar_arrowdown_icon_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_arrowdown_icon');
?>
	<fieldset class="arrow-icon-select">
		<p>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="f078" <?php
	checked('f078', $settings); ?> />
				<i class="arrow-style-icon f078"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="e801" <?php
	checked('e801', $settings); ?> />
				<i class="arrow-style-icon e801"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="f0ab" <?php
	checked('f0ab', $settings); ?> />
				<i class="arrow-style-icon f0ab"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="f149" <?php
	checked('f149', $settings); ?> />
				<i class="arrow-style-icon f149"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="e803" <?php
	checked('e803', $settings); ?> />
				<i class="arrow-style-icon e803"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="e804" <?php
	checked('e804', $settings); ?> />
				<i class="arrow-style-icon e804"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="e806" <?php
	checked('e806', $settings); ?> />
				<i class="arrow-style-icon e806"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="e808" <?php
	checked('e808', $settings); ?> />
				<i class="arrow-style-icon e808"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="e80a" <?php
	checked('e80a', $settings); ?> />
				<i class="arrow-style-icon e80a"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="e80c" <?php
	checked('e80c', $settings); ?> />
				<i class="arrow-style-icon e80c"></i>
			</label><br />

			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_arrowdown_icon]" value="e80e" <?php
	checked('e80e', $settings); ?> />
				<i class="arrow-style-icon e80e"></i>
			</label>
		</p>
	</fieldset>
<?php
}

function scrolltopbar_background_color_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_background_color');
?>
	
	<fieldset>
		<p>
			<input type="text" class="color-picker" data-alpha="true" data-default-color="rgba(0,0,0,0.2)" name="scrolltopbar_plugin_settings[scrolltopbar_background_color]" id="scrolltopbar_background_color" value="<?php
	echo sanitize_text_field($settings); ?>" />
			<p class="description"><?php esc_html_e( 'Normal', 'scrolltopbar' ); ?></p>
		</p>
	</fieldset>
	
<?php
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_background_color_on_hover');
?>
	<fieldset class="scrolltopbar_margin_top_15px">
		<p>
			<input type="text" class="color-picker" data-alpha="true" data-default-color="rgba(0,0,0,0.3)" name="scrolltopbar_plugin_settings[scrolltopbar_background_color_on_hover]" id="scrolltopbar_background_color_on_hover" value="<?php
	echo sanitize_text_field($settings); ?>" />
			<p class="description"><?php esc_html_e( 'On hover', 'scrolltopbar' ); ?></p>
		</p>
	</fieldset>

<?php
}

function scrolltopbar_hover_transition_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_hover_transition');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_hover_transition]" type="number" min="0" step="50" max="500" id="scrolltopbar_hover_transition" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'ms', 'scrolltopbar' ); ?>
	<p class="description"><?php esc_html_e( '0 – disable smooth effect', 'scrolltopbar' ); ?></p>
<?php
}

function scrolltopbar_text_offset_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_text_offset');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_text_offset]" type="number" min="0" id="scrolltopbar_text_offset" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	
<?php
}

function scrolltopbar_color_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_color');
?>
	
	<fieldset>
		<p>
			<input type="text" class="color-picker" data-alpha="false" data-default-color="#000000" name="scrolltopbar_plugin_settings[scrolltopbar_color]" id="scrolltopbar_color" value="<?php
	echo $settings; ?>" />
		</p>
	</fieldset>

<?php
}

function scrolltopbar_arrow_size_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_arrow_size');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_arrow_size]" type="number" min="0" max="100" id="scrolltopbar_arrow_size" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	<p class="description"><?php esc_html_e( "0 – don't show the arrow", 'scrolltopbar' ); ?></p>
	
<?php
}

function scrolltopbar_caption_size_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_caption_size');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_caption_size]" type="number" min="0" max="30" id="scrolltopbar_caption_size" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	
<?php
}

function scrolltopbar_caption_position_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_caption_position');
?>

	<fieldset>
		<p>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_caption_position]" value="0" <?php
	checked(0, $settings); ?> />
				<?php esc_html_e( 'Under the arrow', 'scrolltopbar' ); ?>
			</label>
			<br/>
			<label>
				<input type="radio" name="scrolltopbar_plugin_settings[scrolltopbar_caption_position]" value="1" <?php
	checked(1, $settings); ?> />
				<?php esc_html_e( 'To the right of the arrow', 'scrolltopbar' ); ?>
			</label>
		</p>
	</fieldset>
	
<?php
}

function scrolltopbar_caption_font_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_caption_font');
?>

	<input name="scrolltopbar_plugin_settings[scrolltopbar_caption_font]" type="text" id="scrolltopbar_caption_font" value="<?php
	echo $settings; ?>" />
<?php
}

function scrolltopbar_custom_css_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_custom_css');
?>

	<textarea name="scrolltopbar_plugin_settings[scrolltopbar_custom_css]" id="scrolltopbar_custom_css" cols="50" rows="12"><?php echo $settings; ?></textarea>
	
<?php
}

function scrolltopbar_make_smaller_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_make_smaller_width');
?>

	<label><?php esc_html_e( "Make ScrollTopBar's width to", 'scrolltopbar' ); ?> 
	<input name="scrolltopbar_plugin_settings[scrolltopbar_make_smaller_width]" type="number" min="0" step="5" id="scrolltopbar_make_smaller_width" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?></label><?php
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_make_smaller');
?><label> <?php esc_html_e( "if the user's screen is less than", 'scrolltopbar' ); ?> 
	<input name="scrolltopbar_plugin_settings[scrolltopbar_make_smaller]" type="number" min="0" id="scrolltopbar_make_smaller" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	</label>
	<p class="description"><?php esc_html_e( "0 – don't make ScrollTopBar smaller", 'scrolltopbar' ); ?></p>
	
<?php
}

function scrolltopbar_hide_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_hide');
?>

	<label><?php esc_html_e( "Hide ScrollTopBar if the user's screen is less than", 'scrolltopbar' ); ?> 
	<input name="scrolltopbar_plugin_settings[scrolltopbar_hide]" type="number" min="0" step="50" id="scrolltopbar_hide" value="<?php
	echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	</label>
	
	<p class="description"><?php esc_html_e( "0 – don't hide ScrollTopBar", 'scrolltopbar' ); ?></p>
	
<?php
}

function scrolltopbar_hide_lite_field()
{
	$settings = scrolltopbar_get_plugin_settings('scrolltopbar_hide_lite');
?>

	<label>
	<input name="scrolltopbar_plugin_settings[scrolltopbar_hide_lite]" type="checkbox" id="scrolltopbar_hide_lite" value="1" <?php
	checked(1, $settings); ?> /><?php esc_html_e( 'Show small back to top button instead of hide', 'scrolltopbar' ); ?>
	</label>
<?php 
$settings = scrolltopbar_get_plugin_settings('scrolltopbar_hide_lite_border_radius');
?>
	<label class="scrolltopbar_margin_top_15px">
	<?php esc_html_e( 'Back to top button border radius:', 'scrolltopbar' ); ?> <input name="scrolltopbar_plugin_settings[scrolltopbar_hide_lite_border_radius]" type="number" min="0" step="5" id="scrolltopbar_hide_lite_border_radius" value="<?php echo (int)$settings; ?>" class="small-text" /> <?php esc_html_e( 'px', 'scrolltopbar' ); ?>
	</label>
	
<?php
}

function scrolltopbar_plugin_settings_validate( $settings ) {

	if ( !in_array( $settings['scrolltopbar_position'], array(0, 1) ) )
		$settings['scrolltopbar_position'] = 0;
	
	if ( !in_array( $settings['scrolltopbar_text_position'], array(0, 1) ) )
		$settings['scrolltopbar_text_position'] = 1;
	
	if ( !in_array( $settings['scrolltopbar_allow_user_back'], array(0, 1) ) )
		$settings['scrolltopbar_allow_user_back'] = 0;
	
	if ( !in_array( $settings['scrolltopbar_script_loading'], array(0, 1, 2) ) )
		$settings['scrolltopbar_script_loading'] = 0;
	
	if ( !in_array( $settings['scrolltopbar_arrowup_icon'], array('f077', 'e800', 'f0aa', 'f148', 'e802', 'e804', 'e805', 'e807', 'e809', 'e80b', 'e80d') ) )
		$settings['scrolltopbar_arrowup_icon'] = 'f077';
	
	if ( !in_array( $settings['scrolltopbar_arrowdown_icon'], array('f078', 'e801', 'f0ab', 'f149', 'e803', 'e804', 'e806', 'e808', 'e80a', 'e80c', 'e80e') ) )
		$settings['scrolltopbar_arrowdown_icon'] = 'f078';
	
	if ( !in_array( $settings['scrolltopbar_caption_position'], array(0, 1) ) )
		$settings['scrolltopbar_caption_position'] = 0;
	
	if ( !in_array( $settings['scrolltopbar_hide_lite'], array(0, 1) ) )
		$settings['scrolltopbar_hide_lite'] = 0;
	
	$settings['scrolltopbar_text']                    = sanitize_text_field( $settings['scrolltopbar_text'] );
	$settings['scrolltopbar_caption_font']            = sanitize_text_field( $settings['scrolltopbar_caption_font'] );
	$settings['scrolltopbar_top_offset']              = absint( $settings['scrolltopbar_top_offset'] );
	$settings['scrolltopbar_horizontal_offset']       = absint( $settings['scrolltopbar_horizontal_offset'] );
	$settings['scrolltopbar_scroll_offset']           = absint( $settings['scrolltopbar_scroll_offset'] );
	$settings['scrolltopbar_fadein_duration']         = absint( $settings['scrolltopbar_fadein_duration'] );
	$settings['scrolltopbar_fadeout_duration']        = absint( $settings['scrolltopbar_fadeout_duration'] );
	$settings['scrolltopbar_width']                   = absint( $settings['scrolltopbar_width'] );
	$settings['scrolltopbar_opacity']                 = absint( $settings['scrolltopbar_opacity'] );
	$settings['scrolltopbar_hover_transition']        = absint( $settings['scrolltopbar_hover_transition'] );
	$settings['scrolltopbar_text_offset']             = absint( $settings['scrolltopbar_text_offset'] );
	$settings['scrolltopbar_text_distance']           = absint( $settings['scrolltopbar_text_distance'] );
	$settings['scrolltopbar_arrow_size']              = absint( $settings['scrolltopbar_arrow_size'] );
	$settings['scrolltopbar_caption_size']            = absint( $settings['scrolltopbar_caption_size'] );
	$settings['scrolltopbar_make_smaller_width']      = absint( $settings['scrolltopbar_make_smaller_width'] );
	$settings['scrolltopbar_make_smaller']            = absint( $settings['scrolltopbar_make_smaller'] );
	$settings['scrolltopbar_hide']                    = absint( $settings['scrolltopbar_hide'] );
	$settings['scrolltopbar_hide_lite_border_radius'] = absint( $settings['scrolltopbar_hide_lite_border_radius'] );
	$settings['scrolltopbar_custom_css']              = wp_filter_nohtml_kses( $settings['scrolltopbar_custom_css'] );

	return $settings;
}