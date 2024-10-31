<?php

function scrolltopbar_get_plugin_settings( $option = '' ) {
	$default_settings = array(
		'scrolltopbar_position'  => 0,
		'scrolltopbar_text_position' => 1,
		'scrolltopbar_top_offset' => 0,
		'scrolltopbar_horizontal_offset' => 0,
		'scrolltopbar_scroll_offset' => 1,
		'scrolltopbar_text' => '',
		'scrolltopbar_text_distance' => '',
		'scrolltopbar_fadein_duration' => 300,
		'scrolltopbar_fadein_instant_on_load' => 1,
		'scrolltopbar_fadeout_duration' => 300,
		'scrolltopbar_allow_user_back' => 0,
		'scrolltopbar_script_loading' => 0,
		'scrolltopbar_width' => 125,
		'scrolltopbar_opacity' => 20,
		'scrolltopbar_arrowup_icon' => 'f077',
		'scrolltopbar_arrowdown_icon' => 'f078',
		'scrolltopbar_background_color' => 'rgba(0,0,0,0.2)',
		'scrolltopbar_background_color_on_hover' => 'rgba(0,0,0,0.3)',
		'scrolltopbar_hover_transition' => 250,
		'scrolltopbar_text_offset' => 20,
		'scrolltopbar_color' => '#000000',
		'scrolltopbar_arrow_size' => 20,
		'scrolltopbar_caption_size' => 14,
		'scrolltopbar_caption_position' => 0,
		'scrolltopbar_caption_font' => 'Arial',
		'scrolltopbar_custom_css' => '',
		'scrolltopbar_make_smaller_width' => 75,
		'scrolltopbar_make_smaller' => 1650,
		'scrolltopbar_hide' => 1550,
		'scrolltopbar_hide_lite' => 0,
		'scrolltopbar_hide_lite_border_radius' => 5
	);
	
	$default_settings = apply_filters( 'scrolltopbar_default_settings', $default_settings );
	
	$settings = get_option( 'scrolltopbar_plugin_settings', $default_settings );

	if(empty($option))
	{
		if( isset( $settings ) )
		{
			return array_merge( $default_settings, $settings );
		}

		return $default_settings;
	}
	else
	{
		if( isset( $settings[$option] ) )
		{
			return $settings[$option];
		}

		return $default_settings[$option];
	}
}