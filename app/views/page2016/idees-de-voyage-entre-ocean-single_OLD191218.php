
<?php $this->registerCssFile('/assets/css/page2016/idees-de-voyage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="container-fluid sub-header-fixed text-center">
    <div class="amc-column container text-left row px-0">
        <div class="col-auto col-sm-auto max-width-25 d-none d-sm-none d-lg-flex justify-content-start align-items-center px-0">
            <p class="tt m-0"><?=$theEntry->title ?></p>
        </div>
        <div class="col group-icon col-sm d-inline-flex justify-content-center align-items-center text-center px-0">
                    <?php if(isset($theEntry->data->countries)){?>
                        <div class=" text-center ml-10 mr-20 posi countries flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navintro_section" data-analytics-label="link_country">
                            <img src="/assets/img/page2016/posi-big.png" alt="">
                            <div class="posi-link">
                             <?php
                                $i= 0;
                                if(is_array($theEntry->data->countries)){
                                    foreach ($theEntry->data->countries as $value) {
                                        $i ++;
                                         echo '<a href="'.DIR.$value.'">'.ucfirst($value).'</a>';
                                        if($i < count($theEntry->data->countries)){
                                            echo ', ';
                                        }
                                    }
                                }else{
                                   echo $theEntry->data->countries;
                                }
                            ?>
                            </div>
                        </div>
                    <?php }?>    
                    <div class="px-0 ml-10 tour-type-col  text-center tt-<?= $theEntry->cat->category_id?> flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navintro_section" data-analytics-label="link_inspi_itineraries">
                        <? if($theEntry->cat->photosArray['icon-banner']) : 
                            $iconCat = $theEntry->cat->photosArray['icon-banner'][0];    
                            ?>
                        <img src="<?=$iconCat->image?>" alt="">
                        <? endif ?>
                         <a id="tour-type" href="<?=DIR.str_replace('voyage', SEG1.'/'.SEG2, $theEntry->cat->slug)?>">
                                <?= $theEntry->cat->title?>
                            </a>
                    </div>
        </div>
                    <div class="col-6 col-sm-6 px-0 col-lg-5 text-center btn-devis flex-wrap d-inline-flex justify-content-end align-items-center list-unstyled">
                        <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-booking-top btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navintro_section" data-analytics-label="cta_devis">CONTACTEZ-NOUS POUR PLUS DE DÉTAILS</button>
                    </div>
    </div>
</div> 

<div class="contain container-1">
    <?php
      
        if(!empty($theEntry->photos)){
            
            foreach ($theEntry->photos as $v) {
               
                if($v->model->type == 'banner'){
            
     ?>
    <img alt="" style="width: 100%" class="banner img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
        <?php
                }
            }
        
         }else{
       ?>
    <img alt="" class="img-lazy" style="width: 100%;" src='<?=DIR?>upload/image/banner-idees-de-voyage-single.jpg'>
         <?php } ?>

    <div class="amc-column row-1 d-none d-sm-none d-lg-block">
        <? include('_inc_breadcrumb_specials.php') ?>

    </div>
</div>


<div class="contain container-2 non-area-form container row-content-1 px-0">
    
    <div class="amc-column">
        <div class="intro mt-txt-40 text-center px-20">
            <h1 class="title mt-0 mb-10"><?= str_replace('|', '<br>',$this->context->pageT)?></h1>
            <p class="tt-s mt-txt-5 mb-txt-25">
                <?= $theEntry->model->sub_title?>
            </p>
            
            <p class="spirit my-0 px-60">
                <?= $theEntry->model->spirit?>
            </p>
        </div>
        <div class="sub-intro my-txt-40 row no-gutters ">
                    
                    <?php if(isset($theEntry->data->countries)){?>
                        <div class="col col-sm text-center posi countries flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                            <img src="/assets/img/page2016/posi-big.png" alt="">
                            <p class="d-block w-100">Pays</p>
                            <a href="<?=DIR.SEG1 ?>">
                             <?php
                                $i= 0;
                                if(is_array($theEntry->data->countries)){
                                    foreach ($theEntry->data->countries as $value) {
                                        $i ++;
                                         echo '<a href="'.DIR.$value.'" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="subintro_section" data-analytics-label="link_country">'.ucfirst($value).'</a>';
                                        if($i < count($theEntry->data->countries)){
                                            echo ', ';
                                        }
                                    }
                                }else{
                                   echo $theEntry->data->countries;
                                }
                            ?>
                            </a>
                        </div>
                    <?php }?>    
                    <div class="col col-sm text-center tt-<?= $theEntry->cat->category_id?> flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                        <? if($theEntry->cat->photosArray['icon-banner']) : 
                            $iconCat = $theEntry->cat->photosArray['icon-banner'][0];    
                            ?>
                        <img src="<?=$iconCat->image?>" alt="">
                        <p class="d-block w-100">Type de voyage</p>
                        <? endif ?>
                         <a id="tour-type" href="<?=DIR.str_replace('voyage', SEG1.'/'.SEG2, $theEntry->cat->slug)?>" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="subintro_section" data-analytics-label="link_inspi_itineraries">
                                <?= $theEntry->cat->title?>
                            </a>
                    </div>
                    <div class="col-5 col-sm-5 px-0 col-sm-5 text-center btn-devis flex-wrap d-inline-flex justify-content-center align-items-center list-unstyled">
                        <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="btn-booking-top btn-amica-basic btn-amica-basic-2 mb-10 pugjd" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="subintro_section" data-analytics-label="cta_devis">CONTACTEZ-NOUS POUR PLUS DE DÉTAILS</button>
                        
                    </div>
        </div>
    </div>
</div>
 <? $galeriesBf =  array_reverse($theEntry->photos);
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
                <? $galeriesBf =  array_reverse($theEntry->photos);
                         $galeries = [];
                            foreach ($galeriesBf as $key => $value) {
                                if($value->model->type == 'galery'){
                                    $galeries[] = $value;
                                }
                            }
                           ?>
<div class="container-fluid container-2 px-0 ">
    <div class="amica-column container column-nav-tab-tour">
        <ul class="nav nav-tabs" id="content-tour-nav" role="tablist">
            <li class="active">
            <span class="nav-item nav-link active" id="program-tab" data-toggle="tab" role="tab" aria-controls="program" aria-selected="true" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_programm">Programme & carte</span>
            </li>
             <? if($theProgram) : ?>
            <li>
            <span class="nav-item nav-link" id="formules-tab" data-toggle="tab" role="tab" aria-controls="formules" aria-selected="true" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_secrets">Découvrez notre jonque préférée</span>
            </li>
            <? endif; ?>
            <li class="dropdown cm-cb-nav">
            <span class="nav-item dropdown-toggle " data-toggle="dropdown" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="navtour_section" data-analytics-label="tab_how">Quand, comment, combien</span>
            <div class="dropdown-menu">
              <a data-toggle="tab" role="tab" aria-controls="formules" aria-selected="true" class="dropdown-item" href="#climat" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_climat">Climat</a>
              <a data-toggle="tab" role="tab" aria-controls="formules" aria-selected="true" class="dropdown-item" href="#hebergement" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_hebergement">Hébergement</a>
              <a data-toggle="tab" role="tab" aria-controls="transport" aria-selected="true" class="dropdown-item" href="#transport" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_transport">Transport</a>
              <a data-toggle="tab" role="tab" aria-controls="visa" aria-selected="true" class="dropdown-item" href="#visa" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_visa">Visa</a>
              <a data-toggle="tab" role="tab" aria-controls="tarif" aria-selected="true" class="dropdown-item" href="#tarif" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_tarif">Tarif</a>
            </div>
            </li>
        </ul>
    </div>
    
    <div class="tab-content pb-40 mb-40 d-inline-block w-100" id="content-tour-tab">
          <div class="tab-pane fade show active" id="program" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="map float-right">
                    <img alt="" src="<?=isset($theEntry->photosArray['map']) ? $theEntry->photosArray['map'][0]->image : '' ?>"/>
              </div>
            <div class="amc-column container program">

                    <div id="tourContent" class="mt-40 text points entry-body">
                        <?= preg_replace('/<!--(.|\s)*?-->/', '', $theEntry->description); ?>
                    </div>
            </div>
             
          </div>
          <div class="tab-pane fade" id="formules" role="tabpanel" aria-labelledby="pills-home-tab row no-gutters">
            <div class="amc-column container row no-gutters pt-40">
              <? foreach ($theProgram as $key => $p):?>
                  <div class="col-12 col-sm-12 col-lg item-formules mb-40 row no-gutters">
                        <div class="img topopup" name="pop-<?=$key+1 ?>" class="col-auto col-sm-auto col-lg-12" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_<?= $p->model->item_id ?>">
                            <? if(isset($p->photosArray['banner'])) : ?>
                            <img alt="<?= $p->photosArray['banner'][0]->description ?>" src="<?='/thumb/299/200/1/80'.$p->photosArray['banner'][0]->image ?>">
                            <? endif; ?>
                        </div>
                        <div class="text pl-10 col col-sm col-lg-12 d-sm-flex flex-sm-column d-lg-block">
                        <p class="tt tt-1 my-txt-25 text-uppercase topopup " name="pop-<?=$key+1 ?>" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="secrets_section" data-analytics-label="secret_card_t_<?= $p->model->item_id ?>"><?=$p->title;?></p>
                        <ul class="p-0 mb-10 row mx-0 mt-sm-auto mt-lg-0">
                            <?php if(isset($p->model->data->countries)){?>
                                    <li class="posi  col-6 col-md-6">
                                        <p class="posi-title m-0 row">
                                            <img class="col-auto  p-0" src="/assets/img/page2016/posi.png" alt="">
                                            <span class="col-auto  p-0">
                                            <?php
                                            $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);

                                            $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');
                                            $ct = 0;
                                            foreach ($p->model->data->locations as $local) { $ct ++;
                                                echo $location[$local];
                                                if(count($p->model->data->locations) == 1) {
                                                    echo ', <br/>';
                                                } else {
                                                    echo ', ';
                                                }
                                            }
                                            ?>
                                            <?=isset($p->data->countries[0]) ? ucfirst($p->data->countries[0]) : ''?>
                                        </span>
                                        </p>
                                    </li>
                                <?php }?>
                                <li class="type-de-voyage col-6 col-md-6">
                                    <? $iconBanner = isset($theProgram[0]->cat->photosArray['icon-banner']) ? $theProgram[0]->cat->photosArray['icon-banner'][0] : ''?>
                                    <p class="type-de-voyage-title m-0 row">
                                        <img class="col-auto p-0" src="<?php echo $iconBanner->image; ?>" alt="">
                                        <span class="col-auto  p-0"><?= $iconBanner->description; ?></span>
                                    </p>
                                </li>
                        </ul>
                        </div>
                  </div>
              <? endforeach;?>
            </div>
          </div>
    </div>
