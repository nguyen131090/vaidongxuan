<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<?php $this->registerCssFile('/assets/css/page2016/temoignage-type.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <?php
        if(!empty($theEntry->model->photos)){
            foreach ($theEntry->model->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_temoi.jpg'>
    <?}?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
     
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0">
           <?= $this->context->pageT ?>
        </h1>
    </div>
</div>


<!-- Phan bai viet Temoignage -->

<div class="contain container-2">
    
    <div id="temoignages" class="amc-column">
        <div class="rows row-1 p-0 mt-60">
            <div class="amc-col amc-col-1 d-none d-sm-none d-lg-block mb-40">
<!--               <div class="search-form">
                   <p class="t">Avis par</p>
                    <?//php
                   // include '_form_search_temoignage.php';
                    ?>
               </div>-->
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
                <?=$theEntry->model->content?>
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

//                                preg_match_all('/<img[^>]+>/i', $vt->description, $result);
//                                foreach ($result as $img_tag) {
//                                    foreach ($img_tag as $vimg) {
//                                        if(strpos($vimg, 'ngoac_kep') === false){
//                                            preg_match('/(src)=("[^"]*")/i', $vimg, $src);
//                                            break;
//                                        }
//                                    }
//
//                                }
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
                                    <?// if(isset($vt->data->from) && isset($vt->data->to)) : ?>
                                        <?// $days =  floor(abs(strtotime($vt->data->from) - strtotime($vt->data->to)) / (60*60*24));?>
                                       <!-- <li><?//=$days ?> jours <?//= $days - 1;?> nuits</li> -->
                                    <?// endif;?>
                                    <li>
                                            <? if(isset($vt->data->from) && isset($vt->data->to)) : ?>    
                                                     <?= date('d/m/Y', strtotime($vt->data->from)) ?> <?//= date('d/m/Y', strtotime($vt->data->to)) ?>
                                            <? endif; ?> 
                                    </li>
                                    <li class="posi-country">
                                        <? if(isset($vt->data->countries)) :  ?>
                                        <? foreach($vt->data->countries as $kc => $vc) {
                                                if(isset(Yii::$app->params['tsDestinationList'][$vc])) echo Yii::$app->params['tsDestinationList'][$vc];
                                                if($kc == count($vt->data->countries) - 1) break;
                                                echo ", ";
                                            }?>
                                        <? endif; ?>

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
<div class="contain container-7">
    <div class="amc-column">
        <p><span class="tt">Besoin d’inspiration ?</span><span class="btn-amica-basic btn-amica-basic-1 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Faites-nous savoir vos attentes</span></p>
    </div>
</div>
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
    
  
<? 
$url = DIR.URI;
$js = <<<JS
     $(document).on("click",".pagination-testi .pagination li a",function(e){
        e.preventDefault();
        var target = $(this);
        var url = $(this).attr('href');
//        var datapage = $(this).attr('data-page');
//        datapage = datapage + 1;
//        var href = window.location.href;
//        var pr = href.split("?")[1];
//        url = window.location.pathname + '?' + pr + '&page=' + datapage;
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
    text-align: center} #temoignages-load .item h5{margin-top: 0} .back-button .line:last-of-type{border: none;}');
?>
