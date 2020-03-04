
<? use yii\widgets\Pjax; 
use yii\helpers\Html;
use yii\widgets\LinkPager;
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
            <div class="text-on-banner m-0 p-0">
                <h1 class="no-margin tt-latolatin-bold tt-fontsize-45 tt-color-white mb-50"><?=$theEntry->model->seo->h1 ? $theEntry->model->seo->h1 : $theEntry->title ?></h1>
<!--                 <a href="/nous-contacter" class="btn-testi-filter tt-latolatin-bold tt-fontsize-32 ui-link tt-color-white">Contactez-nous</a>-->
            </div>            
        </div>
        <div class="row-content content-page tt-fontsize-32">
            <?= $theEntry->model->content?>
        </div>
        
        <div class="row-content ajaxfilter">
            <div id="actual-load" class="getcontent">
                    <? foreach ($theEntries as $key => $te) : ?>
                        <div class="actual-item actual-item-<?= $key ?>">
                            <a href="/actualites/<?=$te->slug ?>">
                         <? if(!empty($te->data->image)) { 
                            $img = $te->data->image;
                         
                            ?>
                            <img class="img-responsive" lazy-sizes='auto' alt="" data-src="<?=DIR?>timthumb.php?src=<?= $img?>&w=660&h=440&zc=1&q=80">   
                         <?php }else{ ?>
                        <?php
                            $src = DIR.'upload/image/img_exclusi_type.jpg';
                            
                            preg_match_all('/<img[^>]+>/i', $te->description, $result);
                            foreach ($result[0] as $img_tag) {
                                 preg_match_all('/(src)=("[^"]*")/i', $img_tag, $src);
                            }
                            
                            ?>

                           <img class="img-responsive" alt="" data-sizes='auto' data-src='<?php if (is_array($src)) {
                                    echo DIR.'timthumb.php?src='.str_replace('"','',$src[2][0]).'&w=660&h=440&zc=1&q=80';
                            } else echo DIR.'timthumb.php?src='.$src.'&w=660&h=440&zc=1'; ?>'/>
                         <? } ?>
                        <div class="text-on-image">
                            <p class="time tt-fontsize-28 tt-latolatin-regular tt-color-white">
                                <img data-src="/assets/img/mobile/icon-clock.png" alt="">
                           <?php
                            $date_list = date("d.m.Y", $te->time);
                            echo $date_list;
                            ?>
                            </p>
                            <h2 class="tt tt-fontsize-40 tt-latolatin-bold tt-color-white"><?= $te->title?></h2>
                        </div>
                    </a>
                      </div>
                     <? endforeach; ?>
                
                <div class="pagination pagination-centered"><?=LinkPager::widget([
		'pagination'=>$pages,
		'maxButtonCount'=>5,
		'firstPageLabel'=>'&lt;&lt;',
		'lastPageLabel'=>'&gt;&gt;',
		'prevPageLabel'=>'&lt;',
		'nextPageLabel'=>'&gt;',
		]
	);
	?>
    </div>
                
                
                    <?
        
                    if (Yii::$app->request->get('page') == NULL) {
                            $page = $pagesize / 12;
                        } else {
                            $page = Yii::$app->request->get('page');
                        }

                    ?>
                    <?

                     if(count($totalCount) > $pagesize && (count($totalCount) / 12) > $page ){?>  
<!--                    <a class="btn-see-more btn-see-more-portrait tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get="" data-seemore="<?= ($page + 1)*12 ?>" href="<?=DIR.URI?>?page=<?= $page + 1 ?>" data-page="<?= $page + 1?>" data-value="">Afficher la suite</a>-->
                    <? } ?>       
                 </div>
                 
