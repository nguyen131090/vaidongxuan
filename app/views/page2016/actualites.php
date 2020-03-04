<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
 

?>

<?php $this->registerCssFile('/assets/css/page2016/actualites.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <?php
        if(!empty($theEntry->model->photos)){
            foreach ($theEntry->model->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" data-src='<?=DIR?>upload/image/banner_actualites.jpg'>
    <?}?>
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    <div class="amc-column row-1">
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
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->entry->slug;
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
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0"><?= $this->context->pageT; ?></h1>
    </div>
</div>

<div class="contain container-4">
    
    <div class="amc-column amc-column-fixpadding">
        
        <div class="rows row-1 amica-update-01 mt-60 pb-0">
            <div class="amc-col amc-col-1">
                
                <?php $cnt = 0;  $count = count($theEntries); foreach ($theEntries as $te) { $cnt ++;?>
                        
                    <?php 
                    if($cnt % 2 != 0){
                        echo '<div class="clear-fix">';
                    }
                    ?>
                    <div class="item item-<?= $cnt?> <?= $cnt % 2 != 0 ? 'it-l mr-20' : 'it-r' ?>">
                        <a href="<?=DIR. $theEntry->slug.'/'.$te->slug?>">
                        <?php if(!empty($te->data->image)) : ?>
                            <img class="img-lazy img-responsive" alt="" data-src="<?=DIR?>timthumb.php?src=<?= $te->data->image?>&w=329&h=219&zc=1">   
                        <?php else: ?>
                        <?php
                            $src = DIR.'upload/image/img_exclusi_type.jpg';
                            
                            preg_match_all('/<img[^>]+>/i', $te->description, $result);
                            foreach ($result[0] as $img_tag) {
                                  //  if (strpos($img_tag, 'display-page') !== false) {
                                            preg_match_all('/(src)=("[^"]*")/i', $img_tag, $src);
                                   // }
                            }
                          
                            ?>

                           <img class="img-lazy img-responsive" alt="" data-src='<?php if (is_array($src)) {
                                    echo DIR.'timthumb.php?src='.str_replace('"','',$src[2][0]).'&w=329&h=219&zc=1';
                            } else echo DIR.'timthumb.php?src='.$src.'&w=329&h=219&zc=1'; ?>'/>
                      <?php endif; ?>
                        </a>
                        <p class="time">
                           <?php
                            $date_list = date("d F Y", $te->time);
                            $date_list = str_replace(
                                array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'),
                               $date_list
                            ); 
                            
                            echo $date_list;
                            ?>
                        </p>
                        <a href="<?=DIR. $theEntry->slug.'/'.$te->slug?>">
                            <h2 class="tt"><?= $te->title?></h2>
                        </a>    
                        <div class="summary">
                            <?= $te->model->summary?>
                        </div>


                    </div>
                    <?php
                        if($cnt % 2 == 0){
                            echo '</div>';
                            if($count > $cnt){
                                echo '<span class="space space-40"></span>';
                            }
                        }
                        if($cnt % 2 != 0 && $cnt == $count){
                            echo '</div>';
                            if($count - 1 > $cnt){
                                echo '<span class="space space-40"></span>';
                            }
                        }
                    ?>
                <?php }?>

          <div class="pagination pagination-centered"><?=LinkPager::widget([
		'pagination'=>$pages,
		'maxButtonCount'=>5,
		'firstPageLabel'=>'&lt;&lt;',
		'lastPageLabel'=>'&gt;&gt;',
		'prevPageLabel'=>'&lt;',
		'nextPageLabel'=>'&gt;',
		]
	);
	?>
    </div>
            </div>
            <div class="amc-col amc-col-2 d-none d-sm-none d-lg-block" style="text-align: center;">
				<?php
					 if(!empty($theEntry->model->photos)){
						$cnt = 0;
						
						//$link_2 = 'https://blog.amica-travel.com';
						foreach ($theEntry->model->photos as $value) {
							
							
							if($value->type == 'summary'){
                                                                $cnt++;
                                                                if($cnt == 1){
                                                                    $link = 'https://www.facebook.com/amicatravel';
                                                                }
                                                                if($cnt == 2){
                                                                    $link = 'https://blog.amica-travel.com';
                                                                }
								echo '<a style=" display: inline-block;" class="mb-25 btn-link btn-link-'.$cnt.'" target="_blank" rel="noopener"  href="'.$link.'"><img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'"></a>';
								
							}
						}
					}
				?>
                <div class="amc-area-sub-article mb-25">
                    <p>Top 5 des actualités</p>
                    <ul>
                        <?php
                            foreach ($top5 as $v) : ?>
                                <li><a href="/actualites/<?=$v->slug?>">
                                <? if(isset($v->photosArray['summary'])): 
                                    $img = $v->photosArray['summary'][0];
                                ?>
                                    <img data-src="/thumb/40/40/1/80<?=$img->image?>" alt=''>
                                <? else:  ?>
                                    <? if(isset($v->data->image)) : ?>
                                    <img alt='' data-src="/thumb/40/40/1/80<?=$v->data->image?>">
                                        <? endif ?>
                                <? endif; ?>
                                   
                                
                                <span><?=$v->title ?></span>
                            </a></li>
                            <? endforeach;?>
                        
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--<div class="back-button-center back-button">

              <div class="line"></div>
              <a href="<?//= DIR.$root->slug?>"><img alt="" data-src="<?//=DIR?>assets/img/back-button.png"/> <?//=$root->title ?></a>
              <div class="line"></div>
          </div>-->
<div class="contain container-5">
    
    <div class="amc-column">
        
        <div class="rows row-1">
            <p class="tt">Notre équipe à votre écoute</p>
            <span class="btn-amica-basic btn-amica-basic-1 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Faites-nous savoir vos attentes</span>
        </div>
            
    </div>
        
</div>
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->

<?php

$js = <<<JS
	  

		
$(window).bind("load", function() { 
        
           
          $('.clear-fix').each(function(index) {
                var htleft = $(this).children('.it-l').children('a').children('.tt').outerHeight();
                
                var htright = $(this).children('.it-r').children('a').children('.tt').outerHeight();
                if (htleft > htright){
                    $(this).children('.it-r').children('a').children('.tt').css('min-height', htleft);
                }  
                 if (htright > htleft){
                    $(this).children('.it-l').children('a').children('.tt').css('min-height', htright);
                }   
          });
       

});

JS;
$this->registerJs($js, \yii\web\View::POS_END);
$this->registerCss('
  .back-button .line:last-of-type{border: none;}
  ');
?>

