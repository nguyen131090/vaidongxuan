<?
    $sg1 = ['temoignages','portrait-voyageur', 'actualites'];
    if(in_array(SEG1, $sg1) && SEG2 != Null){
        $fix_breadcrumb = 'fix-breadcrumb';
    }else if(SEG1 == 'tourisme-solidaire' && SEG2 != NULL && SEG3 != NULL && SEG2 != 'projets'){
        $fix_breadcrumb = 'fix-breadcrumb';
     }else if(SEG1 == 'mentions-legales' || SEG1 == 'conditions-generales-de-vente' || SEG1 == 'politique-de-confidentialite'){
         $fix_breadcrumb = 'fix-breadcrumb';
     }else if(URI == 'voyage/itineraire' || URI == 'formules/itineraire'){
         $fix_breadcrumb = 'fix-breadcrumb';
     }else if(SEG2 == 'reportages' && SEG3 != NULL){
         $fix_breadcrumb = 'fix-breadcrumb';
     }else if(SEG1 == 'recrutement' && SEG2 != NULL){
         $fix_breadcrumb = 'fix-breadcrumb';
     }else if(SEG2 == 'projets' && SEG3 != NULL){
         $fix_breadcrumb = 'fix-breadcrumb';
     }else if(SEG1 == 'francophonie'){
         $fix_breadcrumb = 'fix-breadcrumb';
     }else if(Yii::$app->controller->action->id == 'page-list' || Yii::$app->controller->action->id == 'page-detail'){
         $fix_breadcrumb = 'fix-breadcrumb';
     }else{
        $fix_breadcrumb = Null;
    }
?>
<?
    if(empty($arrAnaly)) $arrAnaly = [];
    if(Yii::$app->controller->action->id == 'nos-destinations-country-info'){ // page informations-pratiques
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="infos_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="infos_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"'
        ];   
    }else if(Yii::$app->controller->action->id == 'nos-destinations-guide-type'){ // page guide
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="guide_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="guide_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"'
        ];   
    }else if(Yii::$app->controller->action->id == 'nos-destinations-country-exclusive'){ // page vietnam/formules
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"',
        ];   
    }else if(Yii::$app->controller->action->id == 'nos-destinations-visiter'){ // page vietnam/visiter
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="cities_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="cities_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"',
        ];   
    }else if(Yii::$app->controller->action->id == 'nos-destinations-country-ideel'){ // page vietnam/itineraire
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"',
        ];   
    }else if(Yii::$app->controller->action->id == 'nos-destinations-detaile'){ // page vietnam/hanoi
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="city_single" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="city_single" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"',
            '3' => 'data-analytics="on" data-analytics-category="city_single" data-analytics-action="breadcrumb_section" data-analytics-label="cities_page"',
        ];   
    } else if(Yii::$app->controller->action->id == 'idees-de-voyage-type'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="inspirations_cat_page" data-analytics-action="breadcrumb_section" data-analytics-label="inspirations_page"',
        ];   

    } else if(Yii::$app->controller->action->id == 'thanks'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="thankyou_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"'

        ];   

    } else if(Yii::$app->controller->action->id == 'host'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="host_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="host_page" data-analytics-action="breadcrumb_section" data-analytics-label="habitant"',
        ];   

    }else if(Yii::$app->controller->action->id == 'fondation-single-about-us'){
        if(SEG2 == 'partenaires'){
            $arrAnaly = [
                '1' => 'data-analytics="on" data-analytics-category="partenaire_single" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
                '2' => 'data-analytics="on" data-analytics-category="partenaire_single" data-analytics-action="breadcrumb_section" data-analytics-label="qui_page"',
                '3' => 'data-analytics="on" data-analytics-category="partenaire_single" data-analytics-action="breadcrumb_section" data-analytics-label="tourisme_page"',
                '4' => 'data-analytics="on" data-analytics-category="partenaire_single" data-analytics-action="breadcrumb_section" data-analytics-label="partenaires_page"',
            ]; 
        }
        if(SEG2 == 'associations'){
            $arrAnaly = [
                '1' => 'data-analytics="on" data-analytics-category="association_single" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
                '2' => 'data-analytics="on" data-analytics-category="association_single" data-analytics-action="breadcrumb_section" data-analytics-label="qui_page"',
                '3' => 'data-analytics="on" data-analytics-category="association_single" data-analytics-action="breadcrumb_section" data-analytics-label="tourisme_page"',
                '4' => 'data-analytics="on" data-analytics-category="association_single" data-analytics-action="breadcrumb_section" data-analytics-label="associations_page"',
            ]; 
        }

    }else if(Yii::$app->controller->action->id == 'recherche-idees-de-voyage'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="itineraries_page" data-analytics-action="breadcrumb_section" data-analytics-label="voyage"',
        ];   

    }else if(URI == 'formules/itineraire'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="secrets"',
        ];   

    }
    else if(Yii::$app->controller->action->id == 'nos-destinations-country-exclusive-type'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"',
            '3' => 'data-analytics="on" data-analytics-category="formules_page" data-analytics-action="breadcrumb_section" data-analytics-label="secrets"',
        ];   

    }else if(Yii::$app->controller->action->id == 'nos-destinations-detaile-infos' || Yii::$app->controller->action->id == 'nos-destinations-detaile-infos-single'){ // page vietnam/informations-pratiques/comment-organiser-son-voyage || vietnam/guide/langue-vietnamienne
        $category = SEG2 == 'guide' ? 'guide_single' : 'info_single';
        $label_3 = SEG2 == 'guide' ? 'guide_page' : 'info_page';
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="'.$category.'" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="'.$category.'" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"',
            '3' => 'data-analytics="on" data-analytics-category="'.$category.'" data-analytics-action="breadcrumb_section" data-analytics-label="'.$label_3.'"',
        ];   
    }
    else if(Yii::$app->controller->action->id == 'nos-destinations-country'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="country_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
        ];   

    }
    else if(Yii::$app->controller->action->id == 'propos-de-nous-about-us'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="qui_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
        ];
    }    
    else if(Yii::$app->controller->action->id == 'nos-destinations-country-ideel-type'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="itineraries_cat_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
            '2' => 'data-analytics="on" data-analytics-category="itineraries_cat_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"',
            '3' => 'data-analytics="on" data-analytics-category="itineraries_cat_page" data-analytics-action="breadcrumb_section" data-analytics-label="itineraries_page"',
        ];
    }    
    else if(Yii::$app->controller->action->id == 'idees-de-voyage'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="voyage_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
        ];
    }    
    else if(Yii::$app->controller->action->id == 'exclusivites'){
        $arrAnaly = [
            '1' => 'data-analytics="on" data-analytics-category="formule_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage"',
        ];   

    }
