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
    $categorie = $_GET['categorie']; 
    $args = array(
        'post_type' => 'photo', 
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'terms' => $categorie,
                'field' => 'slug',
            )
        ),
    );

   $response .= require_once( locate_template( 'templates_part/photo_block.php' ) );

   exit;
}
add_action('wp_ajax_action_load_more', 'action_load_more');
add_action('wp_ajax_nopriv_action_load_more', 'action_load_more');

//fonction pour les filtres
function filtre_photos() {  
    $response = '';
    $tax_query = ''; 
    $categorie = $_GET['categorie']; 
    $format = $_GET['format'];
    $num_page = $_GET['paged']; 
    $tri = $_GET['tri'];   

    //On détermine les conditions de filtre et de tri
    if ($categorie != "tous" and $format != "tous"){     
        $tax_query = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categorie,
            ),
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $format,
            ),
        );        
    } 
    if ($categorie != "tous" and $format == "tous" ){
        $tax_query = array(
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categorie,
            ),
        );
    } 
    if ($categorie == "tous" and $format != "tous" ){
        $tax_query = array(
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $format,
            ),
        );
    }

    //Les arguments de filtres et de tri des photos (tout en un)
    $args = array(
        'post_type' => 'photo',
        'order' => $tri,
        'posts_per_page' => 6,
        'paged' => $num_page,
        'tax_query' => $tax_query,
    );
    //var_dump("malika paged: ",$num_page); 
    $response .= require_once( locate_template( 'templates_part/photo_block.php' ) );
    exit;
}
add_action('wp_ajax_filtre_photos', 'filtre_photos');
add_action('wp_ajax_nopriv_filtre_photos', 'filtre_photos');

//fonction pour charger la lightbox
function action_lightbox(){    
    $response = '';
    $identifiant = $_GET['identifiant']; 
    $response .= require_once( locate_template( 'templates_part/lightbox.php' ) );
    exit;
}
add_action('wp_ajax_action_lightbox', 'action_lightbox');
add_action('wp_ajax_nopriv_action_lightbox', 'action_lightbox');

function prev_next_lightbox(){
    $response = '';
    $id = $_GET['identifiant']; 
    $response .= require_once( locate_template( 'templates_part/post_lightbox.php' ) );
    exit;
}
add_action('wp_ajax_prev_next_lightbox', 'prev_next_lightbox');
add_action('wp_ajax_nopriv_prev_next_lightbox', 'prev_next_lightbox');