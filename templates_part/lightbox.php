<div id ="light_box" class="lightbox">
  <div class="lightbox_close"> X </div>

  <div class="lightbox_container">

    <?php echo get_the_post_thumbnail($identifiant , 'large'); ?>
  </div>
    <?php 
    //récupérer les posts précédent et suivant
    $args = array(
        'post_type' => 'photo', // Nom du Custom Post Type
        'p' => $identifiant,
    );
    $my_query = new WP_Query( $args );

    if ($my_query->have_posts()) : 
        $my_query->the_post();     
    endif;
    wp_reset_postdata(); 

    // Previous/next post navigation.
    $next_post = get_next_post();
    $next_id = $next_post->ID;
    if (isset($next_id)){
        echo "<div class='lightbox_next'> suivant </div>";
    }
    $previous_post = get_previous_post();
    $prev_id = $previous_post->ID;
    if (isset($prev_id)){
        echo "<div class='lightbox_prev'> précédent </div>";
    }  
        
    ?>


</div>