</div>
         <div class="container-fluid mt-20 mb-60">
            <div class="row">
                <? include('_inc_galeries_tour.php') ?>
            </div>
        </div> 

<!--End Form Booking Tour-->

<div class="contain container-4 text-center">
    <div class="amc-column container text-left">
         <div class="d-block devis-btn-block mt-20  container-fluid d-flex justify-content-center align-items-center py-20">
            <div class="text text-center mr-40 ">
                Ce circuit vous intéresse ?
            </div>
            <img alt="" class="img-lazy mx-10" src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;">
            <button data-title="<?= base64_encode(DIR.URI.'/form') ?>" class="ml-60 btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">CONTACTEZ-NOUS POUR PLUS DE DÉTAILS</button>
        </div>
        <div class="" style="clear: both;"><? include '_inc_back_button.php'; ?></div>
    </div>
    
</div>
<div class="contain button-fix-devis img-lazy" data-src="<?=DIR?>assets/img/page2016/bg_row_link_devis_rdv.jpg">
    
    <div class="amc-column">
        <p class="text">Consultez un Expert Amica
pour obtenir un devis gratuit</p>
        <span class="button-to-devis-form"><img alt="Personnaliser ce voyage" src="<?=DIR?>assets/img/button/button-to-devis-fix.jpg"></span>
    </div>
    
