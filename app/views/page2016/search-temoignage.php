<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<?php $this->registerCssFile('/assets/css/page2016/temoignage-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<!-- Phan bai viet Temoignage -->
<div class="contain container-1">
    <div class="amc-column row-1">
        <?// include('_inc_breadcrumb.php') ?>
        
        <div class="breadcrumb fix-breadcrumb">
          <div class="item">
            <a href="/"><span>Accueil</span></a> <span> &gt; </span> 
            
          </div>
<?
$json_bread = [];
$json_bread[1] =<<<TXT
{
    "@type": "ListItem",
    "position": 1,
    "item": {
    "@id": "https://www.amica-travel.com/",
    "name": "Accueil"
    }
}
TXT;
?>             
          <div class="item">
            <a href="<?=DIR.$this->context->root->slug ?>"><span><?=$this->context->root->model->seo->breadcrumb ? $this->context->root->model->seo->breadcrumb : $this->context->root->title?></span></a> 
            
          </div>
<?
$txt_name =  $this->context->root->model->seo->breadcrumb ? $this->context->root->model->seo->breadcrumb : $this->context->root->title; 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->root->slug;
$json_bread[2] =<<<TXT
{
    "@type": "ListItem",
    "position": 2,
    "item": {
    "@id": "$id_url",
    "name": "$txt_name"
    }
}
TXT;
?>            
            <? if(isset($this->context->entry)) : ?>
                <span> &gt; </span>
                <? if($parents = $this->context->entry->parents()) : ?>
                    <? foreach($parents as $kpr => $vpr) : ?>
                    <div class="item">
                        <a href="<?=DIR.$vpr->slug ?>"><span><?=$vpr->seo['breadcrumb'] ? $vpr->seo['breadcrumb'] : $vpr->title?></span></a> <span> &gt; </span> 
                        
                      </div>
<?
$txt_name =  $vpr->seo['breadcrumb'] ? $vpr->seo['breadcrumb'] : $vpr->title; 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$vpr->slug;
$position = $kpr+3;
$json_bread[$position] =<<<TXT
{
    "@type": "ListItem",
    "position": $position,
    "item": {
    "@id": "$id_url",
    "name": "$txt_name"
    }
}
TXT;
?>                 
                    <? endforeach; ?>
                <? endif;?>
            <div class="item">
            <a href="<?=DIR.$this->context->entry->slug ?>"><span><?= isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : $this->context->entry->title?></span></a>
            
          </div>
<?
$txt_name =  isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : str_replace('|', '', $this->context->entry->title); 
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->entry->slug;
$position = count($parents) + 3;
$json_bread[$position] =<<<TXT
{
    "@type": "ListItem",
    "position": $position,
    "item": {
    "@id": "$id_url",    
    "name": "$txt_name"
    }
}
TXT;
?>                 
            <? endif;?>
            <span> &gt; </span> 
            <div class="item">
            <span><span>Recherche</span></span>
            
          </div>
<?
$position = count($parents) + 4;
$id_url = str_replace('http://', 'https://', Yii::$app->urlManager->getHostInfo()).'/'.$this->context->entry->slug.'/'.'recherche';
$json_bread[$position] =<<<TXT
{
    "@type": "ListItem",
    "position": $position,
    "item": {
    "@id": "$id_url",    
    "name": "Recherche"
    }
}
TXT;
?> 
<?

$txt_first =<<<TXT
{
"@context": "http://schema.org",
"@type": "BreadcrumbList",
"itemListElement": [
TXT;

$txt_last =<<<TXT
]
}
TXT;

foreach ($json_bread as $key => $value) {
    $txt_first .= $value;
    if($key <= count($json_bread) - 1){
     $txt_first .= ',';  
    }
}
$txt_first .= $txt_last;
$this->context->json_ld_breadcrumd = $txt_first;
//var_dump($this->context->json_ld_breadcrumd);exit;
//$this->registerJsonLd($txt_first, \yii\web\View::POS_END);
//echo Html::script($txt_first, ['type' => 'application/ld+json']);
?>            
        </div>

    </div>
</div>
<div class="contain container-2">
    
    <div id="temoignages" class="amc-column">
        <div class="rows row-1 pt-40">
            <div class="amc-col amc-col-1 mb-40 d-none d-sm-none d-lg-block">
                <p class="text-top">Témoignages</p>
               <div class="desktop-filter container-filter p-0">
                    <p class="title-filter">Filtrer votre recherche</p>
                   
                    <div class="search-form getnumber">
                    <?php
                        include '_form_search_temoignage.php';
                    ?>
                    </div>    
               </div>
            </div>
            
            <div class="amc-col amc-col-2">
                <?=$theTesti->model->content?>
                <div class="search-form responsive-search-temoi mt-25 mb-20 d-none d-sm-block d-lg-none">
                 <?php
                    include '_form_search_temoignage.php';
                    ?>
                </div>    
                <p class="fix-btn"><a style="display: none;" class="btn-click">Les plus récent</a></p>
                <div id="temoignages-load" class="ajaxfilter">
                    <div class="getcontent">
                    <? foreach($testis as $kt => $vt)  : ?>
                    <div class="item item-<?= $kt+1?> d-flex mb-40">
                        <div class="col-left mr-20">
                            <a href="<?= DIR.$vt->cat->slug.'/'.$vt->slug?>">
                            <? if(!empty($vt->photosArray['summary'])) {
                                   $img =  $vt->photosArray['summary'][0];
                             ?>
                            <img class="img-lazy img-responsive" data-src= "/thumb/299/199/1/80<?=$img->image?>" alt="<?=$img->description?>">
                            <? }else { ?>
                            <?php
                            $src = DIR.'assets/img/cf/defaut-img-testi.jpg';

//                            preg_match_all('/<img[^>]+>/i', $vt->description, $result);
//                            foreach ($result as $img_tag) {
//                                foreach ($img_tag as $vimg) {
//                                    if(strpos($vimg, 'ngoac_kep') === false){
//                                        preg_match('/(src)=("[^"]*")/i', $vimg, $src);
//                                        break;
//                                    }
//                                }
//
//                            }
                            ?>

                           <img class="img-lazy img-responsive" alt="" data-src='<?php if (is_array($src)) {
                                    echo '/'.'timthumb.php?src='.str_replace('"','',$src[2]).'&w=299&h=199&zc=1';
                            } else echo '/'.'timthumb.php?src='.$src.'&w=299&h=199&zc=1'; ?>'/>
                            <? } ?>
                            </a>
                        </div>
                        <div class="col-right">
                            <a href="<?= DIR.$vt->cat->slug.'/'.$vt->slug?>"><h3><?= $vt->title?></h3></a>
                            <span class="nameClient"><?=$vt->data->nameclient ?></span>
                            <div class="text">
                                 <? $line=$vt->model->summary; if (preg_match('/^.{1,150}\b/s', $vt->model->summary, $match))
                                    {
                                        $line=$match[0].'...';
                                    } 
                                    echo $line;
                                    ?>
                            </div>
                            <ul>
                               <!-- <?// if(isset($vt->data->from) && isset($vt->data->to)) : ?>
                                    <?// $days =  floor(abs(strtotime($vt->data->from) - strtotime($vt->data->to)) / (60*60*24));?>
                                    <li><?//=$days ?> jours <?//= $days - 1;?> nuits</li>
                                <?// endif;?>
                                                            -->
                                                             <li>
                                        <? if(isset($vt->data->from) && isset($vt->data->to)) : ?>    
                                                 <?= date('d/m/Y', strtotime($vt->data->from)) ?> <?//= date('d/m/Y', strtotime($vt->data->to)) ?>
                                        <? endif; ?> 
                                </li>
                                <li class="posi-country">
                                    <? foreach($vt->data->countries as $kc => $vc) {
                                            if(isset(Yii::$app->params['tsDestinationList'][$vc])) echo Yii::$app->params['tsDestinationList'][$vc];
                                            if($kc == count($vt->data->countries) - 1) break;
                                            echo ", ";
                                        }?>
                                </li>
                            </ul>
                        </div>    
                    </div>
                    <? endforeach; ?>
                      <div class="mt-0 pagination pagination-centered pagination-testi">
               <?=LinkPager::widget([
                    'pagination'=>$pageTesti,
                    'maxButtonCount'=>5,
                    'firstPageLabel'=>'&lt;&lt;',
                    'lastPageLabel'=>'&gt;&gt;',
                    'prevPageLabel'=>'&lt;',
                    'nextPageLabel'=>'&gt;',
                    ]
                );
                ?>
                </div>
            </div>  
            </div>   
        </div>
        </div>
    </div>
