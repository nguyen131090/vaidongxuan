                 <? foreach ($exclusives as $key => $value) : ?>
                <? if($key==12) break; ?>
                <?php 
                            if(($key+1) % 2 != 0){
                                echo '<div class="clear-fix">';
                            }
                        ?>
                <div class="item item-<?=$key+1?> <?= ($key+1) % 2 != 0 ? 'it-l' : 'it-r' ?>">
                    <a href="<?=DIR.$value->slug?>">
                                        <? 
                                        $hasSummary = false;
                                        if(isset($value->photos)) {
                                            foreach ($value->photos as $kp => $vp) {
                                                if($vp->model->type == 'summary'){
                                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" src="'.$vp->image.'"/>';
                                                    $hasSummary = true;
                                                    break;
                                                }
                                            } 
                                        } ?>
                                        <? if(!$hasSummary) : ?>
                                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                                        <? endif; ?>
                                        
                    <h4 class="tt"><?=$value->title?></h4>
                    </a>
                    <div class="summary">
                         <?=$value->model->summary?>
                    </div>
                    <ul>
                        <li class="posi"><?=$locationsLib[$value->data->locations[0]] ?>, <?=isset($value->data->countries[0]) ? ucfirst($value->data->countries[0]) : '' ?></li>
                    </ul>
                    
                    </div>
                    <?php
                            if(($key+1) % 2 == 0){
                                echo '</div>';
                            }
                            if(($key+1) % 2 != 0 && ($key+1) == count($exclusives)){
                                echo '</div>';
                            }
                        ?>
                    <? endforeach; ?>
                    <div class="pagination-excl">
                            <? 
                            $pagi = new \yii\data\Pagination(['totalCount' => Yii::$app->session->get('countExcl'), 'defaultPageSize'=>12]);
                            echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pagi,
                            ]);
                            ?>  
                            <? if($pagi->pageCount > 1) : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?=Yii::$app->request->url?><?=Yii::$app->request->get('country') || Yii::$app->request->get('page') ? '&' : '?' ?>view=all">Voir tout</a>
                            <? endif; ?>     
                    </div>
