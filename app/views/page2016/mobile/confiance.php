
<? use yii\widgets\Pjax; 
    use yii\helpers\Html;
?>
<? if(Yii::$app->request->isAjax): ?>
    <? 
                        $cnt = 0;
                    foreach($testis as $kt => $vt)  : 
                        $cnt++;
                        ?>
                    <div class="item item-<?= $kt+1?>">
                        <a href="<?= DIR.$vt->cat->slug.'/'.$vt->slug?>">
                            <h3 class="no-margin title-item tt-latolatin-bold tt-fontsize-40"><?= $vt->title?></h3></a>
                        <p class="nameClient tt-fontsize-24">
<!--                                <img data-src="/assets/img/mobile/man-icon.png" alt="">-->
                                <?=$vt->data->nameclient ?></p>
                        <div class="text tt-fontsize-32 tt-latolatin-regular">
                            <?= $vt->model->summary;?>
                        </div>
                        <ul class="no-margin no-padding">
                            <? if(isset($vt->data->from) && isset($vt->data->to)) : ?>
                                <li class=" tt-fontsize-24">
                                    <img data-src="/assets/img/page2016/icon_time.png" alt="">
                    <span>
                                    <span>
                        <?= date('d/m/Y',strtotime($vt->data->from)) ?></li>
                            <? endif;?>
                            <li class=" tt-fontsize-24">
                                <img data-src="/assets/img/page2016/posi.png" alt="">
                                <? if(isset($vt->data->countries)) : ?>
                                <? foreach($vt->data->countries as $kc => $vc) {
                                        if(isset(Yii::$app->params['tsDestinationList'][$vc])) echo Yii::$app->params['tsDestinationList'][$vc];
                                        if($kc == count($vt->data->countries) - 1) break;
                                        echo ", ";
                                    }?>
                                <? endif; ?>
                            </li>
                        </ul>
                    </div>
                    <? endforeach; ?>
<? else: ?>

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
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32">
            <?= $theEntry->model->content?>
        </div>
        <div class="row-content portrait full-width">
            <h2 class="tt-latolatin-bold sub-title-page tt-fontsize-40 tt-color-000000"><?= $thePortrait->title?></h2>
            <?= $thePortrait->model->content?>
            <div class="portrait-slider swiper-container full-width">
                <div class="swiper-wrapper">
                    <? foreach ($portraits as $k => $v) : ?>
                    <div class="swiper-slide item item-<?=$k+1?>">
                        <a href="<?=DIR.$v->slug?>">
                            <? if(isset($v->photosArray['summary'])){
                                $value = $v->photosArray['summary'][0];
                                            echo '<img data-sizes="auto" alt="'.$value->description.'" class="lazyload img-responsive" data-srcset="'.$value->image.'" data-src="'.$value->image.'">';
                                }
                            ?>
                            <h3 class="tt tt-fontsize-32 tt-latolatin-bold">
                                <?= $v->title?>
                            </h3>
                        </a>
                    </div>
               <? endforeach; ?>

                </div>
            </div>
            
            <a href="/portrait-voyageur" class="amc-btn-link tt-fontsize-32 tt-latolatin-bold">Voir les autres portraits voyageurs</a>
        </div>
        
        <div class="row-content comment-recommend">
            
        
            <p class="tt-latolatin-bold tt-color-000000 tt-fontsize-40 m-0 mt-50 mb-50 p-0">Comment nous recommander&nbsp? </p>
            
            <div class="layout-no-gutter-around fb-cf">
                <div class="d-flex justify-content-center px-0">
                    <div class="amc-icon icon-fb">
                        <img alt="" data-src="/assets/img/mobile/fb-cf.png">
                    </div>
                    <div class="btn-img d-inline-block">
                        <div class="img"><img class="mb-5" alt="" data-src="/assets/img/mobile/fb-number-stars.png"></div>
                        <div class="">
                             
                            <a href="https://www.facebook.com/amicatravel/" class="btn-items" target="_blank">Suivez-nous !</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layout-no-gutter-around trip-cf">
                <div class="d-flex justify-content-center px-0">
                    <div class="amc-icon icon-trip">
                        <img alt="" data-src="/assets/img/mobile/trip-cf.png">
                    </div>
                    <div class="btn-img d-inline-block">
                        <div class="img"><img class="mb-5" alt="" data-src="/assets/img/mobile/trip-number-stars.png"></div>
                        <div class="">
                            <a href="https://www.tripadvisor.fr/UserReviewEdit-g293924-d8861467-Amica_Travel-Hanoi.html" class="btn-items" target="_blank">Ecrire un avis</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layout-no-gutter-around petit-cf">
                <div class="d-flex justify-content-center px-0">
                    <div class="amc-icon icon-petit">
                        <img alt="https://www.petitfute.com/v45031-hanoi/c1122-voyage-transports/c747-tours-operateurs/143513-amica-travel-siege-social.html" data-src="/assets/img/mobile/petit-cf.png">
                    </div>
                    <div class="btn-img d-inline-block">
                        <div class="img"><img class="mb-5" alt="" data-src="/assets/img/mobile/petit-number-stars.png"></div>
                        <div class="">
                            <a href="https://www.petitfute.com/v45031-hanoi/c1122-voyage-transports/c747-tours-operateurs/143513-amica-travel.html" target="_blank" class="btn-items">Donner votre avis</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="row-content testi">
            <h2 class="tt-latolatin-bold tt-color-000000 tt-fontsize-40">
                <a href="<?= DIR ?>temoignages"><?= $theTesti->title?></a>
            </h2>
            <div class="text tt-fontsize-32">
                <?=$theTesti->model->content?>
            </div>
            <a href="#search-testi" class="btn-testi-filter tt-latolatin-bold tt-fontsize-32 ui-link tt-color-white">Filtrer les avis</a>
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
<!--                                    <img data-src="/assets/img/mobile/man-icon.png" alt="">-->
                                    <?=$vt->data->nameclient ?></p>
                            <div class="text tt-fontsize-32 tt-latolatin-regular">
                                <?= $vt->model->summary;?>
                            </div>
                            <ul class="no-margin no-padding">
                                <? if(isset($vt->data->from) && isset($vt->data->to)) : ?>
                                    <li class=" tt-fontsize-24">
                                        <img data-src="/assets/img/page2016/icon_time.png" alt="">

                            <?= date('d/m/Y',strtotime($vt->data->from)) ?></li>
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
                 </div>

                 <span class="btn-see-more btn-see-more-testi tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get='<?=DIR.URI?>' data-page="2" data-value="4">Afficher la suite</span>
        </div>
        
        <div class="row-content presse full-width">
            <img class="img-responsive" data-src="<?=DIR?>assets/img/mobile/press_m.jpg">
            <div class="text">
                <h2 class="tt-fontsize-40 tt-latolatin-bold">La presse parle de nous</h2>
                <p class="tt-latolatin-regular">Retrouvez ici les derniers articles de presse et de blog ainsi que des reportages sur Amica Travel afin de mieux découvrir notre équipe.</p>  
                <a href="/presse" id="" class="btn-see-more tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925">En savoir plus</a>  
            </div>
        </div>
    </div>

    
</div>
<? include '_inc_filter_testi.php'; ?>
<? 
$country = SEG1;
$uri = URI;
$js = <<< JS

var portraitSwiper = new Swiper('.portrait-slider', {
        slidesPerView: 1.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
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
?>
<? endif; ?>