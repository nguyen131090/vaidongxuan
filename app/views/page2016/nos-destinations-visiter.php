
<?//php $this->registerCssFile(DIR . '//cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?//php $this->registerCssFile(DIR . '//cdn.maptiler.com/mapbox-gl-js/v0.53.0/mapbox-gl.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?//php $this->registerJsFile(DIR . '//cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?//php $this->registerJsFile(DIR . '//cdn.maptiler.com/mapbox-gl-js/v0.53.0/mapbox-gl.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?//php $this->registerJsFile(DIR . '//cdn.maptiler.com/mapbox-gl-leaflet/latest/leaflet-mapbox-gl.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>



<?php $this->registerCssFile(DIR . 'assets/js/mobile/swiper/swiper.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile(DIR . 'assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerCssFile(DIR . 'assets/css/page2016/nos-destinations-visiter.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]); ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/responsive.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>



<div class="contain container-1">
    <? if(isset($theEntry->model->photos)) : ?>
    <?
    $banner = '';
    foreach ($theEntry->model->photos as $key => $value) {
        if($value->type == 'banner') $banner = $value;
    } ?>
    <img style="width: 100%;" alt="<?=$banner->description; ?>" class="img-lazy" data-src='<?=$banner->image ?>'>
    <? endif; ?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>
     <div class="amc-column row-2 mb-txt-40">

        <h1 class="title m-0"><?=$theEntry->model->seo->h1 ?></h1>

    </div>


</div>
<div class="container-flud amc-menu-tab menu-tab responsive-menu-tab">
    <div class="scroll-menu-tab">
        <div class="amc-column column">
            <ul>
                <li  class="<?= !SEG2 ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_country"><?='Voyage '. (SEG1 == 'birmanie' ? 'en ' : 'au '). ucfirst(SEG1)?></a></li>
                <li class="<?= SEG2 == 'itineraire' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/itineraire" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_itineraries">Idées de voyage</a></li>
                <? if(SEG1 !== 'birmanie'){?>
                <li class="<?= SEG2 == 'formules' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/formules" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_secrets">Formules d'Amica</a></li>
                <? } ?>
                <li  class="<?= SEG2 == 'visiter' ? 'active' : '' ?>"><a href="<?=DIR.SEG1.'/visiter' ?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_cities">Sites à visiter</a></li>
                <li class="<?= SEG2 == 'informations-pratiques' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/informations-pratiques" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_infos">Infos pratiques</a></li>
                <li class="<?= SEG2 == 'guide' ? 'active' : '' ?>"><a href="<?=DIR.SEG1 ?>/guide" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="submenu_section" data-analytics-label="link_c_guide">Guide culturel</a></li>
            </ul>
        </div>
    </div>    
</div>

<div class="contain container-search-destination-map mt-txt-60 mb-txt-60">
   <div class="amc-column">
        <div class="area-text text-center">
            <?
            
            
            if(isset($theEntry->data->block1)){
                $txt = explode('</p>', $theEntry->data->block1);
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
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="intro_section" data-analytics-label="read_more">Lire la suite</span></p>'; ?>

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
       
        <div class="area-input">
            <div class="search-destination">
                <div class="area-query-destination">
                    <?
                        if(SEG1 == 'vietnam'){
                            $placehoder = 'Où souhaitez-vous visiter ? (Hanoi, Ho Chi Minh...etc)';
                        }else if(SEG1 == 'laos'){
                            $placehoder = 'Où souhaitez-vous visiter ? (Luang Prabang, Vientiane...etc)';
                        }else if(SEG1 == 'cambodge'){
                            $placehoder = 'Où souhaitez-vous visiter ? (Phnom Penh, Sieam Reap...etc)';
                        }else{
                            $placehoder = 'Où souhaitez-vous visiter ? (Yangon, Bagan...etc)';
                        }
                    ?>
                    <input id="input-destination" class="input-destination" data-url="<?= URI ?>" value="" placeholder="<?= $placehoder ?>" name="question" type="text" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="intro_section" data-analytics-label="search_city">
                    <div class="result-search">
                        <ul id="search-result">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       
    </div>   
    
    
    
    
    <div class="control-map">
<!--        <iframe id="get-map" class="img-lazy" width="" height="" frameborder="0" style="border:0" data-src="https://www.google.com/maps/embed/v1/place?q=<?= SEG1 ?>&amp;key=AIzaSyC_ywNEeFiqs9YVlH9WhpSBa7GfyAk1LI8" allowfullscreen="" ></iframe>
    -->
    <!-- include Map -->
    <? include_once '_inc_leaflet_mapbox.php'; ?>
    
    <!-- End Map -->
      
    </div>
</div>    

<div class="contain container-envis mb-txt-25">
    <div class="amc-column">
        <div class="area-text text-center">
            
            <?
                           
                $txt = explode('</p>', $theEntry->model->content);
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
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="intro_section" data-analytics-label="read_more">Lire la suite</span></p>'; ?>

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
            
        </div>    
        
        <div class="area-envis">
            
            <? $envies = \app\modules\destinations\api\Catalog::cat(SEG1.'/envies')?>
            <? if($envies) { ?>
            <?
            $cnt = 0;
            foreach ($envies->items(['pagination'=>['pageSize' => 0]]) as $key => $value) {
                $cnt++;
                if($cnt % 3 == 2){
                    $class = 'item-fix-margin';
                }else{
                    $class = null;
                }
                ?>
                <div class="item item-<?=$key+1?> <?= $class ?> mb-txt-40">
                <a href="<?=DIR.$value->slug ?>" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="envy_section" data-analytics-label="envy_card_<?= $value->model->item_id ?>">
                    
                     
                      <?
                        $hasSummary = false;
                        if(isset($value->photos)) {
                            foreach ($value->photos as $kp => $vp) {
                                if($vp->type == 'icon'){
                                ?>    
                                     <img alt="<?=$vp->description ?>" class="img-lazy" data-src="/thumb/45/45/1/100<?=$vp->image ?>">
                                <?
                                    $hasSummary = true;
                                    break;
                                }
                            }
                        } ?>
                     
                    <p>
                        <span class="tt-1 tt-latolatin-bold"> <?=$value->title ?></span>
                        <span class="tt-2"><?= $value->model->summary != null ? $value->model->summary : ''?></span>
                    </p>
                    
                </a>
            </div>
            <? } ?>
            <? } ?>
            
            
        </div>
        
    </div>       
</div>  

<?
if($getNordCenterSub){
    foreach ($getNordCenterSub as $value) {
       // $allRoot =  \app\modules\destinations\api\Catalog::cat($value->slug)->items(['pagination' => ['pageSize' => 0]]);
        //var_dump($allRoot);exit;
        //var_dump($value);exit;
        $explodeslug = explode('/', $value->slug);
?>
<div class="contain container-tour-country container-country-<?= $explodeslug[count($explodeslug) - 1]; ?> responsive-swiper-slider-3-item mb-txt-60">
    <div class="amc-column">
        <div class="area-text text-center">
            
            <?
                           
                $txt = explode('</p>', $value->content);
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
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="intro_section" data-analytics-label="read_more">Lire la suite</span></p>'; ?>

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
            
           
            
        </div>    
    </div>       
        <!-- Include file slide 3 item -->
        <!-- Slider main container -->
            <div class="area-slider-swiper area-slider-swiper-3-item">    
                <div class="swiper-container custom-slides-swiper-<?= $explodeslug[count($explodeslug) - 1]; ?> custom-slides-swiper-3-item">

                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <?
                            $list_tour =  \app\modules\destinations\api\Catalog::cat($value->slug)->items(['pagination' => ['pageSize' => 0]]);
                            //var_dump($list_tour);exit;
                        ?>
                        <?
                        $i = 0;
                        foreach ($list_tour as $item) {
                            $i++;
                        
                        ?>
                            <div class="swiper-slide">
                                <div class="item-img">
                                    <a href="<?= DIR.$item->slug ?>" >
                                        
                                        <?
                                        $hasSummary = false;
                                        if(isset($item->photos)) {
                                            foreach ($item->photos as $kp => $vp) {
                                                if($vp->type == 'custom'){

                                                    echo '<img style="" alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="/thumb/250/340/1/100'.$vp->image.'" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="list_section" data-analytics-label="city_card_'.$item->model->item_id.'"/>';
                                                    $hasSummary = true;
                                                    break;
                                                }
                                            }
                                        } ?>
                                        
<!--                                        <img width="" height="" alt="" data-src="https://demo.amica-travel.com/thumb/250/340/1/100/upload-images/destinations/au-plus-pres-des-peuples/immersion-vie-locale-ninh-binh-483b22bd53.jpg" class="img-lazy lazyload"/>-->
                                        <h3 class="text-on-img tt-fontsize-18 tt-latolatin-bold" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="list_section" data-analytics-label="city_card_t_<?= $item->model->item_id ?>"><?= $item->title ?></h3>
                                    </a>
                                </div>
                            </div>    
                        <? 
                        }
                        ?>
                          
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination swiper-pagination-<?= $explodeslug[count($explodeslug) - 1]; ?>"></div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev swiper-button-prev-<?= $explodeslug[count($explodeslug) - 1]; ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="formules_section" data-analytics-label="control_left"></div>
                <div class="swiper-button-next swiper-button-next-<?= $explodeslug[count($explodeslug) - 1]; ?>" data-analytics="on" data-analytics-category="country_page" data-analytics-action="formules_section" data-analytics-label="control_right"></div>   
            </div>
        <!-- End Include file slide 3 item -->

<?
$swiper = '.custom-slides-swiper-'. $explodeslug[count($explodeslug) - 1];
$next = '.swiper-button-next-'. $explodeslug[count($explodeslug) - 1];
$prev = '.swiper-button-prev-'. $explodeslug[count($explodeslug) - 1];
$pagination = '.swiper-pagination-'. $explodeslug[count($explodeslug) - 1];
$jsss=<<<JS
var swiper = new Swiper('$swiper', {
      slidesPerView: 5,
        slidesPerGroup: 5,
        spaceBetween: 15,
        loop: false,
       // centerInsufficientSlides: true,
        navigation: {
            nextEl: '$next',
            prevEl: '$prev',
          },
        pagination: {
            el: '$pagination',
            clickable: true,
            renderBullet: function (index, className) {
                if(index == 0){
                    var disablepagi = 'swiper-pagination-disable';
                    $('$pagination').addClass(disablepagi);
                }else{
                    var disablepagi = 'swiper-pagination-disable';
                    $('$pagination').removeClass(disablepagi);
                }
                return '<span class="' + className + '"></span>';
            }
        },
        breakpoints: {
           
            // when window width is <= 960px
            960: {
                slidesPerView: 3,
                spaceBetween: 15,
                slidesPerGroup: 3,
            },
            // when window width is <= 1400px
            1400: {
                slidesPerView: 4,
                spaceBetween: 15,
                slidesPerGroup: 4,
            }
        }
    });      
JS;
$this->registerJs($jsss, yii\web\View::POS_END);
?>         
</div>
<? 
    }
}
?>

<?
include '_inc_guide_book.php';
?>

<div class="contain container-button-contact">
    <div class="amc-column">
        <div class="d-block devis-btn-block mt-60 mb-60 container-fluid d-flex justify-content-around align-items-center py-20">
            <div class="text text-center">
                Un voyage <?= SEG1 == 'birmanie' ? 'en' : 'au' ?> <?= ucfirst(SEG1) ?> vous intéresserait ?
                <span class="tt-fontsize-20">Sur mesure, avec guide et chauffeur privé.</span>
            </div>
            <img alt="" class="img-lazy mx-10" data-src="/assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%; display: inline;" src="/assets/img/page2016/hot_gon_thao_100_100.jpg">
            <button data-title="L2Rldmlz" class="btn-amica-basic btn-amica-basic-2 pugjd" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="quote_section" data-analytics-label="cta_devis">Demander un devis</button>
        </div>
    </div>
</div>

<?

$js=<<<JS
//$(document).on('mouseover', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
//    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');
//    $(this).find('img').addClass('active');    
//    $(this).find('.text-slide').addClass('active');
//    $(this).find('.text-on-img').hide();
//});
//$(document).on('mouseleave', '.custom-slides-swiper-3-item .swiper-slide .item-img', function(){
//    $('.custom-slides-swiper-3-item .swiper-slide .item-img img').removeClass('active');  
//    $('.custom-slides-swiper-3-item .swiper-slide .item-img .text-slide').removeClass('active');  
//     $(this).find('.text-on-img').fadeIn(500);  
//});
        
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
  
$('.swiper-wrapper').each(function (key,value) {
        var target = $(this);
       var leng = target.children('.swiper-slide').length;
     
        if(window.innerWidth <= 960 && leng < 3){
            target.addClass('justify-content-center');
        }else if(window.innerWidth > 960 && window.innerWidth <= 1400 && leng < 4){
            target.addClass('justify-content-center');
        }else if(window.innerWidth > 1400 && leng < 5){
            target.addClass('justify-content-center');
        }else{
            target.removeClass('justify-content-center');
        }
    });
$(window).resize(function() {
  $('.swiper-wrapper').each(function (key,value) {
        var target = $(this);
       var leng = target.children('.swiper-slide').length;
     
        if(window.innerWidth <= 960 && leng < 3){
            target.addClass('justify-content-center');
        }else if(window.innerWidth > 960 && window.innerWidth <= 1400 && leng < 4){
            target.addClass('justify-content-center');
        }else if(window.innerWidth > 1400 && leng < 5){
            target.addClass('justify-content-center');
        }else{
            target.removeClass('justify-content-center');
        }
    });
}); 

   

var csrfToken = $('meta[name="csrf-token"]').attr("content"); 
	$('#input-destination').keyup(function(event) {
		var target = $(this);
		var specialKey = [37, 39];
		var code = event.keyCode || event.which;
		if($.inArray(code, specialKey) > -1 ){
			return false;
		}
                var keyarrowdown = target.parent().children('.result-search').children('#search-result');
                var liSelected = keyarrowdown.children('li.selected');
                if(event.which === 40){ //ARROW DOWN
                    
                    if(liSelected.length === 1 && liSelected.next().length === 1){
                        liSelected.removeClass('selected').next().addClass('selected');
                    }
                    if(liSelected.length === 0){
                        keyarrowdown.children('li:first-child').addClass('selected');
                    }
                    return false;
                }   
		
                if(event.which === 38){ //ARROW UP
                    
                    if(liSelected.length === 1 && liSelected.prev().length === 1){
                        liSelected.removeClass('selected').prev().addClass('selected');
                    }
                    if(liSelected.length === 0){
                        keyarrowdown.children('li:last-child').addClass('selected');
                    }
                    return false;
                }   
        
                if(event.which === 13){ //KEY ENTER
                    
//                    var position = liSelected.children().attr('data-code');
//                    var textname = liSelected.children().text();
//                    $('#input-destination').val(textname);
//                    $('iframe#get-map').attr('src', 'https://www.google.com/maps/embed/v1/place?q=' + position + '&key=AIzaSyC_ywNEeFiqs9YVlH9WhpSBa7GfyAk1LI8');
                    var switchlink = liSelected.children().attr('href');
                    window.location.href = switchlink;
                    $('.result-search').removeClass('active');    
                    return false;
                }   
        
		var pageurl = target.data('url');
		$.ajax({
			type: "POST",
			url: '/amica-fr/visiter-search',
                        data: { search : target.val(), pageurl : pageurl , _csrf : csrfToken},
			dataType: 'html',
			success: function(data){
				$('#search-result').html(data);
				$('.area-query-destination').addClass('active');
                                $('.result-search').addClass('active');
                                
			},
                         error: function (errormessage) {

                            //do something else
                           // alert(data);

                        }
		});
       
	});
    $("html").click(function() {
        $('.area-query-search').removeClass('active');
        $('.result-search').removeClass('active');
        
    });   
  
$(document).on('click', '#search-result li .it', function() {        
//        var position = $(this).attr('data-code');
//        var textname = $(this).text();
//        $('#input-destination').val(textname);
//        $('iframe#get-map').attr('src', 'https://www.google.com/maps/embed/v1/place?q=' + position + '&key=AIzaSyC_ywNEeFiqs9YVlH9WhpSBa7GfyAk1LI8');
        var switchlink = $(this).attr('href');
        window.location.href = switchlink;
        return false;
        
    });   
  

        
 
JS;
$this->registerJs($js, yii\web\View::POS_END);
?>