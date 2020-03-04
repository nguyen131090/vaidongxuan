
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]);
?>
<?php $this->registerCssFile('/assets/css/mobile/nos-desinations-visiter.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain no-padding">
    <div class="column">
        <? include('_inc_menu_all_page_destinations.php'); ?>
    </div>
</div>
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content banner">
           <? 
            if(!empty($theEntry->photosArray['banner'])) {
            $banner = $theEntry->photosArray['banner'][0]; 
            ?>
             <img
                 alt=""
    data-src="<?= $banner->image?>" 
    data-srcset="/thumb/600/400/1/80<?= $banner->image?> 450w, /thumb/900/0/1/80<?= $banner->image?>"
    data-sizes="auto"
    class="image-banner img-responsive lazyload" />
                <? } ?>
            <div class="text-on-banner">
                <h1><?=$theEntry->model->seo->h1 ?></h1>
                <span class="space space-40"></span>
                <div class="quick-search">
                    <? $allRoot =  \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter')->items(['pagination' => ['pageSize' => 0]]);
                    $optDes = \yii\helpers\ArrayHelper::map($allRoot, 'slug', 'title');
                    $data = \yii\helpers\ArrayHelper::getColumn($allRoot, function($element){
    return ['id' => $element->id, 'text' => $element->title];
});
                    ?>


                    <?= \yii\helpers\Html::dropDownList('search_destination', null, [],[
                        'class' => 'select2 visiter-search',
                        'multiple' => 'multiple',
                        'data-role' => 'none',
                        'id'    => 'search-destination'
                    ]) ?>
                                    </div>
            </div>            
        </div>
        
        <div class="row-content region">
            <h2 class="title-row">Une destination par région</h2>
            <div class="region-content">
                <? $region = \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter'); ?>
                        <? if(isset($region)) : ?>
                            <? $optRegion =  $region->fieldOptions('region'); ?>
                            <? foreach ($optRegion as $key => $value) : ?>
                                    <div class="region-item" data-name="<?=$key?>">
                                        <h3 class="no-margin tx-1 tt-fontsize-32 tt-latolatin-regular <?=SEG1 ?>"><?=$value?><?=SEG1=='birmanie' ? ' de la ' : ' du ' ?><?=ucfirst(SEG1)?></h3>
                                        <ul class="no-padding">
                                            <? $regionLocation = $locations->items(['filters' => ['region' => $key], 'pagination' => ['pageSize' => 0]]);
                                            foreach ($regionLocation as $kl => $vl) {
                                                echo '<li class="no-liststyle tt-fontsize-32 tt-latolatin-regular"><a href="'.DIR.$vl->slug.'">'.$vl->title.'</a></li>';
                                            } ?>
                                        </ul>
                                    </div>
                                <? endforeach; ?>
                    <? endif; ?>
            </div>

        </div>
    
    </div>

    <div class="row-content envies">
        <h2 class="title-row">Une destination par envie</h2>
        <div class="envies-slider">
            <div class="swiper-wrapper">
            <? $envies = \app\modules\destinations\api\Catalog::cat(SEG1.'/envies');
           ?>
                    <? foreach ($envies->items() as $key =>  $value) {
                        
                            $v = '';
                            if(isset($value->photosArray['banner'])){
                                $v = $value->photosArray['banner'][0];
                            }
                    ?>
                       <div class="swiper-slide item-slide item-slide-<?= $key ?>">
                            <a href="<?=DIR.$value->slug?>">
                                <? if($v) : ?>
                                <img alt="<?= $v->description?>"
                                        data-src="<?=$v->image?>" 
                                        data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, /thumb/900/0/1/80<?=$v->image?>"
                                        data-sizes="auto"
                                        class="banner-img lazyload" />
                                <? endif; ?>
                                <p class="tt-fontsize-32 tt-latolatin-bold tt-color-black tt-custom"><?= $value->title ?></p>
                            </a>
                        </div>
                    <?
                    } ?>

                </div>
        </div>
    </div>
    <div class="row-content tours-visiter">
        <h2 class="title-row">Tous les sites à visiter <?=SEG1=='birmanie' ? 'en' : 'au' ?> <?= ucfirst(SEG1) ?></h2>
        <? $html = '<div class="clear-fix tour-item"><a href="{{slug}}"><img alt="{{description-img}}" data-src="/thumb/660/440/1/80{{image}}" data-srcset="/thumb/660/440/1/80{{image}}" data-sizes="auto" class="banner-img lazyload" /><div class="text-on-image"><h3 class="tt-title tt-fontsize-32 tt-latolatin-bold tt-color-white">{{title}}</h3><p class="tt-fontsize-28 no-margin tt-latolatin-regular tt-color-white">{{sub-title}}</p></div></a></div>' ?>
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
            
        ?>
        <div class="ajaxfilter">    
        <div class="getcontent">
               <? if((Yii::$app->request->get('page') != NULL && Yii::$app->request->get('page') > 1)  || Yii::$app->request->get('before-page') > 1){ ?>
                <div class="text-center see-more-prev mb-80 mt-0">
                    <span class="btn-see-more-prev tt-title tt-latolatin-bold tt-fontsize-32 tt-color-white tt-custom ajax-see-more-prev" data-get="" data-seemore="<?= (($page + 1) * 4) ?>" data-value='' data-page="<?= $page - 1 ?>">Lieux précédents</span>
                </div>
                <? } ?> 
                <? 
                $count = count($visiter);
                foreach ($visiter as $key => $value) {
                        $v = '';
                        if(isset($value->photosArray['summary'])){
                            $v = $value->photosArray['summary'][0];
                        } 
                        $sumT =  $value->model->sub_title ? $value->model->sub_title : $value->title;
                       // echo str_replace(['{{slug}}', '{{description-img}}', '{{image}}', '{{sub-title}}', '{{title}}'], [DIR.$value->slug, $v->description, $v->image, $sumT, $value->model->title], $html);  
                ?>
                 <div class="clear-fix tour-item item">
                     <a href="<?= DIR.$value->slug ?>">
                         <img alt="<?= isset($v->description) ? $v->description : '' ?>" data-src="<?= isset($v->image) ? $v->image : '' ?>" data-srcset="<?= isset($v->image) ? $v->image : ''?>" data-sizes="auto" class="banner-img lazyload" />
                         <div class="text-on-image">
                             <h3 class="tt-title tt-fontsize-40 tt-latolatin-bold tt-color-white"><?= $value->model->title ?></h3>
                             <p class="tt-fontsize-28 no-margin tt-latolatin-regular tt-color-white"><?= $sumT ?></p>
                         </div>
                     </a>
                 </div>       
                <?  } ?>
        
        
        <? if ($totalCount > $pagesize && ($totalCount / 4) > $page ){ ?>
        <div class="amc-area-detaile-number-items">
            <span class="space space-30"></span>        
            <? if($totalCount < 2){ ?>
                <span class="amc-text">Vous avez vu le seul lieu <span class="amc-nb-seen" data-value="<?= $count ?>"></span><span class="amc-nb-total" data-value="<?= $totalCount ?>"></span></span>
            <? }else{ ?>
                <span class="amc-text">Vous avez vu <span class="amc-nb-seen" data-value="<?= $count ?>"><?= $count ?></span> lieux sur <span class="amc-nb-total" data-value="<?= $totalCount ?>"><?= $totalCount ?></span></span>
            <? } ?>
            <span class="space space-40"></span>
            <div class="amc-progress mt-txt-25">
                <div class="" style="width: <?= ($count/$totalCount)*100 ?>%;"></div>
            </div>
            
        </div>
        
        <span class="space space-50"></span>    
        <div class="see-more">
            <span class="btn-see-more tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more mb-0" data-get="" data-seemore="<?= ($page + 1)*4 ?>" data-value="" data-page="<?= $page + 1 ?>">Plus de lieux</span>
                                    
        </div>
            
        <? } ?>
        </div>   
        </div>    
    </div>
</div>
<!-- Start of second page -->

<? 
$country = SEG1;
$uri = URI;
$data = \yii\helpers\ArrayHelper::getColumn($allRoot, function($element){
    return ['id' =>  $element->slug, 'text' => $element->title];
});
$data = json_encode($data);
$js = <<< JS
// xu ly Ajax nut see-more
        $(document).on("click", ".ajax-see-more-visiter", function(event){    
            var target = $(this);
            var html = '{$html}';
            var page = $(this).data('page');
            var pr = $(this).data('get')+'?page='+$(this).data('page');
            
            var pagesize = $(this).data('value');
            var url = window.location.pathname + '?' + pr;
            history.pushState('', '', window.location.pathname + '?page=' + page);
               $.ajax({
                    type: "GET",
                    url: pr,
                    datatype: 'json',
                    beforeSend: function() {
                        $('.getcontent').append('<div class="backgroundwhite"></div>');
                        $('.getcontent').css({'position':'relative'});
                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
                    },
                    success: function(data){
                        data = JSON.parse(data);
                        $('.getcontent').append(data.content);
                        $('.getcontent .tour-item').slice(-4).hide();
                        $('.getcontent img').on('load', function(){
                            $('.getcontent .tour-item').slice(-4).fadeIn();
                        });
                        if(!data.showMore){
                            $('.ajax-see-more-visiter').hide();
                        }
                        page++;
                        target.data('page', page);
                        $('.backgroundwhite').remove();
                    }
               }); 
            return false;      
        });
        
    // end ajax see-more

$('.region .region-item .tx-1').click(function(){
   
    $(this).parent().siblings().removeClass('active');
    $(this).parent().toggleClass('active');
     $.mobile.silentScroll($(this).parent().position().top - 60);
})
var enviesSwiper = new Swiper('.envies-slider', {
        slidesPerView: 2.1,
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

$('.select2').select2({
    placeholder: 'Taper le nom d’un site...',
    dropdownCssClass : "visiter-search",
    data: JSON.parse(JSON.stringify($data)),
    language: {
        noResults: function (params) {
          return "Pas de résultat";
        }
      },
    width: '100vw'
});

$("#search-destination").on('change', function(){
    window.location.href = '/'+this.value;
    return false;
});
$('.quick-search .select2-search__field').on('keyup', function(){
    if($(this).val()){
        $('.visiter-search.select2-dropdown').show();
        if($('.quick-search .reset-input').length < 1)
            $(this).parent().prepend('<span class="reset-input">&#215;</span>');
    } else{
        $('.quick-search .reset-input').remove();
    }
})



$(window).on('scroll', function () {
        if($(window).scrollTop() > 30){
            $('.menu-slider').addClass('fixed-header');
        }
        else{
            $('.menu-slider').removeClass('fixed-header');
        }
    });
$('.quick-search').on('click', '.reset-input', function(){
    $('.quick-search .select2-search__field').val('');
    $(this).remove();
})
var menuSwiper = new Swiper('.menu-slider', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 30,
        grabCursor: true,
        initialSlide: 3
    }); 

JS;
$this->registerJs($js); 
?>