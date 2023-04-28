
//DOMContentLoaded permet de s'assurer qu'on a bien chargé notre DOM avant d'éxécuter les scripts
document.addEventListener('DOMContentLoaded', (event) => {

    //Gestion de la popup
    gestion_popup();

    //On récupère la référence photo dans le formulaire
    jQuery(document).ready(function($){
        $(".refer").val($('#reference-photo').text());
    });

    //Fonction AJAX pour charger plus de photos    
    charger_photos();  
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

function charger_photos(){
    jQuery(document).ready(function($){   

        let currentPage = 1;
        $('#load-more').on('click', function() {
            currentPage++;        
            console.log(currentPage);                
            $.ajax({
                type: 'GET',
                url: '/photos-mota/wp-admin/admin-ajax.php',
                dataType: 'html',
                data: {
                action: 'action_load_more',
                paged: currentPage,
                },
                success: function (response) {   
                    //Quand on arrive à la fin des posts, on cache le bouton charger plus
                    var maxpages = $('input[name="max-pages"]').val();
                    if( currentPage >= maxpages) {
                        $('#load-more').hide();
                    }                            
                    $('.suite-photos').append(response);          
                },
        
            });
        });
        
    });
}