</div>
  
<? 
$url = DIR.URI;
$js = <<<JS
    $('.seach-submit').click(function(){
        var url = '$url';
        var des = '';
        $('.search-destination .list-option .active').each(function(index){
            des += $(this).data('value');
            if(index != $('.search-destination .list-option .active').length -1)
                des += '-';
        })
        if(!des) des = 'all';
        var type = $('.search-type .list-option .active').data('value');
        if(!type) type= 'all';

        var theme = $('.search-theme .list-option .active').data('value');
        if(!theme) theme= 'all';
        // var length = $('.search-length .list-option .active').data('value');
        // if(!length) length = 'all';

        var pr = {'country': des, 'type': type, 'theme' : theme };
        var url2 = $.param( pr );
        url = url + '?'+url2+'#temoignages';
        window.location = url;
    });
     $(document).on("click",".pagination-port .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        $.post(url, { type: 'port' }, function(data){ 
            $('#portrait-load').html(data);
            $('html, body').animate({scrollTop: $('#portrait-load').offset().top - 100}, 200);
            return false;
        });
        return false;
     });
     $(document).on("click",".pagination-testi .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
        history.pushState('', '', url);
        $('.getcontent').append('<div class="backgroundwhite"></div>');
        $('.getcontent').css({'position':'relative'});
        $('.backgroundwhite').css({'position':'absolute','top':'0','left':'0','right':'0','bottom':'0','background':'rgba(255,255,255,0.7)'});
        $.post(url, { type: 'testi' }, function(data){ 
           // $('#temoignages-load').html(data);
            var metadescription = $($.parseHTML(data)).filter('meta[name="description"]');
            var title = $($.parseHTML(data)).filter('title');
            var metarobotupdate = $($.parseHTML(data)).filter('meta[name="ROBOTS"]');
            var canonicalupdate = $($.parseHTML(data)).filter('link[rel="canonical"]');
            var linkprev = $($.parseHTML(data)).filter('link[rel="prev"]');
            var linknext = $($.parseHTML(data)).filter('link[rel="next"]');
            var propertyog = $($.parseHTML(data)).filter('meta[property="og:url"]');

            $('meta[name="description"]').remove();
            $('title').remove(); 
            $('meta[name="ROBOTS"]').remove();
            $('link[rel="canonical"]').remove();
            $('link[rel="prev"]').remove();
            $('link[rel="next"]').remove();
            $('meta[property="og:url"]').remove();

            $('head').append(metadescription);
            $('head').append(title);
            $('head').append(metarobotupdate);
            $('head').append(canonicalupdate);
            $('head').append(linkprev);
            $('head').append(linknext);    
            $('head').append(propertyog);  
        
            var datanew = $($.parseHTML(data)).find(".getcontent");
            $('.ajaxfilter').html(datanew);
             $('html, body').animate({scrollTop: $('#temoignages-load').offset().top - 100}, 200);
            return false;
        });
        return false;
     });
JS;

$this->registerJs($js);
$this->registerCss('.text-top{
    text-align: center} #temoignages-load .item h5{margin-top: 0}');
?>