?>
<div class="breadcrumb <?= $fix_breadcrumb ?>">
    <div class="item">
        <a href="/"><span <?= isset($arrAnaly['1']) ? $arrAnaly['1'] : '' ?>>Trang chủ</span></a> <span> &gt; </span>
        
    </div>
<?
$json_bread = [];
$json_bread[1] =<<<TXT
{
    "@type": "ListItem",
    "position": 1,
    "item": {
    "@id": "https://www.amica-travel.com/",
    "name": "Trang chủ"
    }
}
TXT;
?>    

    <? if(isset($this->context->entry)) : ?>
        <? if(!empty($this->context->root->slug) && $this->context->root->slug != 'destinations'){ ?>
            <div class="item">
                <a href="<?=DIR.$this->context->root->slug ?>"><span <?= isset($arrAnaly['2']) ? $arrAnaly['2'] : '' ?>><?=$this->context->root->model->seo->breadcrumb ? $this->context->root->model->seo->breadcrumb : $this->context->root->title?></span></a>
                
            </div>
            <span> &gt; </span>
            
<?
$txt_name =  $this->context->root->model->seo->breadcrumb ? $this->context->root->model->seo->breadcrumb : $this->context->root->title; 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->root->slug;
$json_bread[2] =<<<TXT
{
    "@type": "ListItem",
    "position": 2,
    "item": {
    "@id": "$id_url",
    "name": "$txt_name"
    }
}
TXT;
?>
            
        <? 
            $j = 3;
        }else{ 
            $j = 2;
        }
        ?>   
         <?
         if(($parents = $this->context->entry->parents()) == false){
             $countparent = 0;
         }else{
                foreach ($parents as $kp => $kv) {
                    if($kv->seo['breadcrumb'] == 'none')
                        unset($parents[$kp]);
                }
                $parents = array_values($parents);
             $countparent = count($parents);
         }
         ?>   
       
        <? if($parents) : ?>
            <? foreach($parents as $kpr => $vpr) : ?>
                <div class="item">
                    <a href="<?=DIR.$vpr->slug ?>"><span <?= isset($arrAnaly[$kpr+$j]) ? $arrAnaly[$kpr+$j] : '' ?>><?=$vpr->seo['breadcrumb'] ? $vpr->seo['breadcrumb'] : $vpr->title?></span></a> <span> &gt; </span>
                    
                </div>
<?
$txt_name =  $vpr->seo['breadcrumb'] ? $vpr->seo['breadcrumb'] : $vpr->title; 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$vpr->slug;
$position = $kpr + $j;
$json_bread[$position] =<<<TXT
{
    "@type": "ListItem",
    "position": $position,
    "item": {
    "@id": "$id_url",
    "name": "$txt_name"
    }
}
TXT;
?>            
            <? endforeach; ?>
        <? endif;?>
        <div class="item">
            <span><span><?= isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : str_replace('|', '', $this->context->entry->title)?></span></span>
            
        </div>

<?
$txt_name =  isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : str_replace('|', '', $this->context->entry->title); 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->entry->slug;
$position = $countparent + $j;
$json_bread[$position] =<<<TXT
{
    "@type": "ListItem",
    "position": $position,
    "item": {
    "@id": "$id_url",    
    "name": "$txt_name"
    }
}
TXT;
?>             
            
    <?php else:?>
        <div class="item">
            <span><?=$this->context->root->model->seo->breadcrumb ? $this->context->root->model->seo->breadcrumb : $this->context->root->title?></span>
            
        </div>
<?
$txt_name =  $this->context->root->model->seo->breadcrumb ? $this->context->root->model->seo->breadcrumb : $this->context->root->title; 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->root->slug;
$position = 2;
$json_bread[$position] =<<<TXT
{
    "@type": "ListItem",
    "position": $position,
    "item": {
    "@id": "$id_url",   
    "name": "$txt_name"
    }
}
TXT;
?>             
    <? endif;?>
</div>

<?

$txt_first =<<<TXT
{
"@context": "http://schema.org",
"@type": "BreadcrumbList",
"itemListElement": [
TXT;

$txt_last =<<<TXT
]
}
TXT;

foreach ($json_bread as $key => $value) {
    $txt_first .= $value;
    if($key <= count($json_bread) - 1){
     $txt_first .= ',';  
    }
}
$txt_first .= $txt_last;
$this->context->json_ld_breadcrumd = $txt_first;
//var_dump($this->context->json_ld_breadcrumd);exit;
//$this->registerJsonLd($txt_first, \yii\web\View::POS_END);
//echo Html::script($txt_first, ['type' => 'application/ld+json']);
?>