
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/fix-banner-top.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <?php $this->registerCssFile('/assets/css/mobile/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


 <?php $this->registerCssFile('/assets/css/mobile/format_style.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-guide.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>



<div class="contain no-padding">
    <div class="column">
       
        <!-- Menu Ngang -->
        <? include '_inc_menu_all_page_destinations.php'; ?>
        <!-- End Menu Ngang -->
    </div> 
</div>
<div class="contain no-padding">
    <div class="column ">
        <div class="area-filter fix-banner-top">
            <? 
            if(!empty($theEntry->photosArray['banner'])) {
            $banner = $theEntry->photosArray['banner'][0]; 
            ?>
                
                <img class="image-banner img-responsive lazyload" alt="<?= $banner->description; ?>" data-sizes="auto" data-src='<?= $banner->image ?>' data-srcset="/thumb/600/400/1/80<?= $banner->image?> 450w, /thumb/900/0/1/80<?= $banner->image?>">
            <?php }else{ ?>
                <img class="image-banner" alt="" data-src="<?=DIR?>assets/img/mobile/img-destination-ideel-banner-640-442.jpg">
            <?php } ?>    
        
            
            
            <span class="fil-background"></span>
             <? if($theEntry->model->seo != NULL){ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->model->seo->h1 ?></h1>
            <? }else{ ?>
                <h1 class="tt-title tt-fontsize-45 tt-latolatin-bold tt-color-white tt-custom"><?= $theEntry->title ?></h1>
            <? } ?>    
<!--                <a href="<?//=DIR?>nous-contacter" data-transition="slide" data-direction="reverse">
            <span class="btn-filter tt-title tt-fontsize-32 tt-color-white tt-latolatin-bold tt-custom-btn-filter" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="banner_section" data-analytics-label="cta_contact">Contactez-nous</span>
            </a>-->
        </div>
    </div>
    
       
</div>
<div class="contain container-1">
    <div class="row-content">
        
 
        <span class="space space-80"></span>
        <div class="text-sumary">
            <?php
              //$content = str_replace('<h2', '<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-custom"', isset($theEntry->model->contentsMobile) ? $theEntry->model->contentsMobile[0]['description'] : ''); 
              //$content = str_replace('</h2>', '</h2><span class="space space-20"></span>', $content);
              //echo $content;
                $content = str_replace('<h2', '<h2 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-custom"', $theEntry->model->content); 
                $content = str_replace('</h2>', '</h2>', $content);
                
               
                
                $subtext = explode('.', $content);
                unset($subtext[count($subtext) - 1]);
                    
                    
                    
                   //echo $subtext[0]. ' <span class="view-more tt-color-e65925">Lire la suite</span></p>';
                    $cnt = 0;
                    foreach ($subtext as $sub) {
                        $cnt++;
                        if($cnt == 1 && $cnt == count($subtext)){
                            echo $sub. '</p>';
                        }else if($cnt == 1 && $cnt < count($subtext)){
                            echo $sub. '. <span class="view-more tt-color-e65925">Lire la suite</span></p>';
                            echo '<div class="full-text">';
                        }else if($cnt > 1 && $cnt < count($subtext)){
                            
                                echo '<p>'.str_replace(['<p>','</p>'], ['',''], $sub).'.</p>';
                        }else if($cnt == count($subtext)){
                            if(str_replace(['<p>','</p>'], ['',''], $sub) == NULL){
                                echo '<p><span class="close-text tt-color-e65925">Réduire</span></p>';
                                echo '</div>';
                            }else{
                                echo '<p>'.str_replace(['<p>','</p>'], ['',''], $sub). '.</p><p><span class="close-text tt-color-e65925">Réduire</span></p>';
                                echo '</div>';
                            }
                                
                        }
                        
                    }
                
              ?>
        </div>
        <span class="space space-40"></span>
        
        <? 
        $cnt = 0;
        $i = 0;
        $after_foreach_guides = $guides;
        $sub_category_guides_spec = [];
        foreach ($guides as $k => $v) {
            $cnt++;
//           $items = \app\modules\destinations\api\Catalog::items([
//                    'where' => ['category_id' => $v->category_id],
//                    'pagination' => ['pageSize' => 0]
//                ]);
            if(empty($v->items) && ($v->rgt - $v->lft) == 1 && $v->depth == 2){
                $i++;
                if($i <= 3){
                
            ?>
                <? if($i == 1){ ?>
                <div class="top-guides">
                <? } ?>    
                    <div class="item">
                        <a href="<?=DIR.$v->slug?>">
                            <div class="img m-0 p-0" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_card_<?= $v->category_id ?>">
                                <? 
                                $summary = '';
                                $icon = '';
                                foreach ($v->photos as $key => $value) {
                                    if($value->type == 'custom') $summary = $value; 
                                    if($value->type == 'icon') $icon = $value; 
                                } ?>
                                <? if($summary) :  ?>
                                    <img alt="<?=$summary->description?>" 
                                    data-src="/thumb/520/350/1/100<?=$summary->image ?>" 
                                    data-srcset="/thumb/660/440/1/80<?=$summary->image ?> 450w, /thumb/900/0/1/80<?=$summary->image ?>" 
                                    data-sizes="auto" class="img-responsive" 
                                     />
                                
                                <? endif; ?>
                                
                            </div>
                        </a>    
                        <a href="<?=DIR.$v->slug?>">
                        <h3 class="tt-fontsize-40 tt-latolatin-bold tt-custom m-0 p-0 amc-fix-mt-25-0" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_card_t_<?= $v->category_id ?>">
                            <?=$v->title?> 
                        </h3>
                        </a>   
                        <p  class="text m-0 p-0 amc-fix-mt-15"><?=$v->summary?></p>

                    </div>
                    <span class="space space-txt-80"></span>
                <? if($i == 3){ ?>    
                </div>
                <? } ?>
            <? 
                }else{
            ?>
                 
            <div class="<?=SEG1?> all-article">
                <div class="item">
                    
                    <? 
                        $summary = '';
                        foreach ($v->photos as $key => $value) {
                            if($value->type == 'custom') $summary = $value; 
                        } ?>
                    <? if($summary) :  ?>
<!--                    <a href="<?//=DIR.$v->slug?>" class="">
                        <img class="img-lazy" alt="<?//=$summary->description?>" data-src="<?//=$summary->image?>"  width="" height="" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_icon_<?//= $v->category_id ?>">
                    </a>   -->
                    <? endif; ?>

                    <div class="item-right">
                        <h3 class="area-text-control" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_icon_t_<?= $v->category_id ?>">


                               <span class="text tt-title tt-fontsize-32 tt-latolatin-regular tt-custom">
                                    <a href="<?=DIR.$v->slug?>" class=""><?=$v->title?></a>
                                </span>


                        </h3>

                    </div>
                    
                </div>
            </div>
            <?// if($cnt < count($guides)){ ?>
             <span class="space space-50"></span>   
            <?// } ?>
        
        <? }
            unset($after_foreach_guides[$k]);
            }else if($v->depth == 3){
                $sub_category_guides_spec[] = $v;
            }}
        ?>
       
             
        <!--  cac category co item -->
        <? 
        $cnt = 0;
        // var_dump($guides[2]->fields);exit;
        foreach ($after_foreach_guides as $k => $v) {
            $cnt++;
            $summary = '';
                foreach ($v->photos as $key => $value) {
                    if($value->type == 'custom') $summary = $value; 
                } 
                
            if($v->depth == 2 && ($v->rgt - $v->lft) == 1){
               
                
                
            ?>   
            <div class="<?=SEG1?> all-article">
                <div class="item">
                   
                   <div class="item-right">
                        <h3 class="area-text-control" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_tab_<?= $v->category_id ?>">
                            <span class="text tt-title tt-fontsize-32 tt-latolatin-regular tt-custom">
                                <a href="<?=DIR.$v->slug?>">
                                    <?= $v->title ?>
                                </a>    
                            </span>
                            <span class="arrow-down-up">arrow</span>
                        </h3>
                        <ul class="sub-article">
<!--                            <li><a href="<?//=DIR.$v->slug?>" class="tt-title tt-fontsize-32 tt-latolatin-bold tt-sub-custom" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_block_<?//= $v->category_id ?>"><?//=$v->title?></a></li>-->
                            <? foreach ($v->items as $ki => $vi) : ?>
                                <li><a href="<?=DIR.$vi->slug?>" class="tt-title tt-fontsize-32 tt-latolatin-regular tt-sub-custom" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_<?= $vi->item_id ?>"><?=$vi->title?></a></li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
           
            <span class="space space-50"></span>   
            
            <? 
            
            }else if($v->depth == 2 && ($v->rgt - $v->lft) > 1){              
            ?>
                
            <div class="<?=SEG1?> all-article">
                <div class="item">
                   
                   <div class="item-right">
                        <h3 class="area-text-control" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_tab_<?= $v->category_id ?>">
                            
                            <span class="text tt-title tt-fontsize-32 tt-latolatin-regular tt-custom">
                                <a href="<?=DIR.$v->slug?>">
                                    <?= $v->title ?>
                                </a>   
                            </span>
                             
                            <span class="arrow-down-up">arrow</span>
                        </h3>
                        <ul class="sub-article">
<!--                            <li><a href="<?//=DIR.$v->slug?>" class="tt-title tt-fontsize-32 tt-latolatin-bold tt-sub-custom" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_block_<?//= $v->category_id ?>"><?//=$v->title?></a></li>-->
                            
                            <? 
                        
                                $j = 0;
                                if(!empty($sub_category_guides_spec)){
                                    foreach ($sub_category_guides_spec as $key => $value) {
                                        $j++;
                                        if($v->lft < $value->lft && $v->rgt > $value->rgt){
                                            if(!empty($value->items)){
                                                
                                               
                                                echo '<li class="name-group">'.$value->title.'</li>';
                                                    foreach ($value->items as $it) {
                                                        echo '<li><a href="'. DIR.$it->slug .'" class="tt-title tt-fontsize-32 tt-latolatin-regular tt-sub-custom" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_'. $it->item_id .'">'. $it->title .'</a></li>';
                                                    }
                                               
                                                
                                            }
                                        }
                                    }
                                }

                            ?>
                                
                        </ul>
                    </div>
                </div>
            </div>
           
            <span class="space space-50"></span>   
            <?    
                
            } }?>
       
            <!-- END cac category co item -->     
             
             
        
      
    </div>
</div>    
<span class="space space-30"></span>   
<? include_once '_inc_guide_book_mobile.php'; ?>

<div class="contain container-tours mt-80 bg-f7f7f7">
    <div class="amc-column column">
        <div class="area-text">
            <?= isset($theEntry->data->titletours) ? $theEntry->data->titletours : '' ?>
        </div>    
        
        <div class="area-tours mt-50">
            <div class="tours-slider">
                <div class="swiper-wrapper">
                    
                   <? foreach ($progs as $key => $v) : ?>
                    <div class="swiper-slide bg-white">
                                <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                                    <div class="img amc-image" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?=$v->model->item_id ?>">

                                        <? if(isset($v->photosArray['summary'])) : ?>
                                        <img style="min-height: 10rem;" class="img-responsive w-100" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/299/200/1/100<?=$v->photosArray['summary'][0]->image ?>">                           
                                        <? endif; ?>
                                    </div>
                                </span>
                                <div class="text">
            <!--                    <span class="space space-10 space-horizontal"></span>    -->
                                <p class="tt-color-6b6b6b tt-fontsize-28 p-0 m-0 amc-fix-mt-12-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                                <p class="tt tt-latolatin-bold tt-fontsize-40 tt-line-height-1-2 m-0 p-0 amc-fix-mt-15 ">
                                    <a class="tt-line-height-1-2" href="/<?=$v->slug; ?>" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?= $v->model->item_id ?>"><?=$v->title;?></a>
                                </p>
                                <? if($v->model->sub_title != NULL){ ?>
                                    <p class="m-0 p-0 amc-fix-mt-12 tt-fontsize-28 tt-latolatin-regular tt-custom-sub-tt"><?= $v->model->sub_title ?></p>
                                <? } ?> 
                                <p class="m-0 p-0 amc-fix-mt-15"><?= $v->model->summary ?></p>
                                <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                                    <p class="tt-color-6b6b6b tt-fontsize-28 m-0 p-0 amc-fix-mt-15">
                                        <?= (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0) ? $v->model->days.' jours ' : ''; ?> 
                                        <?   
                                            if((isset($v->data->budget) && $v->data->budget != '')){
                                                if(isset($v->model->days) && $v->model->days != '' && $v->model->days > 0){
                                                    echo 'à partir de '.$v->data->budget.'€'; 
                                                }else{
                                                    echo 'À partir de '.$v->data->budget.'€'; 
                                                }
                                            }    

                                        ?>
                                    </p>
                                <? } ?>
                            </div>
                      </div>
                    <? endforeach; ?>
                    
                </div>
            </div>    
        </div>
        
    </div>       
</div>  

<?
$datacategory = 'guide_page';
?>
<div class="contain container-blogs mt-80 mb-80">
    <div class="amc-column column">
        <div class="area-text">
            <?= isset($theEntry->data->titleblogs) ? $theEntry->data->titleblogs : '' ?>
        </div>    
        
        <div class="area-blogs mt-50">
            <div class="blogs-slider">
                <div class="swiper-wrapper">
                    
                  <?php
                        $cnt = 0;
                        if(!empty($arrBlog)){
                        foreach ($arrBlog as $value) {

                        $cnt++;    


                    ?>
                    <div class="swiper-slide bg-f7f7f7 item item-<?=$cnt?>">

                            <div class="img">
                                <a href="<?= $value['link']?>" target="_blank" rel="noopener" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="blog_section" data-analytics-label="blog_card_<?= $value['id'] ?>">
                                <img width="" height="" class="img-lazy img-responsive w-100" alt="" data-src="<?= $value['src'] ?>">
                                <p><?= $value['cat_name'] ?></p>
                                </a>
                            </div>
                            <div class="text">
                                <p class="tt tt-latolatin-bold tt-fontsize-40 tt-line-height-1-2 amc-fix-mt-25-0 m-0 p-0">
                                    <a class="tt-line-height-1-2" href="<?= $value['link']?>" target="_blank" rel="noopener" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="blog_section" data-analytics-label="blog_card_t_<?= $value['id'] ?>"><?= $value['title']['rendered']?></a>
                                </p>
                                <div class="amc-fix-mt-25 m-0 p-0"><?=\app\helpers\Text::limit_text($value['excerpt']['rendered'], 200)?></div>
                            </div>

                    </div> 
                <? }} ?>
                    
                </div>
            </div>    
        </div>
        
    </div>       
</div>  


<? 
$uri = '/'.URI;

$js = <<< JS
$(function() {
        
        
var enviesSwiper = new Swiper('.tours-slider', {
        slidesPerView: 2.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        lazyLoading: true,
        lazyLoadingInPrevNext: true,
        breakpoints: {
            // when window width is <= 320px
            550: {
              slidesPerView: 1.1,
            }
          }
    });                  

var enviesSwiper = new Swiper('.blogs-slider', {
        slidesPerView: 2.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        lazyLoading: true,
        lazyLoadingInPrevNext: true,
        breakpoints: {
            // when window width is <= 320px
            550: {
              slidesPerView: 1.2,
            }
          }
    });         
        

 

});


 
     
    
   function delayremoveclass(text){
      setTimeout(function()
        {
           // text.removeClass('active');
           // text.parent().removeClass('active');
            //text.addClass('active');
            text.slideDown(500);
        }, 500);
};        
        
    $('.area-text-control .arrow-down-up').click(function(){
        var hClass = $(this).hasClass('active');
        $('.area-text-control .arrow-down-up').removeClass('active');
        $('.area-text-control').parent().parent().children('.sub-article').removeClass('active');
        //$('.area-text-control').parent().parent().children('.sub-article').slideUp(500);
        $('.sub-article').removeClass('active');
        if(hClass){
            $(this).removeClass('active');
            $(this).parent().parent().children('.sub-article').removeClass('active');
           // $(this).parent().children('.sub-article').slideUp(500);
        }else{
            $(this).addClass('active');
           // delayremoveclass($(this).parent().children('.sub-article'));
            $(this).parent().parent().children('.sub-article').addClass('active');
           // $(this).parent().children('.sub-article').slideDown(500);
        }
        
        $('body, html').animate({
            scrollTop: $(this).offset().top - 70
        }, 0);
        
    });    
        
        $('.text-sumary .view-more').click(function(){
        
        $('.full-text').show();
        $(this).hide();
    });    
        
    $('.text-sumary .close-text').click(function(){
        $('.view-more').show();
        $('.full-text').hide();
   });
    
JS;
$this->registerJs($js, yii\web\View::POS_END); 


?>