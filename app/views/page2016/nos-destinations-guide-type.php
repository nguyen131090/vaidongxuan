<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/nos-destinations-guide.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
    <? if(isset($theEntry->model->photos)) : ?>
    <? 
    $banner = '';
    foreach ($theEntry->model->photos as $key => $value) {
        if($value->type == 'banner') $banner = $value; 
    } ?>
    <img style="width: 100%;" alt="<?=$banner->description; ?>" class="img-lazy" data-src='<?=$banner->image ?>'>
    <? endif; ?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
    <div class="column amc-column row-2 mb-txt-40">
        <h1 class="title m-0"><?=$theEntry->model->seo->h1 ?></h1>
    </div>
</div>

<div class="container-flud amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="column amc-column">
            <ul>
                <li  class="<?= !SEG2 ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="submenu_section" data-analytics-label="link_country"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/itineraire" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries">Idées de voyage</a></li>
                <? if(SEG1 !== 'birmanie'){?>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/formules" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets">Formules d'Amica</a></li>
                <? } ?>
                <li  class="<?= SEG2 == 'visiter' ? 'active' : '' ?>"><a href="<?=DIR.SEG1.'/visiter' ?>" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="submenu_section" data-analytics-label="link_c_cities">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/informations-pratiques" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="submenu_section" data-analytics-label="link_c_infos">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/guide" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="submenu_section" data-analytics-label="link_c_guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>
