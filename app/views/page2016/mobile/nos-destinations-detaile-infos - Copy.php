
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile(DIR . 'assets/js/chosen/mobile/chosen.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]);
?>

<div class="contain container-1">
    <?php
      
        if(!empty($theEntry->model->photos)){
            
            foreach ($theEntry->model->photos as $v) {
               
                if($v->type == 'banner'){
            
     ?>
    <img style="width: 100%" class="banner img-lazy img-full" alt='<?= $v->description?>' data-src='<?= DIR.'timthumb.php?src='.$v->image.'&w=640&h=275&zc=1'?>'>
        <?php
                }
            }
        
         }
       ?>
</div>
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="rows row-title">
            <h1 class="title"><?= str_replace('|', '<br>',$theEntry->title)?></h1>
            <a class="glyphicon glyphicon-search btn filters" href="<?=DIR.URI ?>#search-page" data-transition="slidefade">Filtrer</a>
        </div>

         <div class="menu-slider swiper-container">
            <div class="swiper-wrapper">
            <div class="swiper-slide <?= !SEG2 ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>">Voyage au <?=ucfirst(SEG1)?></a></div>
            <div class="swiper-slide <?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/itineraire">Idées de voyage</a></div>
            <div class="swiper-slide <?= SEG2 == 'formules' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/formules">Formules d'Amica</a></div>
            <div  class="swiper-slide <?= SEG2 == 'visiter' ? 'active' : '' ?>"><a href="<?=DIR.SEG1.'/visiter' ?>">Sites à visiter</a></div>
            <div class="swiper-slide <?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/informations-pratiques">Infos pratiques</a></div>
            <div class="swiper-slide <?= SEG2 == 'guide' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/guide">Guide culturel</a></div>
            </div>
            <div class="swiper-scrollbar"></div>
        </div>
    </div>
    <div class="column country-infos">
        <?=$theEntry->model->content; ?>
    </div>
    <div class="column">
        <a href="#options-panel" data-transition="slide" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-rel="popup"><?=SEG2 == 'informations-pratiques' ? 'Toutes les infos pratiques' : 'Tout le guide culturel' ?></a>
    </div>
</div>
<div data-role="popup" class="ui-content ui-popup ui-body-a ui-overlay-shadow ui-corner-all" data-theme="a" data-animate="true"  id="options-panel" >
                <ul class="body-options-panel">
                    <? foreach ($children as $key => $value) : ?>
                            <li class="<?=$key == count($children) -1 ? 'last' : ''?> <?=$value->items ? 'parent' : ''?> <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                <a data-ajax='false' href="<?=DIR.$value->slug?>"><?=$value->title?></a><span class="arrow-down-up <?=$value->slug == URI ? 'active' : ''?>">arrow</span>
                            <? if($value->items) : ?>
                                <ul class="items <?=$value->slug == SEG1.'/'.SEG2.'/'.SEG3 ? 'active' : ''?>">
                                    <? foreach ($value->items as $ki => $vi) : ?>
                                        <li class="<?=$vi->slug == URI ? 'active' : ''?>"><a data-ajax='false' href="<?=DIR.$vi->slug?>"><?=$vi->title?></a></li>
                                    <? endforeach; ?>
                                </ul>
                            <? endif; ?>
                            </li>
                        <? endforeach; ?>
                </ul>
            </div><!-- /panel -->
<? 
$country = SEG1;
$uri = URI;
$js = <<< JS

$('#search-page .ui-content ul li').on('click',function(){
        $(this).toggleClass('selected');
         var target = $(this);
         var index = $(this).index();
         var des = pr = url = '';
         if(!des) des = 'vietnam';
         var type = '';
         $('#search-page .ui-content ul.voyage li.selected').each(function(index){
             type += $(this).data('value');
             if(index != $('#search-page .ui-content ul.voyage li.selected').length -1){
               type += '-';
             }
         });
         if(!type) type= 'all';
         var length = '';
         var i = 0;
           $('#search-page .ui-content ul.tour-length li.selected').each(function(index){
               length += $(this).data('value');
               if(index != $('#search-page .ui-content ul.tour-length li.selected').length -1)
               {
                   length += '-';
               }
               i++;
           })
           if(!length || i ==3) length= 'all';
               pr = {'country': des, 'type': type, 'length': length};
               var url2 = $.param( pr );
                 url = '/amica-fr/get-number-prog';
                 url = url + '?'+url2;
                 searchCountryHome($(this), url);
});
$('#search-page .cs-select.submit').off().on('click',function(){
    $(this).toggleClass('selected');
         var target = $(this);
         var index = $(this).index();
         var des = pr = url = '';
         if(!des) des = 'vietnam';
         var type = '';
         $('#search-page .ui-content ul.voyage li.selected').each(function(index){
             type += $(this).data('value');
             if(index != $('#search-page .ui-content ul.voyage li.selected').length -1){
               type += '-';
             }
         });
         if(!type) type= 'all';
         var length = '';
         var i = 0;
           $('#search-page .ui-content ul.tour-length li.selected').each(function(index){
               length += $(this).data('value');
               if(index != $('#search-page .ui-content ul.tour-length li.selected').length -1)
               {
                   length += '-';
               }
               i++;
           })
           if(!length || i ==3) length= 'all';
               pr = {'country': des, 'type': type, 'length': length};
               var url2 = $.param( pr );
                 url = '$uri';
                 url = url + '?'+url2;
                 window.location = url;
});
function searchCountryHome(target, url){
       var parent = target.closest('#search-page');
       $.get(url, function(data){
           var ext = data > 1 ? 's' : ''; 
           if(data==0){
             parent.find('.submit').addClass('disable');
           } else{
             parent.find('.submit').removeClass('disable');
             if(data < 10 && data > 0) data = '0' + data;
           }
           parent.find('.submit').text(data+ ' voyage'+ext);
       })
}

var menuSwiper = new Swiper('.menu-slider', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 30,
        grabCursor: true,
        initialSlide: 4
    }); 
