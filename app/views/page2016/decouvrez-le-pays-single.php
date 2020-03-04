<?php $this->registerCssFile('/assets/css/page2016/decouvrez-le-pays-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>



<div class="contain container-1">
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
    
</div>

<div class="contain container-4 reportage entry-body responsive-entry-body">
    
    <div class="amc-column">
        
        <div class="rows row-1 pt-40">
            <div class="amc-col amc-col-1 mt-0">
                <h1 class="title"><?= $this->context->pageT?></h1>
                <?= str_replace('src="', 'data-src="', $theEntry->model->description) ?>
                <div class="amc-area-sub-article mb-0 mt-txt-60 d-none d-sm-block d-lg-none">
                    <p>Reportages récents</p>
                    <ul>
                        <?php
                            foreach ($theRand_thrre as $v) {
                                echo '<li><a href="'.DIR.$v->slug.'"><img data-src="' . DIR . 'thumb/40/40/1/80' . $v->photosArray['summary'][0]->image . '&w=40&h=40&zc=1"><span>'.$v->title.'</span></a></li>';
                            }
                        ?>
                        
                    </ul>
                </div>
<!--                    <div class="post-relate">

                        <p class="tt">articles liés :</p>
                        <?//php
                          //  $cnt = 0;
                          //  foreach($theRand_thrre as $v){
                         //     $cnt++;     
                        ?>
                            <div class="item item-<?//= $cnt?>">
                                <a href="<?//=DIR.$v->slug?>">
                                 <?//php
                                  //  if(!empty($v->photos)){
                                 //       foreach ($v->photos as $value) {
                                  //          if($value->model->type == 'summary'){
                                 //               echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy img-responsive" data-src="'.DIR.'thumb/194/129/1/80'.$value->image.'">';
                                  //          }
                                  //      }
                                  //  }else{

                                    ?>

                                    <img alt="" class="img-lazy img-responsive" data-src="<?//=DIR?>upload/image/img-194-129.jpg">
                                <?//}?>
                                </a>
                               <p class="title">
                                   <a href="<?//=DIR.$v->slug?>">
                                       <?//= $v->title?>
                                   </a>
                               </p>
                           </div>
                        <?//php } ?>

                    </div>-->
                    <!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON --> 
            </div>
             <div class="amc-col amc-col-2 m-0 d-none d-lg-block d-sm-none">
                <div class="amc-area-sub-article mb-25">
                    <p>Reportages récents</p>
                    <ul>
                        <?php
                            foreach ($theRand_thrre as $v) {
                                echo '<li><a href="'.DIR.$v->slug.'"><img data-src="' . DIR . 'thumb/40/40/1/80' . $v->photosArray['summary'][0]->image . '&w=40&h=40&zc=1"><span>'.$v->title.'</span></a></li>';
                            }
                        ?>
                        
                    </ul>
                </div>
                
                
                
            </div>
        </div>
        
        
        
    </div>
</div>