<div class="contain container-guide mt-txt-60">
    <div class="column amc-column">
        <div class="area-text">
            <?=$theEntry->model->content ?>
        </div>  
        
        <? 
        $cnt = 0;
        $i = 0;
        $guides_spec = $guides;
        $sub_category_guides_spec = [];
        foreach ($guides as $k => $v) {
         //   var_dump($v->items);exit;
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
                                    <img class="img-lazy" alt="<?=$summary->description?>" data-src="<?=$summary->image?>" width="" height="">
                                <? endif; ?>
                                <div class="icon">
                                    <? if($icon) :  ?>
                                    <img class="img-lazy" alt="<?=$icon->description?>" data-src="<?=$icon->image?>">
                                    <? endif; ?>
                                </div>

                            </div>
                        </a>    
                        <a href="<?=DIR.$v->slug?>">
                        <h3 class="title-item m-0 p-0 amc-fix-mt-25-0" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_card_t_<?= $v->category_id ?>">
                            <?=$v->title?>  
                        </h3>
                        </a>      
                        <p  class="text m-0 p-0 amc-fix-mt-25"><?=$v->summary?></p>

                    </div>
                <? if($i == 3){ ?>    
                </div>
                <? } ?>
            <? 
                unset($guides_spec[$k]);
                }else{
            ?>
                <? if($i == 4){ ?>    
                <div class="guides-normal p-0">
                <? } ?>    

                    <div class="item mb-40">
                         <? 
                            $summary = '';
                            foreach ($v->photos as $key => $value) {
                                if($value->type == 'custom') $summary = $value; 
                            } ?>
                        <? if($summary) :  ?>
                        <div class="amc-img">
                            <a href="<?=DIR.$v->slug?>">
                            <img class="img-lazy" alt="<?=$summary->description?>" data-src="<?=$summary->image?>"  width="136" height="136" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_icon_<?= $v->category_id ?>">
                            </a>
                        </div>    
                        <? endif; ?>
                        <div class="text">
                            <h3 class="title tt-fontsize-18"><a href="<?=DIR.$v->slug?>" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_icon_t_<?= $v->category_id ?>"><?=$v->title?></a></h3>
                            <p class="m-0 p-0"><?=$v->summary?></p>
                        </div>
                    </div>

                <? if($cnt == count($guides)){ ?>       
                </div>
                <? } ?>
        
        <? 
            unset($guides_spec[$k]);
        
            }}else if($v->depth == 3){
                $sub_category_guides_spec[] = $v;
            }}?>
        
        
        <!--  cac category co item -->
        <? 
        $cnt = 0;
        // var_dump($guides[2]->fields);exit;
        foreach ($guides_spec as $k => $v) {
            $cnt++;
            $summary = '';
                foreach ($v->photos as $key => $value) {
                    if($value->type == 'custom') $summary = $value; 
                } 
                
            if($v->depth == 2 && ($v->rgt - $v->lft) == 1){
               
                
                
            ?>   
            <div class="guides-spec mb-60">
                <div class="amc-col amc-col-left">
                    <a href="<?= DIR.$v->slug ?>" class="lazy-background amc-image" data-src="<?= $summary->image ?>">
                        <div class="area-1">
                            <p class="tt tt-1 tt-fontsize-24 tt-latolatin-bold tt-color-white">
                                <span data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_block_<?= $v->category_id ?>"><?= $v->title ?></span>
                            </p>
                            <p class="tt tt-2 m-0 p-0 tt-color-white">En résumé</p>
                        </div>
                    </a>    
                </div>
                <div class="amc-col amc-col-right">
                    
                        <? 
                        if(!empty($v->items)){
                        $cnt = 0;
                        foreach ($v->items as $it) {
                            $cnt++;
                           
                            
                        ?>

                        <a class="it" href="<?= DIR.$it->slug ?>" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_<?= $it->item_id ?>"><?= $it->title ?></a>
                        <?  }
                       
                        }?>

                       
                </div>
            </div>
            <? 
            
            }else if($v->depth == 2 && ($v->rgt - $v->lft) > 1){              
            ?>
                
            <div class="guides-spec mb-60">
                <div class="amc-col amc-col-left">
                    <a href="<?= DIR.$v->slug ?>" class="lazy-background amc-image" data-src="<?= isset($summary->image) ? $summary->image : '' ?>">
                        <div class="area-1">
                            <p class="tt tt-1 tt-fontsize-24 tt-latolatin-bold tt-color-white">
                                <span data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_block_<?= $v->category_id ?>"><?= $v->title ?></span>
                            </p>
                            <p class="tt tt-2 m-0 p-0 tt-color-white">En résumé</p>
                        </div>
                    </a>    
                </div>
                <div class="amc-col amc-col-right">
                    
                        <? 
                        
                            $j = 0;
                            if(!empty($sub_category_guides_spec)){
                                foreach ($sub_category_guides_spec as $key => $value) {
                                    $j++;
                                    if($v->lft < $value->lft && $v->rgt > $value->rgt){
                                        if(!empty($value->items)){
                                            if($j == 1 || $j == 3){
                                                echo '<div class="area">';
                                            }
                                            echo '<div class="list-item list-item-'.$j.'">';
                                            echo '<p>'.$value->title.'</p>';
                                                foreach ($value->items as $it) {
                                                    echo '<a class="it" href="'. DIR.$it->slug .'" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="guide_section" data-analytics-label="info_'. $it->item_id .'">'. $it->title .'</a>';

                                                }
                                            echo '</div>';
                                            if($j == 2 || $j == 3 || $j == count($sub_category_guides_spec)){
                                                echo '</div>';
                                            }  
                                        }
                                    }
                                }
                            }
                           
                        ?>

                       
                </div>
            </div>
            <?    
                
            } }?>
       
            <!-- END cac category co item -->
    </div>
</div>

<? include_once '_inc_guide_book.php'; ?>