</div>


<!-- POPUP-->
    


    

    <div id="toPopup">
        <div class="close"></div>
        <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>

        <div id="popup_content"> <!--your content start-->
            
        </div> <!--your content end-->
        
    </div> <!--toPopup end-->
    <div id="pop-email-pdf" class="popup pop-email-pdf" data-pop="pop-email-pdf">
                <div class="header-email-pdf w-100 d-inline-block">
                    <p class="small-tt mb-5">Programme complet à télécharger</p>
                    <p class="tt w-100"><?=$theEntry->title; ?></p>
                </div>
                <div class="body-email-pdf">
                    <p>Pour recevoir maintenant ce programme au format PDF, veuillez saisir votre email adresse : </p>
                    <form>
                        <div class="form-group float-left mb-5">
                            <input type="email" class=" mb-5 rounded email form-control required" aria-describedby="emailHelp" placeholder="Votre email" required/>
                             <small id="emailHelp" class="form-text text-muted"><img src="/assets/img/tour/icon-warning.png" class="mr-10" alt="">Cette adresse email semble ne pas exister</small>
                        </div>
                        <button type="submit" class="submit btn-amica-basic btn-amica-basic-2 float-right">TÉLÉCHARGER</button>
                        <div class="form-check d-inline-flex w-100 p-0 mt-10">
                            <input type="checkbox" class="form-check-input float-left d-none" id="exampleCheck1">
                            <span class="float-left"></span>
                            <label class="form-check-label float-left" for="exampleCheck1">Souhaitez-vous recevoir des informations (reportages, promotions, conseils de voyages...)
