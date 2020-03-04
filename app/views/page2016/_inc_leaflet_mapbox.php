<?//php $this->registerCssFile(DIR . 'assets/plugins/leaflet/leaflet.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile(DIR . 'assets/plugins/leaflet/mapbox-gl.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?//php $this->registerJsFile(DIR . 'assets/plugins/leaflet/leaflet.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerJsFile(DIR . 'assets/plugins/leaflet/mapbox-gl.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?//php $this->registerJsFile(DIR . 'assets/plugins/leaflet/leaflet-mapbox-gl.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?
$css=<<<CSS
.marker {
    background-size: cover;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    cursor: pointer;
    background-color: #ff7800;
    border: 1px solid black;
     opacity: 0.9; 
}
.marker:hover{
    width: 17px;
    height: 17px;
}
.mapboxgl-popup-content {
    position: relative;
    background: #fff;
    border-radius: 3px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    padding: 3px 40px 3px 10px;
    pointer-events: auto;
    font-family: inherit;
}
.mapboxgl-popup-content .mapboxgl-popup-close-button{
    width: 40px;
    padding: 0;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}      
.mapboxgl-popup-close-button{
    font-size: 20px;
}
button.mapboxgl-ctrl-icon.mapboxgl-ctrl-compass{
    display: none;
}
.mapboxgl-ctrl-attrib.mapboxgl-compact{
    display: none;
}
#map .disable-zoom{
    cursor: default;
    background-color: #f4f4f4;
    color: #bbb;
    opacity: 0.5;
}   
.mapboxgl-ctrl-group > button{
    margin: 0;
}  
.control-map #map{
    min-height: 32rem;
}    
.control-map #map canvas{
    height: 100% !important;
}        
CSS;
$this->registerCss($css);

if(IS_MOBILE || IS_TABLET){
    $css_m=<<<JS
        .marker {
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            background-color: unset;
            border: none;
             opacity: 0.9; 
        }
    .marker:hover{
        width: 50px;
        height: 50px;
    } 
    .marker p {
        width: 15px;
        height: 15px;
        background: #ff7800;
        border-radius: 100%;
        border: 1px solid black;
        /* opacity: 0.9; */
        margin: 18px auto;
        /* display: block; */
    }
    .marker p:hover{
        width: 17px;
        height: 17px;    
    }
    .mapboxgl-popup-content{
        display: flex;
        align-items: center;
        justify-content: center;
    } 
     .mapboxgl-popup-content a{
        padding: 0 0px 0 0;
    }   
     .mapboxgl-popup-content .mapboxgl-popup-close-button{
        height: 20px;
    }   
      
JS;
    $this->registerCss($css_m);   
}


?>

<? 
    $json_list = [];
    $i = 0;
    $items_json =<<<JS
            
JS;
    if($allItemVisiter != null){
    foreach ($allItemVisiter as $k => $v) { 
      // var_dump($v);exit;
        
        if((isset($v->data->longitude) && $v->data->longitude != '') && (isset($v->data->latitude) && $v->data->latitude != '')){
            $i++;
            $longitude = floatval($v->data->longitude);
            $latitude = floatval($v->data->latitude);
            $title = $v->model->title;
            $id_item = $v->model->item_id;
            $url = DIR.$v->slug;
            
$json_list[$i] =<<<TXT
{
    "geometry": {
        "type": "Point",
        "coordinates": [
                $longitude, $latitude
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "<a href='$url'>$title</a>",
        "url": "$url"
    },
    "id": $id_item
}
TXT;
            
        }
    } 

  

foreach ($json_list as $key => $value) {
    $items_json .= $value;
    if($key <= count($json_list) - 1){
     $items_json .= ',';  
    }
}
    }
//var_dump($items_json);exit;
?>

<div id="map"></div>

<?
if(SEG1 == 'vietnam'){
    $lgi = '106.200523';
    $lat = '16.040219';
}else if(SEG1 == 'laos'){
    $lgi = '104.200523';
    $lat = '18.040219';
}else if(SEG1 == 'cambodge'){
    $lgi = '105.200523';
    $lat = '12.540219';
}else if(SEG1 == 'birmanie'){
    $lgi = '96.200523';
    $lat = '21.040219';
}else{
    $lgi = '106.200523';
    $lat = '16.040219';
}  
$zoom = 5;
$minzoom = 5;
$maxzoom = 9;

if(IS_MOBILE){
    if(SEG1 == 'vietnam'){
        $lgi = '105.200523'; 
        $lat = '16.040219';
    }else if(SEG1 == 'laos'){
        $lgi = '104.200523';
        $lat = '18.040219';
    }else if(SEG1 == 'cambodge'){
        $lgi = '105.200523';
        $lat = '12.540219';
    }else if(SEG1 == 'birmanie'){
        $lgi = '96.200523';
        $lat = '21.040219';
    }else{
        $lgi = '105.200523'; 
        $lat = '16.040219';
    } 
    
    $zoom = 4;
    $minzoom = 4;
    $maxzoom = 12;
}

$js=<<<JS
        
// Js For MAP
        
        
        var geojson = {
             "type": "FeatureCollection",
             "features": [
                 $items_json
             ]
         };
       
    

        mapboxgl.accessToken = 'pk.eyJ1Ijoibmd1eWVuZHQiLCJhIjoiY2p4eTFzd3hwMDVxNTNjcXM1cjYyajE5eSJ9.ddbTu1ncxINV-B9iQZ_NeQ';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'https://api.maptiler.com/maps/8ad794d7-a13c-4520-9f39-1a34f9c078c5/style.json?key=LnX9QGkCi1lrAKH6KPtr',
            center: [$lgi, $lat],
            doubleClickZoom: false,
            zoom: $zoom,
            maxZoom: $maxzoom,
            minZoom: $minzoom,
            
        });
       // console.log(map.getMaxZoom());
        
        // disable map zoom when using scroll
        map.scrollZoom.disable();
       
        
        // add markers to map
         geojson.features.forEach(function(marker) {

            // create a HTML element for each feature
            var el = document.createElement('div');
            var node = document.createElement("p");
            el.appendChild(node);
            el.className = 'marker';

            // make a marker for each feature and add to the map
            new mapboxgl.Marker(el)
              .setLngLat(marker.geometry.coordinates)
              .addTo(map);

            new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .setPopup(new mapboxgl.Popup({ offset: 10 }) // add popups
              .setHTML(marker.properties.popupContent))
            .addTo(map);
        
        }); 
        // Add zoom and rotation controls to the map.
        map.addControl(new mapboxgl.NavigationControl({showCompass: false, showZoom: true}), 'bottom-right');
        map.on('load', function () {
            if (map.getZoom() === map.getMaxZoom()) {
                    $('.mapboxgl-ctrl-zoom-in').addClass('disable-zoom');
            } 
            if (map.getZoom() === map.getMinZoom()) {
                    $('.mapboxgl-ctrl-zoom-out').addClass('disable-zoom');
            } 
        });
        map.on('zoom', function() {
            if (map.getZoom() === map.getMaxZoom()) {
                    $('.mapboxgl-ctrl-zoom-in').addClass('disable-zoom');
            }else if(map.getZoom() > map.getMinZoom() && map.getZoom() < map.getMaxZoom()){
                $('.mapboxgl-ctrl-group button').removeClass('disable-zoom');
            }else if (map.getZoom() === map.getMinZoom()) {
                    $('.mapboxgl-ctrl-zoom-out').addClass('disable-zoom');
            } 
        });
      
        


