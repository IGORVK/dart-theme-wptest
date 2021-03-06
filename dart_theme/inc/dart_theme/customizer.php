<?php
/**
 * dart_theme Theme Customizer
 *
 * @package dart_theme
 */

add_action( 'after_setup_theme', 'dart_theme_setup_logo' );
function dart_theme_setup_logo() {
	add_theme_support( 'custom-logo', array(
		'width' => 128,
		'height' => 128,
		'flex-width' => true,
		'flex-height' => true,
		'header-text' => array('site-title', 'site-description')
	));
}


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dart_theme_customize_register( $wp_customize ) {




	/*******************************************
	Color scheme
	 ********************************************/

// add the section to contain the settings
	$wp_customize->add_section( 'textcolors' , array(
		'title' =>  'Color Scheme',
	) );

	// main color ( site title, h1, h2, h4. h6, widget headings, nav links, footer headings )
	$txtcolors[] = array(
		'slug'=>'color_scheme_1',
		'default' => '#000',
		'label' => 'Main Color'
	);

// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
	$txtcolors[] = array(
		'slug'=>'color_scheme_2',
		'default' => '#666',
		'label' => 'Secondary Color'
	);

// link color
	$txtcolors[] = array(
		'slug'=>'link_color',
		'default' => '#008AB7',
		'label' => 'Link Color'
	);

// link color ( hover, active )
	$txtcolors[] = array(
		'slug'=>'hover_link_color',
		'default' => '#9e4059',
		'label' => 'Link Color (on hover)'
	);

	// add the settings and controls for each color
	foreach( $txtcolors as $txtcolor ) {

		// SETTINGS
		$wp_customize->add_setting(
			$txtcolor['slug'], array(
				'default' => $txtcolor['default'],
				'type' => 'option',
				'capability' =>  'edit_theme_options'
			)
		);

	}

	// CONTROLS
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			$txtcolor['slug'],
			array('label' => $txtcolor['label'],
			      'section' => 'textcolors',
			      'settings' => $txtcolor['slug'])
		)
	);

	// add the settings and controls for each color
	foreach( $txtcolors as $txtcolor ) {

		// SETTINGS
		$wp_customize->add_setting(
			$txtcolor['slug'], array(
				'default' => $txtcolor['default'],
				'type' => 'option',
				'capability' =>
					'edit_theme_options'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$txtcolor['slug'],
				array('label' => $txtcolor['label'],
				      'section' => 'textcolors',
				      'settings' => $txtcolor['slug'])
			)
		);
	}


	/**************************************
	Solid background colors
	 ***************************************/
// add the section to contain the settings
	$wp_customize->add_section( 'background' , array(
		'title' =>  'Solid Backgrounds',
	) );


// add the setting for the header background
	$wp_customize->add_setting( 'header-background' );

// add the control for the header background
	$wp_customize->add_control( 'header-background', array(
		'label'      => 'Add a solid background to the header?',
		'section'    => 'background',
		'settings'   => 'header-background',
		'type'       => 'radio',
		'choices'    => array(
			'header-background-off'   => 'no',
			'header-background-on'  => 'yes',
		) ) );


// add the setting for the footer background
	$wp_customize->add_setting( 'footer-background' );

// add the control for the footer background
	$wp_customize->add_control( 'footer-background', array(
			'label'      => 'Add a solid background to the footer?',
			'section'    => 'background',
			'settings'   => 'footer-background',
			'type'       => 'radio',
			'choices'    => array(
				'footer-background-off'   => 'no',
				'footer-background-on'  => 'yes',
			)
		)
	);


	//$wp_customize->remove_section('colors');
	$wp_customize->get_setting( 'custom_logo' )->transport      = 'refresh';
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';


}

add_action( 'customize_register', 'dart_theme_customize_register' );


function dart_theme_customize_colors() {

	/**********************
	text colors
	 **********************/
// main color
	$color_scheme_1 = get_option( 'color_scheme_1' );

// secondary color
	$color_scheme_2 = get_option( 'color_scheme_2' );

// link color
	$link_color = get_option( 'link_color' );

// hover or active link color
	$hover_link_color = get_option( 'hover_link_color' );

	/****************************************
	styling
	 ****************************************/
	?>
	<style>


		/* color scheme */

		/* main color */
		#site-title a, h1, h2, h2.page-title, h2.post-title, h2 a:link, h2 a:visited, .menu.main a:link, .menu.main a:visited, footer h3 {
			color:  <?php echo $color_scheme_1; ?>;
		}

		/* secondary color */
		#site-description, .sidebar h3, h3, h5, .menu.main a:active, .menu.main a:hover {
			color:  <?php echo $color_scheme_2; ?>;
		}
		.menu.main,
		.fatfooter {
			border-top: 1px solid <?php echo $color_scheme_2; ?>;
		}
		.menu.main {
			border-bottom: 1px solid <?php echo $color_scheme_2; ?>;
		}
		.fatfooter {
			border-bottom: 1px solid <?php echo $color_scheme_2; ?>;
		}

		/* links color */
		a:link, a:visited {
			color:  <?php echo $link_color; ?>;
		}

		/* hover links color */
		a:hover, a:active {
			color:  <?php echo $hover_link_color; ?>;
		}


		/* background colors */

		/* header */
		.header-background-on header{
			background-color: <?php echo $color_scheme_1; ?>;
		}
		.header-background-on #site-title a, .header-background-on h1, .header-background-on #site-description, .header-background-on address, .header-background-on header a:link, .header-background-on header a:visited, .header-background-on header a:active, .header-background-on header a:hover {
			color: #fff;
		}
		.header-background-on header a:link, .header-background-on header a:visited {
			text-decoration: underline;
		}
		.header-background-on header a:active, .header-background-on header a:hover {
			text-decoration: none;
		}
		.header-background-on .menu.main {
			border: none;
		}

		/* footer */
		.footer-background-on footer {
			background-color: <?php echo $color_scheme_1; ?>;
		}
		.footer-background-on footer, .footer-background-on footer h3, .footer-background-on footer a:link, .footer-background-on footer a:visited, .footer-background-on footer a:active, .footer-background-on footer a:hover {
			color: #fff;
		}
		.footer-background-on footer a:link, .footer-background-on footer a:visited {
			text-decoration: underline;
		}
		.footer-background-on footer a:active, .footer-background-on footer a:hover {
			text-decoration: none;
		}
		.footer-background-on .fatfooter {
			border: none;
		}

	</style>

<?php }
add_action( 'wp_head', 'dart_theme_customize_colors' );


/*******************************************************************************
add class to body if backgrounds turned on using the body_class filter
 ********************************************************************************/
function dart_theme_add_background_color_style( $classes ) {

	// set the header background
	$header_background = get_theme_mod( 'header-background' );
	$classes[] = $header_background;

	// set the footer background
	$footer_background = get_theme_mod( 'footer-background' );
	$classes[] = $footer_background;

	return $classes;

}
add_filter('body_class', 'dart_theme_add_background_color_style');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dart_theme_customize_preview_js() {
	wp_enqueue_script( 'dart_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'dart_theme_customize_preview_js' );



