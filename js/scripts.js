
//DOMContentLoaded permet de s'assurer qu'on a bien chargé notre DOM avant d'éxécuter les scripts
document.addEventListener('DOMContentLoaded', (event) => {

    //Gestion de la popup
    gestion_popup();

    //On récupère la référence photo dans le formulaire
    jQuery(document).ready(function($){
        $(".refer").val($('#reference-photo').text());
    });

})

function gestion_popup(){
    // On récupère la div popup
    var modal = document.getElementById('myModal');

    // On récupère le bouton contact
    var btn = document.getElementById("menu-item-26");
    var btncontact = document.getElementById("contact");
    //console.log(btncontact);
    
    // L'élément de fermeture de la modale
    var span = document.getElementsByClassName("close")[0];

    // Ouverture de la popup
    btn.onclick = function() {
        modal.style.display = "block";
    }
    if (btncontact !== null) {
        btncontact.onclick = function() {
            modal.style.display = "block";
        }
    }

    // Fermeture de la popup
    span.onclick = function() {
        modal.style.display = "none";
    }
}
