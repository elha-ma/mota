<?php

get_header();

//On récupère l'identifiant de la photo principale
$id_photo = get_the_id();

// Définition des arguments de la photo à afficher 
$args = array(
    'post_type' => 'photo', // Nom du Custom Post Type
    'p' => $id_photo,
    //'meta_key' => 'reference_photo', // nom du champ ACF
   // 'meta_value' => 'bf2400', //Référence de la photo
);

// On exécute la WP Query
$my_query = new WP_Query( $args );
//echo "nombre photos:",$wp_query->post_count;

// On a un seul résultat 
if ($my_query->have_posts()) : $my_query->the_post();
?>

<!-- La partie photo et ses infos -->
<div class="display-photo">
	<div class="half bloc-infos">
        <h1><?php the_title(); ?></h1>
        <div class="display-infos">
            <div class="marge">Type : <?php the_field( 'type_photo' ); ?></div>
            <div class="marge">Référence : <span id="reference-photo"><?php the_field( 'reference_photo' ); ?></span></div>
            <div class="marge">Année : <?php the_field( 'annee_photo' ); ?></div>            
        </div>
        <hr/>
    </div>
	<div class="half">        
        <?php the_post_thumbnail('full', array('class' => 'image-single')); ?>
    </div>
</div>
    


<?php

//identifiant et catégorie de la photo affichée
$term_id = get_the_ID();
$terms = get_the_terms( $term_id, 'categorie' );
$term_categorie = $terms[0]->name;

endif;

// on réinitialise à la requête principale 
wp_reset_postdata(); ?>

<!-- La partie contact et défiler les photos -->
<div class="contact-single">
	<div> 
        Cette photo vous intéresse ?  <b>|</b> <span id="contact"><a href="#?ref=<?php the_field( 'reference_photo' ); ?>"> Contact </a></span>  
    </div>
	<div class="pos-vignette">         
        <?php 
        // Previous/next post navigation.
        the_post_navigation(
            array(
                'next_text' => '<div>&#10230;</div>',
                'prev_text' => '<div>&#10229;</div>',
            )
        );  
        ?>
    </div>    
</div>

<!-- La gallerie des photos apparentées-->
<div>
    <hr/>
	<p>VOUS AIMEREZ AUSSI</p>

    <!--Intégration de la template d'affichage des photos en bloc --> 
    <?php     
    //on transmets les variables via set_query_var
    set_query_var( 'term_id', $term_id );
    set_query_var( 'term_categorie', $term_categorie );
    get_template_part( '/templates_part/photo_block' ); ?>
</div>

<?php get_footer(); ?>

