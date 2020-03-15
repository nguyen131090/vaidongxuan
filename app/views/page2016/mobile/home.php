
<? 
use yii\helpers\Markdown; 
use app\helpers\Text;
$this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile('/assets/css/mobile/home.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
?>
<div class="contain no-padding">
    <div style="position: relative;" class="amc-column">
        <div class="slider-banner-home">
            <div class="swiper-wrapper">
                 <?   $home = \yii\easyii\modules\page\api\Page::get(31); 
            $i = 0;
            if(!empty($home->photos)) :  ?>
                <? foreach ($home->photos as $key => $value) : ?>
                    <? if($value->type == 'banner') : ?>
                    <div class="swiper-slide item item-<?=$i ?> <?=$i==0 ? 'active' : '' ?>">
                        <img
                                    alt="vaidongxuan"    
                       data-src="<?= $value->image?>" 
                       data-srcset="/thumb/600/400/1/80<?= $value->image?> 450w, /thumb/900/0/1/80<?= $value->image?>"
                       data-sizes="auto"
                       class="banner-img lazyload" />
                        
                    </div>
                    <? $i++; ?>
                    <?  endif;?>
                <? endforeach; ?>
            <? endif;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-banner-home"></div>
            <!-- Add Arrows -->
<!--            <div class="swiper-button-next swiper-button-next-banner-home"></div>
            <div class="swiper-button-prev swiper-button-prev-banner-home"></div>-->
        </div>
        <div class="dtn-info">
            <p>Quầy vải DƯ HUẤN</p>
            <p>119 - B2 - Tầng 2 - chợ Đồng xuân - Hà Nội</p>
            <p>Liên Hệ : 0909 415 375</p>
        </div>
    </div>
</div>

<? 
$cnt = 0;
foreach ($programes as $value) {
    $cnt++;
    //var_dump($value->content);exit;
$explodeslug = explode('/', $value->slug);
?>


<div class="contain <?= $cnt == 1 ? 'mt-80' : '' ?> mb-80">
    <div class="amc-column">
        <h2 class="tt tt-fontsize-24 tt-latolatin-bold m-0 mb-50 text-center"><?= $value->seo != null ? $value->seo->h1 : $value->title ?></h2>
        <div class="summary m-0 mb-50 text-center"><?= $value->content ?></div>
        
        <div class="list-item">
            
            <div class="custom-slides-swiper-<?= $explodeslug[count($explodeslug) - 1]; ?>">
                <div class="swiper-wrapper">
            <?
                $listItem = \app\modules\programmes\api\Catalog::items([
                    //  'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                      'where'=>['category_id' => $value->category_id],
                     // 'where' => ['like','title','%'.$search.'%', false],
                      //'filters' => $fil_countries,    
                      'pagination' => ['pageSize' => 6]

                    ]);
                    
            ?>
            
            <?
                $j = 0;
                foreach ($listItem as $v) {
                   // var_dump($v->photosArray);exit;
                    $j++;
               
                    
            ?>
            
                <div class="swiper-slide item item-<?= $j ?> pb-10 mb-40">
                    <a href="<?= $v->slug ?>">
                        <div class="image">
                            <img alt="" data-src="<?= isset($v->photosArray['summary']) ? $v->photosArray['summary'][0]->image : '' ?>">
                            <?
                                if(isset($v->data->offer)){
                                    echo '<span class="offer"> -'.$v->data->offer.'</span>';
                                }
                            ?>
                            
                        </div>
                        <p class="tt-item m-0 amc-fix-mt-25-0 tt-fontsize-18 tt-latolatin-bold"><?= isset(explode('-', $v->title)[0]) ? trim(explode('-', $v->title)[0]) : '' ?></p>
                        <p class="tt-item m-0 amc-fix-mt-12 tt-fontsize-16 tt-latolatin-regular">Mã sp : <?= isset(explode('-', $v->title)[1]) ? trim(explode('-', $v->title)[1]) : '' ?></p>
                        
                        <?
                            if(isset($v->data->price)){
                        ?>       
                            <p class="gia-item m-0 amc-fix-mt-12">Giá: 
                                <span class="tt-fontsize-18"><?= $v->data->price ?> đ/m</span>
                            </p>
                        <?        
                            }
                        ?>
                        
                            <p class="mt-0 amc-fix-mt-12">SĐT : 1900 1000</p>
                    </a>

                </div>
            <?
               
            
                }
            ?>
            </div>
            </div>    
          
            <div class="dtn-btn-link mt-80">
               <a href="<?= $value->slug ?>">Xem thêm</a>
            </div>
              
            
        </div>
        
    </div>
    
    <?
$swiper = '.custom-slides-swiper-'. $explodeslug[count($explodeslug) - 1];
$jsss=<<<JS
var swiper = new Swiper('$swiper', {
        slidesPerView: 1.1,
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
JS;
$this->registerJs($jsss);
?>       
    
</div>
<? } ?>

<?
$js = <<< JS
var homeBannerSwiper = new Swiper('.slider-banner-home', {
        
        loop: true,
        lazyLoading: true,
    autoplay: {
    delay: 4000,
  },    
    navigation: {
        nextEl: '.swiper-button-next-banner-home',
        prevEl: '.swiper-button-prev-banner-home',
    },
    pagination: {
      el: '.swiper-pagination-banner-home',
      dynamicBullets: true,
    },  
}); 
var tourSwiper = new Swiper('.tour-slider', {
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: false,
         pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
    });
var testiSwiper = new Swiper('.testi-slider', {
    pagination: '.swiper-pagination',
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 30,
        lazyLoading: true,
        loop: false,
         pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
    });
var countriesSwiper = new Swiper('.countries-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false
         
    });
var blogSwiper = new Swiper('.swiper-blog', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false
         
    });        
JS;
$this->registerJs($js);
 ?>