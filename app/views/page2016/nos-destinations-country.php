<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile(DIR . 'assets/css/page2016/animate.css/animate.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile(DIR . 'assets/js/chosen/chosen.jquery.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);  ?>
<? $this->registerJsFile(DIR . 'assets/js/scroll-animated.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 

$this->registerCssFile(DIR . 'assets/js/chosen/chosen.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]); ?>
 
<div class="contain container-1">
    <? if(isset($theEntry->model->photos)) : ?>
    <? 
    $banner = '';
    foreach ($theEntry->model->photos as $key => $value) {
        if($value->type == 'banner') $banner = $value; 
    } ?>
        <?php if(isset($banner->description) == true): ?>
            <img style="width: 100%;" alt="<?= $banner->description; ?>" class="img-lazy" data-src='<?= $banner->image ?>'>
        <?php endif;?>
    <? endif; ?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>   
    <div class="column row-2">
        <h1 class="title"><?=$theEntry->model->seo->h1 ?></h1>
    </div>
</div>
<div class="area-search-menu container-flud">
    <div class="column">    
        <div class="group-search">
            <form class="search-form search-form search-prog-form">
                <div class="cs-select search-envies search-type une-envie">
                    <div class="icon-envies"></div>
                    <span class="cs-placeholder">Type de voyage<b></b></span>
                    <div class="cs-options">
                        <ul>
                            <? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                            <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?></li>
                        <? endforeach ?>
                    </ul>

                </div>
                <div class="list-option">
                    <ul>
                       <? foreach ($type as $key => $value) : ?>
                       <li data-value="<?=$value->category_id ?>"><?=$value->title ?><span></span></li>
                        <? endforeach ?>
                    </ul>    
                </div>

           </div>
           <div class="cs-select search-form une-envie search-length">
                        <div class="icon-length"></div>
                        <span class="cs-placeholder">Durée<b></b></span>
                        <div class="cs-options">
                                <ul>
                                    <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                                       <li data-option="" data-value="<?=$key?>"><?=$value ?></li>
                                    <? endforeach; ?>
                                     
                                </ul>
                        </div>
                        <div class="list-option">
                            <ul>
                                <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                                       <li data-option="" data-value="<?=$key?>"><?=$value ?><span></span></li>
                                    <? endforeach; ?>
                            </ul>    
                        </div>

                </div>

           <div class="cs-select submit">
            <?=$countVnTours ?> <?=$countVnTours > 1 ? 'VOYAGES' : 'VOYAGE' ?>
        </div>
        </form>
        </div>  
    </div>  
</div>
<div class="container-flud menu-tab">
    <div class="column">
        <ul>
            <li class="active"><a href="#">Voyage au Vietnam</a></li>
            <li><a href="#">Idées de voyage</a></li>
            <li><a href="#">Formules exclusives</a></li>
            <li><a href="#">Sites à visiter</a></li>
            <li><a href="#">Infos pratiques</a></li>
            <li><a href="#">Guide culturel</a></li>
        </ul>
    </div>
</div>
<div class="entry-body container-flud">
    <div class="contain container-3 column country-tours">
        <h2 class="title-tours">QUE VOIR & QUE FAIRE AU VIETNAM</h2>
           <p class="text-tours"> L’intérêt d’un voyage au Vietnam c’est que les combinaisons sont nombreuses. Vous avez à votre disposition une palette de sites, d’hébergements, d’activités pour y piocher au gré de vos envies.</p>
<p class="text-tours">
Du Nord au Sud, de Hanoi à la baie d’Along via Hoi An jusqu’au delta du Mékong, vous découvrez toutes les facettes du pays via l’alternance de sites incontournables et d’autres inédits. Pour aller à la découverte plus profonde des peuples vietnamiens, nous proposons des rencontres et d’immersions exclusives dans l’extrême Nord où vous découvrez Bac Ha, Mu Cang Chai ou Ha Giang avec leurs ethnies et leurs marchés multicolores. Pour ceux qui cherchent à la fin du voyage des pauses balnéaires, le côté du Centre ou du Sud avec Danang, Hoi An, Phu Quoc vous ne feront jamais déçus. 

           </p>

            <ul class="tous-slider">
                <li>
                <? foreach($tourType as $key=> $value) : ?>
                    <? 
                    $class = '';
                    if($key < 4) {
                        if($key % 2 == 0) $class = 'slideInLeft'; else  $class = 'slideInRight';
                    }
                    ?>
                    <div class="item-img revealOnScroll animated" data-animation="<?=$class?>" >
                    <a href="<?=DIR.$value->slug ?>">
                        <? $i = ''; ?>
                                    <? foreach ($value->photos as $kp => $vp) : ?>
                                        <? if($vp->type == 'summary')
                                                    $i = $kp; ?>
                                    <? endforeach; ?>
                            <img width="460" height="281" alt="<?=$value->photos[$i]->description?>" data-src="<?=$value->photos[$i]->image?>" class="img-lazy lazyload"/>
                        <div class="text-on-img">
                        <p><?=$value->title?></p>
                        <p class="btn">En savoir plus</p>
                        </div>
                        <div class="text-slide">
                            <div class="bottom-block">
                                <span class="title-hover"><?=$value->title?></span>
                                <p><?=$value->description?></p>
                                <span class="btn">en savoir plus</span>
                            </div>
                        </div>            
                    </a>
                    </div>
                <? if($key == 3) echo "</li><li>"; ?>

                <? endforeach; ?>
                </li>
            </ul>
    </div>
    <div class="column pourquoi">
        <h2 class="title-pourquoi">POURQUOI NOUS CHOISIR POUR VOTRE 
VOYAGE AU VIETNAM</h2>   
        <p class="text">Depuis 2007, ce sont plus de 15 000 voyageurs qui sont partis avec nous à la découverte du Vietnam à travers de beaux circuits sur mesure, riches, axés sur la culture, les paysages et les rencontres avec la population locale.</p> 
        <div class="detail">
            <div class="item-detail">
                <img alt="" class="img-lazy" data-src='/assets/img/new-pays/pourquoi-1.png'/>
                <span>Équipe locale &<br>passionnée au Vietnam</span>
            </div>
            <div class="item-detail">
                <img alt="" class="img-lazy" data-src='/assets/img/new-pays/pourquoi-2.png'/>
                <span>Créativité &<br>originalité</span>
            </div>
            <div class="item-detail">
                <img alt="" class="img-lazy" data-src='/assets/img/new-pays/pourquoi-3.png'/>
                <span>Engagement vers<br>un tourisme solidaire</span>
            </div>
        </div>
        <div class="btn-pourquoi">
            <p>
                <span>Notre conseiller(ere) vous repondra sous 48H</span>
                <a href="/devis">DEMANDER UN DEVIS</a>
            </p>
        </div>
    </div>
    <div class="column secrets">
        <img alt="" class="img-lazy fammer" data-src="/assets/img/new-home/img-right-fixed.png">
        <h2>nos secrets d’ailleurs au vietnam</h2>
        <p class="text">Découvrez les sites hors des sentiers battus, les hébergements de charme, les personnalités exceptionnelles - artisans, les artistes - dont le talent et les activités n’attendent qu’à être découverts et partagés </p>
        <ul class="secret-slider">
            
                <? foreach($secretType as $key=> $value) : ?>
                    <? switch ($key) {
                                case 0:
                                    $class = 'slideInLeft';
                                    break;
                                case 1:
                                    $class = 'slideInUp';
                                    break;
                                case 2:
                                    $class = 'slideInRight';
                                    break;
                                default:
                                    $class = '';
                            } ?>
                    <li>
                    <div class="item-img revealOnScroll animated " data-animation="<?=$class?>">
                    <a href="<?=DIR.$value->slug ?>">
                        <? $i = ''; ?>
                                    <? foreach ($value->photos as $kp => $vp) : ?>
                                        <? if($vp->type == 'summary')
                                                    $i = $kp; ?>
                                    <? endforeach; ?>
                            <img width="299" height="325" alt="<?=$value->photos[$i]->description?>" data-src="<?=$value->photos[$i]->image?>" class="img-lazy lazyload"/>
                        <p class="text-on-img"><?=$value->title?></p>
                        <div class="text-slide">
                            <div class="bottom-block">
                                <span class="title-hover"><?=$value->title?></span>
                                <p><?=strip_tags($value->description)?></p>
                                <span class="btn">en savoir plus</span>
                            </div>
                        </div>            
                    </a>
                    </div>
                    </li>
                <? endforeach; ?>
        </ul>
    </div>
    <div class="column preparer-voyage">
        <h2>PRÉPARER VOTRE VOYAGE AU VIETNAM</h2>
        <p class="text">De multiples questions peuvent en effet se poser concernant le choix de la meilleure formule, de la meilleure période, du meilleur itinéraire...</p>
        <a class="link-item-preparer" href="#">
        <div class="item-preparer">
            <div class="img">
            <img alt="" class="img-lazy" data-src="/assets/img/new-pays/preparer-item-1.png">
            </div>
            <p class="big-text">QUAND PARTIR AU VIETNAM ?</p>
            <p>Il y a de bonnes et de moins bonnes périodes pour visiter le Vietnam, mais il n’y a pas de périodes impossibles. Découvrez-le avec nous</p>
        </div>
        </a>
        <a class="link-item-preparer" href="#">
        <div class="item-preparer">
            <div class="img">
            <img alt="" class="img-lazy" data-src="/assets/img/new-pays/preparer-item-2.png">
            </div>
            <p class="big-text">trouver ses billets d’avion
pour le vietnam</p>
            <p>Retrouvez ici nos astuces pour payer un billet d’avion moins cher pour le Vietnam.</p>
        </div>
        </a>
        <a class="link-item-preparer" href="#">
        <div class="item-preparer">
            <div class="img">
            <img alt="" class="img-lazy" data-src="/assets/img/new-pays/preparer-item-3.png">
            </div>
            <p class="big-text">visa pour le vietnam</p>
            <p>Pour tous les voyageurs qui atterrissent sur le sol vietnamien, le visa est maintenant obligatoire ou non ?</p>
        </div>
        </a>
        <div class="clearfix"></div>
        <a href="https://www.amica-travel.com/vietnam/informations-pratiques" class="voir-toutes">VOIR TOUTES LES INFORMATIONS PRATIQUES SUR LE VIETNAM</a>
        <div class="btn-preparer">
            <div>
                <span>Découvrir les sites à visiter</span>
                 <? $allRoot =  \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter')->items(['pagination' => ['pageSize' => 0]]);
                    $optDes = \yii\helpers\ArrayHelper::map($allRoot, 'slug', 'title');
                    ?>
                <?= \yii\helpers\Html::dropDownList('search_destination', null, $optDes,[
                        'class' => 'chosen',
                        'multiple' => 'multiple', 
                        'data-placeholder' => 'Tapez le nom d’un site (Hanoi, Hoi An...)',
                        'id' => 'search_destination',
                        'style' => 'width: 345px; height: 33px;'
                    ]) ?>
            </div>
        </div>
    </div>
    <div class="container column testi">
            <h2>ILS NOUS ONT FAIT CONFIANCE</h2>
            <div class="">
                <ul class="slider testi-slider ">
                    <li>
                        <a href="/temoignages/2017-04-15-guemour">
                            <p class="text">J'ai aimé mon séjour au Vietnam. Il correspondait à ce que voulais : rencontres, découvertes, émotions. Je me suis sentie plus à l'aise chez l'habitant ou dans les petits hôtels
                            </p>
                            <div class="info">
                                <img class="img-lazy img-info" width="76" height="76" alt="" data-src="/assets/img/new-pays/vietnam/tem/voyage-nord-vietnam-1499161235.jpg">
                                <div class="text-info">
                                    <p>Catherine Guemour</p>
                                    <p>Vietnam</p>
                                    <p>Avril 2017</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/temoignages/2017-05-15-mestre">
                            <p class="text">Je souhaite vivement remercier toute l'équipe de l'agence Amica Travel, pour son travail et l'organisation de notre séjour au Nord Vietnam
                            </p>
                            <div class="info">
                                <img class="img-lazy img-info" width="76" height="76" alt="" data-src="/assets/img/new-pays/vietnam/marche-de-can-cau-sapa-vietnam-1497238924.jpg">
                                <div class="text-info">
                                    <p>Brigitte Mestre</p>
                                    <p>Vietnam</p>
                                    <p>Mai 2017</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/temoignages/2016-10-06-duchene">
                            <p class="text">Nous vous remercions de nous avoir permis de découvrir tant des belles choses lors de notre voyage dans le Delta du Mékong en octobre 2016. Nous en avions les larmes aux yeux au moment du départ.
                            </p>
                            <div class="info">
                                <img class="img-lazy img-info" width="76" height="76" alt="" data-src="/assets/img/new-pays/vietnam/repas-chez-habitant.jpg">
                                <div class="text-info">
                                    <p>Octobre 2016</p>
                                    <p>Vietnam</p>
                                    <p>Octobre 2016 </p>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="logo-pages">
            <span>Merci aux guides de
nous avoir recommandé</span>
                <div class="logos">
                    <span class="trip"><img class="img-lazy" data-src="/assets/img/new-home/trip-logo.png" alt="Tripadvisor"></span>
                    <span class="trip"><img class="img-lazy" data-src="/assets/img/new-home/petit-fute.png" alt="Petit Futé"></span>
                    <span href="#" class="trip"><img class="img-lazy" data-src="/assets/img/new-home/routard-logo.png" alt="Le Routard"></span>
                    <span class="trip"><img class="img-lazy" data-src="/assets/img/new-home/lonely-planet.png" alt="Lonely Planet"></span>
                </div>
            </div>
        </div>

        <div class="column guide-blogs">
            <div class="guide">
                <p><span>GUIDE VIETNAM</span> gratuit</p>
                <img width="299" height="382" class="img-lazy" alt="" data-src="/assets/img/new-pays/guide.jpg">
                <div class="text">
                    <p class="bigger">Quand partir </p>
                    <p class="bigger">Comment </p>
                    <p class="bigger">Combien...</p>
                    <p>Vous trouverez toutes les réponses à vos questions pour préparer votre voyage au Vietnam</p>
                    <form id="download-guide-form">
                        <input class="email" data-pdf="https://www.amica-travel.com/uploads/files/amica-travel-voyage-au-vietnam.pdf" type="text" value="" placeholder="Votre adresse mail" name="email">
                        <p class="error-email">
                            Le format de votre email n'est pas valide.
                        </p>
                        <span class="submit-email">TÉLÉCHARGER</span>
                    </form>
                </div>
            </div>
            <div class="blogs">
                <p>LES ARTICLES DU MOMENT DE NOTRE BLOG</p>
                <div class="item-img item">
                    <a href="https://blog.amica-travel.com/comment-preparer-sejour-bien-etre-vietnam/" target="_blank">
                        <div class="img">
                            <img width="299" height="199" class="img-lazy" alt="" data-src="/assets/img/new-pays/blogs/ile-de-la-baleine-vietnam.jpg">
                            <p>Bons plans</p>
                        </div>
                        <div class="text">
                            <p class="title-item">Comment préparer un séjour bien-être au Vietnam ? </p>
                            <p>Que pensez-vous d'un voyage au Vietnam qui devienne source d'enrichissement culturel tout en étant générateur d'énergie et de bien-être physique ?</p>
                        </div>
                    </a>
                </div> 
                <div class="item-img item">
                    <a href="https://blog.amica-travel.com/le-delta-du-mekong-autrement/" target="_blank">
                        <div class="img">
                            <img width="299" height="199" class="img-lazy" alt="" data-src="/assets/img/new-pays/blogs/delta-mekong-vietnam.jpg">
                            <p>Inspirations</p>
                        </div>
                        <div class="text">
                            <p class="title-item">Découvrez le delta du Mékong autrement </p>
                            <p>Envie de sortir des sentiers battus pour découvrir le Delta du Mékong autrement ? Voici nos suggestions de circuits dans cette région.</p>
                        </div>
                    </a>
                </div>  
                <div class="item-img item">
                    <a href="https://blog.amica-travel.com/banh-xeo-crepe-vietnamienne/" target="_blank">
                        <div class="img">
                            <img width="299" height="199" class="img-lazy" alt="" data-src="/assets/img/new-pays/blogs/banh-xeo-vietnam.jpg">
                            <p>Cuisine</p>
                        </div>
                        <div class="text">
                            <p class="title-item">Connaissez-vous le « Banh xeo », la crêpe vietnamienne ? </p>
                            <p>Lors de votre voyage dans le Sud du Vietnam, ne manquez pas de déguster ce vrai délice dans les stands de rue ou chez l’habitant. </p>
                        </div>
                    </a>
                </div>
                <a class="link-to-blog" href="https://blog.amica-travel.com" target="_blank">Découvrez notre blog</a>   
            </div>
        </div>
        <img alt="" class="img-lazy bored-woman" data-src="/assets/img/new-pays/bored-woman.png">
</div>

<?
$js=<<<JS

$('.search-form .cs-options').off().on('mouseleave', function(){
        return false;
    }); 
$(document).on('click', '.group-search .cs-select.active .cs-placeholder b', function(){
    $('.search-form .cs-select').removeClass('active');  
}); 
$('.chosen').chosen({ search_contains: true});
 $('.chosen-choices input').keyup(function(){
        if(!$(this).val()){
            $('.chosen-drop .chosen-results').hide();
            return false;
        }
        $('.chosen-drop .chosen-results').show();
    });
$('.tous-slider ').bxSlider({
      minSlides: 1,
      maxSlides: 1,
      moveSlides: 1,
      slideWidth: 940,
      pager: false,
      infiniteLoop: true,
      // hideControlOnEnd: true,
    });
$('.secret-slider').bxSlider({
      minSlides: 3,
      maxSlides: 3,
      moveSlides: 1,
      slideWidth: 299,
        pager: false,
      slideMargin: 21.5,
      infiniteLoop: true,
    });
$('.testi-slider').bxSlider({
      minSlides: 3,
      maxSlides: 3,
      moveSlides: 3,
      slideWidth: 313,
      slideMargin: 0,
      pager: false,
      infiniteLoop: true,
      responsive: false,
      // hideControlOnEnd: true
    });  

$('.cs-options ul li').off().on('click',function(){
          var target = $(this);
          target.toggleClass('active');
          var parent = target.closest('form');
          var index = $(this).index();
          $(this).closest('.cs-select').find('.list-option ul li:eq('+index+')').toggleClass('active');
          var des = pr = url = '';
          var desText = typeText = lengthText= '';
          
          
          if(!des) des = 'vietnam';
          var type = '';
          parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              typeText += $(this).text();
              if(index != parent.find('.search-type .list-option .active').length -1){
                type += '-';
                typeText += ', ';
              }
          });
          if(!type) type= 'all';
          var length = '';
            parent.find('.search-length .list-option .active').each(function(index){
                length += $(this).data('value');
                lengthText += $(this).text();
                if(index != parent.find('.search-length .list-option .active').length -1)
                {
                    length += '-';
                    lengthText += ', ';
                }
            })
            if(!length || i ==3) length= 'all';

            if($(this).closest('.search-prog-form').length){
                if(!lengthText) lengthText = 'Durée';
                  $('.search-length .cs-placeholder').text(lengthText).append('<b></b>');

                  if(!typeText) typeText = 'Type de voyage';
                  $('.search-type .cs-placeholder').text(typeText).append('<b></b>');
                pr = {'country': des, 'type': type, 'length': length};
                var url2 = $.param( pr );
                  url = '/amica-fr/get-number-prog';
                  url = url + '?'+url2;
                  searchCountryHome($(this), url);
            }
});

