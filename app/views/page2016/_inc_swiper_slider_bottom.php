<? use yii\easyii\modules\text\api\Text; ?>
<div class="amc-column">
<p class="tt mt-txt-60 mb-txt-40 text-center d-inline-block w-100 tt-fontsize-24 tt-latolatin-bold"><?=Text::get('related-text-formules') ?></p>
<div class="area-slider-swiper area-slider-swiper-3-item">    
    <div class="swiper-container custom-slides-swiper custom-slides-swiper-3-item">

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <? foreach ($sliders as $key => $value) : ?>
                <?
                        $arrAnaly = '';
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
                    <div class="item-img " data-animation="<?= $class ?>" <?= $arrAnaly ?>>
                        <a href="<?= DIR . $value->slug ?>">
                            <? if(SEG2 == 'itineraire'){
                                if(!empty($value->photosArray['custom'][0]))
                                    $imgS =  $value->photosArray['custom'][0];
                            } else
                                if(!empty($value->photosArray['summary'][0]))
                                     $imgS =  $value->photosArray['summary'][0];
                            ?>
                            <? if(!empty($imgS)) : ?>
                            <img width="" height="325" alt="<?=$imgS->description ?>" data-src="<?=$imgS->image ?>" class="img-lazy lazyload nozoom"/>
                            <? endif; ?>
                            <h3 class="text-on-img <? if(strpos(URI, 'formules') !== FALSE) echo 'formules';?>"><?= $value->title ?></h3>
                            <? if(strpos(URI, 'formules') !== FALSE) : ?>
                            <div class="text-slide">
                                <div class="bottom-block">
                                    <span class="title-hover"><?= $value->title ?></span>
                                    <p><?= isset($value->model->summary) ? $value->model->summary : $value->summary ?></p>
                                </div>
                            </div> 
                            <? endif; ?>           
                        </a>
                    </div>
                </div>
<? endforeach; ?>
        </div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination swiper-pagination-bt"></div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev swiper-button-prev-bt" data-analytics="on" data-analytics-category="country_page" data-analytics-action="formules_section" data-analytics-label="control_left"></div>
    <div class="swiper-button-next swiper-button-next-bt" data-analytics="on" data-analytics-category="country_page" data-analytics-action="formules_section" data-analytics-label="control_right"></div>   
</div>
</div>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/swiper-slider-3-item.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?
$js=<<<JS
$(document).on('mouseover', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');
    $(this).find('img:not(.nozoom)').addClass('active');    
    $(this).find('.text-slide').addClass('active');
    $(this).find('.text-on-img.formules').hide();
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
            nextEl: '.swiper-button-next-bt',
            prevEl: '.swiper-button-prev-bt',
          },
        pagination: {
            el: '.swiper-pagination-bt',
            clickable: true,
            renderBullet: function (index, className) {
                if(index == 0){
                    var disablepagi = 'swiper-pagination-disable';
                    $('.swiper-pagination-bt').addClass(disablepagi);
                }else{
                    var disablepagi = 'swiper-pagination-disable';
                    $('.swiper-pagination-bt').removeClass(disablepagi);
                }
                return '<span class="' + className + '"></span>';
            }
        },
    });      
          
JS;
$this->registerJs($js);
$css = <<<TXT
//.custom-slides-swiper-3-item .swiper-slide .text-slide .bottom-block{
//    position: relative;
//}
//.custom-slides-swiper-3-item .swiper-slide .text-slide{
//    display: flex;
//    justify-content: center;
//    align-items: center;
//}
.custom-slides-swiper-3-item .swiper-slide .text-slide p{
    margin-bottom: 0;
}
TXT;
$this->registerCss($css);
?>