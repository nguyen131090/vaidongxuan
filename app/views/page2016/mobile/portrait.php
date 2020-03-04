
<? use yii\widgets\Pjax; 
    use yii\helpers\Html;
?>

<?php $this->registerCssFile('/assets/css/mobile/confiance.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<div class="contain container-2 non-area-form">
    <div class="column">
        <div class="row-content banner full-width">
            <? if(isset($theEntry->photosArray['banner'])){
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
                <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-white"><?=$theEntry->model->seo->h1 ? $theEntry->model->seo->h1 : $theEntry->title ?></h1>
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32">
            <?= $theEntry->model->content?>
        </div>
        <div class="ajaxfilter">
            <div class="getcontent">
                <div class="row-content ajax-content-portrait">
                    <? foreach ($portraits as $k => $v) : 
                            ?>
                            <div class="item item-<?=$k+1?>">
                                <a href="<?=DIR.$v->slug?>">
                                     <? if(isset($v->photosArray['summary'])){
                                        $value = $v->photosArray['summary'][0];
                                                    echo '<img data-sizes="auto" alt="'.$value->description.'" class="lazyload img-responsive" data-src="'.$value->image.'" data-srcset="'. $value->image.'">';
                                        }
                                    ?>
                                    <h2 class="no-margin text-on-image tt-latolatin-bold tt-fontsize-40 tt-color-white">
                                        <?= $v->title?>
                                    </h2>
                                </a>
                            </div>
                       <? endforeach; ?>


                </div>
            </div>
            <?
        
            if (Yii::$app->request->get('page') == NULL) {
                    $page = $pagesize / 12;
                } else {
                    $page = Yii::$app->request->get('page');
                }
            ?>
            <?

             if($totalCountPort > $pagesize && ($totalCountPort / 12) > $page ){?>  
            <a class="btn-see-more btn-see-more-portrait tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get="" data-seemore="<?= ($page + 1)*12 ?>" href="<?=DIR.URI?>?page=<?= $page + 1 ?>" data-page="<?= $page + 1?>" data-value="">Afficher la suite</a>
            <? } ?>
        </div>    
        
<?php
include(dirname(__FILE__).'/_inc_back_button.php');
?>
    </div>

    
</div>
<? include '_inc_filter_testi.php'; ?>
<? 
$country = SEG1;
$uri = URI;
$js = <<< JS

//$('.btn-see-more-portrait').click(function(){    
//            var target = $(this);
//            var page = $(this).data('page');
//            var seemore = $(this).data('seemore');
//            var pr = $(this).data('get')+'?page='+$(this).data('page');
//            var pagesize = $(this).data('value');
//            var url = window.location.pathname + '?' + pr;
//          //  history.pushState('', '', window.location.pathname + '?page=' + page);
//               $.ajax({
//                    type: "GET",
//                    url: pr,
//                    datatype: 'html',
//                    beforeSend: function() {
//                        $('.getcontent').append('<div class="backgroundwhite"></div>');
//                        $('.getcontent').css({'position':'relative'});
//                        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
//                    },
//                    success: function(data){
//                        $('.backgroundwhite').remove();
//                        if(!data){
//                            $('.ajax-see-more-portrait').hide();
//                            return false;
//                        }
//                        $('.getcontent .item').slice(-4).hide();
//                        $('.getcontent img').on('load', function(){
//                            $('.getcontent .tour-item').slice(-4).fadeIn();
//                        });
//                        $('.getcontent').append(data);
//                        target.data('page', target.data('page')+1);
//                        
//                    }
//               }); 
//            return false;   
//        });
$(document).ready(function(){
    var newPage = $('#search-testi');
    newPage.appendTo($.mobile.pageContainer);
})
JS;
$this->registerJs($js); 
$css = <<<CSS
.content-page p{
    text-align: left !important;
}
.ajax-content-portrait{
    margin-top: 2rem;
    display: inline-block;
    width: 100%;
}
.ajax-content-portrait .item{
    position: relative;
    margin-bottom: 2.5rem;
}
.ajax-content-portrait .item .text-on-image {
    position: absolute;
    bottom: 0;
    background: linear-gradient(to top,rgba(0,0,0,0.5),rgba(0,0,0,0));
    padding-left: 1.25rem;
    width: 100%;
    padding-bottom: 2rem;
}
CSS;
$this->registerCss($css);
?>
