<?php $this->registerCssFile('/assets/css/page2016/conditions.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<div class="contain container-1">
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    
</div>

<div class="contain container-4">
    
    <div class="amc-column entry-body">
        
        <div class="rows row-1">
            <div class="amc-col amc-col-1 mt-40">
                <h1 class="title"><?= $this->context->pageT; ?></h1>
                
                  <?= $theEntry->content?>       

                    <? include '_inc_back_button.php'; ?>
                    <!-- End BACK BUTTON -->   
            </div>
<!--            <div class="amc-col amc-col-2">
                <div class="area area-1">
                    <p class="t-1">suivez-nous</p>
                    <ul>
                        <li><a href="#"><img alt="Amcia Travel" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/icon_fb_cam.png"></a></li>
                        <li><a href="#"><img alt="Amcia Travel" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/icon_you_cam.png"></a></li>
                        <li><a href="#"><img alt="Amcia Travel" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/icon_twitter_cam.png"></a></li>
                        <li><a href="#"><img alt="Amcia Travel" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/icon_pin_cam.png"></a></li>
                    </ul>
                </div>
                <div class="area area-2">
                    <a href="#">
                        <img alt="" class="img-lazy" data-src="<?=DIR?>assets/img/page2016/img-360.jpg">
                    </a>
                </div>
                <div class="area area-3">
                    <p class="tt">Besoin de conseil d’un expert ?</p>
                    <ul>
                        <li><img alt="" class="img-lazy" data-src="/assets/img/page2016/img-persion-exclusi-single.png" style="display: inline;"></li>
                        <li>Notre conseillère vous répondra sous 48H</li>
                    </ul>
                    <a href="<?=DIR.'devis'?>" class="btn-contact">Demander un devis</a>


                </div>
            </div>-->
        </div>
        
        
        
    </div>
</div>
<? $this->registerCss('.back-button{margin: 25px 0 0 0}') ?>


