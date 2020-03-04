
<?php $this->registerCssFile('/assets/js/mobile/swiper/swiper.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('/assets/js/mobile/swiper/swiper.jquery.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
 <?php $this->registerCssFile('/assets/css/mobile/nos-destinations-country.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<? $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_HEAD]);
?>
<?php $this->registerCssFile('/assets/css/mobile/nos-desinations-visiter.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content aide-single">
            <?if($theEntry->slug == $thechildren->slug){?>
                        <h1 class=" sub-title-page tt tt-fontsize-45 tt-latolatin-bold main-title tt-color-e65925"><?= $theEntry->model->title?></h1>
            <?}else{?>
                <p class=" sub-title-page tt tt-fontsize-45 tt-latolatin-bold main-title  tt-color-e65925"><?= $theEntry->model->title?></p>
            <? } ?>

            <div class="text-content">
                            <? 
                               $cnt = 0;
                               $count = count($theItems); 
                               foreach($theItems as $value) { 
                                   //var_dump($value);exit;
                                    $cnt ++;   
                                    if($cnt == 1){
                                        $i = 30;
                                    }else if($cnt == 2){
                                        $i = 31;
                                    }else if($cnt == 3){
                                        $i = 33;
                                    }
                            ?>



                        <div class="entry entry-<?= $cnt?>" id="<?//= explode('/', $value->slug)[2]?>">
                                
                                <?if($theEntry->slug == $thechildren->slug){?>
                                    <p class="title-content <?= URI == $value->slug ? 'fix-scroll' : '' ?> <?= URI == $value->slug || (URI == $theEntry->slug && $cnt == 1) ? 'active' : ''?>" data-url="<?= $value->slug?>"><span><?= $cnt ?>. <?= $value->model->title?></span></p>
                                
                                <?}else if($theEntry->slug != $thechildren->slug && URI == $value->slug){?>
                                    <h1 class="title-content <?= URI == $value->slug ? 'fix-scroll' : '' ?> <?= URI == $value->slug || (URI == $theEntry->slug && $cnt == 1) ? 'active' : ''?>" data-url="<?= $value->slug?>"><span><?= $cnt ?>. <?= $value->model->title?></span></h1>
                                
                                <?}else{?>    
                                    <p class="title-content <?= URI == $value->slug ? 'fix-scroll' : '' ?> <?= URI == $value->slug || (URI == $theEntry->slug && $cnt == 1) ? 'active' : ''?>" data-url="<?= $value->slug?>"><span><?= $cnt ?>. <?= $value->model->title?></span></p>
                                
                                <? } ?>
                            
                                <div class="text ajaxloadanswer <?= URI == $value->slug || (URI == $theEntry->slug && $cnt == 1) ? 'loaded active' : ''?>">
                                    <div class="getanswer">
                                        <?php 
                                            if(Yii::$app->request->post('slug') != NULL){
                                               echo $value->model->answer;
                                            }else if(URI == $value->slug){
                                               echo $value->model->answer; 
                                            }else if(URI == $theEntry->slug && $cnt == 1){
                                                 echo $value->model->answer; 
                                            }else{
                                                echo '';
                                            }
                               
                                
                                        ?>
                                        
                                    </div>    
                                </div>
                            </div>
                            <?php
                                if($count > $cnt){
                                   echo '<span class="space space-36"></span>';
                                }
                            ?>
                        <? } ?>
                        

                    </div>

        </div>

        <div class="row-content aide">
            <h2 class="title-row">Voir d’autres thématiques questions/réponses</h2>
            <ul class="region-content ">
                
                            <? foreach ($theFive as $key => $value) : ?>
                                        <li>
                                            <a href="/<?=$value->slug ?>" class=" tt-latolatin-bold tt-fontsize-32">
                                            <? if(!empty($value->photosArray['icon'])):
                    $v = $value->photosArray['icon'][0];?>
                                                <img data-src="<?=$v->image ?>" alt="<?=$v->description ?>">
                                            <? endif; ?>
                                            <h3 class="tt-fontsize-32 no-margin tt-latolatin-bold"><?=$value->title; ?></h3>
                                        </a>
                                        </li>
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

$js = <<< JS
var csrfToken = $('meta[name="csrf-token"]').attr("content");         
    $('.title-content').click(function(){
        var hClass = $(this).hasClass('active');
        if(hClass){
            $(this).removeClass('active');
            $(this).parent().children('.text').removeClass('active');
        }else{
        
            $(this).addClass('active');
            $(this).parent().children('.text').addClass('active');
            var slug = $(this).data('url');
        
            var loaded = $(this).parent().children('.text').hasClass('loaded');
            if(!loaded){
                $.ajax({
                        type: "POST",
                        url: '',
                        data: { slug : slug, _csrf : csrfToken},
                        dataType: 'html',
                        context: this,
                        success: function(data){
                            $(this).parent().children('.ajaxloadanswer').addClass('loaded');   
                            var datanew = $($.parseHTML(data)).find(".getanswer");
                             
                            $(this).parent().children('.ajaxloadanswer').html(datanew);

                        },
                         error: function (errormessage) {

                            //do something else
                           // alert(data);

                        }
                });
            }    
        }
        
        
    });    
     // $(window).bind("load", function(){
            var hasClass = $('.title-content').hasClass('fix-scroll');
            if(hasClass){
                $('html, body').animate({
                    scrollTop: $(".title-content.fix-scroll").offset().top
                }, 500);
            }
            
      //  });  
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
.text-content .entry{
    padding: 2.5rem 0;
    border-bottom: 1px solid #ededed;
}
.text-content .entry-1{
    padding-top: 0;
}
.text-content .entry .title-content{
    font: 1.6rem Latolatin-Bold, sans-serif;
    margin: 0;
    position: relative;
}
.text-content .entry .title-content:after{
    content: '';
    display: inline-block;
    width: 3rem;
    height: 2rem;
    background: url(/assets/img/mobile/arrow-up-black.png) center center no-repeat transparent;
    background-size: 3rem;
    position: absolute;
    right: 0;
    top: 50%;
    margin-top: -1rem;
    transform: rotate(180deg);
}
.text-content .entry .title-content >span{
    width: 82vw;
    display: inline-block;
}
.raisons h2{
    margin: 2.5rem 0;
}
.text-content .entry .title-content.active{
    color: #e65925;
}
.text-content .entry .title-content.active:after{
    background-image: url(/assets/img/mobile/back-orange.png);
    width: 2rem;
    height: 4rem;
    background-size: 1.8rem;
    transform: rotate(90deg);
    margin-right: 0.5rem;
    margin-top: -2rem;
}
.text-content .entry .text{
    margin:0;
    font: 1.6rem Latolatin-Regular,sans-serif;
    display: none;
}
.text-content .entry .text.active{
    margin-top: 2.5rem;
    display: block;
}
.text-content ul {
    padding: 0;
    margin: 0;
}
.text-content ul li {
    list-style: none;
}
.text-content ul li::before {
    content: "• ";
    color: #e65925;
    display: inline-block;
    font-size: 2rem;
    margin-right: 1rem;
}
.aide{
    margin-bottom: 1.5rem;
    display: inline-block;
}
.getanswer p{
    font-size: 1.6rem;
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