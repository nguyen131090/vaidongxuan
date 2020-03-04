<!-- Slider main container -->
<div class="area-slider-swiper area-slider-swiper-3-item">    
    <div class="swiper-container custom-slides-swiper custom-slides-swiper-3-item">

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <? foreach ($secretType->items() as $key => $value) : ?>
                <?
                    if(Yii::$app->controller->action->id == 'nos-destinations-country'){
                        $arrAnaly = 'data-analytics="on" data-analytics-category="country_page" data-analytics-action="formules_section" data-analytics-label="formule_cat_card_'.$value->model->item_id.'"';
                    }
                ?>
            
                <?
                switch ($key) {
                    case 0:
                        $class = 'slideInLeft';
                        break;
                    case 1:
                        $class = 'slideInUp';
                        break;
                    case 2:
                        $class = 'slideInRight';
                        break;
                    default:
                        $class = '';
                }
                ?>
                <div class="swiper-slide">
                    <div class="item-img animated " data-animation="<?= $class ?>" <?= $arrAnaly ?>>
                        <a href="<?= DIR . $value->slug ?>">
                            <? $i = ''; ?>
                            <? foreach ($value->photos as $kp => $vp) : ?>
                                <? if ($vp->type == 'summary')
                                    $i = $kp;
                                ?>
                            <? endforeach; ?>
                            <img width="" height="325" alt="<?=$value->photos[$i]->description ?>" data-src="<?=$value->photos[$i]->image ?>" class="img-lazy lazyload"/>
<!--                            <img width="" height="" alt="<?= $value->photos[$i]->description ?>" data-src="https://demo.amica-travel.com/upload-images/destinations/au-plus-pres-des-peuples/immersion-vie-locale-ninh-binh-483b22bd53.jpg" class="img-lazy lazyload"/>-->
                            <h3 class="text-on-img"><?= $value->title ?></h3>
                            <div class="text-slide">
                                <div class="bottom-block">
                                    <span class="title-hover"><?= $value->title ?></span>
                                    <p><?= strip_tags($value->description) ?></p>
<!--                                    <span class="btn radius-5">En savoir plus</span>-->
                                </div>
                            </div>            
                        </a>
                    </div>
                </div>
<? endforeach; ?>
        </div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination swiper-pagination-3-item"></div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev swiper-button-prev-excl" data-analytics="on" data-analytics-category="country_page" data-analytics-action="formules_section" data-analytics-label="control_left"></div>
    <div class="swiper-button-next swiper-button-next-excl" data-analytics="on" data-analytics-category="country_page" data-analytics-action="formules_section" data-analytics-label="control_right"></div>   
</div>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/swiper-slider-3-item.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?
$js=<<<JS
$(document).on('mouseover', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');
   // $(this).find('img').addClass('active');    
    $(this).find('.text-slide').addClass('active');
    $(this).find('.text-on-img').hide();
});
$(document).on('mouseleave', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
    $('.custom-slides-swiper-3-item .swiper-slide .item-img img').removeClass('active');  
    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');  
     $(this).find('.text-on-img').fadeIn(500);  
});
   
var swiper = new Swiper('.custom-slides-swiper', {
      slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 20,
        loop: false,
        navigation: {
            nextEl: '.swiper-button-next-excl',
            prevEl: '.swiper-button-prev-excl',
          },
        pagination: {
            el: '.swiper-pagination-3-item',
            clickable: true,
            renderBullet: function (index, className) {
                if(index == 0){
                    var disablepagi = 'swiper-pagination-disable';
                    $('.swiper-pagination-3-item').addClass(disablepagi);
                }else{
                    var disablepagi = 'swiper-pagination-disable';
                    $('.swiper-pagination-3-item').removeClass(disablepagi);
                }
                return '<span class="' + className + '"></span>';
            }
        },
    });      
          
JS;
$this->registerJs($js);
?>