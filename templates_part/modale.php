
<!-- La popup -->
<div id="myModal" class="modal">

  <!-- contenu de la modale-->
  <div class="modal-content">
    <span class="close">x</span>
    <div class="display-form"> 
        
        <div>
            <?php
		    // On insère le formulaire de demandes de renseignements
		    echo do_shortcode('[contact-form-7 id="25" title="Formulaire de contact 1"]');
		    ?>
        </div>
        
    </div>
  </div>

</div>