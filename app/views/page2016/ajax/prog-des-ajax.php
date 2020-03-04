<? 

                    $query = \app\modules\programmes\models\Item::find()->where(['LIKE', 'locations', SEG3 ])->with(['photos'])->limit(6);

                    $countQuery = clone $query;

                    $pages = new \yii\data\Pagination(['totalCount' => count($countQuery->all()), 'pageSize' => 2]);

                    $proEntry = $query->offset($pages->offset)->limit($pages->limit)->all() ?>

                    <? foreach ($proEntry as $key => $value) : ?>

                    <div class="item item-<?=$key+1 ?>">

                        <? $hasSummary = false;

                            if(isset($value->photos)) {

                            foreach ($value->photos as $kp => $vp) {

                                if($vp->type == 'summary'){

                                    echo '<img alt="'.$vp->description.'" class="lazy" src="'.$vp->image.'"/>';

                                    $hasSummary = true;

                                    break;

                                }

                            } 

                        } ?>

                        <? if(!$hasSummary) : ?>

                             <img alt="" class="img-lazy" src="<?=DIR?>upload/image/img-exclusi-single-2.jpg" data-src="<?=DIR?>upload/image/img-exclusi-single-2.jpg">

                        <? endif; ?>

                               

                        

                        <h4 class="tt"><?=$value->title; ?></h4>

                        <div class="summary">

                            <?=$value->summary; ?>

                        </div>

                        <ul>

                            <li class="time"><?=$value->days ?> jours <?=$value->nights ?> nuits</li>

                            <li class="posi">Vietnam</li>

                        </ul>

                    </div>



                    <? endforeach; ?>    

                    <div class="pagination-prog" style="clear: both">

                    <? echo \yii\widgets\LinkPager::widget([

                        'pagination' => $pages,
                          'firstPageLabel'=>'<img alt="" src="/assets/img/icons/first-pagi.png"/>',
                        'lastPageLabel'=>'<img alt="" src="/assets/img/icons/last-pagi.png"/>',
                        'prevPageLabel'=>'<img alt="" src="/assets/img/icons/prev-pagi.png"/>',
                        'nextPageLabel'=>'<img alt="" src="/assets/img/icons/next-pagi.png"/>',

                    ]);

                    ?>

                    </div>

