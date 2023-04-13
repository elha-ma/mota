
<!-- La popup -->
<div id="myModal" class="modal">

  <!-- contenu de la modale-->
  <div class="modal-content">
    <div><span class="close">x</span></div>
    <div class="fond pos-fond"></div>
    <div class="fond pos-fond-left"></div>

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