
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/mobile/confiance.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content banner full-width">
             <img
                 alt=""    
    data-src="<?=DIR?>upload/image/banner_club_ami.jpg" 
    data-srcset="/thumb/600/400/1/80<?=DIR?>upload/image/banner_club_ami.jpg 450w, <?=DIR?>upload/image/banner_club_ami.jpg"
    data-sizes="auto"
    class="banner-img lazyload" />
            <div class="text-on-banner">
                <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-white"><?=$theEntry->model->seo->h1 ? $theEntry->model->seo->h1 : $theEntry->title ?></h1>
                <span data-title="<?= base64_encode(DIR.'nous-contacter') ?>" class="pugjd btn-testi-filter tt-latolatin-bold tt-fontsize-32 ui-link tt-color-white">Contactez-nous</span>
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32">
            <p>Le Club Ami Amica est l’espace regroupant tous les anciens clients d’Amica Travel,
qu’ils soient titulaires ou non d’une carte de membre.
            </p>
            <div class="text-slider text-slider-1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide-80 item">
                        <p class="tt">Ancien client</p>
                        <p>
Toute personne ayant acheté un circuit touristique auprès d’Amica Travel, quelque soit la durée, et l’ayant réalisé.
                        </p>
                    </div>
                    <div class="swiper-slide swiper-slide-80 item">
                        <p class="tt">Parrain</p>
                        <p>
                            Tout ancien client qui recommande les services d’Amica Travel à une tierce personne seule ou à un groupe de voyageurs.
                        </p>
                    </div>
                    <div class="swiper-slide swiper-slide-80 item">
                        <p class="tt">Filleul</p>
                        <p>
                            Personne seule ou groupe de voyageurs parrainé par un ancien client.
                        </p>
                    </div>
                </div>
            </div>
            <h2 class="tt tt-fontsize-40 tt-latolatin-bold">Avantages pour les anciens clients</h2>
            <p>
                    a) Tout ancien client profite d’une remise immédiate de 5% sur son prochain voyage avec Amica Travel. Cette remise s’applique également aux personnes qui voyagent avec lui.
    </p>
    <p>
    b) Chaque ancien client peut en outre parrainer des groupes de voyageurs et obtient, pour chaque groupe parrainé, deux dotations suivantes :

                </p>
            <div class="r r-2">
                <p class="t-top"><span class="numb">1</span> <span class="fix-color">Un cadeau parmi les  <font color="#e65925">4 choix suivants</font></span> :</p>
                <div class="text-slider text-slider-2">
                    <div class="swiper-wrapper">
                    <div class="swiper-slide item item-1">
                        <img alt="" class="lazyload img-responsive" data-src="<?=DIR?>upload/club-ami/projet-humanitaire-partenaire.jpg">
                        <p class="t tt-latolatin-regular tt-fontsize-32">Un don de 30 € pour un projet humanitaire partenaire</p>
                    </div>
                    
                    <div class=" swiper-slide item item-2">
                        <img alt="" class="lazyload img-responsive" data-src="<?=DIR?>upload/club-ami/dvd-vietnam-de-christian-verot.jpg">
                        <p class="t tt-latolatin-regular tt-fontsize-32">Le DVD Vietnam de<br> Christian VEROT</p>
                    </div>
                    <div class=" swiper-slide item item-3">
                        <img alt="" class="lazyload img-responsive" data-src="<?=DIR?>upload/image/img_club_ami_2.jpg">
                        <p class="t tt-latolatin-regular tt-fontsize-32">Le livre Vietnam de<br> Christian VEROT<br> (uniquement en France)</p>
                    </div>
                    <div class="swiper-slide item item-4">
                        <img alt="" class="lazyload img-responsive" data-src="<?=DIR?>upload/club-ami/un-cheque-cadeau-amazon.jpg">
                        <p class="t tt-latolatin-regular tt-fontsize-32">Un chèque cadeau<br> Amazon.fr de 30 €</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="r r-3">
                <p class="t-top"><span class="numb">2</span> Un crédit sur un prochain voyage avec Amica Travel,<br>
en fonction de la taille du groupe parrainé et de la durée du circuit acheté par ce dernier :</p>
                <div class="list-table">
                <table cellspacing="0"  class="item item-1">
                    <tr>
                        <th style="width: 40vw;">Durée du circuit (J)<br>Taille du groupe (P)</th>
                         <th>DE 4 À 9J</th>
                         <th>DE 10 À 20J</th>
                         <th>Plus de 20j</th>
                    </tr>
                    <tr>
                        <td>De 1 à 4 personnes</td>
                         <td>30 €</td>
                         <td>45 €</td>
                         <td>65 €</td>
                    </tr>
                     <tr>
                        <td>De 5 à 8 personnes</td>
                        <td>45 €</td>    
                        <td>60 €</td>
                        <td>85 €</td>
                    </tr>
                     <tr>
                        <td>De 9 à 12 personnes</td>
                        <td>65 €</td>
                        <td>80 €</td>
                        <td>100 €</td>
                    </tr>
                     <tr>
                        <td>Plus de 12 personnes</td>
                        <td>95 €</td>
                        <td>110 €</td>
                        <td>125 €</td>
                    </tr>
                </table>
                </div>
            </div>
            <div class="rows row-3">
                <div class="text">
                    <h2 class="tt tt-fontsize-40 tt-latolatin-bold">Avantages pour les filleuls</h2>
                    <p>Tout groupe de voyageurs ou toute personne seule qui achète un circuit touristique d’une durée égale ou supérieure à 4 jours auprès d’Amica Travel sur recommandation d’un ancien client bénéficie d’une remise de 5% sur le montant total du prix de son circuit.</p>

                    <a class="" href="/uploads/files/conditions-du-club-ami-amica.pdf">Conditions générales d’application des avantages du Club Ami Amica</a>
                </div>    
            </div>


        </div>
        
    </div>
