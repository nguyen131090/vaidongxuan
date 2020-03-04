<? 
						 $cnt = 0;
						$count = count($theEntries); 
						foreach($theEntries as $key => $v) : 
							$cnt ++;   
						?>
						<?php 
							if($cnt % 2 != 0){
								echo '<div class="clear-fix">';
							}
						?>
                        <div class="item item-<?= $key+1 ?> <?= $cnt % 2 != 0 ? 'it-l' : 'it-r' ?>">
                            <a href="<?=DIR.$v->slug ?>">
                                 <?php
                                        if(!empty($v->photos)){
                                            foreach ($v->photos as $value) {
                                                if($value->model->type == 'summary'){
                                     ?>
                                    <img style="" class="img-lazy img-responsive" alt="<?= $value->model->description?>" data-src='<?= $value->image?>'>
                                        <?php
                                                }
                                            }

                                         }else{
                                       ?>
                                    <img class="img-lazy img-responsive" alt="" src="" data-src="<?=DIR?>upload/image/img_exclusi_type.jpg">
								
                                  <?php } ?>
                                <h2 class="tt"><?= str_replace('|','',$v->title); ?></h2>
                            </a>    
                            <div class="summary">
                                <p><?= $v->model->summary?></p>
                            </div>

                            <span class="posi">
                                <?php
                                     $location = \app\modules\libraries\api\Catalog::items(['where'=>['in','category_id',[3, 4, 5, 6]],'pagination' => ['pageSize'=>0]]);
           
                                    $location = \yii\helpers\ArrayHelper::map($location, 'slug','title');
                                    $ct = 0;
                                    foreach ($v->model->data->locations as $local) { $ct ++;
                                        echo $location[$local];
                                      // echo ucwords(str_replace('-', ' ', $local));
                                    //   if($ct < count($v->model->data->locations)){
                                            echo ', ';
                                    //   }
                                    }
                                ?>
								<?=isset($v->data->countries[0]) ? ucfirst($v->data->countries[0]) : ''?>
                            </span>
                        </div>
						<?php
                            if($cnt % 2 == 0){
                                echo '</div>';
                            }
                            if($cnt % 2 != 0 && $cnt == $count){
                                echo '</div>';
                            }
                        ?>
                    <? endforeach; ?>
                    <div class="pagination-excl">
                            <? 
                            $pagi = new \yii\data\Pagination(['totalCount' => Yii::$app->session->get('countExcl'), 'pageSize'=>12]);
                            echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pagi,
                            ]);
                            ?> 
                             <? if($pagi->pageCount > 1) : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?=Yii::$app->request->url?><?=isset($_GET) ? '&' : '?' ?>view=all">Voir tout</a>
                            <? endif; ?>         
                    </div>