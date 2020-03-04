<? use yii\easyii\modules\text\api\Text; ?>
<div class="row-content related-block mb-80">
    <h2 class="title-row tt-fontsize-40 mt-0 mb-txt-50 tt-latolatin-bold"><?=Text::get('related-text-formules') ?></h2>
    <div class="related-slider swiper-container full-width">
            <div class="swiper-wrapper">
        
            <? foreach($sliders as $key=> $value) : ?>
                <div class="swiper-slide item-img">
                <a href="<?=DIR.$value->slug ?>">
                   <? if(!empty($value->photosArray['summary'][0])) : 
                                $imgS =  $value->photosArray['summary'][0];
                                ?>
                        <img class="lazyload img-full" 
    data-src="<?= $imgS->image?>"
    data-srcset="<?= $imgS->image?>" alt="<?=$imgS->description?>"/>
                    <? endif; ?>
                    <h3 class="text-on-img tt-latolatin-bold tt-fontsize-32"><?=$value->title?></h3>
                </a>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
<? 
$js = <<< JS
var secretSwiper = new Swiper('.related-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
    });
JS;
$this->registerJs($js);?>
