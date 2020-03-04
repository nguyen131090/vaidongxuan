<?php $this->registerCssFile('/assets/css/page2016/portrait-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <img alt="" style="width: 100%; display: none;" data-src='<?=DIR?>upload/image/banner-thongnong.jpg'>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
     
    
</div>
<div class="contain container-2 responsive-entry-body">
    
    <div class="amc-column">
        <div class="rows row-1 pt-40">
           
            
            <div class="amc-col amc-col-1">
                <div class="amc-area-infor-article pt-25 pb-25 mb-txt-40">
                    <h1 class="title"><?= $this->context->pageT?></h1>
                    <div class="amc-name-customer">
                        <span><?= $theEntry->data->nameclient?></span>
                    </div>
                    <div class="amc-info-tour">
                        <span>Voyage effectué <?= str_replace('-', ' ', $theEntry->data->ttourtypes)?></span> 
                        <span class="amc-around">a</span>
                        <span class="amc-date-tour">
                            <? 
                                if(isset($theEntry->data->tourperiod)) { 

                                   echo $theEntry->data->tourperiod;
                                }
                                //var_dump($theEntry->photosArray['summary'][0]->image);exit;
                            ?>    
                                    
                        </span>
                        <span class="amc-around">a</span>
                        <span class="amc-country-tour">
                            <?php
                                $arr_country=[
                                    'vn' => 'Vietnam',
                                    'la' => 'Laos',
                                    'kh' => 'Cambodge',
                                    'th' => 'Thaïlande‎',
                                    'mm' => 'Birmanie',
                                    'id' => 'Indonésie',
                                ];
                               
                                $i= 0;
                                if(is_array($theEntry->model->data->countries)){
                                    foreach ($theEntry->model->data->countries as $value) {
                                        $i ++;
                                        echo $arr_country[$value];
                                        if($i < count($theEntry->model->data->countries)){
                                            echo ', ';
                                        }
                                    }
                                }else{
                                    echo $arr_country[$theEntry->model->data->countries];
                                }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="entry-body mb-txt-40">
                    <?= str_replace('src="', 'data-src="', $theEntry->description)?>
                </div>    
                <div class="amc-area-sub-article mb-40 d-none d-sm-block d-lg-none">
                    <p>Articles récentes</p>
                    <ul>
                        <?php
                            foreach ($theEntries as $v) {
                                echo '<li><a href="'.DIR.$v->slug.'"><img data-src="' . DIR . 'thumb/40/40/1/80' . $v->photosArray['summary'][0]->image . '&w=40&h=40&zc=1"><span>'.$v->title.'</span></a></li>';
                            }
                        ?>
                        
                    </ul>
                </div>


                <div class="amc-group-btn img-lazy mt-20 mb-txt-60">
                    <div class="text">
                        <p class="tt tt-1">Besoin de conseil pour votre voyage ?</p>
                        <p class="tt tt-2">Notre conseiller(ère) vous répondra sous 48H</p>
                        <span class="pugjd amc-btn-link btn-amica-basic btn-amica-basic-2" data-title="<?= base64_encode(DIR.'nous-contacter') ?>">Contactez-nous</span>
                    </div>
                </div>
                <div class="extensions">
                    <h2 class="tt mt-0 p-0 mb-txt-40">Besoin d'inspiration pour votre voyage</h2>
                    <div class="slider-right">
                        <?
                            $cnt = 0;
                            foreach ($theProgram as $value) {
                                $cnt++;
                            
                        ?>
                        <div class="slide slide-<?= $cnt ?>">
                            <a href="<?= DIR . $value->slug ?>">
                                <div class="amc-image">
                                <?
                                    $hasSummary = false;
                                    if (isset($value->photos)) {
                                        foreach ($value->photos as $kp => $vp) {
                                            if ($vp->model->type == 'summary') {
                                                echo '<img height="141" alt="' . $vp->description . '" class="img-lazy lazyload" data-src="' . DIR . 'thumb/211/141/1/80' . $vp->image . '&w=211&h=141&zc=1"/>';
                                                $hasSummary = true;
                                                break;
                                            }
                                        }
                                    }
                                ?>
                                <? if (!$hasSummary) : ?>
                                    <img alt="" class="lazy" data-src="<?= DIR ?>assets/img/page2016/img-slide-right.jpg">
                                <? endif; ?>
                                </div>    
                                <h3 class="title tt-16 pt-25 pb-txt-25"><?= str_replace('|','',$value->title); ?></h3>
                            </a>    
                                <p class="sub-title m-0"><?= $value->model->sub_title ?></p>
                            

                            <ul>
                                            
                                        <? 
                                        $float_left = 'float: left;';
                                        $width = 'width: auto;';
                                        $margin_left = 'margin-left: 5px;';
                                        if($value->model->days) {
                                        $float_left = 'float: right;'; 
                                        $width = Null;
                                        $margin_left = NULL;
                                        ?>
                                            
                                <li class="time"><?= $value->model->days?> jours <?= $value->model->nights?> nuits</li>
                                        <? } ?>

                                            <?//php if(isset($value->data->countries)){ ?>
                                        <?php
                                    //var_dump($value->category_id);exit;
//                                            if(in_array($value->category_id, [8,9,10,11])){
//                                                $categoryid = 4;
//                                            }else{
//                                                $categoryid = $value->category_id;
//                                            }
                                             $wr = Yii::getAlias('@webroot');
                                             $img_icon = NULL;
                                                $w = NULL;
                                                $h = NULL;
                                                
                                            $data = $value->parents();
                                            $last = end($data);
                                            //foreach ($this->context->getIdeesmenu2() as $item_mn) {
                                                //var_dump($item_mn->photos);exit;
                                               if(isset($last->photos)) {
                                                foreach ($last->photos as $image) {
                                                    if($image['type'] == 'icon-banner'){
                                                        $img_icon = $image['image'];
                                                        if(file_exists($wr.$img_icon)){
                                                            $img_size = getimagesize($wr.$img_icon);
                                                            $w = $img_size[0];
                                                            $h = $img_size[1];
                                                        }
                                                    }
                                                }
                                               }
                                               
                                                    
                                                
                                       
                                        ?>
                                <li class="tour-name" style="<?= $float_left ?><?= $width ?><?= $margin_left ?>"><span class="icon" style="width: <?= $w.'px'?>; height: <?= $h.'px'?>; background-image: url(<?= $img_icon?>);"></span><span class="text-name"><?= $last->title ?></span></li>
                                        <?// } }?>

                                        <?//php } ?>    
                            </ul>
                        </div>
                        <? } ?>
                    </div>
                </div>    
                

                <? include '_inc_back_button.php'; ?>
                <!-- End BACK BUTTON -->
            </div>    
             <div class="amc-col amc-col-2 mb-60 d-none d-lg-block d-sm-none">
                <div class="amc-area-sub-article mb-25">
                    <p>Articles récents</p>
                    <ul>
                        <?php
                            foreach ($theEntries as $v) {
                                echo '<li><a href="'.DIR.$v->slug.'"><img data-src="' . DIR . 'thumb/40/40/1/80' . $v->photosArray['summary'][0]->image . '&w=40&h=40&zc=1"><span>'.$v->title.'</span></a></li>';
                            }
                        ?>
                        
                    </ul>
                </div>
                 <a href="<?=DIR?>temoignages">
                     <img alt="temoignages" class="mb-25 img-fluid" data-src="<?=DIR?>assets/img/page2016/img-223-176.jpg">
                </a>
                 <a href="https://www.facebook.com/amicatravel/" target="_blank"> 
                     <img alt="page facebook" class="mb-25 img-fluid" data-src="<?=DIR?>assets/img/page2016/img-fb-221-127.jpg">
                </a>
                
                
            </div>
        </div>
        
    </div>
</div>


<? $this->registerCss('.back-button{margin-top: 35px;}'); ?>
<?
$js = <<<JS
    $(window).bind('load',function(){    
      $('.extensions .slide').each(function(index) {
        var maxtt = 0;
        var heighttt = $(this).children().children('.title').outerHeight();
        if(maxtt < heighttt){
            maxtt = heighttt;
        }
       
        
        var maxsubtt = 0;
        var heightsubtt = $(this).children().children('.sub-title').outerHeight();
        if(maxsubtt < heightsubtt){
            maxsubtt = heightsubtt;
        }
        
        var maxsum = 0;
        var heightsum = $(this).children('.summary').outerHeight();
        if(maxsum < heightsum){
            maxsum = heightsum;
        }
        
//         var maxul = 0;
//        var heightul = $(this).children('ul').outerHeight();
//        if(maxul < heightul){
//            maxul = heightul;
//        }
		
       $('.extensions .slide .title').css("min-height", maxtt);
        $('.extensions .slide .sub-title').css("min-height", maxsubtt);
        $('.extensions .slide .summary').css("min-height", maxsum);
       // $('.extensions .slide ul').css("min-height", maxul);
         
		 
  });  
});      
JS;
$this->registerJs($js, yii\web\View::POS_END);
?>