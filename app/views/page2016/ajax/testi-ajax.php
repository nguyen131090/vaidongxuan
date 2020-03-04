<? foreach($testis as $kt => $vt)  : ?>
                    <div class="item item-<?= $kt+1?>">
                        <a href="<?= DIR.'temoignages/'.$vt->slug?>"><?= $vt->title?></a>
                        <div class="text">
                            <?= $vt->model->summary;?>
                        </div>
                        <ul>
                           
							 <li>
                                    <? if(isset($vt->data->from) && isset($vt->data->to)) : ?>    
                                             <?= date('d/m/Y', strtotime($vt->data->from)) ?> - <?= date('d/m/Y', strtotime($vt->data->to)) ?>
                                    <? endif; ?> 
                            </li>
                            <li class="posi-country">
                                <? foreach($vt->data->countries as $kc => $vc) {
                                        if(isset(Yii::$app->params['tsDestinationList'][$vc])) echo Yii::$app->params['tsDestinationList'][$vc];
                                        if($kc == count($vt->data->countries) - 1) break;
                                        echo ", ";
                                    }?>
                            </li>
                        </ul>
                    </div>
                    <? endforeach; ?>
                      <div class="pagination pagination-centered pagination-testi">
               <?=\yii\widgets\LinkPager::widget([
                    'pagination'=>$pageTesti,
                    'maxButtonCount'=>5,
                    'firstPageLabel'=>'&lt;&lt;',
                    'lastPageLabel'=>'&gt;&gt;',
                    'prevPageLabel'=>'&lt;',
                    'nextPageLabel'=>'&gt;',
                    ]
                );
                ?>
                </div>