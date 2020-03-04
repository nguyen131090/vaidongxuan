
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/mobile/nos-destinations-visiter-new.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?
   // $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
  //  $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]);
?>
<div class="contain no-padding">
    <div class="column">
        <? include('_inc_menu_all_page_destinations.php'); ?>
    </div>
</div>
<div class="contain container-banner">
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
               
            </div>            
        </div>
    </div>
</div>
<div class="contain container-search-destination-map mt-80">
   <div class="amc-column column">
        <div class="area-text">
            
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
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="intro_section" data-analytics-label="read_more"> Lire la suite</span></p>'; ?>

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
    <!-- Include Map -->
    <? include_once dirname(dirname(__FILE__)).'/_inc_leaflet_mapbox.php'; ?>
    <!-- End Map -->
    
    </div>
</div>

<div class="contain container-envis mt-80">
    <div class="amc-column column">
        <div class="area-text">
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
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="intro_section" data-analytics-label="read_more"> Lire la suite</span></p>'; ?>

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
            <div class="envies-slider">
                <div class="swiper-wrapper">
                    
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
                        <div class="swiper-slide item-slide">
                            <a href="<?=DIR.$value->slug ?>">
                               
                                 
                                 <?
                                    $hasSummary = false;
                                   // var_dump($value->photos);exit;
                                    if(isset($value->photos)) {
                                        foreach ($value->photos as $kp => $vp) {
                                            if($vp->type == 'summary'){
                                           //    var_dump($vp);exit;
                                            ?>    
                                              <img alt="<?=$value->photos[0]->description ?>" 
                                                data-src="/thumb/520/350/1/100<?=$vp->image ?>" 
                                                data-srcset="/thumb/660/440/1/80<?=$vp->image ?> 450w, /thumb/900/0/1/80<?=$vp->image ?>" 
                                                data-sizes="auto" class="banner-img lazyautosizes lazyloaded" 
                                                data-analytics="on" data-analytics-category="cities_page" data-analytics-action="envy_section" data-analytics-label="envy_card_<?= $value->model->item_id ?>" />
                                
                                            <?
                                                $hasSummary = true;
                                                break;
                                            }
                                        }
                                    } ?>
                                 
                                <p class="tt-title tt-1 tt-fontsize-32 tt-latolatin-bold tt-color-black tt-custom" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="envy_section" data-analytics-label="envy_card_t_<?= $value->model->item_id ?>"><?=$value->title ?></p>
                                <p class="tt-title tt-2 tt-fontsize-32 tt-latolatin-regular tt-color-6b6b6b"><?= $value->model->summary != null ? $value->model->summary : ''?></p>
                            </a>
                        </div>
                        
                    <? } ?>
                    <? } ?>
                    
                    
                </div>
            </div>    
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
<div class="contain container-tour-country container-country-<?= $explodeslug[count($explodeslug) - 1]; ?> mt-txt-80">
    <div class="amc-column column">
        <div class="area-text">
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
                
                <?= trim($first_text).'<span class="dot-more">...</span><span class="last-character">'.$last_character.'</span><span class="amc-btn-control-text see-more" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="intro_section" data-analytics-label="read_more"> Lire la suite</span></p>'; ?>

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
        
        <div class="area-tour mt-50">
            <div class="custom-slides-swiper-<?= $explodeslug[count($explodeslug) - 1]; ?>">
                <div class="swiper-wrapper">
                    
                    
                    <?
                        $list_tour =  \app\modules\destinations\api\Catalog::cat($value->slug)->items(['pagination' => ['pageSize' => 0]]);
                        //var_dump($list_tour);exit;
                    ?>
                    <?
                    $i = 0;
                    foreach ($list_tour as $item) {
                        $i++;

                    ?>
                    
                        <div class="swiper-slide item-slide">
                            <a href="<?= DIR.$item->slug ?>">
                                <?
                                $hasSummary = false;
                                if(isset($item->photos)) {
                                    foreach ($item->photos as $kp => $vp) {
                                        if($vp->type == 'custom'){
                                        ?>    
                                        <img alt="<?=$vp->description ?>" 
                                        data-src="/thumb/260/370/1/100<?=$vp->image ?>" 
                                        data-srcset="/thumb/660/440/1/80<?=$vp->image ?> 450w, /thumb/900/0/1/80<?=$vp->image ?>" 
                                        data-sizes="auto" class="banner-img lazyautosizes lazyloaded" 
                                        data-analytics="on" data-analytics-category="cities_page" data-analytics-action="list_section" data-analytics-label="city_card_<?= $item->model->item_id ?>" />
                               
                                        <?
                                            $hasSummary = true;
                                            break;
                                        }
                                    }
                                } ?>
                                <p class="tt-title tt-1 tt-fontsize-32 tt-latolatin-bold tt-color-black tt-custom mt-32" data-analytics="on" data-analytics-category="cities_page" data-analytics-action="list_section" data-analytics-label="city_card_t_<?= $item->model->item_id ?>"><?= $item->title ?></p>
                            </a>
                        </div>
                    
                    <? 
                    }
                    ?>
                    
                </div>
            </div>    
        </div>
        
    </div>    
    
<?
$swiper = '.custom-slides-swiper-'. $explodeslug[count($explodeslug) - 1];
$jsss=<<<JS
var swiper = new Swiper('$swiper', {
        slidesPerView: 3.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        lazyLoading: true,
        lazyLoadingInPrevNext: true,
        breakpoints: {
            // when window width is <= 320px
            550: {
              slidesPerView: 2.1,
            }
          }
    });      
JS;
$this->registerJs($jsss);
?>             
    
</div>  
<?
    }
}    
?>

<?
include '_inc_guide_book_mobile.php';
?>

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
        
  

 
$('#download-guide-form .email').on('change, focusout',function(){
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #e65925'});
          $('#download-guide-form .error-email').show();
        $('#download-guide-form .error-email').text('Le format de votre email n\'e​st pas valide.');


        }else{
            $('#download-guide-form .email').css({'border' : 'none', 'background-color' : 'white'});
            $('#download-guide-form .error-email').hide();

        }
});         
$('#download-guide-form .submit-email').click(function(e){
    e.preventDefault();
    
    var hClass = $(this).hasClass('submited');
    if(!hClass){
        var url = '/newsletter';
        var name = $('#download-guide-form .email').data('name');
        var guide = $('#download-guide-form .email').data('guide');
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #e65925'});
          $('#download-guide-form .error-email').show();
          $('#download-guide-form .error-email').text('Le format de votre email n\'e​st pas valide.');   
          return false;
        }
        
        $.ajax({
            type: 'post',
            url: url,
            data: { name: name, guide: guide, email: $('#download-guide-form .email').val(), pdf: '$pdfFile' , type: 'guide'},
            beforeSend: function(){
                
            },
            success: function(data){
                $('#download-guide-form .submit-email').text('Merci');
                $('#download-guide-form .submit-email').css({'background-color' : '#6d6d6d','cursor' : 'not-allowed', 'opacity' : '0.8'});
                $('#download-guide-form .submit-email').addClass('submited');
            }
            });
        
    }else{
        return false;
    }
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
$this->registerJs($js);
?>