<?php

// on exécute la WP Query
$my_query = new WP_Query( $args );

//Nombre de posts trouvés
$count = count( $my_query->posts );

//Nombre de pages que renvoi la requête
$max_pages = $my_query->max_num_pages;
//echo "nombre posts : ", $count;
//echo "max pages  : ", $max_pages;
// on parcoure les données
$i = 0;

if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

    $id = get_the_ID();

    if ($i == 0) { 
        ?>
            <div class="display-photo">
                <div class="half">                   
                    <a href="<?php echo get_post_permalink ($id);?>"><?php the_post_thumbnail('full', array('class' => 'display-img')); ?></a>
                </div>
        <?php    
        $i++; 
    } 
    else { 
        $i = 0; ?>
            <div class="half">
                 <a href="<?php echo get_post_permalink ($id);?>"><?php the_post_thumbnail('full', array('class' => 'display-img')); ?></a>
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
    echo "<p id='msg-photo'><b>Il n'y a pas de/d'autres photos dans cette catégorie</b></p>";
}?>

<!--on transmet le nombre de pages pour gérer l'affichage du bouton 'charger plus' -->
<input id="max-pages" name="max-pages" type="hidden" value="<?php echo $max_pages ?>">

<?php 
// on réinitialise à la requête principale 
wp_reset_postdata(); ?>





