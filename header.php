<?php
/**
 * The header for our theme : MOTA
 *
 * This is the template that displays all of the header section
 *
 */
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<header class='header'>

       		<div class='logo'>			         
                <?php the_custom_logo();  ?>         				
			</div> 

			<div class='pos-right'>
				<?php wp_nav_menu( 
				[
					'menu' => 'menu-entete',
					'container'=> '',
					'items_wrap'=>'<ul>%3$s</ul>'				
				]); 
				?>
			</div>

			
    	</header>           
