<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title></title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<!--    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet' />-->
    <link href="<?= DIR . 'assets/plugins/leaflet/mapbox-gl.css' ?>" rel='stylesheet' />
    <script src="<?= DIR . 'assets/plugins/leaflet/mapbox-gl.js' ?>"></script>
  
    <style>
      body {
        margin: 0;
        padding: 0;
      }

      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
      }
      .marker {
 // background-image: url('mapbox-icon.png');
  background-size: cover;
  width: 15px;
  height: 15px;
  border-radius: 50%;
  cursor: pointer;
  background: red;
  border: 1px solid black;
}
.mapboxgl-popup {
  max-width: 200px;
}

.mapboxgl-popup-content {
  text-align: center;
  font-family: 'Open Sans', sans-serif;
}
    </style>
</head>
<body>

<div id='map'></div>

<script>

mapboxgl.accessToken = 'pk.eyJ1Ijoibmd1eWVuZHQiLCJhIjoiY2p4eTFzd3hwMDVxNTNjcXM1cjYyajE5eSJ9.ddbTu1ncxINV-B9iQZ_NeQ';

var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/light-v10',
  center: [-96, 37.8],
  zoom: 3
});

var geojson = {
  type: 'FeatureCollection',
  features: [{
    type: 'Feature',
    geometry: {
      type: 'Point',
      coordinates: [-77.032, 38.913]
    },
    properties: {
      title: 'Mapbox',
      description: 'Washington, D.C.'
    }
  },
  {
    type: 'Feature',
    geometry: {
      type: 'Point',
      coordinates: [-122.414, 37.776]
    },
    properties: {
      title: 'Mapbox',
      description: 'San Francisco, California'
    }
  },{
    "geometry": {
        "type": "Point",
        "coordinates": [
                -78.032, 38.913
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Ho Chi Minh Ville (Saigon)",
        "url": "/vietnam/ho-chi-minh-ville-saigon"
    },
    "id": 30
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                -79.032, 38.913
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Delta du Mékong",
        "url": "/vietnam/delta-du-mekong"
    },
    "id": 29
}
  
        ]
};


