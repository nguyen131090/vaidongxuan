<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?php // $this->registerCssFile('/assets/css/rules/bootstrap-grid.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/temoignage.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
    <?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_temoi.jpg'>
    <?}?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="column row-1 d-sm-none d-xl-block">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
     
    <div class="column row-2">
        
        <h1 class="title">
           <?= $this->context->pageT ?>
        </h1>
    </div>
</div>
<div class="contain container-3">
    <div class="column align-self-center mt-txt-60 mb-txt-0 text-center text-content-body">
        <?= $theEntry->model->content?>
    </div>
    <div class="column portraits" >
        <h2 class="tt mb-txt-40 mt-txt-60 text-center"><a href="<?=DIR?>portrait-voyageur"><?= $thePortrait->title?></a></h2>
        <div class="container-fluid px-0">
            <div class="row layout-no-gutter-around is-2-columns no-gutters">
            <? 
            if(!empty($topPortrait->photosArray['custom'])){
                $value = $topPortrait->photosArray['custom'][0];
                    echo '<div class="col-7 col-sm-7 pr-10">'."<a href='$topPortrait->slug'>";
                    echo '<img alt="'.$value->description.'" class="img-lazy img-responsive" data-src="'.$value->image.'"><h3>'.$topPortrait->title.'</h3></a></div>';
            }
            ?>
            <?php foreach ($portraits as $key => $value): ?>
                <? if(!empty($value->photosArray['custom'])){
                $vimg = $value->photosArray['custom'][0]; ?>
                <? if(!$key) echo "<div class='col-5 col-sm-5 pl-10'><div class='row-col-5 mb-20'>"; elseif($key==1) echo "<div class='row-col-5'>"; elseif($key==2) echo '<div class="row layout-no-gutter-around is-2-columns no-gutters"><div class="col-6 col-sm-6 mt-20 pr-10">'; else echo '<div class="col-6 mt-20 pl-10">';
                
                    echo "<a href='$value->slug'>".'<img alt="'.$vimg->description.'" class="img-lazy img-responsive" data-src="'.$vimg->image.'"><h3>'.$value->title.'</h3></a></div>';
                    if($key == 1) echo '</div></div>';
                    if($key==3) {echo  '</div>';break;}
                }?>

            <?php endforeach ?>
            </div>
            <div class="row text-center mx-0">
            <a href="/portrait-voyageur" class="btn-amica-basic btn-amica-basic-1 mx-auto mt-40 mb-60">Voir les autres portraits voyageurs</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-md-40 comment-recommend contain">
    <div class="column row">
    <div class="col-12 col-lg-3 col-sm-12 d-inline-flex justify-content-center align-items-center text">
        
        <p class="px-40"><img class="mb-txt-20" alt="" data-src="/assets/img/cf/icons-comment.png"><br class="d-none d-sm-none d-lg-block">Comment <br class="d-none d-sm-none d-lg-block">nous <br class="d-none d-sm-none d-lg-block">recommander&nbsp? </p>
    </div>
    <div class="layout-no-gutter-around col-4 col-sm-4 col-lg-3 col-md-4 fb-cf d-flex justify-content-center align-items-center px-0">
        <div class="row d-flex justify-content-center px-0">
            <div class="align-bottom pr-5 pl-0 d-flex align-items-end">
                <img alt="" data-src="/assets/img/cf/fb-cf.png">
            </div>
            <div class="d-inline-block">
                <div class=""><img class="mb-5" alt="" data-src="/assets/img/cf/fb-number-stars.png"></div>
                <div class="">
                    <a href="https://www.facebook.com/amicatravel/" class="btn-items" target="_blank">Suivez-nous !</a>
                </div>
            </div>
        </div>
    </div>

    <div class="layout-no-gutter-around col-4 col-sm-4 col-lg-3 col-md-4 trip-cf d-flex justify-content-center align-items-center px-0">
        <div class="row row d-flex justify-content-center px-0">
            <div class="align-bottom pr-5 pl-0 d-flex align-items-end">
                <img alt="" data-src="/assets/img/cf/trip-cf.png">
            </div>
            <div class="d-inline-block">
                <div class=""><img class="mb-5" alt="" data-src="/assets/img/cf/trip-number-stars.png"></div>
                <div class="">
                    <a href="https://www.tripadvisor.fr/UserReviewEdit-g293924-d8861467-Amica_Travel-Hanoi.html" class="btn-items" target="_blank">Ecrire un avis</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 col-sm-4 col-lg-3 col-md-4 petit-cf d-flex justify-content-center align-items-center px-0">
        <div class="row row d-flex justify-content-center px-0">
            <div class="align-bottom pr-5 pl-0 d-flex align-items-end">
                <img alt="https://www.petitfute.com/v45031-hanoi/c1122-voyage-transports/c747-tours-operateurs/143513-amica-travel-siege-social.html" data-src="/assets/img/cf/petit-cf.png">
            </div>
            <div class="d-inline-block">
                <div class=""><img class="mb-5" alt="" data-src="/assets/img/cf/petit-number-stars.png"></div>
                <div class="">
                    <a href="https://www.petitfute.com/v45031-hanoi/c1122-voyage-transports/c747-tours-operateurs/143513-amica-travel.html" target="_blank" class="btn-items">Donner votre avis</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Phan bai viet Temoignage -->

