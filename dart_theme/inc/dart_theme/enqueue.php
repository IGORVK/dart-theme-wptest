<?php

/*
@package dart_theme
   =====================================
          FRONT-END ENQUEUE FUNCTIONS
   =====================================
*/

function dart_theme_load_scripts(){
	wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false, NULL, 'all' );
	wp_enqueue_style( 'bootstrap-css' );

	wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, NULL, 'all' );
	wp_enqueue_style('font-awesome');

	wp_register_style('dart_theme_css', get_template_directory_uri().'/inc/dart_theme/dart_theme.css',false, NULL, 'all' );
	wp_enqueue_style('dart_theme_css');

	wp_register_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'bootstrap-js' );

	wp_register_script('dart_theme_js', get_template_directory_uri().'/inc/dart_theme/dart_theme.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'dart_theme_js' );
}
add_action( 'wp_enqueue_scripts', 'dart_theme_load_scripts' );


?>