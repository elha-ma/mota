<?php 
    //récupérer le post avec un identifiant précis
    $args = array(
        'post_type' => 'photo', // Nom du Custom Post Type
        'p' => $identifiant,
    );

    $my_query = new WP_Query( $args );

    if ($my_query->have_posts()) : 
        $my_query->the_post();     
    endif;
    wp_reset_postdata(); 

    // on récupère les identifiants du post précédent et du post suivant
    $next_post = get_next_post();
    $next_id = $next_post->ID;
    $previous_post = get_previous_post();
    $prev_id = $previous_post->ID;
?>

<!--la lightbox -->
<div id ="light_box" class="lightbox">

    <div class="lightbox_close"> X </div>

    <div class="lightbox_container">

        <div class='lightbox_prev'>
            <span class='fleche_prev'> < </span>
        </div>

        <div id="principal">
            <div class="lightbox_principal">
                <?php 
                    //Affichage de la photo 
                    echo get_the_post_thumbnail($identifiant, 'large',  array('class' => 'resp-light'));                     
                    //On transmet les identifiants de la prev et next photo
                    if (isset($next_id)){
                        echo "<input id='next_id' name='next_id' type='hidden' value='$next_id' />";
                    }
                    if (isset($prev_id)){
                        echo "<input id='prev_id' name='prev_id' type='hidden' value='$prev_id' />";
                    }
                ?>
            </div>    
        </div>
        
        <div class='lightbox_next'>
            <span class='fleche_next'> > </span> 
        </div>
    </div>
</div>
