<? 
use yii\helpers\Markdown; 
use app\helpers\Text;
$this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 

?>

<?php $this->registerCssFile(DIR . 'assets/js/fancybox/jquery.fancybox.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<div class="contain mt-80">
    <div class="amc-column">
        <div class="item-detail">
            <div class="dtn-col col-right">
                <h1 class="title m-0 mb-10 tt-fontsize-40 tt-latolatin-bold"><?= isset(explode('-', $theEntry->title)[0]) ? trim(explode('-', $theEntry->title)[0]) : '' ?></h1>
                
                <?
                    if(isset($theEntry->data->price)){
                ?>       
                <p class="gia-item m-0 mb-10">Giá : <span style="color: red;"><?= $theEntry->data->price ?>  đ/m</span></p>
                <?        
                    }
                ?>
                
                <?
                    if(isset($theEntry->data->offer)){
                ?>       
                <p class="offer m-0 mb-10">Giảm giá <span style="color: red;"><?= isset(explode('/', $theEntry->data->offer)[0]) ? explode('/', $theEntry->data->offer)[0] : '' ?></span> cho hóa đơn trên <span style="color: red;"><?= isset(explode('/', $theEntry->data->offer)[1]) ? explode('/', $theEntry->data->offer)[1] : '' ?></span></p>
                <?        
                    }
                ?>    
                
                <p class="color m-0 mb-10">Liên hệ đặt hàng: Dư Huấn - <a style="color: red;" href="tel:19001000">19001000</a> </p>
            </div>
            <?
                if($theEntry->photosArray['galery']){
            ?>
            <div class="dtn-col col-left">
                
                <!-- Swiper -->
                <div class="swiper-container swiper-item-detail">
                  <div class="swiper-wrapper">
                    <?
                       foreach ($theEntry->photosArray['galery'] as $image) {
                    ?>
                      <div class="swiper-slide">
                          <a class="fancybox" href="<?= $image->image?>" rel="galery">
                            <img alt="" class="img-responsive" data-src="<?=DIR?>timthumb.php?src=<?= $image->image?>&w=564&h=400&zc=1">
                          </a>
                      </div>
                      
                    <?
                       }
                    ?>
                      
                    
                  </div>
                  <!-- Add Arrows -->
                  <div class="swiper-button-next swiper-item-detail-next"></div>
                  <div class="swiper-button-prev swiper-item-detail-prev"></div>
                  <!-- Add Pagination -->
                  <div class="swiper-pagination swiper-item-detail-pagination"></div>
                </div>
                <p class="m-0 mt-10 tt-fontsize-24">Nhấn vào ảnh để xem ảnh to</p>
            </div>
            <? } ?>
            
        </div>
        <div class="entry-body">
            <p class="tt-fontsize-40 tt-latolatin-bold text-left mb-0 mt-50">Chi tiết :</p>
            <div class="content text-left">
                <?= $theEntry->description ?>
            </div>
        </div>
    </div>
</div>
<span class="space space-50"></span>

<div class="contain container-2 m-0 mt-40 pt-50 mb-60" style="background: #dedede;">
    <div class="amc-column">
        <h2 class="tt tt-fontsize-40 tt-latolatin-bold m-0 mb-50 mt-50 text-left">Cac mau khac</h2>
        
        <div class="list-item">
            
             <div class="swiper-container list-item-swiper-slider">
                <div class="swiper-wrapper">
                    
                    <?
                        $j = 0;
                        foreach ($listItem as $v) {
                           // var_dump($v->photosArray);exit;
                            $j++;
                        

                    ?>
                    <div class="swiper-slide">
                        <div class="item item-<?= $j ?> pb-10 mb-40">
                            <a href="#">
                                <div class="image">
                                    <img alt="" data-src="<?= isset($v->photosArray['summary']) ? $v->photosArray['summary'][0]->image : '' ?>">
                                    <?
                                        if(isset($v->data->offer)){
                                            echo '<span class="offer"> -'.$v->data->offer.'</span>';
                                        }
                                    ?>

                                </div>
                                <p class="tt-item m-0 mt-10 tt-fontsize-18 tt-latolatin-bold"><?= isset(explode('-', $v->title)[0]) ? trim(explode('-', $v->title)[0]) : '' ?></p>
                                <p class="tt-item m-0 tt-fontsize-16 tt-latolatin-regular">Mã sp : <?= isset(explode('-', $v->title)[1]) ? trim(explode('-', $v->title)[1]) : '' ?></p>

                                <?
                                    if(isset($v->data->price)){
                                ?>       
                                    <p class="gia-item">Giá: 
                                        <span class="tt-fontsize-18"><?= $v->data->price ?> đ/m</span>
                                    </p>
                                <?        
                                    }
                                ?>

                                <p>SĐT : 1900 1000</p>
                            </a>

                        </div>
                    </div>    
                    <?
                        


                        }
                    ?>
            
            
                   
                </div>
                <!-- Add Pagination -->
            <!--    <div class="swiper-pagination"></div>-->
                <!-- Add Arrows -->
<!--                <div class="swiper-button-next list-item-swiper-slider-next"></div>
                <div class="swiper-button-prev list-item-swiper-slider-prev"></div>-->
            </div>
            
            
           
           
            
        </div>
        
        
       
        
    </div>
    <span class="space space-80"></span>
</div>
<span class="space space-80"></span>
<?
$css=<<<CSS
.list-item-swiper-slider{
    overflow: unset;
}
CSS;
$this->registerCss($css);
$js = <<< JS
var swiper = new Swiper('.swiper-item-detail', {
      navigation: {
        nextEl: '.swiper-item-detail-next',
        prevEl: '.swiper-item-detail-prev',
      },
      pagination: {
        el: '.swiper-item-detail-pagination',
        dynamicBullets: true,
      },  
        
    });
        
var swiper = new Swiper('.list-item-swiper-slider', {
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
        
        
    $(document).ready(function() {

	
	
	$("a.fancybox").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false,
                'padding' : 10
	});
	
});            
        
JS;
$this->registerJs($js);
 ?>