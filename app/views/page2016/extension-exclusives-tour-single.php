<!-- Popup Tour Exclusivites-->
                <?php
                    $cnt = 0;
                    foreach ($theProgram as $p) {
                        $cnt ++;
                    
                ?>
                     <div class="popup pop-<?= $cnt ?>" data-pop="pop-<?= $cnt ?>">
                        
                        <?php
                        
                         if(!empty($p->model->photos)){

                             foreach ($p->model->photos as $v) {

                                 if($v->type == 'banner'){

                        ?>
                        <img class="" alt='<?= $v->description?>' data-src='<?=DIR?>timthumb.php?src=<?= $v->image?>&w=1001&h=297&zc=1&q=80'>
                         <?php
                                 }
                             }

                          }else{
                        ?>
                        <img alt="" class="img-lazy" data-src="<?=DIR?>upload/image/img-banner-popup.jpg">
                          <?php } ?>
                        <div class="entry entry-1">

                            <div class="title mt-60">
                                <h3 class="tt w-100"><?= $p->model->title ?></h3>
                                <div class="summary mt-txt-25 mb-txt-20">
                                    <p class="m-0">
                                        <?= $p->model->summary?>
                                    </p>
                                </div>
                                <?
                                    if(Yii::$app->session->get('data_extension') == NULL){
                                        $data_extension = [];
                                    }else{
                                        $data_extension = Yii::$app->session->get('data_extension');
                                    }
                                ?>
                            </div>
                            <ul class="list">
                                <li class="posi">
                                    <?php
                                        $j = 0;
                                        
                                        foreach ($p->data->locations as $v) {
                                           $j ++;  
                                           echo $location[$v];
                                           if($j < count($p->data->locations)){
                                               echo ', ';
                                           }
                                        }
                                    ?>
                                    
                                </li>
                                <li class="plus-<?=$p->category_id?> plus">
                                    <? if($p->cat->photosArray['icon-banner']) : 
                                        $iconCat = $p->cat->photosArray['icon-banner'][0];    
                                        ?>
                                    <img data-src="<?=$iconCat->image?>" alt="">
                                    <? endif ?>
                                    <?= $p->parents()[0]->title; ?>
                                </li>
                                <li class="float-right text-right pr-0 mr-0"><span class="btn-extension btn-amica-basic btn-amica-basic-2<?= in_array($p->title, $data_extension) ? 'active' : ''?>" name="<?= $p->title?>">Ajoutez au programme</span></li>
                            </ul>
                            
                            <div class="program d-inline-block mt-txt-20 mb-40">
                                <?= $p->model->description?>

                            </div>
                        </div>

                    </div>
            
                <?php } ?>
            

             <!--END Content Extensions tour Exclusivites-->
             
              