<?php
function oliord_setup() {
	load_theme_textdomain( 'oliord' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'oliord-featured-image', 2000, 1200, true );
	add_image_size( 'oliord-thumbnail-avatar', 100, 100, true );

	register_nav_menus( array('top-menu'    => __( 'Top Menu', 'oliord' )	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	add_theme_support( 'custom-logo');
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'oliord_setup' );

/* Widget Register */
function oliord_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'oliord' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'oliord' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'oliord' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'oliord' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'oliord' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'oliord_widgets_init' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Olio RD 1.1.0
 */
function oliord_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'oliord_javascript_detection', 0 );

/* Customizer Options */
function oliord_theme_section($wp_customize){
    $wp_customize->add_section('oliord_theme_section_handle', array(
        'title'             => __('Oliord Theme Settings', 'oliord'),
        'description' => '',
        'priority'       => 70,
    ));
     
     /* --------- Copy right Sectoin --------- */
     $wp_customize->add_setting('oliord_cp_op', array(
        'default'      => '',
        'capability'  => 'edit_theme_options',
        'type'          => 'theme_mod',
    ));

    $wp_customize->add_control('oliord_cp', array(
        'label'         => __('Copy right', 'oliord'),
        'section'     => 'oliord_theme_section_handle',
        'settings'    => 'oliord_cp_op',
        'type'         => 'textarea'
    ));
}
add_action( 'customize_register', 'oliord_theme_section' );

/* Register Style and Scripts */
function oliord_scripts() {
	wp_enqueue_script( 'jQuery.min', get_template_directory_uri().'/assets/js/jQuery.min.js' );
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri().'/assets/js/bootstrap.min.js' );
	wp_enqueue_style( 'font-awesome.min', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'progressbar', get_template_directory_uri().'/assets/css/jQuery-plugin-progressbar.css' );
	wp_enqueue_script( 'jquery-progressbar', get_template_directory_uri().'/assets/js/jQuery-plugin-progressbar.js' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css' );
	wp_enqueue_script( 'jquery-asAccordion', get_template_directory_uri().'/assets/js/jquery-asAccordion.js' );
	wp_enqueue_style( 'accordion-slider.min', get_template_directory_uri().'/assets/css/accordion-slider.min.css' );
	wp_enqueue_style( 'asAccordion', get_template_directory_uri().'/assets/css/asAccordion.css' );
	wp_enqueue_script( 'jquery.accordionSlider.min', get_template_directory_uri().'/assets/js/jquery.accordionSlider.min.js' );
	wp_enqueue_style( 'style', get_template_directory_uri().'/style.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css');
}
add_action( 'wp_enqueue_scripts', 'oliord_scripts' );


require get_template_directory() . '/inc/custom_function.php';