var tourSwiper = new Swiper('.tour-slider', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 2,
        slidesPerColumn: 2,
        paginationClickable: true,
        spaceBetween: 30,
        breakpoints: {
            // when window width is <= 320px
            567: {
              slidesPerView: 1
            },
           
          }
    });
var secretSwiper = new Swiper('.secrets-slider', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 3,
        slidesPerColumn: 3,
        paginationClickable: true,
        spaceBetween: 30,
        breakpoints: {
            // when window width is <= 320px
            567: {
              slidesPerView: 1
            },
           
          }
    });
$('.chosen').chosen({touch:true});
 $('.chosen-choices input').keyup(function(){
        if(!$(this).val()){
            $('.chosen-drop .chosen-results').hide();
            return false;
        }
        $('.chosen-drop .chosen-results').show();
    });
JS;
$this->registerJs($js); 
$css = <<< CSS
.country-infos .tt, .tt-big, .tt{
    text-transform: uppercase;
}
.all-aticle{
    margin: 0;
    padding: 0;
}
.all-aticle li{
    list-style: none;
    padding: 1rem 0;
}
.all-aticle li .icon.vietnam {
    background-color: #e6a85e;
}
.all-aticle li .icon.laos {
    background-color: #e65925;
}
.all-aticle li .icon.cambodge {
    background-color: #ca8b09;
}
.all-aticle li .icon.birmanie {
    background-color: #d64c48;
}
.all-aticle li .icon{
    margin-right: 2vw;
}
#options-panel-popup{
    background-color: #c2c2c2;
    border-radius: 1rem;
}
#options-panel-popup ul{
    margin: 0;
    padding: 1rem;
}
#options-panel-popup ul li{
    list-style: none; 
    text-transform: uppercase;
     color: #242424;
     padding: 1rem 0;
}
.ui-btn{
        background: #f6f6f6;
    border: 1px solid #ddd;
    text-shadow: 0 1px 0 #f3f3f3;
        border-radius: .3125em;
}
CSS;
$this->registerCss($css);
?>