<? 
$this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile('/assets/css/mobile/mobile-landing-page.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
?>
<div class="contain ld-container-1 container-banner no-padding">
    <div class="column">
        <div class="row-content banner">
           <? 
            if(!empty($theEntry->photosArray['banner-mobile'])) {
            $banner = $theEntry->photosArray['banner-mobile'][0]; 
            ?>
            <img
                 alt=""
            data-src="<?= $banner->image?>" 
            data-srcset="/thumb/600/400/1/80<?= $banner->image?> 450w, /thumb/900/0/1/80<?= $banner->image?>"
            data-sizes="auto"
            class="image-banner img-responsive lazyload" />
            <? } ?>
<!--            <img class="image-banner img-responsive lazyload" data-src="/assets/img/landing-page/img-banner-mobile.jpg">            -->
        </div>
    </div>
</div>
<div class="contain ld-container-2 container-envis mt-txt-80">
    <div class="amc-column ld-area-text-button mb-txt-80">
        <div class="ld-text-button">
            <p>
                <span><?= isset($theEntry->model->seo) ? $theEntry->model->seo->h1 : '' ?></span>
                
<!--                Laissez-vous tenter par <br>un circuits unique au Vietnam-->
            </p>
            <h1 class="mt-0 tt-latolatin-bold tt-fontsize-45">
                <?= $theEntry->title ?>
            </h1>
            <a href="/devis" class="ld-btn-custom btn-amica-basic btn-amica-basic-2 mt-txt-50" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="cover_section" data-analytics-label="cta_devis">Demander un devis personnalisé</a>
        </div>
    </div>    
    
    <div class="amc-column column">
        <div class="area-text">
            
            <?
            if(isset($theEntry->model->text)){
                $txt = explode('</p>', $theEntry->model->text);
                unset($txt[count($txt) - 1]);
               
            ?>
            
            <div class="substring-text">
               <?
                    if(isset($txt[0])){
                        $strlen = strlen($txt[0]); 
                        $first_text = substr($txt[0], 0, $strlen - 1);
                        $last_character = substr($txt[0], $strlen - 1, $strlen);
                        if($last_character == '.'){
                            $last_character = $last_character;
                        }else{
                            $last_character = ' '.$last_character;
                        }
                ?>
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="content_section" data-analytics-label="read_more"> Lire la suite</span></p>'; ?>

                <?
                    }
                    
                ?>
            </div>
             <div class="fullstring-text">
                <?
                            $cnt = 0;
                            foreach ($txt as $t) {
                                $cnt++;
                                if($cnt > 1 && count($txt) > $cnt){
                                    echo $t . '</p>';
                                }else if(count($txt) == $cnt){
                                    echo $t . '<span class="amc-btn-control-text less-text"> Réduire</span></p>';
                                }
                                
                            }
                ?>
            </div>
            <? }?>
            
          

        </div> 
    </div>     
 </div>    

<div class="contain ld-container-3 container-flud about-container container-video-ytb bg-f7 mt-txt-50">
    <div class="area-text mt-txt-80 mb-80" id="video">
        <?
            if(isset($theEntry->data->video)){
                echo str_replace('<iframe ', '<iframe data-analytics="on" data-analytics-category="landing_page" data-analytics-action="video_section" data-analytics-label="control_play"', $theEntry->data->video);
            }
        ?>
        </div>
<!--    <div class="text-left row-video d-inline-block mb-80">
        <h2 class="tt mt-txt-80 mb-txt-50 tt-latolatin-bold tt-fontsize-40"><strong>Amica Travel,</strong> l’âme du voyage
        </h2>
        <p class="summary mt-0 mb-50">1min30 de condensé d'Amica Travel et de notre définition du voyage. Venez visiter le Vietnam, le Laos, le Cambodge &amp; la Birmanie avec nous.&nbsp;</p>
        <div class="videoWrapper" data-analytics="on" data-analytics-category="homepage" data-analytics-action="video_section" data-analytics-label="control_play">
            <iframe style="min-height: 22rem;" class="videotype videoytb my-0 w-100" title="Amica Travel, l’âme du voyage" scrolling="no" data-src="https://www.youtube.com/embed/iUw37JEoucQ" autoplay="" allowfullscreen="allowfullscreen" frameborder="0" src="https://www.youtube.com/embed/iUw37JEoucQ"></iframe>
        </div>
    </div>-->
</div>
<div class="contain ld-container-4 mt-txt-80">
    <div class="amc-column column">
        
        
        <div class="area-text">
            
            <?
            if(isset($theEntry->data->block3)){
                $txt = explode('</p>', $theEntry->data->block3);
                unset($txt[count($txt) - 1]);
               
            ?>
            
            <div class="substring-text">
               <?
                    if(isset($txt[0])){
                        $strlen = strlen($txt[0]); 
                        $first_text = substr($txt[0], 0, $strlen - 1);
                        $last_character = substr($txt[0], $strlen - 1, $strlen);
                        if($last_character == '.'){
                            $last_character = $last_character;
                        }else{
                            $last_character = ' '.$last_character;
                        }
                ?>
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="content_section" data-analytics-label="read_more"> Lire la suite</span></p>'; ?>

                <?
                    }
                    
                ?>
            </div>
             <div class="fullstring-text">
                <?
                            $cnt = 0;
                            foreach ($txt as $t) {
                                $cnt++;
                                if($cnt > 1 && count($txt) > $cnt){
                                    echo $t . '</p>';
                                }else if(count($txt) == $cnt){
                                    echo $t . '<span class="amc-btn-control-text less-text"> Réduire</span></p>';
                                }
                                
                            }
                ?>
            </div>
            <? }?>
            
          

        </div> 
        
        <div class="list-icon mt-txt-50">
            
             <?
                       //     var_dump($theEntry->photosArray['icon'][0]);exit;
                            
                if(isset($theEntry->photosArray['icon'])){
                    $cnt = 0;
                    foreach ($theEntry->photosArray['icon'] as $v) {
                        $cnt++;
                        ?>
             <div class="item item-<?= $cnt ?> mb-50">
                <div class="img"><img data-src="<?= $v->image ?>"></div>
                <div class="text">
                    <p class="one"><?= isset(explode('|', $v->model->caption)[0]) ? explode('|', $v->model->caption)[0] : '' ?></p>
                    <p class="two"><?= isset(explode('|', $v->model->caption)[1]) ? explode('|', $v->model->caption)[1] : '' ?></p>
                </div>
            </div>
            <?
                    }
                    
                }            
            ?>
            
        </div>
    </div>     
</div>

<div class="contain ld-container-5 no-padding mt-txt-50 mb-txt-80">
    <div class="column amc-column">
        <div class="it-left">
            
            <img class="img-responsive" data-src="<?= isset($theEntry->photosArray['summary']) ? $theEntry->photosArray['summary'][0]->image : ''?>">
        </div>
        <div class="it-right">
            <div class="text">
                <?
                    if(isset($theEntry->data->block4)){
                        echo $theEntry->data->block4;
                    }
                ?>
<!--                <p class="tt-1">Le pays du dragon est une source inépuisable de prétextes d’un voyage au Vietnam.<p>
                <p class="tt-2 m-0">HA Duc Manh - CEO Amica Travel</p>    -->
            </div>
        </div>
    </div>
</div>

<div class="contain ld-container-6 mb-80">
    <div class="column amc-column">
        <div class="area-text text-center">
            
            <?
                    if(isset($theEntry->data->block5)){
                        echo $theEntry->data->block5;
                    }
                ?>
            
<!--            <h2 class="tt mt-0 mb-txt-50 tt-latolatin-bold tt-fontsize-40">Ils nous ont fait confiance</h2>
            <p class="summary mt-0 mb-txt-50"><?=$portrain->parents(1)->summary; ?></p>-->
        </div>
        <div class="testi-slider">
            <div class="swiper-wrapper">
                <? foreach ($arrTemoignages as $k => $v) : ?>
                <div class="swiper-slide">
                    <? $countries = isset($v['data']->countries) ? $v['data']->countries : [];
                    $countries = \yii\helpers\ArrayHelper::getColumn($countries, function($e){
                                    return Yii::$app->params['tsDestinationList'][$e];    
                                 });
                    ?>
<!--                    <a href="/temoignages/<?//=$v['slug'] ?>">-->
                    <p class="summary mt-0 mb-txt-50">“<?= $v['summary'] ?>”</p>    
                        
                    <div class="img-text">
                        <? if(isset($v['photos'][0])) {  ?>
                        <img width="100" data-src="/thumb/100/100/1/80<?=$v['photos'][0]['image']?>"  alt="<?=$v['photos'][0]['description']?>">
                        <? }else{ ?>
                        <img width="100" data-src="/thumb/100/100/1/80/assets/img/tour/client-df.png"  alt="">
                        <? } ?>
                        <div class="info-testi">
                            <span class="tt-name"><?= isset($v['data']->nameclient) ? $v['data']->nameclient : ''?></span>
                            <span class="tt-info"><?=implode(', ',$countries)?>, <?//=date('M Y',$v['time']) ?> <?=ucfirst(Yii::$app->formatter->asDate($v['time'], 'php:F Y'))?> </span>
                        </div>
                    </div>
                    
                    
<!--                    </a>-->
                </div>
                <? endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        
        <div class="area-logo-recom mt-50 ">
            <p class="tt tt-custom">Ils nous ont recommandé</p>
            <div class="logo">
                <img alt="" style="max-width: 5.2rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-trip.jpg" />
                <img alt="" style="max-width: 3.4rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-rou.jpg" />
                <img alt="" style="max-width: 4.8rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-petit.jpg" />
                <img alt="" style="max-width: 6.5rem;" data-src="<?=DIR?>assets/img/mobile/home/logo-home-lonely.jpg" />
            </div>
        </div>
    </div>
</div>
<div class="contain ld-container-7 mb-0 bg-f7">
        <div class="amc-column col-tours">

        <div class="area-text mb-txt-50 mt-txt-80">
             <?
                    if(isset($theEntry->data->block6)){
                        echo $theEntry->data->block6;
                    }
                ?>
            
<!--            <h2 class="">Nos séjours dans les coins reculés</h2>
            <p>Thong Nong, demandez à séjourner dans ces coins reculés d’exception, où le pouls bat lentement, au rythme de la vie quotidienne locale. Il est si bon parfois de déconnecter les esprits, des flux parfois tempétueux de la mondialisation.</p>
        -->
        </div>
        <div class=" countries-slider mb-80">
                <div class="swiper-wrapper">
            
                <? foreach($theEntries as $key => $v) : ?>
                    <div class="swiper-slide item-img p-0 bg-white">
                    <a href="<?=DIR.$v->slug ?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="tours_section" data-analytics-label="tour_card_<?=$v->model->item_id ?>">
                        <? if(isset($v->photosArray['summary'])) : ?>
                            <img class="w-100 img-responsive" alt="<?=$v->photosArray['summary'][0]->description ?>" data-src="<?=$v->photosArray['summary'][0]->image ?>">
                            <? endif; ?>
                    </a>        
                       <div class="text pl-15 col col-sm col-lg-12 d-sm-flex amc-fix-pb-25-0 flex-sm-column d-lg-block">
<!--                            <span class="space space-10 space-horizontal"></span>    -->
                            <p class="tt-color-6b6b6b tt-fontsize-28 p-0 m-0 amc-fix-mt-12-0"><?= $v->parents()[0]->title ?> / <?=ucwords(implode(', ', $v->data->countries)) ?></p>

                            <p class="m-0 p-0 amc-fix-mt-15 tt tt-1 tt-fontsize-40 tt-latolatin-bold tt-line-height-1-2" name="pop-<?=$key+1 ?>" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="tours_section" data-analytics-label="tour_card_t_<?= $v->model->item_id ?>">
                                <a class="tt-line-height-1-2 tt-latolatin-bold" href="/<?=$v->slug?>"><?=$v->title;?></a>
                            </p>
                            <p class="sub-title m-0 p-0 amc-fix-mt-15"><?=\app\helpers\Text::limit_text($v->model->summary, 100); ?></p>
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
            
        <div style="text-align: center;" class="d-block w-100 mb-0">
            <a href="/voyage/itineraire" class="ld-btn-custom ld-btn-custom-1 btn-amica-basic-3 btn-amica-basic mx-auto mt-txt-20" data-analytics="on" data-analytics-category="landing_page" data-analytics-action="tours_section" data-analytics-label="cta_tours">Tous nos circuits au Vietnam (<?= $totalCount ?>)</a>
        </div>    

        
    </div>
</div>
<? if(isset($theEntry->data->condition) && $theEntry->data->condition != ''){ ?>
<div class="contain ld-container-8 mt-txt-80 mb-txt-80">
    <div class="amc-column">
        <?= $theEntry->data->condition ?>
    </div>
</div>
<? } ?>
<?
$js=<<<TXT
    //$('.amc-btn-control-text.see-more').click(function(){
$(document).on('click', '.amc-btn-control-text.see-more', function(){        
   // $(this).parent().parent().hide();
    $(this).parent().parent().parent().children('.fullstring-text').show();  
    $(this).parent().children('.dot-more').hide();      
    $(this).parent().children('.last-character').show();    
    $(this).hide();
});   
//$('.amc-btn-control-text.less-text').click(function(){
$(document).on('click', '.amc-btn-control-text.less-text', function(){          
    $(this).parent().parent().hide();
    $(this).parent().parent().parent().children('.substring-text').children('p').children('.see-more').show();
    $(this).parent().parent().parent().children('.substring-text').children('p').children('.dot-more').show();   
    $(this).parent().parent().parent().children('.substring-text').children('p').children('.last-character').hide();       
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
        
        
    var tourSwiper = new Swiper('.countries-slider', {
       slidesPerView: 2.1,
        centeredSlides: false,
        spaceBetween: 20,
        loop: false,
        breakpoints: {
            640: {
              slidesPerView: 1.1,
            }
          }
    });    
        
TXT;
$this->registerJs($js);
?>