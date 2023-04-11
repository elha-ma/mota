<?php

function mota_setup() {
    //charger le logo du site 
    add_theme_support( 'custom-logo' );
    
    //charge le titre du site
    add_theme_support('title-tag');
    //add_theme_support( 'post-thumbnails' );
  
    //Gestion des menus dans wordpress
    add_theme_support('menus');
    register_nav_menu('header','En tête de la page');
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
add_action( 'wp_enqueue_scripts', 'charger_scripts');