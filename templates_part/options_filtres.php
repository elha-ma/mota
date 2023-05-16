<div class="row-column">
    <!-- Affichage des noms de la taxonomie "catégorie"-->
    <div class="space-r space-b">
        <div>
            <label>CATEGORIES</label>
        </div>
        <div>     
            <?php 
            
            $terms = get_terms([
                'taxonomy' => 'categorie',
                'hide_empty' => false,
            ]);
            ?>
            <select name="cat" id="select-cat" class="sel-option">
                <option value="tous">--</option>
                <?php
                foreach ($terms as $term){
                    echo "<option value=".$term->slug.">".$term->name."</option>";               
                }
                ?>	
            </select>
        </div>
    </div>

    <!-- Affichage des noms de la taxonomie "formats"-->
    <div class="space-b">
        <div>
            <label>FORMATS</label>
        </div>
        <div>        
            <?php 
            $terms = get_terms([
                'taxonomy' => 'format',
                'hide_empty' => false,
            ]);
            ?>
            <select name="format" id="select-format" class="sel-option">
                <option value="tous">--</option>
                <?php
                foreach ($terms as $term){
                    echo "<option value=".$term->slug.">".$term->name."</option>";               
                }
                ?>	
            </select>
        </div>
    </div>


    <!-- Trier les photos-->
    <div class="pos-tri space-b">
        <div>
            <label>TRIER PAR</label>
        </div>
        <div>
            <select name="tri" id="select-tri" class="sel-option">
                <option value="DESC">--</option>
                <option value="DESC">Nouveautés</option>
                <option value="ASC">Les plus anciens</option>
            </select>
        </div>
    </div>

</div>