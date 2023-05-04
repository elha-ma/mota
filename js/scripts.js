
//DOMContentLoaded permet de s'assurer qu'on a bien chargé notre DOM avant d'éxécuter les scripts
document.addEventListener('DOMContentLoaded', (event) => {
    //déclaration d'une variable globale pour la gestion des filtres et tri
    raz_numpage = false;

    //Gestion de la popup
    gestion_popup();

    //On récupère la référence photo dans le formulaire
    jQuery(document).ready(function($){
        $(".refer").val($('#reference-photo').text());
    });

    //Fonction AJAX pour charger les photos (load more)
    charger_photos_page();  

    //Filtrer les photos en fonction de la catégorie et du format
    filtrer_photos();
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
        $('#load-all').on('click', function() {     
            console.log(currentPage);                
            $.ajax({
                type: 'GET',
                url: '/photos-mota/wp-admin/admin-ajax.php',
                dataType: 'html',
                data: {
                action: 'action_load_more',
                },
                success: function (response) {                               
                    $('.suite-photos').append(response);          
                },        
            });
        });
        
    });
}

function charger_photos_page(){
    jQuery(document).ready(function($){   

        let currentPage = 1;
    
        $('#load-more').on('click', function() {
            if (raz_numpage){
                currentPage = 2;
                raz_numpage = false;
            } else{
                currentPage++;  
            }              
                  
            console.log(currentPage);                
            $.ajax({
                type: 'GET',
                url: '/photos-mota/wp-admin/admin-ajax.php',
                dataType: 'html',
                data: {
                    categorie: $('select[id="select-cat"]').val() ,        
                    format: $('select[id="select-format"]').val() , 
                    tri: $('select[id="select-tri"]').val() , 
                    paged: currentPage,
                    action: 'filtre_photos',               
                },
                success: function (response) {   
                    $('#max-pages').remove();
                    $('#msg-photo').remove();
                    $('.suite-photos').append(response);    
                    //Quand on arrive à la fin des posts, on cache le bouton charger plus
                    var maxpages = $('input[name="max-pages"]').val();
                    //console.log("maxpages : ", maxpages);
                    
                    if (maxpages <= 1) {
                        $('#load-more').hide();
                    } else {
                        $('#load-more').show();
                    }    
                    if( currentPage >= maxpages) {
                        $('#load-more').hide();
                    }                                   
                       
                },
        
            });
        });
        
    });
}


function filtrer_photos(){
    jQuery(document).ready(function($){   

        $('.sel-option').on('change', function() {  
            raz_numpage = true;
            $.ajax({
                type: 'GET',
                url: '/photos-mota/wp-admin/admin-ajax.php',
                dataType: 'html',
                data: {
                categorie: $('select[id="select-cat"]').val() ,        
                format: $('select[id="select-format"]').val() , 
                tri: $('select[id="select-tri"]').val() , 
                action: 'filtre_photos',
                //paged: '1',
                },
                success: function (response) {     
                    
                    //On supprime les photos affichés pour permettre l'affichage des photos suivant les nouvelles conditions 
                    $('.display-photo').remove();
                    $('#max-pages').remove();
                    $('#msg-photo').remove();
                    $('.suite-photos').append(response);              
                    var maxpages = $('input[name="max-pages"]').val();
                    console.log("nounou: ", maxpages );
                   
                    if (maxpages <= 1) {
                        $('#load-more').hide();
                    } else {
                        $('#load-more').show();
                    }             
                                    
                            
                },
               
            });
        });
        
    });
}