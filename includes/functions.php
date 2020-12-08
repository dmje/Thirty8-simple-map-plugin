<?php


$root_path = WP_PLUGIN_DIR . '/thirty8-simple-map';

// include ACF (non pro) options page
include_once($root_path . '/lib/acf-options-page/acf-options-page.php');


// Make your plugin options pages here
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Map settings',
		'menu_title'	=> 'Map Settings',
		'menu_slug' 	=> 'thirty8-simplemap-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
		
}

// Hide ACF menu if you need

//add_filter('acf/settings/show_admin', '__return_false');


// Make custom post types
function thirty8_simplemap_makeCPTs() {	

	register_post_type('mapitem', array(
	'labels' => array(
		'name' => __( 'Map' ),
		'singular_name' => __( 'Map Item' ),
		'add_new' => __( 'Add New Item to map' ),
		'add_new_item' => __( 'Add New Map Item' ),
		'edit' => __( 'Edit' ),
		'edit_item' => __( 'Edit Map Item' ),
		'new_item' => __( 'New Map Item' ),
		'view' => __( 'View Map' ),
		'view_item' => __( 'View Map Item' ),
		'search_items' => __( 'Search Map Items' ),
		'not_found' => __( 'No Map Items found' ),
		'not_found_in_trash' => __( 'No Map Items found in Trash' ),
	),
	'public' => false,
	'show_ui' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'menu_position' => 22,
	'menu_icon'   => 'dashicons-admin-site-alt',
	'query_var' => true,
	'rewrite' => array( 'slug' => 'map', 'with_front' => false ),
	'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),	
	'has_archive' => true
	) );
	
}

add_action( 'init', 'thirty8_simplemap_makeCPTs' );



// Shortcode for map
function thirty8base_map( $atts, $content = null ) 
{
    $a = shortcode_atts( array(
        'fullscreen' => '',
    ), $atts );
	
	// not using the attributes, at least not yet...
	
	return thirty8render_map($a);
	    
}
add_shortcode('map', 'thirty8base_map');


function thirty8render_map($a){
	
	$fullscreen = $a['fullscreen']; 
		
	$mapbox_token = get_field('mapbox_token', 'option');
	
	// Get style from options page if specified 
	$mapbox_style = get_field('mapbox_style', 'option');	
	if(!$mapbox_style){
		$mapbox_style = 'mapbox://styles/mapbox/light-v10';
	}
	
	// Get marker from options page if specified, default if not
	$markericon = get_field('marker_icon', 'option');	
	if(!$markericon){
		$markericon = plugin_dir_url( __DIR__ ) . 'assets/map-marker.png';
	} 
			
	# Build GeoJSON feature collection array
	$geojson = array(
		'type'	  => 'FeatureCollection',
		'features'  => array()
	);
	
	$item_id = 0;
	
							
	$thirty8_map_query_args=array(
	   'post_type'=>'mapitem',
	   'posts_per_page' => -1,
	   'paged' => get_query_var('paged')
	);							

	$thirty8_map_query = new WP_Query( $thirty8_map_query_args );

	if ($thirty8_map_query->have_posts()) : 

						
		while ( $thirty8_map_query->have_posts() ) : $thirty8_map_query->the_post(); 

			$item_description = get_field('description',get_the_ID());
			
			$location = get_field('location',get_the_ID());
			
			
			$latitude = $location['latitude'];
			$longitude = $location['longitude'];

			$item_id++;		
			
			// Build the GeoJSON
			// See https://gist.github.com/wboykinm/5730504
			
			$feature = array(
				'id' => $item_id,
				'type' => 'Feature', 
				'geometry' => array(
					'type' => 'Point',
					# Pass Longitude and Latitude Columns here
					'coordinates' => array($longitude,$latitude)
				),
				# Pass other attribute columns here
				'properties' => array(
					'title' => get_the_title(),
					'marker-size' => 'large',
					'description' => $item_description,
				)
			);		 
			
			# Add feature arrays to feature collection array
			array_push($geojson['features'], $feature);		
					
		endwhile;
						
						
	endif; 
	
	
	
	
	
	?>
	
	<!--BEGIN THE MAP-->
	
	<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.css' rel='stylesheet' />
	<style>
		#map {
		/*
		position: absolute;
		top: 0;
		bottom: 0;
		width: 100%;
		*/
		
		width:100%;
		height:600px;
		margin-bottom:40px;
		
		}
		
		.marker {
		background-image: url('<?php echo $markericon;?>');
		background-size: cover;
		width: 20px;
		height: 20px;
		border-radius: 50%;
		cursor: pointer;
		}	  
		
		.mapboxgl-popup {
		max-width: 200px;
		}
		
		.mapboxgl-popup-content {
		text-align: center;
		font-family: 'Open Sans', sans-serif;
		}	
	</style>
	
	<div id='map'></div>
	
	<script>
				
		mapboxgl.accessToken = '<?php echo $mapbox_token;?>';
		
		// Initialise the map
		
		var map = new mapboxgl.Map({
		container: 'map',
		style: '<?php echo $mapbox_style;?>',
		center: [-0.12,51.5],
		zoom: 2
		});
		
		// Load GeoJSON data		
		var geojson = <?php echo json_encode($geojson);?>
		
		
		
		// add markers to map
		geojson.features.forEach(function(marker) {
		
		// create a HTML element for each feature
		var el = document.createElement('div');
		el.className = 'marker';
		
		// make a marker for each feature and add to the map
		new mapboxgl.Marker(el)
		.setLngLat(marker.geometry.coordinates)
		.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
		.setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
		.addTo(map);
		});
		
	</script>
	
	
	
	<?php
	
	
}




?>