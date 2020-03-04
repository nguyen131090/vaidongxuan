
<? use yii\widgets\Pjax; 
    use yii\helpers\Html;
?>


<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/mobile/confiance.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content banner full-width">
            <? if(isset($theEntry->photosArray['banner'])){
                    $v = $theEntry->photosArray['banner'][0];
                    
             ?>
             <img
                 alt=""
    data-src="<?= $v->image?>" 
    data-srcset="/thumb/600/400/1/80<?= $v->image?> 450w, /thumb/900/0/1/80<?= $v->image?>"
    data-sizes="auto"
    class="banner-img lazyload" />
                <? } ?>
            <div class="text-on-banner">
                <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-white"><?=$theEntry->model->seo->h1 ? $theEntry->model->seo->h1 : $theEntry->title ?></h1>
                 <a href="#search-testi" data-transition="slide" data-direction="reverse" class="btn-testi-filter tt-latolatin-bold tt-fontsize-32 ui-link tt-color-white">Afficher les filtres</a>
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32">
            <?= $theEntry->model->content?>
        </div>
        
        <div class="row-content testi ajaxfilter">
            <div id="temoignages-load" class="getcontent">
                    <? 
                        $cnt = 0;
                    foreach($testis as $kt => $vt)  : 
                        $cnt++;
                        ?>
                    <div class="item item-<?= $kt+1?>">
                        <div class="img">
                            <a href="<?= DIR.$vt->cat->slug.'/'.$vt->slug?>">
                            <? if(!empty($vt->photosArray['summary'])) {
                                   $img =  $vt->photosArray['summary'][0];
                             ?>
                            <img class="img-lazy img-responsive" data-src= "/thumb/299/199/1/80<?=$img->image?>" alt="<?=$img->description?>">
                            <? }else { ?>
                            <?php
                            $src = DIR.'assets/img/cf/defaut-img-testi.jpg';

//                                preg_match_all('/<img[^>]+>/i', $vt->description, $result);
//                                foreach ($result as $img_tag) {
//                                    foreach ($img_tag as $vimg) {
//                                        if(strpos($vimg, 'ngoac_kep') === false){
//                                            preg_match('/(src)=("[^"]*")/i', $vimg, $src);
//                                            break;
//                                        }
//                                    }
//
//                                }
                            ?>

                           <img class="img-lazy img-responsive" alt="" data-src='<?php if (is_array($src)) {
                                    echo '/'.'timthumb.php?src='.str_replace('"','',$src[2]).'&w=299&h=199&zc=1';
                            } else echo '/'.'timthumb.php?src='.$src.'&w=299&h=199&zc=1'; ?>'/>
                            <? } ?>
                            </a>
                        </div>
                        <div class="area-info-text">
                            <a href="<?= DIR.$vt->cat->slug.'/'.$vt->slug?>">
                                <h3 class="no-margin title-item tt-latolatin-bold tt-fontsize-40"><?= $vt->title?></h3></a>
                            <p class="nameClient tt-fontsize-24">
                                    <img data-src="/assets/img/mobile/man-icon.png" alt="">
                                    <?=$vt->data->nameclient ?></p>
                            <div class="text tt-fontsize-32 tt-latolatin-regular">
                                <?= $vt->model->summary;?>
                            </div>
                            <ul class="no-margin no-padding">
                                <? if(isset($vt->data->from) && isset($vt->data->to)) : ?>
                                    <li class=" tt-fontsize-24">
                                        <img data-src="/assets/img/page2016/icon_time.png" alt="">

                            <?= date('d/m/Y',strtotime($vt->data->from)); // .' - '. date('d/m/Y',strtotime($vt->data->to)) ?></li>
                                <? endif;?>
                                <li class=" tt-fontsize-24">
                                    <img data-src="/assets/img/page2016/posi.png" alt="">
                                    <? if(isset($vt->data->countries)) : ?>
                                    <? foreach($vt->data->countries as $kc => $vc) {
                                            if(isset(Yii::$app->params['tsDestinationList'][$vc])) echo Yii::$app->params['tsDestinationList'][$vc];
                                            if($kc == count($vt->data->countries) - 1) break;
                                            echo "<br>";
                                        }?>
                                    <? endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <? endforeach; ?>
                 
                 <?
            
             
            
            if(Yii::$app->request->get('country') == NULL){
               $country = 'all';
           }else{
               $country = Yii::$app->request->get('country');
           }
           if(Yii::$app->request->get('type') == NULL){
               $type = 'all';
           }else{
               $type = Yii::$app->request->get('type');
           }
           if(Yii::$app->request->get('theme') == NULL){
               $theme = 'all';
           }else{
               $theme = Yii::$app->request->get('theme');
           }
           if (Yii::$app->request->get('see-more') == NULL) {
               $seemore = 12;
           } else {
               $seemore = Yii::$app->request->get('see-more');
           }

           if (Yii::$app->request->get('page') == NULL) {
                $page = $seemore / 12;
            } else {
                $page = Yii::$app->request->get('page');
            }
           
                    
                    
            if ($totalCountTesti > $seemore && ($totalCountTesti / 12) > $page) {
               ?>
            
                <span class="btn-see-more tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get="<?= 'country=' . $country . '&type=' . $type . '&theme=' . $theme ?>" data-seemore="<?= (($page + 1) * 12) ?>" data-value='' data-page="<?= $page + 1 ?>">Afficher la suite</span>
            
           <? } ?>
<!--                 <span class="btn-see-more btn-see-more-testi tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get='<?//=DIR.URI?>' data-page="2" data-value="4">Afficher la suite</span>-->
           </div>     
        </div>
<?php
include(dirname(__FILE__).'/_inc_back_button.php');
?>        
    </div>

    
</div>
<?// include '_inc_filter_testi.php'; ?>
<? 
$country = SEG1;
$uri = URI;
$js = <<< JS

var portraitSwiper = new Swiper('.portrait-slider', {
        slidesPerView: 'auto',
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        onReachBeginning: function(swiper){
             swiper.params.centeredSlides = false;
            swiper.params.initialSlide = 0;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },
        onReachEnd: function(swiper){
             swiper.params.centeredSlides = false;
             swiper.params.initialSlide = swiper.slides.length - 1;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },
    });
$('.btn-see-more-testi').click(function(){    
            var target = $(this);
            var page = $(this).data('page');
            var pr = $(this).data('get')+'?page='+$(this).data('page');
            
            var pagesize = $(this).data('value');
            var url = window.location.pathname + '?' + pr;
               $.ajax({
                    type: "GET",
                    url: pr,
                    datatype: 'html',
                    beforeSend: function() {
                        $('.getcontent').append('<div class="backgroundwhite"></div>');
                        $('.getcontent').css({'position':'relative'});
                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
                    },
                    success: function(data){
                        if(!data){
                            $('.ajax-see-more').hide();
                            return false;
                        }
                        $('.getcontent').append(data);
                        target.data('page', target.data('page')+1);
                        $('.backgroundwhite').remove();
                    }
               }); 

        });
$(document).ready(function(){
    var newPage = $('#search-testi');
    newPage.appendTo($.mobile.pageContainer);
})
JS;
$this->registerJs($js); 
$css = <<<CSS
.btn-testi-filter{
    width: 92vw;
    margin-left: 4vw;
}
.banner .text-on-banner{
    padding: 2.5rem 0 0;
}
CSS;
$this->registerCss($css);
?>
