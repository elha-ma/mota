<?php

function mota_setup() {
    //charger le logo du site 
    add_theme_support( 'custom-logo' );
    //charger le titre du site
    add_theme_support('title-tag');
    //les images vignettes (images vedette)
    add_theme_support( 'post-thumbnails' );
  
    //Gestion des menus dans wordpress
    add_theme_support('menus');
    register_nav_menu('header','En tête de la page');
    register_nav_menu('footer','Pieds de page');
}
add_action('after_setup_theme', 'mota_setup');


//charger la feuilles de style du thème
function charger_styles() {
    wp_register_style( 'style_site', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'style_site'); 	   
}
add_action( 'wp_enqueue_scripts', 'charger_styles');


//Intégrer les scripts JS du site
function charger_scripts() {
    wp_register_script( 'scripts_site', get_stylesheet_directory_uri() . '/js/scripts.js' );
    wp_enqueue_script( 'scripts_site'); 	   
}
//add_action( 'wp_enqueue_scripts', 'charger_scripts');

function theme_scripts() {
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '', true);
}
add_action('wp_footer', 'theme_scripts');

//fonction pour la pagination 
function action_load_more() {  
    $response = '';
    $args = array(
        'post_type' => 'photo', 
        'posts_per_page' => 2,
        'paged' => $_GET['paged'],
    );

    //$response .= get_template_part('/templates_part/photo_block', 'photo');
   $response .= require_once( locate_template( 'templates_part/photo_block.php' ) );
   
   exit;
  }
  add_action('wp_ajax_action_load_more', 'action_load_more');
  add_action('wp_ajax_nopriv_action_load_more', 'action_load_more');

