
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]);
?>
<?php $this->registerCssFile('/assets/css/mobile/nos-desinations-visiter.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content banner">
            <? if(!empty($theEntry->photosArray['banner'])){
                    $v = $theEntry->photosArray['banner'][0];
                    
             ?>
             <img
                 alt=""
    data-src="<?= $v->image?>" 
    data-srcset="/thumb/600/400/1/80<?= $v->image?> 450w, /thumb/900/0/1/80<?= $v->image?>"
    data-sizes="auto"
    class="banner-img lazyload" />
                <? } ?>
            <div class="text-on-banner">
                <h1><?=$theEntry->model->seo->h1 ?></h1>
                <span class="space space-30"></span>
                <div class="quick-search">
                    <? 
                    $optDes = \yii\helpers\ArrayHelper::map($list_item, 'slug', 'title');
                    $data = \yii\helpers\ArrayHelper::getColumn($list_item, function($element){
    return ['id' => $element->id, 'text' => $element->title];
});
                    ?>


                    <?= \yii\helpers\Html::dropDownList('search_destination', null, [],[
                        'class' => 'select2 visiter-search',
                        'multiple' => 'multiple',
                        'data-role' => 'none',
                        'id'    => 'search-destination'
                    ]) ?>
                                    </div>
            </div>            
        </div>
        
        <div class="row-content aide">
            <h2 class="title-row">Trouvez les questions / réponses par thématique</h2>
            <ul class="region-content ">
                
                            <? foreach ($theEntries as $key => $value) : ?>
                                        <li>
                                            <a href="<?=$value->slug ?>" class=" tt-latolatin-bold tt-fontsize-32">
                                           <?php
                                                if(!empty($value->photos)){
                                                    foreach ($value->photos as $v) {
                                                        if($v->type == 'icon'){
                                             ?>
                                                <img data-src="<?=$v->image ?>" alt="<?=$v->description ?>">
                                                <? }}}else{ ?>
                                                <img alt="" data-src="<?= DIR?>assets/img/page2016/img_item_icon_faq.png">
                                                <? } ?>
                                            <h3 class="no-margin tt-fontsize-32 tt-latolatin-bold"><?=$value->title; ?></h3>
                                        </a>
                                        </li>
                                <? endforeach; ?>
            </ul>

        </div>

        <div class="row-content full-width raisons">
            <h2 class="tt tt-latolatin-bold tt-fontsize-40 tt-color-e65925">Questions les plus fréquentes</h2>
            <ul>
                <? 
                    $cnt = 0;
                   $count = count($list_item); 
                   foreach($list_item as $value) : 

                           $cnt ++;   
                           if($cnt == 1){
                               $i = 30;
                           }else if($cnt == 2){
                               $i = 31;
                           }else if($cnt == 3){
                               $i = 33;
                           }
                   ?>
            <li><a class="tt-latolatin-regular tt-fontsize-32" href="<?=DIR.$value->slug?>"><?= $cnt?>. <?= $value->model->title?></a></li>
            <? endforeach; ?>

            

        </ul>
        </div>
        
    </div>
</div>
<!-- Start of second page -->

<? 
if (!function_exists('json_esc')) {
    function json_esc($input, $esc_html = true) {
        $result = '';
        if (!is_string($input)) {
            $input = (string) $input;
        }

        $conv = array("\x08" => '\\b', "\t" => '\\t', "\n" => '\\n', "\f" => '\\f', "\r" => '\\r', '"' => '\\"', "'" => "\\'", '\\' => '\\\\');
        if ($esc_html) {
            $conv['<'] = '\\u003C';
            $conv['>'] = '\\u003E';
        }

        for ($i = 0, $len = strlen($input); $i < $len; $i++) {
            if (isset($conv[$input[$i]])) {
                $result .= $conv[$input[$i]];
            }
            else if ($input[$i] < ' ') {
                $result .= sprintf('\\u%04x', ord($input[$i]));
            }
            else {
                $result .= $input[$i];
            }
        }

        return $result;
    }
}

$country = SEG1;
$uri = URI;
$data = \yii\helpers\ArrayHelper::getColumn($list_item, function($element){
    return ['id' =>  $element->slug, 'text' => $element->title];
});
$data =  json_esc(json_encode($data));
$js = <<< JS

$('.select2').select2({
    placeholder: 'Tapez un mot clé ou une question ...',
    dropdownCssClass : "visiter-search",
    data: jQuery.parseJSON('$data'),
    language: {
        noResults: function (params) {
          return "Pas de résultat";
        }
      },
    width: '100vw'
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
    $('.reset-input').on('click',function(){
        $(this).remove();
    });
})

JS;
$this->registerJs($js); 
$css = <<<CSS
.aide ul, .raisons ul{
    padding: 0;
    margin: 0;
}
.aide ul li, .raisons ul li{
    list-style: none;
    margin-bottom: 2.5rem;
}
.aide ul li h3{
    display: inline-block;
    margin: 0;
}
.aide ul li img{
    width: 4rem;
    margin-right: 1.5rem;
}
.aide  .title-row{
    margin-bottom: 2.5rem;
}
.raisons ul li {
    margin-bottom: 1.5rem;
}
.raisons{
    background: #ededed;
    padding: 0 4vmin 2.5rem;
    display: inline-block;
    width: 100vw;

}
.raisons h2{
    margin: 2.5rem 0;
}

@media only screen and (orientation:portrait){
    .quick-search .select2-container--default .select2-search--inline .select2-search__field{
    margin-left: 11vw;
    width: 76vw !important;
}
.quick-search .select2-container--default .select2-selection--multiple{
    background-position:  5vw 45%;
}
}
CSS;
$this->registerCss($css);
?>