function searchCountryHome(target, url){
        var parent = target.closest('form');
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

$('.cs-select.submit').off().on('click',function(){
          if($(this).hasClass('disable')) return false;
          var target = $(this);
          var des = pr = url = '';
          var parent = target.closest('form')
          if(!des) des = 'vietnam';
          var type = '';
          parent.find('.search-type .list-option .active').each(function(index){
              type += $(this).data('value');
              if(index != parent.find('.search-type .list-option .active').length -1)
                  type += '-';
          })
          if(!type) type= 'all';

          if(parent.hasClass('search-excl-form')){
              pr = {'country': des, 'type': type};
              url = '/secrets-ailleurs/itineraire';
          }

          if(parent.hasClass('search-prog-form')|| parent.hasClass('search-excl-form-home')){
            var length = '';
            var i = 0;
            parent.find('.search-length .list-option .active').each(function(index){
                length += $(this).data('value');
                if(index != parent.find('.search-length .list-option .active').length -1)
                    length += '-';
                i++;
            })
            if(!length || i ==3) length= 'all';
            pr = {'country': des, 'type': type, 'length': length};
            url = '/voyage/itineraire';
          }
          var url2 = decodeURIComponent($.param( pr ));
          url = url + '?'+url2;
          window.location = url;
        });
$('#search_destination').on('change', function(evt, params) {
    window.location = '/'+params.selected;
    return false;
  }); 
$(document).on('mouseover', '.bx-wrapper li .item-img', function(){
        $('.bx-wrapper li .item-img .text-slide').removeClass('active');
        $(this).find('img').addClass('active');    
        $(this).find('.text-slide').addClass('active');
        $(this).find('.text-on-img').hide();
    });
$(document).on('mouseleave', '.bx-wrapper li .item-img', function(){
    $('.bx-wrapper li .item-img img').removeClass('active');  
    $('.bx-wrapper li .item-img .text-slide').removeClass('active');  
     $(this).find('.text-on-img').fadeIn(500);  
});
$('#download-guide-form .email').on('change, focusout',function(){
         var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#download-guide-form .email').val())){
          $('#download-guide-form .email').css({'border' : '1px solid #fbe6df', 'background-color' : '#fbe6df'});
          $('#download-guide-form .error-email').show();
          
        }else{
            $('#download-guide-form .email').css({'border' : 'none', 'background-color' : 'white'});
            $('#download-guide-form .error-email').hide();
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
        $.post(url, { email: $('#download-guide-form .email').val() }, function(data){ 
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
$this->registerJs($js);
?>