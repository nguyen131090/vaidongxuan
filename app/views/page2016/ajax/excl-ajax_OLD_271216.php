<? foreach ($exclusives as $key => $value) :?>
               <div class="item item-<?=$key+1?>">
                    
                     <a href="<?=DIR.$value->slug?>">
                        <? 
                        if($key == 4) break;
                        $hasSummary = false;
                        if(isset($value->photos)) {
                            foreach ($value->photos as $kp => $vp) {
                                if($vp->type == 'summary'){
                                    echo '<img alt="'.$vp->description.'" class="img-lazy img-responsive" data-src="'.$vp->image.'" src="'.$vp->image.'">';
                                    $hasSummary = true;
                                    break;
                                }
                            } 
                        } ?>
                        <? if(!$hasSummary) : ?>
                            <img alt="Amica Travel" class="img-lazy img-responsive" data-src="<?=DIR?>assets/img/page2016/img-329-219.jpg" src="<?=DIR?>assets/img/page2016/img-329-219.jpg">
                        <? endif; ?>
						
						
						 <h4 class="tt"><?=$value->title?></h4>
					 </a>
                        
                    
                    
                        
                        <div class="summary">
                            <p>
                                <?=$value->model->summary; ?>
                            </p>
                        </div>
                        <span class="posi"><?=isset($value->data->locations) ? \app\modules\libraries\api\Catalog::get($value->data->locations[0])->title : ''?>, <?=isset($value->data->countries[0]) ? ucfirst($value->data->countries[0]) : ''?></span>
                   
                    
                </div>
                <?// if($key%2==1) echo '<div class="clearfix"></div>'; ?>
<? endforeach; ?>

                    <div class="pagination-excl">
                        <? 
                        $pagi = new \yii\data\Pagination(['totalCount' => isset($totalCount) ?  $totalCount : Yii::$app->session->get('countVnExcl'), 'pageSize'=>4]);
                        echo \yii\widgets\LinkPager::widget([
                            'pagination' => $pagi,
                        ]);
                        ?>    
                    </div>
                                