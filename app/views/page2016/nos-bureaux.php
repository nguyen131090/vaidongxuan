<?php $this->registerCssFile('/assets/css/page2016/nos-bureaux.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
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
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner-qui-sommes-nous.jpg'>
    <?}?>
    
    <?php 
        $imageBanner = $theEntry;
        include('_inc_add_license.php'); 
    ?>
    
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title m-0"><?= $this->context->pageT ?></h1>
    </div>
</div>


<div class="contain container-4 mt-60">
    
    <div class="amc-column">
        
        <div class="roww row-slide">
            <div class="amc-col amc-col-1" style="clear: left;">
                <div class="amc-col d-none d-sm-block d-lg-none mb-25">
				
				<?php
					 echo explode('<hr />',$theItem_3->model->content)[0];
				?>
               
                </div>
                
                <div id="slideCarousel" class="carousel slide" style="clear: left;" data-ride="carousel">
                   

                    <!-- Wrapper for Slides -->
                    <div class="carousel-inner">
                        <?php
                                //echo '<pre>';
                                //var_dump($theItem_3->photos);exit;
                                $cnt = 0;
                                foreach($theItem_3->model->photos as $v){
                                if($v->type == 'galery'){
                                $cnt++;
                        ?>
                        <div class="carousel-item <?= $cnt == 1 ? 'active' : ''?>">
                            <!-- Set the first background image using inline CSS below. -->
                            <span class="fill pointer"><img style="width: 100%;" alt="<?= $v->description?>" data-src="<?= $v->image?>"></span>
                            <div class="carousel-caption">
                                    <p><?= $v->caption ?></p>
                            </div>
							

                        </div>
                        <?php }} ?>
                         

                    </div>
                     <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#slideCarousel" data-slide="prev">
                      <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#slideCarousel" data-slide="next">
                      <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
                

                
            </div>
            <div class="amc-col amc-col-2 d-none d-sm-none d-lg-block">
				
				<?php
					 echo explode('<hr />',$theItem_3->model->content)[0];
				?>
               
            </div>
        </div>
        <div class="rows row-2 getcontent">
            <?
                //echo explode('<hr />', str_replace('src="', 'data-src="', $theItem_3->model->content))[1];
            ?>
            <? 
                $cnt = 0;
                foreach ($theEntries as $value) { $cnt ++;

                if($cnt % 3 == 1){
                    if(count($theEntries) - 3 >= $cnt){
                        $clas = 'mb-txt-40';
                    }else{
                        $clas = Null;
                    }
                    echo '<div class="clear-fix d-table w-100 '. $clas .'">';
                }
                ?>
                <div class="item item-<?=$cnt?>">
                    <a href="<?= DIR.$value->slug?>">    
                    <?
                        //var_dump($value->title);exit;
                            $hasSummary = false;
                            if (!empty($value->photos)) {
                                foreach ($value->photos as $kp => $vp) {
                                    if ($vp->model->type == 'summary') {
                                        echo '<img height="" alt="' . $vp->description . '" class="img-responsive w-100" data-src="/thumb/300/200/1/80'.$vp->image.'"/>';
                                        $hasSummary = true;
                                        break;
                                    }
                                }
                            }
                        ?>
<!--                        <img style="" class="img-lazy w-100" data-src='/timthumb.php?src=<?//=DIR?>upload/image/banner-qui-sommes-nous.jpg&w=300&h=200&zc=1'>-->
                        
                    <h2 class="tt tt-18 tt-latolatin-bold tt-custom tt-responsive mt-txt-25 mb-0"><?= $value->title?></h2>

                    </a>
                    <address class="mb-0 amc-fix-mt-25">
                        <?= $value->data->adresse?>
                    </address>
                    <p class="m-0 amc-fix-mt-25">Tél : <?= $value->data->tel?></p>
                </div>
                <?
                if($cnt % 3 == 0 || count($theEntries) == $cnt){
                    echo '</div>';
                }
                }
            ?>
        </div>


    </div>
    
</div>

<div class="contain container-9 responsive-area-btn-link">
    
    <div class="amc-column">
        <div class="rows row-1">
            <p class="tt">Pour aller plus loin</p>
            <div class="area-btn-link mt-40">
                <a class="link-btn link-btn-left btn-amica-basic btn-amica-basic-1" href="<?=DIR?>explorateurs">Parcourez le pays avec ceux qui y sont nés</a>
                <a class="link-btn link-btn-right btn-amica-basic btn-amica-basic-1" href="<?=DIR?>voyage">Bougez selon votre humeur du moment</a>
            </div>
        </div>
        
    </div>
</div>
<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->
