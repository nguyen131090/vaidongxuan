<div class="contain container-back">
    
    <div class="column">
       
       <?if($parents = $this->context->entry->parents()){
           $count = count($this->context->entry->parents());
           $paddingtop = NULL; 
           if(SEG3){
               $sg3 = SEG3;
           }else{
               $sg3 = '';
           }
           $seg3 = [
               'au-plus-pres-des-peuples' => 'au-plus-pres-des-peuples',
               'escales-charme' => 'escales-charme',
               'bouillon-histoire-art-culture' => 'bouillon-histoire-art-culture',
               'escapades-gourmandes' => 'escapades-gourmandes',
               'plongee-vie-locale' => 'plongee-vie-locale',
               'paradis-oublies' => 'paradis-oublies',
               'incontournables' => 'incontournables',
               'balneaire-mer-cocotiers' => 'balneaire-mer-cocotiers',
               'ethnies-sites-insolites' => 'ethnies-sites-insolites',
               'croisiere' => 'croisiere',
               'randonnees-treks' => 'randonnees-treks',
               'velo' => 'velo',
               'famille' => 'famille',
               'indochine-multi-pays' => 'indochine-multi-pays'
               
           ];
           if(isset($seg3[$sg3])){
               $url_seg3 = $seg3[$sg3];
           }else{
               $url_seg3 = '';
           }
           $class_hide = '';
           $title = $this->context->entry->parents()[$count - 1]->title;
           
            if(URI == SEG1.'/formules/'.SEG3){
                if(Yii::$app->controller->action->id == 'nos-destinations-country-exclusive-type'){
                  $title = 'TOUTES LES FORMULES D\'AMICA AU '.SEG1;
                } else{
                  $title = 'TOUTES LES FORMULES “'.$this->context->entry->parents()[$count - 1]->title.'”';
                  
                }
            }
            if(URI == SEG1.'/itineraire/'.SEG3){
                $title = 'TOUS NOS VOYAGES “'.$this->context->entry->parents()[$count - 1]->title.'”';
                if($this->context->entry->parents()[$count - 1]->category_id != 5){
                    $class_hide = 'fix-hide';
                }
            }
            
             if(URI == 'vietnam/'.SEG2 || URI == 'laos/'.SEG2 || URI == 'cambodge/'.SEG2 || URI == 'birmanie/'.SEG2){
                $title = 'TOUS LES SITES À VISITER '. (SEG1 == 'birmanie' ? 'en ' : 'au '). SEG1;
                
            }
            if(URI == SEG1.'/formules' || URI == SEG1.'/formules/'.$url_seg3 || URI == SEG1.'/itineraire' || URI == SEG1.'/itineraire/'.$url_seg3){
               $title = 'TOUTES NOS DESTINATIONS';
               $class_hide = '';
            }
           
            if(URI == SEG1.'/informations-pratiques' || URI == SEG1.'/guide' || URI == SEG1.'/visiter' ){
                $title = 'TOUTES NOS DESTINATIONS';
            }
            if(URI == 'tourisme-solidaire/'.SEG2){
               $title = 'Fondation Amica';
               $class_hide = 'fix-hide';
            }
            if(URI == 'tourisme-solidaire/projets/'.SEG3){
                $title = 'Tous nos projets solidaires';
            }
            if(URI == 'tourisme-solidaire/partenaires/'.SEG3 || URI == 'tourisme-solidaire/associations/'.SEG3){
                $class_hide = 'fix-hide';
            }
            if(URI == 'portrait-voyageur'){
                $class_hide = 'fix-hide';
            }
             if(URI == 'explorateurs/reportages'){
                $class_hide = 'fix-hide';
            }
             if(URI == 'explorateurs/reportages/'.SEG3){
                $title = 'Tous nos repérages';
            }
             if(URI == 'aide/'.SEG2 || URI == 'aide/'.SEG2.'/'.SEG3){
               //$title = 'TOUTES NOS IDÉES DE VOYAGE ';
               $paddingtop = 'padding-top: 61px;';
            }
            if(URI == 'actualites/'.SEG2){
               $title = ' Toutes les actualités';
               $paddingtop = 'padding-top: 60px;';
            }
            if(URI == 'temoignages/'.SEG2){
               $title = 'Tous les témoignages';
            }
            if(URI == 'formules/'.SEG2){
               $title = 'Toutes les formules d\'Amica';
            }
            if(URI == 'voyage/'.SEG2){
               $title = 'TOUTES NOS IDÉES DE VOYAGE ';
               
            }
            if(URI == 'voyage/plages-animees' || URI == 'voyage/plages-intimes' || URI == 'voyage/plages-locales' || URI == 'voyage/plages-sauvages'){
                $title = 'TOUS NOS VOYAGES “'.$this->context->entry->parents()[$count - 1]->title.'”';
                
            }
            
            if(URI == 'recrutement/'.SEG2){
                $title = 'TOUTES NOS OFFRES DE RECRUTEMENT';
            }
            
           
            $url = $this->context->entry->parents()[$count - 1]->slug;
           
           if(URI == SEG1.'/formules/'.$url_seg3 || URI == SEG1.'/itineraire/'.$url_seg3){
                
               $url = $this->context->entry->parents()[$count - 2]->slug;
              
           }
           
           // Fix URL  5 TAB Country Destination
           
           if(URI == SEG1.'/itineraire' || URI == SEG1.'/formules' || URI == SEG1.'/visiter' || URI == SEG1.'/informations-pratiques' || URI == SEG1.'/guide'){
               $url = $this->context->root->slug;
               //var_dump($this->context->root);exit;
           }   
           
           
           ?>
            
            <a class="btn-link-back tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom" href="<?= DIR.$url ?>"><span><?= $title ?></span></a>
            <span class="space space-60"></span>
       <?}else{
           $title = $this->context->root->model->title;
           $paddingtop = NULL;
           if(URI == 'formules/'.SEG2){
               $title = 'Toutes les formules d\'Amica';
               $paddingtop = 'padding-top: 59px;';
           }
            if(URI == 'voyage/'.SEG2){
               $title = 'TOUTES NOS IDÉES DE VOYAGE ';
               $paddingtop = 'padding-top: 59px;';
            }
            if(URI == 'aide/'.SEG2 || URI == 'aide/'.SEG2.'/'.SEG3){
               //$title = 'TOUTES NOS IDÉES DE VOYAGE ';
               $paddingtop = 'padding-top: 61px;';
            }
            if(URI == 'vietnam' || URI == 'laos' || URI == 'cambodge' || URI == 'birmanie'){
                $title = 'TOUTES NOS DESTINATIONS';
            }  
           
           ?>
            
            <a class="btn-link-back tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom-btn-back" href="<?= DIR.$this->context->root->slug?>"><span><?= $title ?></span></a>
            <span class="space space-60"></span>
       <? } ?>
    </div>
</div>    
<?php
$this->registerCss('
    .container-back{
        text-align: center;
        clear: both; 
    }
    .container-back .column{
        width: 100%;
        margin: 0 auto;
    }
    .container-back .btn-link-back{
        background: url(/assets/img/mobile/arrow-back-cam-29-46.png) 0 center no-repeat;
            display: table;
            height: 3rem;
            padding: 0 0 0 2.5rem;
            background-size: 1.45rem;
            margin: 0 auto;
    }
    .container-back .btn-link-back span{
        display: table-cell;
        vertical-align: middle;
        line-height: 1.6rem;
    }

');
?>
