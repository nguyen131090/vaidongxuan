<? foreach ($programes as $key => $vp) : ?>
                                <? if($key == 4) break; ?>
                                    <div class="item item-<?=$key+1?>">
                                    <div class="left">
                                        <a href="<?=DIR.$vp->slug?>">
                                        <? 
                        $hasSummary = false;
                        if(isset($vp->photos)) {
                            foreach ($vp->photos as $kpt => $vpt) {
                                if($vpt->model->type == 'summary'){
                                    echo '<img alt="'.$vpt->description.'" class="img-lazy img-responsive" data-src="'.$vpt->image.'" />';
                                    $hasSummary = true;
                                    break;
                                }
                            } 
                        } ?>
                        <? if(!$hasSummary) : ?>
                            <img alt="" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg"/>
                        <? endif; ?>
                                        </a>
                                    </div>
                                    <div class="right">
                                        <p class="tt"><?=$vp->title;?></p>
                                        <div class="text">
                                            <p>
                                                <?=$vp->model->summary?>
                                            </p>
                                        </div>
                                        <ul>
                                            <? if($vp->model->days) : ?>
                                            <li class="calendar">
                                            <?=$vp->model->days?> jours <?=$vp->model->nights?> nuits
                                           
                                            </li>
                                             <? endif; ?>
                                            <li class="des"> <? foreach ($vp->data->countries as $kc => $vc) {
                                               echo ucfirst($vc);
                                               if($kc == count($vp->data->countries)-1) break;
                                               echo ', ';
                                            } ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <? endforeach; ?>
                                <div class="pagination-prog">
                                    <? 
                                    $pagi = new \yii\data\Pagination(['totalCount' => Yii::$app->session->get('countVnProg'), 'defaultPageSize'=>12]);
                                    echo \yii\widgets\LinkPager::widget([
                                        'pagination' => $pagi,
                                        'maxButtonCount'=>5,
                                    ]);
                                    ?>    
                                </div>