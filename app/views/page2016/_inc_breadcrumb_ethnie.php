<div class="breadcrumb">
    <div class="item">
        <a href="/"><span>Accueil</span></a> <span> &gt; </span>
        
    </div>
<?
$json_bread = [];
$json_bread[1] =<<<TXT
{
    "@type": "ListItem",
    "position": 1,
    "item": {
    "@id": "https://www.amica-travel.com/",
    "name": "Accueil"
    }
}
TXT;
?>     
    <? if($this->context->root->slug != 'destinations'){ ?>
    <div class="item">
        <a href="<?=DIR.$this->context->root->slug ?>"><span><?=$this->context->root->model->seo->breadcrumb ? $this->context->root->model->seo->breadcrumb : $this->context->root->title?></span></a>
       
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
    <? if(isset($this->context->entry)) : ?>
       
        <? if($parents = $this->context->entry->parents()) : ?>
            <? foreach($parents as $kpr => $vpr) : ?>
                <div class="item">
                    <a href="<?=DIR.$vpr->slug ?>"><span><?=$vpr->seo['breadcrumb'] ? $vpr->seo['breadcrumb'] : $vpr->title?></span></a> <span> &gt; </span>
                    
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
            <a href="<?=DIR.SEG1?>/visiter" ><span>Que visiter au <?=ucfirst(SEG1)?> ?</span></a>
            
        </div>
<?
$txt_name =  ucfirst(SEG1);
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.SEG1.'/visiter';
$position = count($parents) + $j;
$json_bread[$position] =<<<TXT
{
    "@type": "ListItem",
    "position": $position,
    "item": {
    "@id": "$id_url",    
    "name": "Que visiter au $txt_name"
    }
}
TXT;
?>      
        <span> &gt; </span>
        <div class="item">
            <span><span><?= isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : $this->context->entry->title?></span></span>
            
        </div>
<?
$txt_name =  isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : $this->context->entry->title; 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->entry->slug;
$position = count($parents) + $j + 1;
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