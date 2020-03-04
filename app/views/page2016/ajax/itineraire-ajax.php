<?php
                    $cnt = 0;
                    $count = count($programes); 
                    foreach ($programes as $v) {
                    $cnt ++;    
                  
                    
                ?>
                   <?php 
                        if($cnt % 2 != 0){
                            echo '<div class="clear-fix">';
                        }
                    ?>
                        <div id="<?=$cnt?>" class="item item-<?= $cnt ?> <?= $cnt % 2 != 0 ? 'it-l' : 'it-r' ?>">
                             <a href="<?= DIR.$v->slug?>">
                             <?php
                                
                                 if(!empty($v->photos)){

                                     foreach ($v->photos as $value) {

                                         if($value->model->type == 'summary'){

                              ?>
                             <img style="" class="img-lazy" alt="<?= $value->model->description?>" src='<?= $value->image?>'>
                                 <?php
                                         }
                                     }

                                  }else{
                                ?>
                             <img class="img-lazy" alt="" src="" src="<?=DIR?>upload/image/img_exclusi_type.jpg">
                                  <?php } ?>
                            
                           
                                <h4 class="tt"><?= str_replace('|','',$v->title) ?></h4>
                            </a>    
                            <div class="summary">
                                <p><?= $v->model->summary?></p>
                            </div>
                            <ul>
                                <?php
                                    if($v->model->days != ''){
                                ?>
                                <li class="calendar"><?= $v->model->days?> jours <?= $v->model->nights?> nuits</li>
                                    <?php } ?>
                                
                                
                                <?php if(isset($v->model->data->countries)){?>
                                <li class="posi">
                                    <?php
                                        $i= 0;
                                        if(is_array($v->model->data->countries)){
                                            foreach ($v->model->data->countries as $value) {
                                                $i ++;
                                                echo ucfirst($value);
                                                if($i < count($v->model->data->countries)){
                                                    echo ', ';
                                                }
                                            }
                                        }else{
                                           echo $v->model->data->countries;
                                        }
                                    ?>
                                </li>
                                <?php }?>
                            </ul>
                            
                        </div>
                        <?php
                            if($cnt % 2 == 0){
                                echo '</div>';
                            }
                            if($cnt % 2 != 0 && $cnt == $count){
                                echo '</div>';
                            }
                        ?>
                    <?php } ?>
                     <div class="pagination-prog">
                                    <? 
                                    $pagi = new \yii\data\Pagination(['totalCount' => $totalPage, 'defaultPageSize'=>12 ]);
                                    echo \yii\widgets\LinkPager::widget([
                                        'pagination' => $pagi,
                                        'maxButtonCount'=>5,
                                    ]);
                                    ?>  
                                       <? if($pagi->pageCount > 1) : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?>view-all-link" href="<?=DIR.URI?>?view=all">Voir tout</a>
                            <? endif; ?>      
                                </div>