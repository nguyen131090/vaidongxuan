<?php $this->registerCssFile('/assets/css/page2016/nos-destinations-list.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php
$params = '';
if(SEG1 != 'birmanie') {
    $params = 'height-400';
}
?>
<!-- Page Envies -->

<div class="contain container-1">
    <?php
    if(!empty($theEntry->model->photos)){
        foreach ($theEntry->model->photos as $value) {
            if($value->type == 'banner'){
                echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
            }
        }
    } else{?>
        <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-idees-de-voyage-type.jpg'>
    <?php }?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>    
        
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb_ethnie.php') ?>
    </div>
    <div class="amc-column row-2 mb-txt-40">
        <p class="title mb-txt-25"><?= $titleBanner ?></p>
        
        <div class="filter">
            <div class="cs-select destination">
                <span class="cs-placeholder active"><?=$theEntry->title ?></span>
                <div class="cs-options <?= $params; ?>" style="">
                    <ul id="filter">
                        <? foreach(\app\modules\destinations\api\Catalog::cat(SEG1.'/envies')->items() as $kde => $vde) : ?>
                            <li data-option="" data-value="">
                                <a href="<?=DIR.$vde->slug?>"><?=$vde->title ?></a>
                            </li>
                        <? endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<input style="height: 0;" type="text" id="trigger-filter">
<div class="clear-fix"></div>

<div class="amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="amc-column column">
            <ul>
                <li  class="<?= !SEG2 ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_country"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/itineraire" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries">Idées de voyage</a></li>
                <? if(SEG1 !== 'birmanie'){?>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/formules" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets">Formules d'Amica</a></li>
                <? } ?>
                <li  class="<?= SEG2 == 'visiter' || Yii::$app->controller->action->id == 'nos-destinations-envies' ? 'active' : '' ?> <?= $this->context->entry->parents()[count($this->context->entry->parents()) - 1]->slug == SEG1.'/visiter' ? 'active' : '' ?>"><a href="<?=DIR.SEG1.'/visiter' ?>" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_cities">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/informations-pratiques" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_infos">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/guide" data-analytics="on" data-analytics-category="city_single" data-analytics-action="submenu_section" data-analytics-label="link_c_guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>

<div class="contain container-2 mt-0">
    <div class="amc-column mb-txt-60">
        <h1 class="title mt-txt-60 mb-txt-40"><?= $this->context->pageT; ?></h1>
        <div class="title-header">
            <?= $theEntry->model->description?>
        </div>
    </div>
</div>

<? $voyage = \app\modules\destinations\api\Catalog::get('presentation-generale-'.SEG1);
                            $pdf = isset($voyage->data->pdf) && $voyage->data->pdf ? \yii\easyii\modules\file\api\File::get($voyage->data->pdf)->model->file : [];
                            $pdfImage = isset($voyage->photos) && $voyage->photos ? $voyage->photos[0]->image : '';?>
<div class="contain container-2 mt-0">
    <div class="amc-column">
        <div class="rows row-4">
            <div class="amc-col col-left">
                <?
                if (Yii::$app->request->get('see-more') == NULL) {
                    if (Yii::$app->request->get('page') != NULL) {
                        $seemore = Yii::$app->request->get('page') * 4;
                    }else{
                        $seemore = 4;
                    }

                } else {
                    $seemore = Yii::$app->request->get('see-more');
                }
                if (Yii::$app->request->get('page') == NULL) {
                    $page = $pagesize / 4;
                } else {
                    $page = Yii::$app->request->get('page');
                }

                if (Yii::$app->request->get('before-page') == NULL) {
                    $page = $seemore / 4;
                } else {
                    $page = Yii::$app->request->get('before-page');
                }
                //  var_dump($page);exit;
                ?>    
                <div class="ajaxfilter">
                    <div id="destination-load" class="getcontent">
                        <? if((Yii::$app->request->get('page') != NULL && Yii::$app->request->get('page') > 1)  || Yii::$app->request->get('before-page') > 1){ ?>
                        <div class="text-center see-more-prev mb-40 mt-0">
                            <span class="btn-submit ajax-see-more-prev btn-amica-basic btn-amica-basic-1" data-get="" data-seemore="<?= (($page + 1) * 4) ?>" data-value='' data-page="<?= $page - 1 ?>">Lieux précédents</span>
                        </div>
                        <? } ?>
                        <?
                        $cnt = 0;
                        $count = count($envies);
                        foreach ($envies as $key => $value) : $cnt++;?>
                            <div class="clear-fix item item-1 item-<?= $cnt ?> <?= count($envies) == $cnt ? 'item-last' : '' ?>">
                                <div class="left">
                                    <a href="<?=DIR.$value->slug ?>">
                                        <?
                                        $hasSummary = false;
                                        if(isset($value->photos)) {
                                            foreach ($value->photos as $kp => $vp) {
                                                if($vp->type == 'summary'){
                                                    echo '<img style="width: 329px; height: 219px;" alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'"/>';
                                                    $hasSummary = true;
                                                    break;
                                                }
                                            }
                                        } ?>
                                        <? if(!$hasSummary) : ?>
                                            <img style="width: 329px; height: 219px;" alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg">
                                        <? endif; ?>
                                    </a>
                                </div>
                                <div class="right">
                                    <a href="<?=DIR.$value->slug ?>"><p class="tt"><?=$value->title?></p></a>
                                    <div class="text">
                                        <p>
                                            <?=$value->model->summary; ?>
                                        </p>
                                    </div>

                                    <span class="posi"><?
                                        if(isset($value->data->envies)){
                                            $visiterEnvies = $value->data->envies;
                                            foreach ($visiterEnvies as $kve => $vve) {
                                                $envisModel = \app\modules\destinations\api\Catalog::get($vve);
                                                if($envisModel){
                                                    echo $envisModel->model->title;
                                                    if($kve==count($visiterEnvies) - 1) break;
                                                    echo ", ";
                                                }
                                            }
                                        }
                                        ?></span>
                                </div>
                            </div>
                            <?
                            if(count($envies) > $cnt){
                                echo '<span class="space space-40"></span>';
                            }
                            ?>
                        <? endforeach; ?>
                        
                        
                         <?
//                                if (Yii::$app->request->get('see-more') == NULL) {
//                                    if (Yii::$app->request->get('page') != NULL) {
//                                        $seemore = Yii::$app->request->get('page') * 4;
//                                    }else{
//                                        $seemore = 4;
//                                    }
//
//                                } else {
//                                    $seemore = Yii::$app->request->get('see-more');
//                                }
                            if (Yii::$app->request->get('page') == NULL) {
                                $page = $pagesize / 12;
                            } else {
                                $page = Yii::$app->request->get('page');
                            }

                        ?>    
                        <?    
                        if($totalCount > $pagesize && ($totalCount / 12) > $page){
                        ?>
                        <div class="amc-area-detaile-number-items mt-txt-40">
                            <div>
                                <? if($totalCount < 2){ ?>
                                    <span class="amc-text">Vous avez vu le seul lieu <span class="amc-nb-seen" data-value="<?= $count ?>"></span><span class="amc-nb-total" data-value="<?= $totalCount ?>"></span></span>
                                <? }else{ ?>
                                    <span class="amc-text">Vous avez vu <span class="amc-nb-seen" data-value="<?= $count ?>"><?= $count ?></span> lieux sur <span class="amc-nb-total" data-value="<?= $totalCount ?>"><?= $totalCount ?></span></span>
                                <? } ?>
                                <div class="amc-area-prog-btn">
                                    <div>
                                        <div class="amc-progress mt-txt-25" <?= ($totalCount > $pagesize && ($totalCount / 12) > $page) ? '' : 'style="width: 175px;"' ?>>
                                            <div class="" style="width: <?= ($count/$totalCount)*100 ?>%;"></div>
                                        </div>
                                    
                                        <div class="see-more mt-25">
                                            <span class="btn-submit ajax-see-more btn-amica-basic btn-amica-basic-1" data-get="" data-seemore="<?= ($page + 1)*12 ?>" data-value='' data-page="<?= $page + 1 ?>">Plus de lieux</span>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? } ?>
                        
                    </div>
                </div>
                <? if($this->context->seoContent != NULL) : ?>
                <div id="text-content" class="iti p-0 entry-content">
                    <span class="tt tt-seo p-0">En savoir plus sur "<?= $this->context->pageT; ?>"</span>
                    <div><?=$this->context->seoContent;?></div>
                </div>
                <? endif; ?>
                 <!-- BACK BUTTON -->
                <div style="clear: both;height: 60px;"><? include '_inc_back_button.php'; ?></div>
                <!-- End BACK BUTTON -->   
            </div>
            <div class="amc-col col-right amc-col-2 m-0 ml-40 d-none d-sm-none d-lg-block">
                <div class="area-1 fix-area mb-25">
                    <p class="tt">Besoin de conseil d’un expert ?</p>
                    <ul>
                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;"></li>
                        <li>Notre conseiller(ère) vous répondra sous 48H</li>
                    </ul>
                    <span data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-contact btn-amica-basic btn-amica-basic-2">Demander un devis</span>
                </div>
                <?php if(!empty($arrBlog)): ?>
                    <div class="amc-area-sub-article d-inline-block">
                    <p>À lire aussi...</p>
                    <ul>
                        <?php
                            foreach ($arrBlog as $item) : ?>
                                <li><a href="<?= $item['link']?>" target="_blank" rel="noopener" >
                                <? if(isset($item['src'])) : ?>   
                                 <img class="lazy lazyload"  alt="<?= $item['alt_text']?>" data-src="<?= $item['src'] ?>"> 
                                <? endif; ?>
                                <span><?= $item['title']['rendered']?></span>
                            </a></li>
                            <? endforeach;?>
                        
                    </ul>
                </div>
                <?php endif;?>
            </div>
        </div>
        
    </div>
</div>
<div class="contain mb-60 pt-25 pb-25 mt-0 responsive-area-devis-col-left d-none d-lg-none d-sm-block">
    <div class="amc-column column">
        <div class="item item-1">
            <span class="tt tt-1">Besoin de conseil d’un expert ?</span>
            <span class="tt tt-2">Notre conseiller(ère) vous répondra sous 48H</span>
        </div>
        <div class="item item-2">
            <img alt="" class="img-lazy lazyload" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
        </div>
        <div class="item item-3">
            <span data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-amica-basic btn-amica-basic-2">Demander un devis</span>
        </div>
    </div>
</div>
<?php
$js=<<<JS
    $(document).on("click",".pagination-des .pagination li a",function(e){
         e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $('.pagination-des .pagination li').removeClass('active');
        $(this).parent().addClass('active');
        $.post(url, { type: 'des' }, function(data){ 
            $('#destination-load').html(data);
            $('html, body').animate({scrollTop: $('#destination-load').offset().top - 200}, 200);
            return false;
        });
        return false;
     });
    
    // TONY JS
    // CONFIG SLIDER
    $(document).ready(function(){
        $('.slider-right').bxSlider({
            slideWidth: 189,
            minSlides: 1,
            maxSlides: 1,
            slideMargin: 0,
            responsive: true,
            nextText: 'Next',
            prevText: 'Prev',
            randomStart: false,
            captions: true,
            // adaptiveHeight: false,
            auto: true,
           // mode: 'fade',
            speed: 1000,
           onSlideBefore: function(slideElement, oldIndex, newIndex){
            var lazy = slideElement.find('.lazy');
            var load = lazy.attr('data-src');
            lazy.attr('src', load).removeClass('lazy');
        }
        
        });
    });
    
    // Setup filter by keyboard
    $(".destination").on("click", function (e) {
        $('#trigger-filter').focus();
    });
    
    $("#trigger-filter").bind("keydown", function (e) {
        var prev, next, current = $("ul li.highlight");
    
        if (e.which === 40 && !current.length) {
            $("ul#filter li:first").addClass("highlight");
        } else if (e.which === 40) {
            next = current.next("li");
            if (next.length) {
                current.removeClass("highlight");
                next.addClass("highlight");
            }
    
        } else if (e.which === 38) {
            prev = current.prev("li");
            if (prev.length) {
                current.removeClass("highlight");
                prev.addClass("highlight");
            }
        } else if (e.which === 38) {
            $("ul li").removeClass("highlight");
        }
        
        if(event.which === 13){ //KEY ENTER
            window.location.href = current.children().attr('href');
            return false;
        } 
    });
    
    // Setup click out of filter
    $(document).mouseup(function(e) {
        var container = $(".cs-select.destination");
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            $('.cs-select.destination').removeClass('active');
            $(".cs-options").removeClass("cs-options-active");
        }
    });
        
        
        $('#download-guide-form .submit-email').click(function(){
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          return false;
        } 
        $.post(url, { email: $('#download-guide-form .email').val(), type: 'guide' }, function(data){ 
                if(data){
                $('#download-guide-form .submit-email').text('Merci'); 
                $('#download-guide-form .submit-email').css({'background-color' : '#6d6d6d','cursor' : 'not-allowed', 'opacity' : '0.8'}); 
                $('#download-guide-form .submit-email').addClass('submited'); 
                window.open($('#download-guide-form input').data('pdf'),'_blank');
                }else{ 
                    return false;
                }
            });
    }else{
        return false;
    }
});    
JS;
$this->registerJs($js,  yii\web\View::POS_END);
$this->registerCss('.view-all-link{ float: none; display: inline-block; vertical-align: top;}')
?>
