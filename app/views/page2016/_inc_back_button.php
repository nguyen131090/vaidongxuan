<?
    $arrAnaly = '';
    if(URI == SEG1.'/itineraire/'.SEG3){
        $arrAnaly = 'data-analytics="on" data-analytics-category="tour_page" data-analytics-action="back_section" data-analytics-label="link_inspirations"';
    }
    if(Yii::$app->controller->action->id == 'fondation-single-about-us'){
        if(SEG2 == 'partenaires'){
            $arrAnaly = 'data-analytics="on" data-analytics-category="partenaire_single" data-analytics-action="back_section" data-analytics-label="link_partenaire"';
        }
        if(SEG2 == 'associations'){
            $arrAnaly = 'data-analytics="on" data-analytics-category="association_single" data-analytics-action="back_section" data-analytics-label="link_associations"';
        }

    }else if(Yii::$app->controller->action->id == 'nos-destinations-detaile-infos' || Yii::$app->controller->action->id == 'nos-destinations-detaile-infos-single'){ // page vietnam/informations-pratiques/comment-organiser-son-voyage || vietnam/guide/langue-vietnamienne
        $category = SEG2 == 'guide' ? 'guide_single' : 'info_single';
        $arrAnaly =  'data-analytics="on" data-analytics-category="'.$category.'" data-analytics-action="back_section" data-analytics-label="btn_back"';   
    }
