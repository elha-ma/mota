
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
    charger_photos_single();
    charger_photos_page();  

    //Filtrer les photos en fonction de la catégorie et du format
    filtrer_photos();

    //Affichage des vignettes dans la page single
    afficher_vignette();

    //Affichage des icônes oeil et plein écran
    afficher_icones();

    //Gestion de la lightbox
    gestion_lightbox();
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

function charger_photos_single(){
    jQuery(document).ready(function($){   

        $('#load-all').on('click', function() {   
       
            $.ajax({
                type: 'GET',
                url: '/photos-mota/wp-admin/admin-ajax.php',
                dataType: 'html',
                data: {                
                    categorie: $('input[name="categ"]').val(),
                    action: 'action_load_more',
                },
                success: function (response) {  
                    $('.display-photo').remove();  
                    $('#load-all').hide();                                              
                    $('.suite-photos').append(response);
                    //charger les events pour gérer la lightbox et afficher les icones eye et fullscreen
                    gestion_lightbox();
                    afficher_icones();          
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
                    //charger les events pour gérer la lightbox et afficher les icones eye et fullscreen
                    gestion_lightbox();
                    afficher_icones();   
                    //Quand on arrive à la fin des posts, on cache le bouton charger plus
                    var maxpages = $('input[name="max-pages"]').val();
              
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
                    //charger les events pour gérer la lightbox et afficher les icones eye et fullscreen
                    gestion_lightbox();
                    afficher_icones();        
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

function afficher_vignette(){
    jQuery(document).ready(function($){ 
        //Afficher la vignette      
        $('.flechenext').on('mouseover', function() {
            $('.visiblenext').css('visibility','visible');
        });
        $('.flecheprev').on('mouseover', function() {
            $('.visibleprev').css('visibility','visible');
        });
        //Cacher la vignette
        $('.flechenext').on('mouseout', function() {
            $('.visiblenext').css('visibility','hidden');
        });
        $('.flecheprev').on('mouseout', function() {
            $('.visibleprev').css('visibility','hidden');
        });
    });
}

function afficher_icones(){
    jQuery(document).ready(function($){   

        $('.half').on('mouseover', function() {
            //On récupère l'id du div séléctionné
            var obj = $(this);
            var id = obj.attr("id");  
            console.log("mouseover : ", id);             
            if (id != 'undefined'){
                //On affiche les icones 
                $('#' + id).find('.display-eye').css('display','block');
                $('#' + id).find('.display-fullscreen').css('display','block');
            }              
        });

        $('.half').on('mouseout', function() {
            var obj = $(this);
            var id = obj.attr("id");                 
            if (id != 'undefined'){
                //On cache les icones
                $('#' + id).find('.display-eye').css('display','none');
                $('#' + id).find('.display-fullscreen').css('display','none');
            }              
        });

    });
}

function gestion_lightbox(){    
    jQuery(document).ready(function($){  

        // Ouverture de la lightbox
        $('.btnlightbox').on('click', function() { 
            $.ajax({
                type: 'GET',
                url: '/photos-mota/wp-admin/admin-ajax.php',
                dataType: 'html',
                data: {                
                    identifiant: $(this).parent().attr("id"),
                    action: 'action_lightbox',
                },
                success: function (response) {               
                    // construction de la lightbox
                    $('.box').append(response);  
                    // fermeture de la lightbox 
                    $('.lightbox_close').on('click', function() {                 
                        $('#light_box').remove();
                    });
                    $('.lightbox_prev').on('click', function() {                 
                        next_image(identifiant);
                    });
                },        
            });    
        }); 
    });   
}

function next_image($id){
    jQuery(document).ready(function($){  
        $('.lightbox_container').remove();
        $.ajax({
            type: 'GET',
            url: '/photos-mota/wp-admin/admin-ajax.php',
            dataType: 'html',
            data: {                
                identifiant: $id,
                action: 'prev_next_lightbox',
            },
            success: function (rep) {               
                // construction de la lightbox
                $('lightbox_container').remove();
                
                $('.box').append(rep);  
          
            },        
        });
        
    });
}