<div class="contain container-2">
    <div id="temoignages" class="column">
        <h2 class="mt-60 mb-40 tt">
            <a href="<?= DIR ?>temoignages">Les avis de nos voyageurs</a>
        </h2>
        <!-- search form responsive -->
        <div class="search-form py-40 search-form-responsive search-testi-form quick-search d-block d-sm-block d-lg-none p-0 row no-gutters">
            <form class="row form-search d-flex justify-content-between  horizontal mx-0">
                <div class="cs-select destination search-destination  pl-0  mr-20">
                    <span class="cs-placeholder"><span class="icon-left"></span> <span class="input-text">Destination(s)</span><span class="icon-right"></span></span>
                        <div class="cs-options">
                                <ul>
                                    <? $selectDes = explode('-',Yii::$app->request->get('country')); ?>
                                    <? foreach(Yii::$app->params['tsDestinationList'] as $key => $value) : ?>
                                    <li class="<?=in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>">
                                        <span class="icon-check"></span>
                                        <span class="text-option"><?=$value ?></span>
                                    </li>
                                    <? endforeach; ?>
                                </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                            <? foreach(Yii::$app->params['tsDestinationList'] as $key => $value) : ?>
                                    <li class="<?=in_array($key, $selectDes) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><span class="icon-check"></span>
                                        <span class="text-option"><?=$value ?></span></li>
                                    <? endforeach; ?>
                            </ul>
                        </div>

                </div>
                <div class="cs-select une-envie  search-type filter-type mr-20">
                    <span class="cs-placeholder"><span class="icon-left"></span> <span class="input-text">Type de groupe</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                                <ul>
                                    <? $selectType = explode(',',Yii::$app->request->get('type')); ?>
                                    <? foreach(Yii::$app->params['tTourTypes'] as $key => $value) : ?>
                                    <li class="<?=in_array($key, $selectType) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><span class="icon-check"></span>
                                        <span class="text-option"><?=$value ?></span></li>
                                    <? endforeach; ?>
                                </ul>
                        </div>
                         <div class="list-option">
                <ul>
                <? foreach(Yii::$app->params['tTourTypes'] as $key => $value) : ?>
                        <li class="<?=in_array($key, $selectType) ? 'active' : '' ?>"  data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                        <? endforeach; ?>

                </ul>
            </div>

                </div>
                 <div class="cs-select type-de-voyage search-theme filter-type pr-0 mx-0 float-right">
                     <span class="cs-placeholder"><span class="icon-left"></span> <span class="input-text">Thématique du voyage</span> <span class="icon-right"></span></span>
                        <div class="cs-options">
                                <ul>
                                    <? $selectTheme = explode(',',Yii::$app->request->get('theme')); ?>
                                    <? foreach(Yii::$app->params['tTourThemes'] as $key => $value) : ?>
                                    <li class="<?=in_array($key, $selectTheme) ? 'active' : '' ?>" data-option="" data-value="<?=$key?>"><span class="icon-check"></span>
                                        <span class="text-option"><?=$value ?></span></li></li>
                                    <? endforeach; ?>
                                </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                            <? foreach(Yii::$app->params['tTourThemes'] as $key => $value) : ?>
                                    <li class="<?=in_array($key, $selectTheme) ? 'active' : '' ?>"  data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                                    <? endforeach; ?>
                            </ul>
                        </div>

                </div>

                <div class="cs-select submit quick-search-submit col-xs-12 col-sm-12 px-0 mt-40">
                     Afficher 737 résultats
    </div>
            </form>
       </div>  
        

    <!-- end search form responsive -->
        <div class="row-1 pt-0 row ">
            <div class="col-amc col-amc-2 col-3 no-gutters px-0 d-none d-sm-none d-lg-block">
                <div class="area-1 d-none d-sm-none d-lg-block contact-left fix-area mt-0 mb-25">
