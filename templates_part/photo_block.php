
<div class="suite-photos">
<?php

// on exécute la WP Query
$my_query = new WP_Query( $args );

//Nombre de posts trouvés
$count = count( $my_query->posts );

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
    echo "<p><b>Il n'y a pas d'autres photos dans cette catégorie</b></p>";
}

// on réinitialise à la requête principale 
wp_reset_postdata(); ?>
</div>

<!--bouton pour charger plus de photos -->
<div id="btn-load-more">
  <a href="#!" id="load-more">Charger plus</a>
</div>


