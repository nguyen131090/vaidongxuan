<div class="breadcrumb">
    <div class="item">
        <a href="/"><span data-analytics="on" data-analytics-category="tour_page" data-analytics-action="breadcrumb_section" data-analytics-label="homepage">Accueil</span></a> <span> &gt; </span>
        
    </div>
<!--    <div class="item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem">
        <a  itemprop="item" href="/<?//= $destination['url']; ?>"><span itemprop="name"><?//= $destination['title']; ?></span></a>
        <meta itemprop="position" content="2" />
    </div>
    <span> &gt; </span>-->
    <div class="item">
        <a href="<?=DIR.SEG1 ?>"><span data-analytics="on" data-analytics-category="tour_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_page"><?= $breadcrumb_3['title']; ?></span></a> <span> &gt; </span>
        
    </div>
    <div class="item">
        <a href="<?=DIR.SEG1 ?>/itineraire"><span data-analytics="on" data-analytics-category="tour_page" data-analytics-action="breadcrumb_section" data-analytics-label="country_itineraries"> <?= $breadcrumb_4['title']; ?></span></a> <span> &gt; </span>
        
    </div>

    <div class="item">
        <span ><span><?= isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : $this->context->entry->title?></span></span>
        
    </div>
</div>
<?
$id_2 = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.SEG1;
$name_2 = $breadcrumb_3['title'];
$id_3 = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.SEG1.'/itineraire';
$name_3 = $breadcrumb_4['title'];
$id_4 = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->entry->slug;
$name_4 = isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : $this->context->entry->title;
$txt_first =<<<TXT
{
"@context": "http://schema.org",
"@type": "BreadcrumbList",
"itemListElement": [{
"@type": "ListItem",
"position": 1,
"item": {
"@id": "https://www.amica-travel.com/",
"name": "Accueil"
}
},{
"@type": "ListItem",
"position": 2,
"item": {
"@id": "$id_2",
"name": "$name_2"
}
},{
"@type": "ListItem",
"position": 3,
"item": {
"@id": "$id_3",
"name": "$name_3"
}
},{
"@type": "ListItem",
"position": 4,
"item": {
"@id": "$id_4",        
"name": "$name_4"
}
}]
}
TXT;

$this->context->json_ld_breadcrumd = $txt_first;

?>  