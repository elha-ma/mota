
    <!--Intégration de la fenêtre modale Contact-->
    <?php get_template_part( '/templates_part/modale' ); ?>

    <!--Intégration de la Lightbox-->
    <div class="box"></div>

    <footer>
        <hr/>
        <div class="display-center">
            <?php wp_nav_menu( 
                            [
                                'menu' => 'menu-footer',
                                'container'=> '',
                                'items_wrap'=>'<ul>%3$s</ul>'				
                            ]); 
                            ?>  
        </div>                          
        <?php wp_footer(); ?>
    </footer>

</body>
</html>