</div>
<div class="contain container-6 contain-background-ededed">
    <div class="column">
        <span class="space space-50"></span>
        <p class="tt-custom">Pour aller plus loin</p>
        <span class="space space-50"></span>
        <a href="/temoignages" class="btn-link btn-link-1 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925 ui-link" data-ajax="false"><span>Témoignages de nos anciens clients</span></a>
        <span class="space space-80"></span>
    </div>
</div>
<? 
$country = SEG1;
$uri = URI;
$js = <<< JS

var textSwiper = new Swiper('.text-slider', {
        slidesPerView: 'auto',
        centeredSlides: false,
        paginationClickable: true,
        spaceBetween: 20,
        loop: false,
        onReachBeginning: function(swiper){
             swiper.params.centeredSlides = false;
            swiper.params.initialSlide = 0;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },
        onReachEnd: function(swiper){
             swiper.params.centeredSlides = false;
             swiper.params.initialSlide = swiper.slides.length - 1;
            swiper.init();
            swiper.params.centeredSlides = true;
            swiper.update();
        },
    });

$(document).ready(function(){
    var heights = $(".text-slider-1 .swiper-slide").map(function ()
    {
        return $(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);
    $(".text-slider-1 .swiper-slide").height(maxHeight+'px');
});

JS;
$this->registerJs($js); 
$css = <<<CSS
.btn-testi-filter{
    margin: 1rem 0 2rem;
}
.content-page{
    font: 1.6rem LatoLatin-Regular,sans-serif;
}
.content-page .tt{
    font: 2rem LatoLatin-Bold,sans-serif;
    color: #000000;
    margin: 2.5rem 0 1.5rem;
}
.btn-testi-filter{
    width: 92vw;
    margin-left: 4vw;
}
.banner .text-on-banner{
    padding: 2.5rem 0 0;
}
.text-slider{
    margin: 2.5rem 0;
}
.text-slider .swiper-slide{
    width: 80%;
}
.text-slider-1 .swiper-slide{
    background: #ededed;
    padding: 0 1rem 1.5rem;
}
.text-slider-1 .tt{
    margin: 2.5rem 0 1rem;
}
.content-page table  th, .content-page table  td {
    text-align: center;
    padding: 10px 0;
    border: 1px solid #ccc;
    font-size: 1.4rem;
}
.content-page table{
    display: inline-block !important;
    float: left;
}
.content-page .list-table{
    width: 100%;
    display: inline-block;
}
.content-page .list-table table:not(:first-of-type){
    width: 17vw;
}
.content-page .list-table table th {
    color: white;
    font: 1.4rem 'LatoLatin-Bold',sans-serif;
    background-color: #da521f;
    padding: 5px 0;
    height: 56px;
    text-transform: lowercase;
    width: 17vw;
}
.content-page .list-table table th:first-letter {
    text-transform: uppercase;
}
.content-page  .t-top .numb {
        width: 3rem;
    height: 3rem;
    border: 2px solid #da521f;
    line-height: 34px;
    border-radius: 100%;
    display: flex;
    margin-right: 10px;
    float: left;
    align-items: center;
    justify-content: center;
    min-width: 3rem;
}
.text-slider-2{
    margin: 0.5rem 0;
}
.text-slider-2 .t{
    margin-bottom: 0;
}
.content-page .t-top{
        display: inline-flex;
    margin: 2rem 0;
    align-items: flex-start;
}
.content-page .row-3 .tt{
    margin-top: 4rem;
}
.content-page .row-3 a{
       color: #e65925;
    font: 1.6rem LatoLatin-Bold,sans-serif;
        display: flex;
    align-items: flex-start;
    margin: 2rem 0 2.5rem;
}

.contain-background-ededed {
    background: #ededed;
}
.container-6 .tt-custom {
    font-family: "Grand Hotel",sans-serif;
    font-size: 8.59375vmin;
    line-height: 9.59375vmin;
    margin: 0;
    color: black;
    text-align: center;
}
.container-6 .btn-link {
    border-radius: 3rem;
    border: 0.1rem #e65925 solid;
    margin: 0;
    width: 100%;
    clear: left;
    height: 4.7rem;
    display: table;
}
.container-6 .btn-link span {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    padding: 0 2rem;
}

@media only screen and (orientation:landscape){
    .content-page .list-table table{
        width: auto !important;
    }
    .content-page .list-table table th, .content-page .list-table table td{
        padding: 10px 1rem;
    }
    .text-slider .swiper-slide{
        width: 45%;
    }
}
CSS;
$this->registerCss($css);
?>
