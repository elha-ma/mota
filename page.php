<?php 
//En-tête de la page 
get_header(); 
?>

<div>
	<?php
	//Paramètres pour afficher aléatoirement 1 seule image 
	$args = array(
		'post_type' => 'photo', 
		'orderby' => 'rand', 
		'showposts' => 1,
	);

	// On exécute la WP Query
	$my_query = new WP_Query( $args );

	//On parcourt les résultats de la WP_Query
	if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

		//Affichage de l'image du hero header
		the_post_thumbnail('full', array('class' => 'hero-header')); 

		//Affichage du titre du hero 
		$attachment_id = 94; //Valeur récupérée au niveau de la médiathèque wordpress	
		$img_atts = wp_get_attachment_image_src( $attachment_id, 'full');
		$img_src = $img_atts[0];	
	?>
		<img src="<?php echo $img_src ?>" alt="image hero header" class="title-hero" />

	<?php 
	endwhile;
	endif; 
	wp_reset_postdata();
	?>
</div>

<!--Partie Filtres: Par catégorie et par format -->
<div>
	<?php require_once( locate_template( 'templates_part/options_filtres.php' ) );?>
</div>

<?php 
//Affichage de toutes les photos
$args = array(
	'post_type' => 'photo', 
	'posts_per_page' => 6,
	'paged' => 1,
); ?>

<div class="suite-photos">
<?php 
//get_template_part( '/templates_part/photo_block' ); 
require_once( locate_template( 'templates_part/photo_block.php' ) );?>
</div>

<!--bouton pour charger plus de photos -->
<div id="btn-load-more">  
  <input type="button" value="Charger plus" id="load-more" />
</div>

<?php get_footer(); ?>