<p class="tt">Vous souhaitez nous laisser un témoignage ?</p>
<ul>
<li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;"></li>
<li>Notre conseiller(ère) vous répondra sous 48H</li>
</ul>
<span data-title="<?= base64_encode(DIR.'nous-contacter') ?>" class="pugjd btn-contact btn-amica-basic btn-amica-basic-2">Contactez-nous</span>
</div>
               <div class="search-form container-filter p-0 search-testi-form">
                    <?
                    include_once '_form_search_temoignage_cf.php';
                    ?>
               </div>
            </div>
            
            <div class="col-amc col-amc-2 col-md-12 col-lg-9 pr-0 pl-40 col-sm-12 col-xs-12">
                <div class="ajaxfilter">
                    <div id="temoignages-load" class="">
                    <? 
                        $cnt = 0;
                    foreach($testis as $kt => $vt)  : 
                        $cnt++;
                        ?>
                    <div class="item item-<?= $kt+1?> mb-20 mt-0 row ">
                        
                        <div style="width: auto;" class="col-auto pl-0 pr-20">
                            <a href="<?= DIR.$vt->cat->slug.'/'.$vt->slug?>">
                            <? if(!empty($vt->photosArray['summary'])) :
                                   $img =  $vt->photosArray['summary'][0];
                             ?>
                            <img class="img-lazy img-responsive" data-src= "/thumb/299/199/1/80<?=$img->image?>" alt="<?=$img->description?>">
                            <? else : ?>
                            <?php
                            $src = DIR.'assets/img/cf/defaut-img-testi.jpg';
                            
                            preg_match_all('/<img[^>]+>/i', $vt->description, $result);
                            foreach ($result as $img_tag) {
                                foreach ($img_tag as $vimg) {
                                    if(strpos($vimg, 'ngoac_kep') === false){
                                        preg_match('/(src)=("[^"]*")/i', $vimg, $src);
                                        break;
                                    }
                                }
                                    
                            }
                            ?>

                           <img class="img-lazy img-responsive" alt="" data-src='<?php if (is_array($src)) {
                                    echo 'https://www.amica-travel.com/'.'timthumb.php?src='.str_replace('"','',$src[2]).'&w=299&h=199&zc=1';
                            } else echo DIR.'timthumb.php?src='.$src.'&w=299&h=199&zc=1'; ?>'/>
                            <? endif; ?>
                            </a>
                        </div>
                        <div class="col-6 px-0">
                        <a href="<?= DIR.$vt->cat->slug.'/'.$vt->slug?>" class="row d-block"><h3 class="title-item mb-0 "><?= $vt->title?></h3></a>
                        <span class="nameClient my-txt-15"><?=isset($vt->data->nameclient) ? $vt->data->nameclient : '' ?></span>
                        <div class="text">
                            <? $line=$vt->model->summary; if (preg_match('/^.{1,150}\b/s', $vt->model->summary, $match))
                            {
                                $line=$match[0].'...';
                            } 
                            echo $line;
                            ?>
                            
                        </div>
                        <ul class="mb-0">
                            <li>
                                <? if(isset($vt->data->from) && isset($vt->data->to)) : ?>    
                                     <?= date('d/m/Y', strtotime($vt->data->from))?>
                                <? endif; ?> 
                            </li>
                            <li class="posi-country">
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
                    </div>
                     <?
                    if(count($testis) > $cnt){
                        echo '<span class="space space-20"></span>';
                    }
                    ?>   
                    <? endforeach; ?>
                    
                 </div>       
            </div>    
    
        </div>
        </div>
    </div>
    <div class="d-block d-lg-none contact-responsive my-60 container-fluid d-flex justify-content-center align-items-center py-20">
        <div class="text text-center mr-40 ">
            Vous souhaitez<br>
nous laisser un temoinage ?
        </div>
        <img alt="" class="img-lazy mx-10" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
        <span data-title="<?= base64_encode(DIR.'nous-contacter') ?>" class="pugjd ml-60 btn-amica-basic btn-amica-basic-3">Contactez-nous</span>
    </div>
    <div class="column parle mt-40 mb-60">
        <div class="text pull-right text-left">
            <h2 class="title mt-0 mb-txt-20">la presse parle de nous</h2>
            <p class="mt-0 mb-txt-20">Retrouvez ici les derniers articles de presse et de blog ainsi que des reportages sur Amica Travel afin de mieux découvrir notre équipe.</p>  
            <a href="/presse" id="" class="read-more pull-left btn-amica-basic-1 btn-amica-basic">En savoir plus</a>  
        </div>
    </div>
</div>
  
<? 
$url = DIR.URI;
$js = <<<JS
     $(document).on("click",".pagination-port .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        
        $('.getcontent-portrait').append('<div class="backgroundwhite"></div>');
        $('.getcontent-portrait').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        
        $.post(url, { type: 'port' }, function(data){ 
           
            var datanew = $($.parseHTML(data)).find(".getcontent-portrait");
            $('.ajaxpagination').html(datanew);
           // $('html, body').animate({scrollTop: $('#portrait-load').offset().top - 100}, 200);
        
            $('.img-lazy').lazy({
                        scrollDirection: 'vertical',
                        effect: 'fadeIn',
                        effectTime: 1000,
                        visibleOnly: true,
                        onError: function(element) {
                            console.log('error loading ' + element.data('src'));
                        }
                    });     
            return false;
        });
        return false;
     });
     $(document).on("click",".pagination-testi .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $.post(url, { type: 'testi' }, function(data){ 
            $('#temoignages-load').html(data);
             $('html, body').animate({scrollTop: $('#temoignages-load').offset().top - 100}, 200);
            return false;
        });
        return false;
     });
        
        
           $('.item-slide').bxSlider({
            slideWidth: 283,
            minSlides: 1,
            maxSlides: 3,
            moveSlides: 3,
            slideMargin: 20,
            responsive: true,
           // adaptiveHeight: true,
           randomStart: false,
           
           auto: false,
          
            speed: 1000,
       
        
        });
        
        
JS;

$this->registerJs($js);
$this->registerCss('#temoignages-load .item h5{margin-top: 0}');
?>
