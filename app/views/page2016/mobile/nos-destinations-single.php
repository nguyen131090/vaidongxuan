<?php $this->registerCssFile(DIR . 'assets/plugins/leaflet/leaflet.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/plugins/leaflet/mapbox-gl.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/plugins/leaflet/leaflet.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/plugins/leaflet/mapbox-gl.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/plugins/leaflet/leaflet-mapbox-gl.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<div class="contain no-padding">
    <div class="column">
        <? include('_inc_menu_all_page_destinations.php'); ?>
    </div>
</div>
<div class="contain container-2 non-area-form">
    <div class="column">
            <?// include('_inc_menu_all_page_destinations.php'); ?>
        <div class="row-content top-lieu">
                <h1 class="title-row"><?=$theEntry->model->seo->h1 ?></h1>
                <ul class="list-envies no-padding">
                   
            <?
            //$envies = [];
            foreach ($theEntry->data->envies as $key => $value) {
                //var_dump($value);exit;
                $envies = \app\modules\destinations\api\Catalog::items([
                    'where' => ['item_id' => $value],
                ]);
                $img_icon = [
                    'uri' => NULL,
                    'alt' => NULL,
                    'caption' => NULL,
                ];
                if($envies){
                foreach ($envies[0]->photos as $image) {
                    if($image->model->type == 'icon'){
                        $img_icon = [
                            'uri' => $image->model->image,
                            'alt' => $image->model->description,
                            'caption' => $image->model->caption,
                        ];
                    }
                }
                //var_dump($envies->photos[0]->model);exit;
            ?>
            <li class="tt tt-latolatin-regular no-liststyle"><span><img alt="<?=$img_icon['alt'] ?>" data-src="<?=$img_icon['uri']?>"><a href="<?= DIR.$envies[0]->slug?>"><?= $envies[0]->title ?></a></span></li>
            <?
            }
            }
           
            ?>
            </ul>
            <?// if(!empty($theEntry->photosArray['galery'])) :?>
<!--            <div class="galeries-slider bullet-dynamic">
                <div class="swiper-wrapper">
                    
                            <?// foreach ($theEntry->photosArray['galery'] as $key => $v) : ?>
                    <div class="swiper-slide">
                        <img alt="<?//= $v->description?>"
                                    data-src="<?//=$v->image?>" 
                                    data-srcset="/thumb/660/440/1/80<?//=$v->image?> 450w, <?//=$v->image?>"
                                    data-sizes="auto"
                                    class="banner-img lazyload" />
                    </div>
                <?// endforeach;?>
                
                </div>
                <div class="swiper-pagination swiper-pagination-galery"></div>
            </div>-->
            <?// endif; ?>
                
            <!-- Include Gallery Image -->
            <? include_once '_inc_gallery.php'; ?>
            <span class="space space-80"></span>
            <!-- End Include Gallery Image -->    
            
            <div class="area-map-leaflet">
                <div id="map"></div>
            </div>    
                
                
            <div class="text-row content-page tt-latolatin-regular tt-fontsize-32">
                <?=$theEntry->description; ?>
            </div>
        </div>
        <? $theList_tour = null;
                    foreach ($theEntry->data->location as $v) {

                        $theList_tour = \app\modules\programmes\api\Catalog::items([
                        'where' => ['like', 'locations', $v],
                        'orderBy' => ['on_top_flag' => SORT_ASC, 'on_top' => SORT_ASC],
                        'pagination' => ['pageSize' => 3],
                    ]);
                    } ?>
        <? if($theList_tour) : ?>
        <div class="row-content tours-lieu">

            <h2 class="title-row">Idées de voyage incluant “<?=$theEntry->model->summary_title ? $theEntry->model->summary_title : $theEntry->title?>”</h2>
            <div class="tours-lieu-slider">
                <div class="swiper-wrapper">
                     <? 
                    foreach ($theList_tour as $key => $value) : ?>
                        <div class="swiper-slide">
                            <a href="<?= DIR . $value->slug ?>"">
                                <? 
                                $v = NULL;
                                if(!empty($value->photosArray['summary'])){
                                    $v= $value->photosArray['summary'][0];
                                }?>
                                <? if($v != NULL){ ?>
                                <img alt="<?= $v->description?>"
                                    data-src="<?=$v->image?>" 
                                    data-srcset="<?=$v->image?>"
                                    data-sizes="auto"
                                    class="banner-img lazyload" />
                                <? } ?>
                                <div class="text-on-img">
                                    <h3 class="tt-latolatin-bold tt-fontsize-32"><?= str_replace('|','',$value->title); ?></h3>
                                    <p class="sub-title tt-fontsize-28"><?= $value->model->sub_title ?></p>
                                </div>
                            </a>
                        </div>
                     <? endforeach ?>
                </div>
                <div class="swiper-pagination swiper-pagination-lieu"></div>
            </div>
        </div>
        <? endif; ?>
        <div class="row-content visiter-related">
            <h2 class="title-row">Lieux à découvrir :</h2>
            <div class="visiter-related-slider">
                <div class="swiper-wrapper">
                    <? foreach ($random_destination as $value) : ?>
                        <div class="swiper-slide">
                            <a href="<?= DIR.$value->slug?>">    
                                <? 
                                $v = null;
                                if(!empty($value->photosArray['summary'])){
                                    $v= $value->photosArray['summary'][0];
                                }?>
                                <? if($v != NULL){ ?>
                                 <img alt="<?= $v->description?>"
                                    data-src="<?=$v->image?>" 
                                    data-srcset="/thumb/660/440/1/80<?=$v->image?> 450w, <?=$v->image?>"
                                    data-sizes="auto"
                                    class="banner-img lazyload" />
                                 <? } ?> 
                                <h3 class="tt-fontsize-32 tt-latolatin-bold"><?= $value->title?></h3>
                            </a>
                        </div>
                    <? endforeach ?>
                </div>
            </div>
        </div>
</div>
</div>
<!-- Start of second page -->

<? 
$country = SEG1;
$uri = URI;
$longitude = floatval($theEntry->data->longitude);
$latitude = floatval($theEntry->data->latitude);
$title = $theEntry->model->title;
$id_item = $theEntry->model->item_id;
$url = DIR.$theEntry->slug;
$items_json =<<<TXT
{
    "geometry": {
        "type": "Point",
        "coordinates": [
                $longitude, $latitude
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "$title",
        
    },
    "id": $id_item
}
TXT;

$lgi = $longitude;
$lat = $latitude;

//if(SEG1 == 'vietnam'){
//    $lgi = '105.200523'; 
//    $lat = '16.040219';
//}else if(SEG1 == 'laos'){
//    $lgi = '104.200523';
//    $lat = '18.040219';
//}else if(SEG1 == 'cambodge'){
//    $lgi = '105.200523';
//    $lat = '12.540219';
//}else if(SEG1 == 'birmanie'){
//    $lgi = '96.200523';
//    $lat = '21.040219';
//}else{
//    $lgi = '105.200523'; 
//    $lat = '16.040219';
//}   
$js = <<< JS

$('.region .region-item .tx-1').click(function(){
   
    $(this).parent().siblings().removeClass('active');
    $(this).parent().toggleClass('active');
     $.mobile.silentScroll($(this).parent().position().top - 60);
})
var galeriesSlider = new Swiper('.galeries-slider', {
        slidesPerView: 2,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
        breakpoints: {
            // when window width is <= 320px
            567: {
              slidesPerView: 1
            },
           
          }
    });  

var tourSlider = new Swiper('.tours-lieu-slider', {
        slidesPerView: 2,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        pagination: {
            el: '.swiper-pagination-lieu',
            dynamicBullets: true,
        },
        breakpoints: {
            // when window width is <= 320px
            567: {
              slidesPerView: 1
            },
           
          }
    }); 


var relatedSwiper = new Swiper('.visiter-related-slider', {
        slidesPerView: 2.1,
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        breakpoints: {
            567: {
              slidesPerView: 1.1
            },
           
          }
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
        
        
// Js For MAP
   
var bicycleRental = {
    "type": "FeatureCollection",
    "features": [
        $items_json
    ]
};


       var map = L.map('map', {
      	scrollWheelZoom: false,
      	minZoom: 4, 
      	maxZoom: 10,
//        zoomSnap: 0.5,
//        zoomDelta: 0.5,
      	zoomControl: true
      }).setView([$lat, $lgi], 7);

      map.zoomControl.setPosition('bottomright');


      var gl = L.mapboxGL({
        accessToken: 'not-needed',
        style: 'https://api.maptiler.com/maps/8ad794d7-a13c-4520-9f39-1a34f9c078c5/style.json?key=LnX9QGkCi1lrAKH6KPtr'
      }).addTo(map);

      var baseballIcon = L.icon({
		iconUrl: 'baseball-marker.png',
		iconSize: [32, 37],
		iconAnchor: [16, 37],
		popupAnchor: [0, -28]
	});

      function onEachFeature(feature, layer) {
		var popupContent = "";

		if (feature.properties && feature.properties.popupContent) {
			popupContent += feature.properties.popupContent;
		}

		layer.bindPopup(popupContent);
	}

	L.geoJSON([bicycleRental], {

		style: function (feature) {
			return feature.properties && feature.properties.style;
		},

		onEachFeature: onEachFeature,

		pointToLayer: function (feature, latlng) {
			return L.circleMarker(latlng, {
				radius: 6.4,
				fillColor: "#ff7800",
				color: "#000",
				weight: 1,
				opacity: 1,
				fillOpacity: 0.8
			});
		}
	}).addTo(map);
      
  
// END JS FOR MAP           
     

$(document).on('click', '.leaflet-popup-content a', function(e) {
    var url = $(this).attr('href');
    window.location.href = url;
    e.preventDefault();
    
});        
        

JS;
$this->registerJs($js); 
$css = <<<CSS
.swiper-container-horizontal{
    position: relative;
}
.visiter-related-slider .swiper-slide h3{
    margin-top: 1rem;
    margin-bottom: 4rem;
}
.top-lieu .text-row >  h2{
    font-family: 'LatoLatin-Bold',sans-serif;
   // color: #e65925;
   // padding-left: 50px;
   // background: transparent url(/assets/img/page2016/icon_tim.png) no-repeat scroll 0 0;
    margin: 1.3rem 0;
    background-size: 4rem;
    font-size: 2rem;
    text-align: left !important;
    min-height: 4rem;
    display: flex;
    align-items: center;
}
.top-lieu .text-row ul{
   list-style: none;    
   padding: 0;     
   // list-style-image: url(/assets/img/page2016/bg-list.png);
   // padding-left: 20px;
}
}
.top-lieu .text-row ul li{
   
}
.top-lieu .text-row ul li::before {
    content: "• ";
    color: #000;
    display: inline-block;
    padding: font-size: 2rem;
    margin-right: 1rem;
   
      
}
.galeries-slider{
    margin-bottom: 2.5rem;
}
.galeries-slider .swiper-button-prev{
    background-color: transparent;
    background-size: 2rem;
    left: -0.5rem;
}
.galeries-slider .swiper-button-next{
    background-color: transparent;
    background-size: 2rem;
    right: -0.5rem;
}
.tours-lieu-slider .text-on-img {
    position: absolute;
    z-index: 9999;
    bottom: 0;
    color: #fff;
    display: block;
    width: 100%;
    text-align: center;
    background: linear-gradient(to top,rgba(0,0,0,0.5),rgba(0,0,0,0));
        padding: 0 1.25rem;
}
.tours-lieu-slider .text-on-img h3 {
    font: 1.6rem LatoLatin-Bold, sans-serif;
    margin-bottom: 2rem;
    margin: 0;
}
.tours-lieu-slider .text-on-img p{
    margin: 0.5rem 0 2rem;
}
.top-lieu .text-row p{
    margin: 0 0 1rem;
}
.top-lieu .text-row p:last-of-type{
    margin: 0;
}
.list-envies{
    margin-bottom: 2rem;
    margin-top: 0;
    display: inline-block;
}
.list-envies li{
    float: left;
    background: #e4e4e4;
    border-radius: 1rem;
    padding: 0.5rem 1rem;
    font: 1.3rem LatoLatin-Regular,sans-serif;
    margin: 0.5rem 0.5rem 0.5rem 0;
    height: 3rem;
    display: flex;
    align-items: center;
}
.list-envies li img{
    margin-right: 0.5rem;
}
.visiter-related-slider .swiper-slide:first-of-type {
      justify-content: center;
      margin: 0 auto;
    }
@media only screen and (orientation:landscape){
    .visiter-related-slider .swiper-slide{
        width: 45%;
    }
}
CSS;
$this->registerCss($css);
?>