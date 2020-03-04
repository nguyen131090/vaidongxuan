<?php $this->registerCssFile('/assets/css/page2016/actualites-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <div class="amc-column row-1">
        <div class="breadcrumb fix-breadcrumb">
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
            
            <? if(isset($this->context->entry)) : ?>
                <? if($parents = $this->context->entry->parents()) : ?>
                    <? foreach($parents as $kpr => $vpr) : ?>
                    <div class="item">
                        <a href="<?=DIR.$vpr->slug ?>"><span><?=$vpr->seo['breadcrumb'] ? $vpr->seo['breadcrumb'] : $vpr->title?></span></a> <span> &gt; </span> 
                        
                      </div>
<?
$txt_name =  $vpr->seo['breadcrumb'] ? $vpr->seo['breadcrumb'] : $vpr->title; 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$vpr->slug;
$position = $kpr + 2;
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
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$vpr->slug.'/'.$this->context->entry->slug;
$position = count($parents) + 2;
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
        </div>
    </div>    
    
</div>

<div class="contain container-4">
    
    <div class="amc-column">
        
        <div class="rows row-1">
            
            <div class="amc-col amc-col-1 mt-40">
                <div class="amc-area-infor-article p-25 mb-txt-40">
                    <h1 class="title"><?= $this->context->pageT?></h1>
                    <div class="amc-name-customer">
                        <span>Par L’équipe d'Amica Travel</span>
                    </div>
                    <?php
                        $date = date("m F Y", $theEntry->time);
                        $date_list = str_replace(
                            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                            array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'),
                           $date
                        ); 
                    ?>
                    <div class="amc-info-tour">
                        
                        <span class="amc-date-tour">
                            <?= $date_list ?>
                                    
                        </span>
                        
                    </div>
                </div>
				

                <div class="entry-body">
                    <?= str_replace('src="', 'data-src="', $theEntry->model->description) ?>
                </div>


                    <!-- BACK BUTTON -->
                    <? include '_inc_back_button.php'; ?>
                    <!-- End BACK BUTTON -->
            </div>
            <div class="amc-col amc-col-2 mt-40 d-none d-sm-none d-lg-block">
				<?php
					
					 if(!empty($theParent->photos)){
						$cnt = 0;
                                                
						
						$link_2 = 'http://360degresvietnam.com/';
						foreach ($theParent->photos as $value) {
							$cnt++;
							if($cnt == 1){
								$link = 'https://www.facebook.com/amica.travel.vietnam';
							}
							if($cnt == 2){
								$link = 'http://360degresvietnam.com/';
							}
							if($value->type == 'summary'){
								echo '<a style=" display: inline-block; margin: 0 0 20px 0;" class="btn-link btn-link-'.$cnt.'" target="_blank" rel="noopener"  href="'.$link.'"><img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'"></a>';
								
							}
						}
					}
				?>
                    <div class="area-btn-contact">
                        <div class="button-right-devis">
                            <p class="tt">Besoin de conseil<br>pour votre voyage</p>
                            <ul>
                                <li><img alt="" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/hot_gon_thao_100_100.jpg"></li>
                                <li>Notre conseiller(ère) vous répondra sous 48H</li>
                            </ul>
                           <span class="btn-contact pointer btn-amica-basic btn-amica-basic-2 pugjd" data-title="<?= base64_encode(DIR.'nous-contacter') ?>">Contactez-nous</span> 
                            
                        </div>

                    </div>
                    <a style=" display: inline-block;" class="mt-25 btn-link btn-link-1" target="_blank" rel="noopener" href="https://www.facebook.com/amicatravel"><img style="width: 100%; display: inline;" alt="rejoignez-nous sur facebook" class="img-lazy" data-src="/upload-images/whoarewe/actualites/rejoignez-nous-sur-fb-1-769624c793.jpg"></a>
                
<!--                <div class="area area-3">
                    <p class="tt">Besoin de conseil d’un expert ?</p>
                    <ul>
                        <li><img class="person" alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="display: inline;"></li>
                        <li>Notre conseillère vous répondra sous 48H</li>
                    </ul>
                    <a href="<//?=DIR.'devis'?>" class="btn-contact">Demander un devis</a>
                </div>-->
            </div>
        </div>
        
        
        
    </div>
</div>
<?php $this->registerCssFile('/assets/css/page2016/_inc_btn_devis_col_right.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
                
<? $this->registerCss('.person{border-radius: 100%;} .container-4 .row-1 .col-1 .post-relate{background: none; margin: 40px 0 0 0;} .back-button{margin-top: 25px;}'); ?>