?>
<div class="contain container-back">
    
    <div class="column">
       <? if(Yii::$app->controller->action->id == 'exclusivites-single'){
    $arrAnaly = " data-analytics ='on' data-analytics-category='secret_single
' data-analytics-action ='back_section' data-analytics-label='link_secrets_inspirations' ";
}?>

       <?
       $parents = $this->context->entry->parents();
      
       if($parents){
           
           foreach ($parents as $kp => $kv) {
                  
                if($kv->seo['breadcrumb'] == 'none'){
                    unset($parents[$kp]);
                }
                    
            }
          
           
           $count = count($parents);
          
            
           
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
           $title = $parents[$count - 1]->title;
           
            if(URI == SEG1.'/formules/'.SEG3){
                if(Yii::$app->controller->action->id == 'nos-destinations-country-exclusive-type'){
                  $title = 'Toutes les formules d\'Amica au '.SEG1;
                } else{
                  $title = 'Toutes les formules “'.$parents[$count - 1]->title.'”';
                  
                }
            }
            if(URI == SEG1.'/itineraire/'.SEG3){
                $title = 'Tous nos voyages “'.$parents[$count - 1]->title.'”';
                if($parents[$count - 1]->category_id != 5){
                    $class_hide = 'fix-hide';
                }
            }
            
             if(URI == 'vietnam/'.SEG2 || URI == 'laos/'.SEG2 || URI == 'cambodge/'.SEG2 || URI == 'birmanie/'.SEG2){
                $title = 'Tous les sites à visiter '. (SEG1 == 'birmanie' ? 'en ' : 'au '). SEG1;
                $arrAnaly = 'data-analytics="on" data-analytics-category="city_single" data-analytics-action="back_section" data-analytics-label="link_cities"';
                
            }
            if(URI == SEG1.'/formules' || URI == SEG1.'/formules/'.$url_seg3 || URI == SEG1.'/itineraire' || URI == SEG1.'/itineraire/'.$url_seg3){
               $title = 'Toutes nos destinations';
               $class_hide = '';
            }
           
            if(URI == SEG1.'/informations-pratiques' || URI == SEG1.'/guide' || URI == SEG1.'/visiter' ){
                $title = 'Toutes nos destinations';
            }
            if(URI == 'tourisme-solidaire/'.SEG2){
               $title = 'Fondation Amica';
               $class_hide = 'fix-hide';
            }
            if(URI == 'tourisme-solidaire/projets/'.SEG3){
                $title = 'Tous nos projets solidaires';
              //  $class_hide = 'fix-hide';
            }
            if(URI == 'tourisme-solidaire/partenaires/'.SEG3 || URI == 'tourisme-solidaire/associations/'.SEG3){
                $class_hide = 'fix-hide';
            }
            if(URI == 'portrait-voyageur'){
                //$class_hide = 'fix-hide';
            }
             if(URI == 'explorateurs/reportages'){
                $class_hide = 'fix-hide';
            }
             if(URI == 'explorateurs/reportages/'.SEG3){
                $title = 'Tous nos repérages';
            }
             if(URI == 'aide/'.SEG2 || URI == 'aide/'.SEG2.'/'.SEG3){
               //$title = 'TOUTES NOS IDÉES DE VOYAGE ';
               $paddingtop = 'padding-top: 55px;';
              // $class_hide = 'fix-hide';
            }
            
            if(URI == 'actualites/'.SEG2){
               $title = ' Toutes les actualités';
               $paddingtop = 'padding-top: 45px;';
               $class_hide = 'fix-hide';
            }
            if(URI == 'temoignages/'.SEG2){
               $title = 'Tous les témoignages';
            }
            if(URI == 'formules/'.SEG2){
               $title = 'Toutes les formules d\'Amica';
            }
            if(URI == 'voyage/'.SEG2){
               $title = 'Toutes nos idées de voyage ';
               
            }
            if(URI == 'voyage/plages-animees' || URI == 'voyage/plages-intimes' || URI == 'voyage/plages-locales' || URI == 'voyage/plages-sauvages'){
                $title = 'Tous nos voyages “'.$parents[$count - 1]->title.'”';
                
            }
            
            if(URI == 'recrutement/'.SEG2){
                $title = 'Toutes nos offres de recrutement';
                 $class_hide = 'fix-hide';
            }
             if(URI == 'nos-bureaux/'.SEG2){
               
                 $class_hide = 'fix-hide';
            }
            if(URI == 'recrutement'){
                $class_hide = 'fix-hide';
            }
            if(URI == 'conditions-generales-de-vente'){
                $class_hide = 'fix-hide';
            }
            if(URI == 'mentions-legales'){
                $class_hide = 'fix-hide';
            }
            if(URI == 'portrait-voyageur/'.SEG2){
                $paddingtop = 'padding-top: 45px;';
            }
           
            $url = $parents[$count - 1]->slug;
            
           if(URI == SEG1.'/formules/'.$url_seg3 || URI == SEG1.'/itineraire/'.$url_seg3){
                
               $url = $parents[$count - 2]->slug;
              
           }
          // var_dump($parents);exit;
           // Fix URL  5 TAB Country Destination
           
           if(URI == SEG1.'/itineraire' || URI == SEG1.'/formules' || URI == SEG1.'/visiter' || URI == SEG1.'/informations-pratiques' || URI == SEG1.'/guide'){
               $url = $this->context->root->slug;
               //var_dump($this->context->root);exit;
           }   
           if(Yii::$app->controller->action->id == 'nos-destinations-detaile'){
              // var_dump($parents[$count - 2]->slug);exit;
             //  $url = $parents[$count - 2]->slug;
           }
          
           ?>
<!--        <div class="border-line <?//= SEG1 ?> <?//= $class_hide?>" style="<?//=$paddingtop?>"></div>-->
            <a class="btn-link-back mt-txt-40 mb-txt-60" href="<?= DIR.$url ?>" <?= $arrAnaly ?>><?= $title ?></a>
       <?}else{
           $title = $this->context->root->model->title;
           $paddingtop = NULL;
           if(URI == 'formules/'.SEG2){
               $title = 'Toutes les formules d\'Amica';
               $paddingtop = 'padding-top: 59px;';
           }
            if(URI == 'aide/'.SEG2 || URI == 'aide/'.SEG2.'/'.SEG3){
               //$title = 'TOUTES NOS IDÉES DE VOYAGE ';
               $paddingtop = 'padding-top: 55px;';
            }
            if(URI == 'voyage/'.SEG2){
               $title = 'Toutes nos idées de voyage ';
               $paddingtop = 'padding-top: 59px;';
            }
            if(URI == 'vietnam' || URI == 'laos' || URI == 'cambodge' || URI == 'birmanie'){
                $title = 'Toutes nos destinations';
            }  
          
           ?>
            <a class="btn-link-back mt-txt-40 mb-txt-60" href="<?= DIR.$this->context->root->slug?>" <?= $arrAnaly ?>><?= $title ?></a>
        
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
        width: 100% !important;
        max-width: 960px !important;
        margin: 0 auto;
        padding: 0 10px;
    }
    .container-back .btn-link-back{
        background: rgba(0, 0, 0, 0) url("/assets/img/back-button.png") no-repeat scroll 0 center;
        color: #e1653f;
        display: inline-block;
        font: 13.5px/26px LatoLatin-Bold,sans-serif;
        height: 26px;
        margin: 33px 0px;
        padding: 1px 0 0 38px;
        text-transform: uppercase;
    }
    .container-back .btn-link-back:hover{
        opacity: 0.7;
        color: #e1653f;
    }
    .container-back .border-line{
        border-bottom: 1px solid #cbc0a2;
        display: block;
        margin: 0 auto;
        width: 100px;
        padding-top: 60px;
    }
    .container-back .border-line.a-propos-de-nous{
        display: none;
    }
    .container-back .temoignages{
        display: none;
    }
    .container-back .border-line.portrait-voyageur{
        display: none;
    }
    
    .container-back .fix-hide{
        display: none;
    }
    .container-back .confiance{
        display: block !important;
        padding-top: 60px;
    }
    .container-back .chez-habitant-indochine{
         display: block !important;
    }
    .container-back .mentions-legales{
        display: block !important;
        padding-top: 45px;
    }
    .container-back .conditions-generales-de-vente{
        display: block !important;
        padding-top: 40px;
    }
    .container-back .recrutement{
        display: block !important;
        padding-top: 55px;
    }
    .container-back .politique-de-confidentialite{
        display: block !important;
        padding-top: 45px;
    }
    
    
    /* Fix khoang cach noi dung trang so voi nut quay ve trang me cua nhung trang can fix tai day */
    
    /* Trang vietnam/informations-pratiques  va Trang vietnam */
    .fix-space-vs-back-button .guide{
        margin-bottom: 0 !important;
    }
    .fix-space-vs-back-button .blogs{
        margin-bottom: 0 !important;
    }
    .fix-space-vs-back-button .birmanie .link-to-blog{
        margin-bottom: 0 !important;
    }

    
    /* Trang vietnam/guide */
    .fix-space-vs-back-button .country-tours{
        padding-bottom: 0;
    }
    
    /* Fix trang Exclusive type */
    .fix-space-vs-back-button .row-2{
        padding-bottom: 0 !important;
    }
    .fix-space-vs-back-button .row-2 .r2{
        padding-bottom: 0 !important;
    }
    /* Fix trang Exclisuve Single */
    
    .fix-space-vs-back-button .related-articles{
        margin-bottom: 0 !important;
    }
    
    /* Fix trang tourisme-solidaire/projets/lolo-noirs-vietnam */
     .fix-space-vs-back-button{
        margin-bottom: 0 !important;
    }   
    .fix-space-vs-back-button .item .posi{
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
    }
    /* Fix trang recrutement/conseiller-en-voyage-b2c */
    .fix-space-vs-back-button .row-1, .fix-space-vs-back-button .row-2{
        
        margin-bottom: 0 !important;
    }

');
?>
