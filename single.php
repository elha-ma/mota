<?php

get_header();

//On récupère l'identifiant de la photo principale
$id_photo = get_the_id();

// Définition des arguments de la photo à afficher 
$args = array(
    'post_type' => 'photo', // Nom du Custom Post Type
    'p' => $id_photo,
);

// On exécute la WP Query
$my_query = new WP_Query( $args );

// On a un seul résultat 
if ($my_query->have_posts()) : $my_query->the_post();

//identifiant et catégorie de la photo affichée
$term_id = get_the_ID();
$terms = get_the_terms( $term_id, 'categorie' );
$term_categorie = $terms[0]->name;
$term_categ_slug = $terms[0]->slug;
?>

<!-- La partie photo et ses infos -->
<div class="photo-single">
	<div class="half bloc-infos">
        <h1><?php the_title(); ?></h1>
        <div class="display-infos">
            <div class="marge">Type : <?php the_field( 'type_photo' ); ?></div>
            <div class="marge">Référence : <span id="reference-photo"><?php the_field( 'reference_photo' ); ?></span></div>
            <div class="marge">Année : <?php the_field( 'annee_photo' ); ?></div> 
            <div class="marge">Catégorie : <?php echo $term_categorie; ?></div>            
        </div>
        <hr/>
    </div>
	<div class="half">        
        <?php the_post_thumbnail('full', array('class' => 'image-single')); ?>
    </div>
</div>
    


<?php



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
        $next_post = get_next_post();
        $previous_post = get_previous_post();
        the_post_navigation(
            array(
                'next_text' => '<div class="visiblenext">' . get_the_post_thumbnail($next_post->ID, [100,100]) . '</div><div class="flechenext"><b>&#10230;</b></div>',
                'prev_text' => '<div class="visibleprev">' . get_the_post_thumbnail($previous_post->ID, [100,100]).'</div><div class="flecheprev"><b>&#10229;</b></div>',
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
   // set_query_var( 'term_id', $term_id );
   // set_query_var( 'term_categorie', $term_categorie );
    $args = array(
        'post_type' => 'photo', 
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'terms' => $term_categ_slug,
                'field' => 'slug',
            )
        ),
        //on exclut la photo principal
        'post__not_in' => array ($term_id),
        'posts_per_page' => 2,
    );
   
    
    
    ?>
    <div class="suite-photos">
        <?php 
        //get_template_part( '/templates_part/photo_block' ); 
        require_once( locate_template( 'templates_part/photo_block.php' ) );?>
    </div>

    <?php if ($count != 0) { ?>
        <!--bouton pour charger toutes les photos -->
        <div id="btn-load-all">
            <input type="button" value="toutes les photos" id="load-all" />
            <input id="categ" name="categ" type="hidden" value="<?php echo $term_categ_slug; ?>">
        </div>
    <?php }; ?>
</div>

<?php get_footer(); ?>

