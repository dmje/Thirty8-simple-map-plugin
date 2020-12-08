<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5fcf4da42bf33',
	'title' => 'Map Items',
	'fields' => array(
		array(
			'key' => 'field_5fcf4e50561ad',
			'label' => 'Location',
			'name' => 'location',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_5fcf4e84561ae',
					'label' => 'Latitude',
					'name' => 'latitude',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '',
					'max' => '',
					'step' => '',
				),
				array(
					'key' => 'field_5fcf4e8d561af',
					'label' => 'Longitude',
					'name' => 'longitude',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '',
					'max' => '',
					'step' => '',
				),
			),
		),
		array(
			'key' => 'field_5fcf4dab6a118',
			'label' => 'Description',
			'name' => 'description',
			'type' => 'wysiwyg',
			'instructions' => 'Keep this short - it displays in the map popup! Note that this also supports oEmbed, so you can paste in YouTube, SoundCloud or other URLs',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'mapitem',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
	),
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5fcf599510d20',
	'title' => 'Map settings',
	'fields' => array(
		array(
			'key' => 'field_5fcf5999fb799',
			'label' => 'Mapbox Token',
			'name' => 'mapbox_token',
			'type' => 'text',
			'instructions' => 'You\'ll need a free Mapbox token in order to use this plugin. Read more about how to do this here: https://docs.mapbox.com/help/how-mapbox-works/access-tokens/',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5fcf607e6de3b',
			'label' => 'Mapbox Style',
			'name' => 'mapbox_style',
			'type' => 'text',
			'instructions' => 'Choose a style for your map. Defaults to Light v10. Find more here: https://github.com/mapbox/mapbox-gl-styles or you can make your own with Mapbox studio',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5fcf60d7d60e1',
			'label' => 'Marker Icon',
			'name' => 'marker_icon',
			'type' => 'file',
			'instructions' => 'Upload a PNG file 200x200px to overwrite the default marker icon',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => 'png',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'thirty8-simplemap-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;

?>