//       var map = L.map('map', {
//      	scrollWheelZoom: false,
//      	minZoom: 5, 
//      	maxZoom: 10,
//      	zoomControl: true
//      }).setView([$lat, $lgi], 5);
//
//      map.zoomControl.setPosition('bottomright');
//
//
//      var gl = L.mapboxGL({
//        accessToken: 'not-needed',
//        style: 'https://api.maptiler.com/maps/8ad794d7-a13c-4520-9f39-1a34f9c078c5/style.json?key=LnX9QGkCi1lrAKH6KPtr'
//      }).addTo(map);
//
//      var baseballIcon = L.icon({
//		iconUrl: 'baseball-marker.png',
//		iconSize: [32, 37],
//		iconAnchor: [16, 37],
//		popupAnchor: [0, -28]
//	});
//
//      function onEachFeature(feature, layer) {
//		var popupContent = "";
//
//		if (feature.properties && feature.properties.popupContent) {
//			popupContent += feature.properties.popupContent;
//		}
//
//		layer.bindPopup(popupContent);
//	}
//
//	L.geoJSON([geojson], {
//
//		style: function (feature) {
//			return feature.properties && feature.properties.style;
//		},
//
//		onEachFeature: onEachFeature,
//
//		pointToLayer: function (feature, latlng) {
//			return L.circleMarker(latlng, {
//				radius: 6.4,
//				fillColor: "#ff7800",
//				color: "#000",
//				weight: 1,
//				opacity: 1,
//				fillOpacity: 0.8
//			});
//		}
//	}).addTo(map);
      
  
// END JS FOR MAP   
        
//$(document).on("mouseenter", ".leaflet-interactive", function(event){
////	$('.mybutton').addClass('mybutton-animation');
//   
//        var hId = $(this).attr('id');
//       
//        if(hId != 'fix'){
//            var oldclass = $(this).attr('class');
//            $(this).attr('class', oldclass + ' act-hover');
//         }
//             var tt = $(this).attr('d');
//            var ttt = tt.split(",");
//            var x = ttt[0].split("M");
//            var y = ttt[1].split("a");
////            console.log(x[1]);
////            console.log(y[0]);
////            var x = $(this).offset().left;
////            var y = parseInt($(this).offset().top - $("#map").offset().top) + 10;
//
//            var origin = x[1] + 'px' +' '+ y[0] + 'px';
//
//            $(this).css("transform-origin", origin);
//            $(this).attr('id','fix');
//      //  }
//       
//});  
           
       
 
JS;
$this->registerJs($js, yii\web\View::POS_END);

if(IS_MOBILE){
    $jss=<<<JS
        $(document).on('click', '.mapboxgl-popup-content a', function(e) {
            var url = $(this).attr('href');
            window.location.href = url;
            e.preventDefault();

        });             
JS;
    $this->registerJs($jss, yii\web\View::POS_END);   
}
?>        