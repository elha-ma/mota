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

			<div class='pos-right menu-desktop'>
				<?php wp_nav_menu( 
				[
					'menu' => 'menu-entete',
					'container'=> '',
					'items_wrap'=>'<ul>%3$s</ul>'				
				]); 
				?>
			</div>

			<div class="pos-right menu-mobile">
				<div class="m-burger">
					<a href="#" id="openBtn">
						<span class="burger-icon">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</a>
					<a id="closeBtn" href="#" class="close-menu invisible">X</a>
				</div>

				<div id="mySidenav" class="sidenav">                    
					<?php wp_nav_menu( 
					[
						'menu' => 'menu-entete',
						'container'=> '',
						'items_wrap'=>'<ul>%3$s</ul>'				
					]); 
					?>
				</div>
			</div>  
			
    	</header>
		