var geojsonnew = {
  type: 'FeatureCollection',
  features: [
      {
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.6296638, 10.8230989
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Ho Chi Minh Ville (Saigon)",
        "url": "/vietnam/ho-chi-minh-ville-saigon"
    },
    "id": 30
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.5943388, 10.063363
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Delta du Mékong",
        "url": "/vietnam/delta-du-mekong"
    },
    "id": 29
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.8341598, 21.0277644
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Hanoi",
        "url": "/vietnam/hanoi"
    },
    "id": 1
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.1726816, 20.4665271
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "La réserve naturelle de Pu Luong",
        "url": "/vietnam/reserve-naturelle-pu-luong"
    },
    "id": 8
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                -122.4123109, 37.6557751
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Ben Tre",
        "url": "/vietnam/ben-tre"
    },
    "id": 26
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.3131185, 20.6861265
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "La province de Hoa Binh",
        "url": "/vietnam/hoa-binh"
    },
    "id": 356
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.7177215, 22.3970255
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Le lac Ba Be",
        "url": "/vietnam/lac-ba-be"
    },
    "id": 9
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                103.98402, 10.289879
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Phu Quoc",
        "url": "/vietnam/ile-phu-quoc"
    },
    "id": 32
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.2833928, 17.5907815
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Parc national de Phong Nha Ke Bang",
        "url": "/vietnam/phong-nha-ke-bang"
    },
    "id": 25
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                104.705431, 22.7417169
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Hoang Su Phi",
        "url": "/vietnam/hoang-su-phi"
    },
    "id": 304
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                107.1839024, 20.9100512
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Baie d’Halong",
        "url": "/vietnam/baie-halong"
    },
    "id": 3
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.3380469, 15.8800584
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Hoi An",
        "url": "/vietnam/hoi-an"
    },
    "id": 17
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.2522143, 22.635689
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Cao Bang",
        "url": "/vietnam/cao-bang"
    },
    "id": 4
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                107.5908628, 16.4637117
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Hué",
        "url": "/vietnam/hue"
    },
    "id": 18
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.9113847, 20.2158094
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Tam Coc ou Baie d’Halong terrestre",
        "url": "/vietnam/tam-coc-baie-halong-terrestre"
    },
    "id": 12
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                104.1466046, 21.7670046
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Mu Cang Chai",
        "url": "/vietnam/mu-cang-chai"
    },
    "id": 303
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.7225925, 22.8553194
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Ban Gioc",
        "url": "/vietnam/ban-gioc"
    },
    "id": 305
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                104.9388853, 22.7662056
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "La province de Ha Giang",
        "url": "/vietnam/ha-giang"
    },
    "id": 353
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.4536718, 23.1341053
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Meo Vac",
        "url": "/vietnam/meo-vac"
    },
    "id": 298
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.92299, 20.2129969
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "La province de Ninh Binh",
        "url": "/vietnam/ninh-binh"
    },
    "id": 187
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.6881788, 22.8786248
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Bao Lac",
        "url": "/vietnam/bao-lac"
    },
    "id": 274
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.761519, 21.853708
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Lang Son",
        "url": "/vietnam/lang-son"
    },
    "id": 389
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.254879, 22.900279
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Le Grand Nord du Vietnam",
        "url": "/vietnam/grand-nord-vietnam"
    },
    "id": 188
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.2428853, 23.2246718
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Dong Van",
        "url": "/vietnam/dong-van"
    },
    "id": 7
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                103.0321549, 21.4063898
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Dien Bien Phu",
        "url": "/vietnam/dien-bien-phu"
    },
    "id": 186
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                104.9973028, 20.6098264
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Mai Chau (Mai Hich)",
        "url": "/vietnam/mai-hich-mai-chau"
    },
    "id": 10
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                104.332644, 22.4965469
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Bac Ha",
        "url": "/vietnam/bac-ha"
    },
    "id": 2
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.0213889, 21.7272222
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Le lac Thac Ba",
        "url": "/vietnam/lac-thac-ba"
    },
    "id": 13
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.4185406, 10.3759416
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Long Xuyen",
        "url": "/vietnam/long-xuyen"
    },
    "id": 194
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                103.8437852, 22.3363608
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Sapa",
        "url": "/vietnam/sapa"
    },
    "id": 11
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.6114474, 8.7009282
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Con Dao",
        "url": "/vietnam/ile-archipel-con-dao"
    },
    "id": 28
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.3346061, 9.9513316
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Tra Vinh",
        "url": "/vietnam/tra-vinh"
    },
    "id": 191
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.7468535, 10.0451618
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Can Tho",
        "url": "/vietnam/can-tho"
    },
    "id": 27
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                109.1967488, 12.2387911
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Nha Trang",
        "url": "/vietnam/nha-trang"
    },
    "id": 24
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.9123598, 11.5995481
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Le Panduranga",
        "url": "/vietnam/panduranga"
    },
    "id": 23
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                -73.1275775, 44.4500248
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "My Son",
        "url": "/vietnam/my-son"
    },
    "id": 22
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                10.3273368, 5.2864698
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Les Hauts Plateaux du Centre",
        "url": "/vietnam/les-hauts-plateaux-du-centre"
    },
    "id": 21
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.2021667, 16.0544068
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Danang",
        "url": "/vietnam/danang"
    },
    "id": 15
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.4583132, 11.9404192
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Dalat",
        "url": "/vietnam/dalat"
    },
    "id": 14
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.3438891, 10.3765284
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "My Tho",
        "url": "/vietnam/my-tho"
    },
    "id": 189
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.999722, 20.8
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "L’île de Cat Ba",
        "url": "/vietnam/ile-cat-ba"
    },
    "id": 5
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.2871837, 10.9332105
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Mui Ne",
        "url": "/vietnam/mui-ne"
    },
    "id": 31
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.1087261, 10.7022388
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Chau Doc",
        "url": "/vietnam/chau-doc"
    },
    "id": 185
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                106.462359, 11.142148
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Les tunnels de Cu Chi",
        "url": "/vietnam/les-tunnels-de-cu-chi"
    },
    "id": 195
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                109.171413, 11.6642762
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Parc national de Nui Chua",
        "url": "/vietnam/parc-national-nui-chua"
    },
    "id": 403
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.3260022, 15.873398
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Les îles Cham",
        "url": "/vietnam/iles-cham"
    },
    "id": 20
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                104.1487055, 22.3380865
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Lao Cai",
        "url": "/vietnam/lao-cai"
    },
    "id": 275
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.0382475, 12.6661944
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Buon Ma Thuot",
        "url": "/vietnam/buon-ma-thuot"
    },
    "id": 183
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.7517453, 10.2901261
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Sa Dec (Sadec)",
        "url": "/vietnam/sadec"
    },
    "id": 190
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.2073725, 21.6977164
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Massif du Song chay",
        "url": "/vietnam/song-chay"
    },
    "id": 6
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                105.9464874, 10.3718873
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Cai Be",
        "url": "/vietnam/cai-be"
    },
    "id": 184
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                104.0363948, 10.0572576
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Phu Quoc (plage du Nord Ouest)",
        "url": "/vietnam/phu-quoc-plage-nord-ouest"
    },
    "id": 396
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.296561, 10.9480216
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Plage de Mui Ne",
        "url": "/vietnam/plage-mui-ne"
    },
    "id": 397
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                109.1967488, 12.2387911
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Plages de Nha Trang",
        "url": "/vietnam/plages-nha-trang"
    },
    "id": 398
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                109.2510752, 12.3902162
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Baie de Ninh Van",
        "url": "/vietnam/baie-ninh-van"
    },
    "id": 399
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.2466932, 16.0639056
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Plages de Danang",
        "url": "/vietnam/plages-da-nang"
    },
    "id": 401
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                108.3406489, 15.9136072
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Plages de Hoi An",
        "url": "/vietnam/plages-hoi-an"
    },
    "id": 402
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                103.9658443, 10.188651
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Phu Quoc (plage de Duong Dong)",
        "url": "/vietnam/phu-quoc-plage-duong-dong"
    },
    "id": 405
},{
    "geometry": {
        "type": "Point",
        "coordinates": [
                107.6359118, 16.5458888
        ]
    },
    "type": "Feature",
    "properties": {
        "popupContent": "Hué (plage de Thuan An)",
        "url": "/vietnam/hue-plage-thuan-an"
    },
    "id": 404
}
  ]
};

// add markers to map
geojson.features.forEach(function(marker) {

  // create a HTML element for each feature
  var el = document.createElement('div');
  el.className = 'marker';

  // make a marker for each feature and add to the map
  new mapboxgl.Marker(el)
    .setLngLat(marker.geometry.coordinates)
    .addTo(map);
    
    new mapboxgl.Marker(el)
  .setLngLat(marker.geometry.coordinates)
  .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
    .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
  .addTo(map);
    
});

// code from the next step will go here!

</script>

</body>
</html>