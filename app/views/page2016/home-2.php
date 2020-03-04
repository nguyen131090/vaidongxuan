
<?php $this->registerCssFile('/assets/css/page2016/home.css?v=14',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <div class="contain container-3">
    <div class="row-content">
        <h2>BESOIN <span>D’INSPIRATION</span></h2>
        <div class="text">
           <p> Chacun trouvera dans notre sélection de quoi céder à la tentation.<br>
Piochez dans nos coups de cœurs, nos adresses de charme testées et appréciées, nos créations originales ou encore nos activités décalées, et modulez votre programme comme bon vous semble.
           </p>     
        </div>
    </div>    
</div>
<div class="contain container-4 inspiration-contain">
    <ul class="inspiration-bxslider row-content">
      <li>
        <a href="/vietnam/itineraire/douceur-vietnam">
        <img alt="" width="301" height="325" data-src="<?=DIR?>upload/home/en-famille-vietnam.jpg" class="lazyload"/>
        </a>
        <div class="text-slide">
            <a href="/vietnam/itineraire/douceur-vietnam">
            <h4>vietnam</h4>
            <h4><b>DOUCEUR VIETNAM</b></h4>
            </a>
            <p>Les immanquables, la vie locale, des escales de charme</p>
        </div>
      </li>
      <li>
        <a href="/cambodge/itineraire/angkor-et-encore">
        <img alt="" width="301" height="325" data-src="<?=DIR?>upload/home/angkor-cambodge.jpg" class="lazyload"/>
        </a>
        <div class="text-slide">
            <a href="/cambodge/itineraire/angkor-et-encore">
            <h4>CAMBODGE</h4>
            <h4><b>ANGKOR ET ENCORE</b></h4>
            </a>
            <p>
Toutes les merveilles d’Angkor, agrémentées d’étapes d’immersion dans la vie locale</p>
        </div>
      </li>
      <li>
        <a href="/laos/itineraire/laos-panorama">
        <img alt="" width="301" height="325" class="lazyload" data-src="<?=DIR?>upload/home/banner-laos.jpg" />
        </a>
         <div class="text-slide">
            <a href="/laos/itineraire/laos-panorama">
            <h4>laos</h4>
            <h4><b>PANORAMA DU LAOS</b></h4>
            </a>
            <p>L’essentiel du Laos, via les sites touristiques les plus connus</p>
        </div>
      </li>
      <li>
        <a href="/vietnam/itineraire/les-tresors-de-indochine">
        <img alt="" width="301" height="325" data-src="<?=DIR?>upload/home/baie-dalong-vietnam.jpg" class="lazyload"/>
        </a>
        <div class="text-slide">
            <a href="/vietnam/itineraire/les-tresors-de-indochine">
            <h4>MULTI-PAYS</h4>
            <h4><b>LES TRÉSORS DE L'INDOCHINE</b></h4>
            </a>
            <p>La Baie d’Halong, Luang Prabang et les Temples d’Angkor</p>
        </div>
      </li>
      <li>
        <a href="/vietnam/itineraire/couleurs-tonkinoises">
        <img alt="" width="301" height="325" data-src="<?=DIR?>upload/home/rizieres-en-terrasse.jpg" class="lazyload"/>
        </a>
        <div class="text-slide">
            <a href="/vietnam/itineraire/couleurs-tonkinoises">
            <h4>VIETNAM </h4>
            <h4><b>COULEURS TONKINOISES</b></h4>
            </a>
            <p>Rizières en terrasses, marchés colorés, villages de minorités ethniques</p>
        </div>
      </li>
      <li>
        <a href="/birmanie/itineraire/tresors-birmans">
        <img alt="" width="301" height="325" class="lazyload" data-src="<?=DIR?>upload/home/temples-birmanie.jpg" />
        </a>
         <div class="text-slide">
            <a href="/birmanie/itineraire/tresors-birmans">
            <h4>BIRMANIE</h4>
            <h4><b>Trésors birmans</b></h4>
            </a>
            <p>Les incontournables de la Birmanie</p>
        </div>
      </li>
    </ul>
</div>

</div>    

<div class="contain container-2 background img-lazy" data-src="/assets/img/page2016/bg_container_2.jpg">
    <div class="row-content">
        <div class="col col-left">
            <ul>
				 <?php
                    $cnt = 0;
                    $image = array();
                    foreach ($theRaisons_list as $v) {
                        $cnt ++;
                        if(!empty($v->photos)){
                            foreach ($v->photos as $img) {
                                if($img->model->type == 'icon'){
                                    $image[$cnt] = [
                                            'image' => $img->image,
                                            'description' => $img->description,      
                                            'caption' => $img->model->caption
                                            ];
                                }
                            }
                        }
                    
                ?>
                    <li>
                        <a class="item item-<?= $cnt?>" data-name="image-<?= $cnt?>" href="<?=DIR.$theRaisons->slug.'?p='.$cnt?>">
                            <?= $v->title?>
                        </a>
                    </li>
                    <?php } ?>
            </ul>
        </div>    
        <div class="col col-right">
            <div class="change-image">
				<?php
                    $j = 0;
                    foreach ($image as $v) {
                        
                        $j++;
					    echo '<img id="image-'.$j.'" class="img-lazy" alt="'.$v['description'].'" title="'.$v['caption'].'" src="" data-src="'.$v['image'].'">';
                    
					}
                ?>
                
                <img alt="" class="fix" src="<?=DIR?>assets/img/page2016/layout.png">
            </div>    
        </div>
    </div>    
</div>


<div class="contain container-6">
	<img alt="" class="img-fix img-left-fixed" src="<?=DIR?>assets/img/page2016/img-left-fixed.png">
	<div class="row-content-1">
        <div class="col col-left background img-lazy" data-src="/assets/img/page2016/img-left.jpg">
            <h3>ils nous ont fait confiance</h3>
            <a href="<?= DIR.'confiance'?>">en savoir plus</a>
        </div>    
        <div class="col col-right background img-lazy" data-src="/assets/img/page2016/img-right.jpg">
            <h3>UN PEU DE CULTURE... Fête hmong au Laos</h3>
            <a href="<?=DIR.'actualites'?>">en savoir plus</a>
        </div>
    </div>    
    <div class="row-content row-content-2">
        <div class="col col-left">
            <div class="video-content-1 video-content active">
                <h3>En famille dans le <br>Nord du Vietnam
</h3>
                <div class="text">
                    <p>Entre paysages à couper le souffle et rencontres inoubliables, le Vietnam est l'une des destinations parfaites pour un voyage un famille. 
</p>
                </div>
            </div>

            <div class="video-content-2 video-content">
                <h3>Sur les bords du lac de Thac Ba</h3>
                <div class="text">
                    <p>Sérénité. Nature. Rencontre.<p>
                    <p>Parsemé de centaines d’îlots en forme de bols renversés et recouvert d’une végétation dense, le lac Thac Ba dégage sans effort une ambiance de premier matin du monde. 
</p>
                </div>
            </div>
            <div class="video-content-3 video-content">
                <h3>Chez l'habitant à <br>Ha Giang (Vietnam)</h3>
                <div class="text">
                    <p>Vous pénètrerez dans un village à peindre entouré de rizières ondulantes, avec en toile de fond les dentelures insolites des montagnes karstiques typiques.
</p>
                </div>
            </div>
            <div class="video-content-4 video-content">
                <h3>Kampot (Cambodge)</h3>
                <div class="text">
                    <p>Ville côtière particulièrement charmante, proche de l’embouchure de la rivière du même nom et tournée vers la mer et le couchant, Kampot séduit les voyageurs par son atmosphère d’ancienne ville provinciale. 
</p>
                </div>
            </div>
            
        </div>    
        <div class="col col-right">
           
            <video width="627" height="353" preload="yes" id="video" loop autoplay controls="true" muted src="/uploads/files/family 960x540.mp4" type="video/mp4" poster="<?=DIR?>upload/home/video/poster-family.jpg">
                <!-- <source src="<?=DIR?>uploads/files/sur-les-bords-du-lac-de-thac-ba.mp4" type="video/mp4"> -->
                
                Your browser does not support the video tag.
          </video>
          <div class="list-video">
                <div class="video-item active" data-poster="<?=DIR?>upload/home/video/poster-family.jpg" data-video="/uploads/files/family 960x540.mp4">
                    <img alt="" src="<?=DIR?>upload/home/video/voyage en famille.jpg?v=1">
                    <p class="caption">En famille dans le Nord du Vietnam</p>
                </div>
                <div class="video-item " data-poster= "<?=DIR?>upload/home/video/poster-thac-ba.jpg" data-video="/uploads/files/thacba 960x540.mp4">
                    <img alt="" src="<?=DIR?>upload/home/video/thac-ba-thumb.jpg">
                    <p class="caption">Sur les bords du lac de Thac Ba (Vietnam)</p>
                </div>    
                <div class="video-item" data-poster="<?=DIR?>upload/home/video/poster-hagiang.jpg" data-video="/uploads/files/hathanh 960x540.mp4">
                    <img alt="" src="<?=DIR?>upload/home/video/video-1.jpg">
                    <p class="caption">Chez l'habitant à Ha Giang (Vietnam)</p>
                </div>
                <div class="video-item" data-poster="<?=DIR?>upload/home/video/poster-cambodge.jpg" data-video="/uploads/files/kampot960x540.mp4">
                    <img alt="" src="<?=DIR?>upload/home/video/video-2.jpg">
                    <p class="caption">Kampot (Cambodge)</p>
                </div>
                
          </div>
        </div>
    </div>    
	 <img alt="" class="img-fix img-right-fixed" src="<?=DIR?>assets/img/page2016/img-right-fixed.png">
</div>
<?php
$js=<<<JS
$(document).ready(function(){
   $('#homeCarousel').carousel({
        interval: 5000, //changes the speed
        auto: false,       
    });
});
$('.video-item').click(function(){
    var source = $(this).data('video');
    var poster = $(this).data('poster');
    var index = $(this).index();
    $('.video-item').removeClass('active');
    $(this).addClass('active');
    $('.video-content').fadeOut(200);
    $('.video-content:eq('+index+')').fadeIn(1000);
    var video = document.getElementById('video');
    video.src = source;
    video.poster = poster;
    video.load();
    video.play();
});
$('.inspiration-bxslider').bxSlider({
  minSlides: 1,
  maxSlides: 3,
  moveSlides: 1,
  slideWidth: 301,
  slideMargin: 18.5,
  //pager: false,
  infiniteLoop: true,
  responsive: true,
  // hideControlOnEnd: true
});
        
       $('.container-2 .col-left li .item').hover(function() {
           var name = $(this).attr('data-name');
            var src = $('.container-2 .col-right .change-image #' + name).attr('data-src');    
                $('.container-2 .col-right .change-image #' + name).attr('src', src);
                $('.container-2 .col-right .change-image #' + name).toggleClass('active');
				$('.container-2 .col-right .change-image .fix').toggleClass('active');
        })         
      
        $('.map ul li').click(function(){
           $('.map ul li').removeClass('active');     
           $(this).addClass('active'); 
        });
                
//Jquery Video AutoPlay
    $(document).ready(function() {
            // Get media - with autoplay disabled (audio or video)
            var media = $('video').not("[autoplay='autoplay']");
            var tolerancePixel = 40;

            function checkMedia(){
                // Get current browser top and bottom
                var scrollTop = $(window).scrollTop() + tolerancePixel;
                var scrollBottom = $(window).scrollTop() + $(window).height() - tolerancePixel;

                media.each(function(index, el) {
                    var yTopMedia = $(this).offset().top;
                    var yBottomMedia = $(this).height() + yTopMedia;

                    if(scrollTop < yBottomMedia && scrollBottom > yTopMedia){ //view explaination in `In brief` section above
                        $(this).get(0).play();
                         
                    } else {
                        $(this).get(0).pause();
                    }
                });

                //}
            }
            $(document).on('scroll', checkMedia);
        });
//End Video    

JS;


$this->registerJs($js,  yii\web\View::POS_END);
?>