de la part de Amica Travel (1 fois par semaine) ?</label>
                          </div>
                    </form>
                </div>
            </div> 
    <div class="loader"></div>
    <div id="backgroundPopup"></div>



<!--END POPUP-->

<?php
      $img = NULL;                     // var_dump($theEntry->photos);exit;
foreach ($theEntry->photos as $v) {
   if($v->model->type == 'summary'){
       $img = $v->image;
   }
}

$this->registerCssFile('/assets/js/fancybox/jquery.fancybox.css');


$this->registerJsFile('/assets/js/fancybox/jquery.fancybox.pack.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);


$pdfFile = isset($theEntry->data->pdf) && $theEntry->data->pdf ? \yii\easyii\modules\file\api\File::get($theEntry->data->pdf)->model->file : '';
$seg1 = SEG1;
$dir_uri = DIR.URI;
$dir = DIR;
$uri = URI;
$id = $theEntry->model->item_id;
$title = $theEntry->model->title;
$catSlug = explode('/',$theEntry->cat->slug);
$temName = end($catSlug).'-'.SEG1;
$fileName = SEG1.'-'.SEG3;
$image = $img;
$sub_title = $theEntry->model->sub_title;
$description = str_replace(array("\r", "\n"), '', $theEntry->description);
$get = Yii::$app->request->get('tab');
$js=<<<JS
$('.row-content-1').css('margin-top', '-'+($('.intro').height()+40)+'px');

var map = $('#program .map');
var mapTop = map.offset().top;
var proTop = $('#program').offset().top + $('#program').height();
var devisTop = $('.sub-intro .btn-devis').offset().top + $('.sub-intro').height();
$(window).scroll(function(){
    
    var scroll = $(window).scrollTop();
    console.log(scroll+'/'.devisTop);
    if(scroll > devisTop) $('.sub-header-fixed').addClass('show'); else $('.sub-header-fixed').removeClass('show');
});

$('#content-tour-nav span.nav-link').on('click', function (e) {
  e.preventDefault()
  var idTab = '#'+$(this).attr('aria-controls');

  
  $('#content-tour-tab .tab-pane').removeClass('show active');
  $(idTab).addClass('show active');
})


$('.btn-retour').click(function(){
    $('.area-form').hide();
    $('.entry-addthis').show();
    $('.non-area-form').show();
    $('.end-page').show();
  //  $('#devis-form').scrollTop(0); 
         $('html, body').animate({
            
            scrollTop: $('html').offset().top
            
        }, 200);
        
});    
        
jQuery(document).ready(function () {
     $('a.fancybox').fancybox({
           titlePosition: 'over', 
            centerOnScroll: true,
            padding: 2,
     });
     
     $('.fancybox-thumbs').click(function(){
        var slider = jQuery("#wowslider-container1").get(0);
        slider.wsStart($(this).data('thumb'), false, 0);
        $('.fancybox-thumbs').fancybox({
        centerOnScroll: true,
        padding: 1,
        width: 1024,
        height: 680, 
        scrolling: 'no',
        titleShow: false
     });

     });
    
});     

	   
// Jquery config Content
        
    // for (var i = 1; i < 30; i++) {
       // alert(i);
//        $('div.program h3:contains(jour ' + i + ' -)').html(function(_, html) {
//            return html.split('jour '+ i + ' -').join('<span class="fix-jour">jour '+ i +'.</span><span class="tt">');
//         });
//        }
        // $('div.program h3:contains(Jour ' + i + ' -)').html(function(_, html) {
        //     return html.split('Jour '+ i + ' -').join('<span class="fix-jour">Jour '+ i +'.</span><span class="tt">');
        //  });
        // }
        
        $('div.program .entry-content li:contains(L\'Hotel)').addClass('hotel');
        $('div.program .entry-content li:contains(Kayaking)').addClass('kayaking');
        $('div.program .entry-content li:contains(En avion)').addClass('en-avion');
        
    
        
        
        $(".tab-children > .tt-info").click(function() {
        
        $(this).parent().parent().find(".tab-children").not($(this).parent()).removeClass("active");
        $(this).parent().toggleClass("active");

       
    })    
        
    $('.popup-infos .nav-tabs li a').click(function(){
        var data = $(this).parent().attr('data');
        $('.popup-infos .btn-tabs img').removeClass('active');
        $('.popup-infos .btn-tabs img.' + data).addClass('active');
    });    
        
// End jquery config content        
 

// Jquery bxslider right
    
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
            auto: false,
           // mode: 'fade',
            speed: 1000,
           onSlideBefore: function(slideElement, oldIndex, newIndex){
            var lazy = slideElement.find('.lazy');
            var load = lazy.attr('data-src');
            lazy.attr('src', load).removeClass('lazy');
        }
        
        });
    });
