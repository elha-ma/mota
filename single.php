<?php
/**
 * The template for displaying all single posts
 */

get_header();

// définition des arguments pour les données qu'on veut afficher
$args = array(
    'post_type' => 'photo',
    'tax_query' => array(
        array (
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => 'television',
        ) )
);

// on exécute la WP Query
$my_query = new WP_Query( $args );

// on parcoure les données
if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
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
        <img src="<?php echo the_field( 'image_photo' ); ?>" alt="Photo Mota" class="image-single">
    </div>
</div>
    

<!-- La partie contact et défiler les photos -->
<div class="contact-single">
	<div> 
        Cette photo vous intéresse ?  <b>|</b> <span id="contact"><a href="#?ref=<?php the_field( 'reference_photo' ); ?>"> Contact </a></span>  
    </div>
	<div class="pos-vignette"> ------- </div>
    
</div>

<!-- La gallerie des photos -->
<div>
	
</div>
<?php

endwhile;
endif;

// on réinitialise à la requête principale 
wp_reset_postdata(); ?>

<?php get_footer(); ?>