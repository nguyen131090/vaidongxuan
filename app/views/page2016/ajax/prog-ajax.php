
<? foreach ($programes as $key => $value) : ?>
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
                                            <img alt="" class="img-lazy img-responsive" src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                                        <? endif; ?>
                                        
                    <h4 class="tt"><?=$value->title?></h4>
                    </a>
                    <div class="summary">
                        <?=substr($value->model->summary, 0, 190)?><?=strlen($value->model->summary) ? '...' : '' ?>
                    </div>
                    <ul>
                        <? if($value->model->days) : ?>
                        <li class="calendar"><?=$value->model->days?> jours <?=$value->model->nights?> nuits</li>
                        <? endif; ?>
                        <li class="posi">
                            <? //foreach(explode(',',$value->model->locations) as $kl => $vl) {
                                 //   echo $locationsLib[$vl].', ';
                            //}?><?=ucwords(implode(', ', $value->data->countries)) ?>
                        </li>
                    </ul>
                    
                </div>
                <?php
                            if(($key+1) % 2 == 0){
                                echo '</div>';
                            }
                            if(($key+1) % 2 != 0 && ($key+1) == count($programes)){
                                echo '</div>';
                            }
                        ?>
                <? endforeach; ?>							
                                <div class="pagination-prog">
                                    <? 
                                    $pagi = new \yii\data\Pagination(['totalCount' => Yii::$app->session->get('countProg'), 'pageSize'=>12]);
                                    echo \yii\widgets\LinkPager::widget([
                                        'pagination' => $pagi,
                                        'maxButtonCount'=>5,
                                    ]);
                                    ?>    
                                    <? if($pagi->pageCount > 1) : ?>
                            <a class="<?=Yii::$app->request->get('view')== 'all' ? 'active' : '' ?> view-all-link" href="<?=Yii::$app->request->url?><?=isset($_GET) ? '&' : '?' ?>view=all">Voir tout</a>
                            <? endif; ?>       
                                </div>