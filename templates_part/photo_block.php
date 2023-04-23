<?php

// Sélection des posts photos à afficher 
$args = array(
    'post_type' => 'photo', 
    'tax_query' => array(
        array(
            'taxonomy' => 'categorie',
            'terms' => $term_categorie,
            'field' => 'slug',
        )
    ),
    //on exclut la photo principal
    'post__not_in' => array ($term_id),
);

// on exécute la WP Query
$my_query = new WP_Query( $args );

//Nombre de posts trouvés
$count = count( $my_query->posts );

// on parcoure les données
$i = 0;
if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
    
    if ($i == 0) { 
        ?>
            <div class="display-photo">
                <div class="half">
                    <img src="<?php echo the_field( 'image_photo' ); ?>" alt="Photo Mota" class="display-img">
                </div>
        <?php    
        $i++; 
    } 
    else { 
        $i = 0; ?>
            <div class="half">
                <img src="<?php echo the_field( 'image_photo' ); ?>" alt="Photo Mota" class="display-img">
            </div>
        </div>    
    <?php
    }

endwhile;

if ( ($count)%2 == 1 ) { 
    echo "</div>"; 
}

endif;

if ( $count == 0) { 
    echo "<p><b>Il n'y a pas d'autres photos dans cette catégorie</b></p>";
}

// on réinitialise à la requête principale 
wp_reset_postdata(); ?>