// End Jquery bxslider right  
$(function(){
    $('.button-to-devis-form').click(function(){
        $('.btn-contact').trigger('click');
    });
       
});
function onElementHeightChange(elm, callback){
    var lastHeight = elm.height(), newHeight;
    (function run(){
        newHeight = elm.height();
        if( lastHeight != newHeight )
            callback();
        lastHeight = newHeight;

        if( elm.onElementHeightChangeTimer )
            clearTimeout(elm.onElementHeightChangeTimer);

        elm.onElementHeightChangeTimer = setTimeout(run, 200);
    })();
}


onElementHeightChange($(document), displayFixedDevis);
function displayFixedDevis(){
    var iScrollPos = 0;
    
    var buttonRight = $('.area-1 .btn-contact').position();
    var lastScrollTop = 0;
    
    $(window).scroll(function(event){
        var posBtnBottom = $('.btn-deman').position();
       var st = $(this).scrollTop();
       if(!$('#devis-form').is(":visible")){
            if($(this).scrollTop() > (buttonRight.top + 70) && $(this).scrollTop() < (posBtnBottom.top - $(this).height())){
                if (st < lastScrollTop){
                                $('.button-fix-devis').addClass('active');
                        } else{
                          $('.button-fix-devis').removeClass('active');
                        } 
           } else {
              $('.button-fix-devis').removeClass('active');
           }
           lastScrollTop = st;
       } else{
            $('.button-fix-devis').removeClass('active');
       }
    });
}
        

 $('.btn-tout').click(function(){
        var hClass = $(this).hasClass('active');
        if(hClass){
            $(this).removeClass('active');
            
            $(this).text('Tout Afficher');
            $('#tourContent .tab-children').removeClass('active');
        }else{
            $(this).addClass('active');
            
            $(this).text('Tout Réduire');
            $('#tourContent .tab-children').addClass('active');
        }
   });     
$('.cm-cb-nav').one('click', function(){
    $.post('', {type: "combien"},  function(data){
        $('#content-tour-tab').append(data);
    })
}); 	
JS;
$this->registerJs($js);
$illus1 = isset($illus[1]->image) ? $illus[1]->image : '';
$illus2 = isset($illus[0]->image) ? $illus[0]->image : '';
$css = <<<CSS
.row-content-1{
    background: url('$illus1') 15px 15px no-repeat #fff;
}
#program .map{top: 0; right: 100px;}
.sub-header-fixed .max-width-25{max-width: 33%;}
.sub-header-fixed .tour-type-col{max-width: 70%;}
#content-tour-tab .tab-pane:not(#program) {
    background: url($illus2) left center no-repeat #f7f7f7;
}
#content-tour-nav{
        justify-content: flex-start;
}
@media (min-width: 1601px) {
    #program {
        position: relative;
        min-height: 430px;
    }
}
CSS;
$this->registerCss($css);
?>