<!--                 <span class="btn-see-more btn-see-more-actual tt-title tt-latolatin-bold tt-fontsize-32 tt-color-e65925 tt-custom ajax-see-more" data-get='<?=DIR.URI?>' data-page="2" data-value="4">Afficher la suite</span>
       -->
        </div>
        <div class="amc-area-sub-article mb-25">
                    <p>Top 5 des actualités</p>
                    <ul>
                        <?php
                            foreach ($top5 as $v) : ?>
                                <li><a href="/actualites/<?=$v->slug?>">
                                <? if(isset($v->photosArray['summary'])): 
                                    $img = $v->photosArray['summary'][0];
                                ?>
                                    <img data-src="/thumb/40/40/1/80<?=$img->image?>" alt=''>
                                <? else:  ?>
                                    <? if(isset($v->data->image)) : ?>
                                    <img alt='' data-src="/thumb/40/40/1/80<?=$v->data->image?>">
                                        <? endif ?>
                                <? endif; ?>
                                   
                                
                                <span><?=$v->title ?></span>
                            </a></li>
                            <? endforeach;?>
                        
                    </ul>
      </div>
    </div>

    
</div>
<? 
$country = SEG1;
$uri = URI;
$js = <<< JS

//$('.btn-see-more-actual').click(function(){    
//            var target = $(this);
//            var page = $(this).data('page');
//            var pr = $(this).data('get')+'?page='+$(this).data('page');
//            
//            var pagesize = $(this).data('value');
//            var url = window.location.pathname + '?' + pr;
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
//                        if(!data){
//                            $('.ajax-see-more').hide();
//                            return false;
//                        }
//                        $('.getcontent').append(data);
//                        $('.getcontent .tour-item').slice(-6).hide();
//                        $('.getcontent img').on('load', function(){
//                            $('.getcontent .tour-item').slice(-6).fadeIn();
//                        });
//                        target.data('page', target.data('page')+1);
//                        $('.backgroundwhite').remove();
//                    }
//               }); 
//
//        });
JS;
$this->registerJs($js); 
$css = <<<CSS
.btn-testi-filter{
    width: 92vw;
    margin-left: 4vw;
    margin-top: 1rem;
    margin-bottom: 2rem;
}
.banner .text-on-banner{
    padding: 2.5rem 0 0;
}
.getcontent .actual-item {
    margin-bottom: 2rem;
    position: relative;
    min-height: 10rem;
}
.getcontent .actual-item .text-on-image {
    position: absolute;
    bottom: 0;
    background: linear-gradient(to top,rgba(0,0,0,0.5),rgba(0,0,0,0));
    padding-left: 1.25rem;
    width: 100%;
    padding-bottom: 2rem;
}
.getcontent .actual-item .text-on-image .time{
        display: flex;
    align-items: center;
    line-height: 100%;
}
.getcontent .actual-item .text-on-image .time img{
        width: 2rem;
    margin-right: 0.6rem;
}
.getcontent .actual-item .text-on-image .tt{
    margin: 1rem 0 0 ;
    padding-right: 1rem;
}
/*top 5*/
.amc-area-sub-article {
    border: 1px solid #787878;
    font: 1.6rem LatoLatin-Regular,sans-serif;
        margin: 0 0 4rem;
}

.amc-area-sub-article p{
    color: #1a1a1a;
    font-family: "Grand Hotel",sans-serif;
    font-size: 30px;
    margin: 0;
    padding: 18px 0 10px;
    text-align: center;
}
.amc-area-sub-article ul{
    margin: 0;
    padding: 0 15px 10px 15px;
    list-style: none;
    
   
}
.amc-area-sub-article ul li{
    text-align: left;
    
    font-size: 14.2px;
    margin-bottom: 12px;
    padding-bottom: 10.5px;
    border-bottom: 1px solid #bab9b9;
}
.amc-area-sub-article ul li:last-child{
    border: none;
    padding-bottom: 0;
}
.amc-area-sub-article ul li a{
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.amc-area-sub-article ul li img{
    width: 40px;
    height: 40px;
    margin: auto 12px auto 0;
    border-radius: 100%;
}
/*end top 5*/
@media only screen and (orientation:landscape){
    .getcontent .actual-item{
        width: 48%;
        float: left;
    }
    .getcontent .actual-item:nth-child(odd){
        margin-right: 4%;
    }
}
CSS;
$this->registerCss($css);
?>
