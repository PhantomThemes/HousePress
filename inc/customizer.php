<?php
/**
 * housepress Theme Customizer
 *
 * @package housepress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function housepress_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'refresh';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'refresh';
 $wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';



}
add_action( 'customize_register', 'housepress_customize_register' );



/**
 * Enqueue scripts for customizer
 */
function housepress_customizer_js() {
    wp_enqueue_script('housepress-customizer', get_template_directory_uri() . '/assets/js/housepress-customizer.js', array('jquery'), '1.3.0', true);

    wp_localize_script( 'housepress-customizer', 'housepress_customizer_js_obj', array(
        'pro' => __('Upgrade To Housepress Pro','housepress')
    ) );
    wp_enqueue_style( 'housepress-customizer', get_template_directory_uri() . '/assets/css/housepress-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'housepress_customizer_js' );

