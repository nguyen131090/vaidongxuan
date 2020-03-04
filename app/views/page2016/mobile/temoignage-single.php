
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/mobile/confiance.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content content-page tt-fontsize-32">
            <h1 class="tt-latolatin-bold tt-fontsize-45 tt-color-e65925"><?=$theEntry->model->seo->h1 ?></h1>
            <ul class="gro-info">
                <? if(isset($theEntry->data->from) && isset($theEntry->data->to)) : ?>
                <li class="calendar">
                    <img data-src="/assets/img/page2016/icon_time.png" alt="">
                    <?= date('d/m/Y',strtotime($theEntry->data->from)) .' - '. date('d/m/Y',strtotime($theEntry->data->to)) ?>
                </li>
                <? endif; ?>
                <li class="posi">
                    <img data-src="/assets/img/page2016/posi.png" alt="">
                    <? if(isset($theEntry->data->countries)) : ?>
                    <? $countries = $theEntry->data->countries; ?>
                    <? foreach ($countries as $key => $value) {
                        echo Yii::$app->params['tsDestinationList'][$value];
                        if($key==count($countries)-1) break;
                        echo ", ";
                    } ?>
                <? endif;?> 
                </li>
                <li class="contact">
                    <img data-src="/assets/img/page2016/icon-mail.png" alt="">
                    <span class="email">
                    <?= isset($theEntry->data->emailclient) ? $theEntry->data->emailclient : ''?></span><span class="text-contact">Contact</span>
                </li>
            </ul>
            <div class="list-posi tt-fontsize-32">
                <span class="tt-fontsize-32 tt-latolatin-regular">Son itinéraire en bref</span>
                <?= isset($theEntry->data->itinerary) ? '<p class=" tt-latolatin-regular tt-fontsize-32">'.$theEntry->data->itinerary.'</p>' : ''?>
            </div>
            <div class="content">
                <?= $theEntry->model->description?>
            </div>
            <div class="contain container-6 contain-background-ededed full-width">
                <div class="column">
                    <span class="space space-50"></span>
                    <p class="tt-custom">Besoin d’inspiration</p>
                    <span class="space space-50"></span>
                    <p data-title="<?= base64_encode(DIR.'devis') ?>" class="pugjd btn-link btn-link-1 tt-title tt-fontsize-32 tt-latolatin-bold tt-color-e65925 ui-link" data-ajax="false"><span>Faites-nous savoir vos attentes</span></p>
                    <span class="space space-50"></span>
                </div>
            </div>
        </div>
        <span class="space space-60"></span>
<?php
include(dirname(__FILE__).'/_inc_back_button.php');
?>
    </div>

    
</div>
<? 
$country = SEG1;
$uri = URI;
$js = <<< JS
$('li.contact').click(function(){
    $(this).addClass('active');
});
JS;
$this->registerJs($js); 
$css = <<<CSS
.content-page h1{
    margin-bottom: 2.5rem;
}
.contain-background-ededed {
    background: #ededed;
}
.container-6 .tt-custom {
    font-family: "Grand Hotel",sans-serif;
    font-size: 2.75rem;
    line-height: 3rem;
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
.content{
    margin-bottom: 2.5rem;
}
.content img{
    width: 100% !important;
    height: auto !important;
    margin-bottom: 1rem;
}
.gro-info li{
    font: 1.3rem LatoLatin-Regular,sans-serif;

}
.content img[src*='ngoac_kep.png']{
    display: none;
}
.content img[data-cfsrc*='ngoac_kep.png']{
    display: none;
}
.content-page {
    margin: 2.5rem 0 0;
}
.gro-info{
    margin: 0;
    padding: 0;
}
.gro-info li{
    display: flex;
    align-items: center;
    list-style: none;
    margin-bottom: 1.5rem;
}
.gro-info li img{
    width: 2rem;
    margin-right: 1rem;
}
.gro-info li.contact .email{
    display: none;
}
.gro-info li.contact.active .email{
    display: inline-block;
}
.gro-info li.contact.active .text-contact{
    display: none;
}
.list-posi span{
    position: relative;
    display: flex;
    align-items: center;
}
.list-posi {
    padding: 1rem 1rem 2.5rem;
    background: #ededed;
    margin: 1rem 0 2rem ;
    display: inline-block;
}
.list-posi span:before {
    content: '';
    display: inline-block;
    background: url(/assets/img/page2016/icon_tt_program.png) 0 center no-repeat;
    width: 4rem;
    height: 4rem;
    background-size: 4rem;
    margin-right: 1.5rem;
}
.list-posi p{
    margin: 1rem 0 0;
}
CSS;
$this->registerCss($css);
?>
