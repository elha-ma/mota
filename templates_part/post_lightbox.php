<!--permet de récupérer le post à afficher au niveau de la lightbox via les flèches suivant et précédent-->
<?php 
    //récupérer les posts précédent et suivant
    $args = array(
        'post_type' => 'photo', // Nom du Custom Post Type
        'p' => $id,
    );
    $my_query = new WP_Query( $args );

    if ($my_query->have_posts()) : 
        $my_query->the_post();     
    endif;
    wp_reset_postdata(); 

    // Previous/next post navigation.
    $next_post = get_next_post();
    $next_id = $next_post->ID;
    $previous_post = get_previous_post();
    $prev_id = $previous_post->ID;
?>


<div class="lightbox_principal">
    <?php 
        //Affichage de la photo 
        echo get_the_post_thumbnail($id , 'large'); 
        //On transmet les identifiants de la prev et next photo
        if (isset($next_id)){
            echo "<input id='next_id' name='next_id' type='hidden' value='$next_id' />";
        }
        if (isset($prev_id)){
            echo "<input id='prev_id' name='prev_id' type='hidden' value='$prev_id' />";
        }
    ?>
</div>
