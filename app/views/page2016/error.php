
<?php
use yii\helpers\Html;
$this->title = 'Page non trouvée | Amica Travel';
?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/error.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
    
    <div class="amc-column row-1">
        <div class="breadcrumb fix-breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
  <div class="item" itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
    <a itemprop="item" href="/"><span itemprop="name">Accueil</span></a> <span> &gt; </span> 
    <meta itemprop="position" content="1" />
  </div>
      <div class="item" itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
    <span  itemprop="item" ><span itemprop="name">404 error</span></span>
    <meta itemprop="position" content="2" />
  </div>
</div>

    </div>   
     
    
</div>
<div class="contain container-2">
    
    <div class="amc-column">
        <div class="rows row-1">
            <div class="amc-col amc-col-1">
                <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/404.jpg">
            </div>
            <div class="amc-col amc-col-2">
               <p>Il semble qu’il y ait une erreur sur cette page :</p>
               <p><strong><?= str_replace('http', 'https', Yii::$app->request->getAbsoluteUrl()) ?></strong></p>
                <p>Nous sommes désolés, choisissez un des liens ci-dessous pour accéder à une des sections de notre site.</p>
                <ul>
                        <li><?=Html::a('Page d\'accueil', '/')?></li>
                        <li><?=Html::a('Idées de voyage', '/voyage')?></li>
                        <li><?=Html::a('Nous contacter', '/nous-contacter')?></li>
                </ul>
                
            </div>
        </div>
   </div>
</div>   