<div class="contain container-country-tour responsive-swiper-slider-3-item bg-f7 mt-60">
    <div class="column amc-column pt-txt-40 pb-40">
        <div class="area-text text-center mb-txt-40">
            <?= isset($theEntry->data->titletours) ? $theEntry->data->titletours : '' ?>
        </div>
        <div class="swiper-slider area-slider-swiper amc-custom-hover-block-image">
        <div class="swiper-container custom-slides-swiper-3-item">
            <div class="swiper-wrapper">
            <? foreach ($progs as $key => $v) : ?>
            <div class="swiper-slide bg-white">
                        <span class="pugjd"  data-title="<?=base64_encode('/'.$v->slug)?>">
                            <div class="img amc-image" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?=$v->model->item_id ?>">

                                <? if(isset($v->photosArray['summary'])) : ?>
                                <img style="min-height: 100px; max-width: 299px;" class="img-responsive w-100" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="/thumb/299/200/1/100<?=$v->photosArray['summary'][0]->image ?>">                           
                                <? endif; ?>
                            </div>
                        </span>
                        <div class="text pl-20 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block mb-0 amc-fix-pb-25-0">
                            <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-12-0 p-0 m-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>
                                
                            <p class="m-0 p-0 amc-fix-mt-25 tt-latolatin-bold" name="pop-<?=$key+1 ?>">
                                <a class="tt-fontsize-18 tt-line-height-1-2" href="/<?=$v->slug?>"  data-analytics="on" data-analytics-category="guide_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?=$v->model->item_id ?>"><?=$v->title;?></a>
                            </p>
                            <p class="m-0 p-0 amc-fix-mt-20"><?=\app\helpers\Text::limit_text($v->model->summary, 100); ?></p>
                            <? if((isset($v->data->budget) && $v->data->budget != '') || (isset($v->model->days) && $v->model->days != '' && $v->model->days > 0)){ ?>
                                <p class="tt-color-6b6b6b tt-fontsize-13-5 amc-fix-mt-25 amc-fix-pb-25-0 m-0 p-0">
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
        <!-- If we need pagination -->
            <div class="swiper-pagination swiper-pagination-custom-tour"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-prev-custom-tour" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="tours_section" data-analytics-label="control_left"></div>
            <div class="swiper-button-next swiper-button-next-custom-tour" data-analytics="on" data-analytics-category="guide_page" data-analytics-action="tours_section" data-analytics-label="control_right"></div>  
        </div>
         
    </div>
</div>

<?
$datacategory = 'guide_page';
?>
<div class="contain container-blogs mt-txt-60 mb-60">
    <div class="column amc-column">
        <div class="area-text text-center mb-txt-40">
            <?= isset($theEntry->data->titleblogs) ? $theEntry->data->titleblogs : '' ?>
        </div>
        <div class="blogs mt-0 mb-0">
            
            <?php
                $cnt = 0;
                if(!empty($arrBlog)){
                foreach ($arrBlog as $value) {
                    
                $cnt++;    
               
                   
            ?>
            <div class="item-img item item-<?=$cnt?>">
                
                    <div class="img">
                        <a href="<?= $value['link']?>" target="_blank" rel="noopener" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="blog_section" data-analytics-label="blog_card_<?= $value['id'] ?>">
                        <img width="" height="" class="img-lazy img-responsive w-100" alt="" data-src="<?= $value['src'] ?>">
                        <p><?= $value['cat_name'] ?></p>
                        </a>
                    </div>
                    <div class="text">
                        <p class="tt tt-latolatin-bold tt-fontsize-18 tt-line-height-1-2 amc-fix-mt-25-0 m-0 p-0">
                            <a class="tt-line-height-1-2" href="<?= $value['link']?>" target="_blank" rel="noopener" data-analytics="on" data-analytics-category="<?= $datacategory ?>" data-analytics-action="blog_section" data-analytics-label="blog_card_t_<?= $value['id'] ?>"><?= $value['title']['rendered']?></a>
                        </p>
                        <div class="amc-fix-mt-25 m-0 p-0"><?=\app\helpers\Text::limit_text($value['excerpt']['rendered'], 200)?></div>
                    </div>
               
            </div> 
                <? }} ?>
            
        </div>
    </div>
</div>

<?
$swiper = '.custom-slides-swiper-3-item';
$next = '.swiper-button-next-custom-tour';
$prev = '.swiper-button-prev-custom-tour';
$pagination = '.swiper-pagination-custom-tour';
$jsss=<<<JS
var swiper = new Swiper('$swiper', {
      slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 20,
        loop: false,
       // centerInsufficientSlides: true,
        navigation: {
            nextEl: '$next',
            prevEl: '$prev',
          },
        pagination: {
            el: '$pagination',
            clickable: true,
            renderBullet: function (index, className) {
                if(index == 0){
                    var disablepagi = 'swiper-pagination-disable';
                    $('$pagination').addClass(disablepagi);
                }else{
                    var disablepagi = 'swiper-pagination-disable';
                    $('$pagination').removeClass(disablepagi);
                }
                return '<span class="' + className + '"></span>';
            }
        },
        
    });      
JS;
$this->registerJs($jsss, yii\web\View::POS_END);
?>         