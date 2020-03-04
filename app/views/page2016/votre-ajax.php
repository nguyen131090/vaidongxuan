
            <? if(count(Yii::$app->session['projet']['programes']['select']) + count(Yii::$app->session['projet']['exclusives']['select'])) : ?>
            <div class="col col-1">
                <div class="count-tour">
                    <p class="tt ">VOTRE LISTE D’ENVIEs</p>
                    <span class="count-numb"><?= count(Yii::$app->session['projet']['programes']['select']) + count(Yii::$app->session['projet']['exclusives']['select']) ?></span>
                </div>
            </div>
            <div class="col col-2">
                    
                    <?php
                    $selectProg = $viewProg = $progSelectObj = []; 
                    if (Yii::$app->session['projet']['programes']['select']) $selectProg = Yii::$app->session['projet']['programes']['select'];
                    if (Yii::$app->session['projet']['programes']['view']) $viewProg = Yii::$app->session['projet']['programes']['view'];
                    if($selectProg){
                        $progSelectObj = \app\modules\programmes\api\Catalog::items(['where' => ['item_id' => $selectProg]]);
                    }
                    ?>
                    <? if($progSelectObj) : ?>
                    <p class="t-1 prog-zero-text <?=!Yii::$app->session['projet']['programes']['select'] ? 'active' : '' ?>">Aucun programme sélectionné. Retrouvez nos suggestions :</p>
                    <p class="t-2">LES VOYAGES QUE VOUS AIMEZ :</p>
            <!-- Get programes select or view or hot voyage -->
                    <ul class="bxslider" id="bxslider-programes" >
                        <? foreach ($progSelectObj as $kps => $vps) : ?>
                        <li>
                            <div data-name="programes" class="item item-<?=$kps+1 ?>">
                                <a class="url-tour" href="<?=DIR.$vps->slug?>">
                                    <? foreach ($vps->photos as $kpvps => $pvps) :?>
                                        <? if($pvps->model->type == 'summary') : ?>
                                                <img width="194" height="129"  data-src="<?='/timthumb.php?src='.$pvps->image.'&w=194&zc=0'?>" alt="<?=$pvps->description?>">
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <p class="tt"><?= $vps->title?></p>
                                </a>
                                <a href="<?=DIR.$vps->slug.'?tab=form'?>" class="link-to-form">Personnaliser ce programme</a>
                                <?  if(in_array($vps->model->item_id, $selectProg)) : ?>
                                <span data-id="<?= $vps->model->item_id?>" data-type="prog" class="btn-add pointer" name="selected"></span>
                                <? else: ?>
                                 <a  data-id="<?= $vps->model->item_id?>" data-type="prog" class="btn-add active" name=""></a>
                                <? endif; ?>
                            </div>
                        </li>
                        <? endforeach; ?>
                        
                    </ul>
                     <div class="hr"></div>
                    <? endif; ?>
                   
                   
                    <?php
                    $selectExcl = $viewExcl = $exclSelectObj = []; 
                    if (Yii::$app->session['projet']['exclusives']['select']) $selectExcl = Yii::$app->session['projet']['exclusives']['select'];
                    if (Yii::$app->session['projet']['exclusives']['view']) $viewExcl = Yii::$app->session['projet']['exclusives']['view'];
                    if($selectExcl){
                        $exclSelectObj = \app\modules\exclusives\api\Catalog::items(['where' => ['item_id' => $selectExcl]]);
                    }
                    ?>
                    <? if($exclSelectObj) : ?>
                     <p class="t-1 excl-zero-text <?=!Yii::$app->session['projet']['exclusives']['select'] ? 'active' : '' ?>">Aucune formule sélectionnée. Retrouvez nos suggestions :</p>
                    <p class="t-2">LES SECRETS D'AILLEURS QUE VOUS AIMEZ :</p>
                    <!-- Get exclusives select or view or hot exclusives -->
                    <ul class="bxslider" id="bxslider-exclusives" >
                        <? foreach ($exclSelectObj as $kes => $ves) : ?>
                        <li>
                            <div data-name="exclusives" class="item item-<?=$kes+1 ?>">
                                <a class="url-tour" href="<?=DIR.$ves->slug?>">
                                    <? foreach ($ves->photos as $kesp => $vesp) :?>
                                        <? if($vesp->model->type == 'summary') : ?>
                                                <img   width="194" height="129"    data-src="<?='/timthumb.php?src='.$vesp->image.'&w=194&zc=0'?>" alt="<?=$vesp->description?>">
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <p class="tt"><?= $ves->title?></p>
                                </a>    
                               <a href="<?=DIR.$ves->slug.'?tab=form'?>" class="link-to-form">Personnaliser cette formule</a>    
                                <?  if(in_array($ves->model->item_id, $selectExcl)) : ?>    
                                <span data-id="<?= $ves->model->item_id?>" data-type="excl" class="btn-add pointer" name="selected"></span>
                                <? else: ?>
                                 <a  data-id="<?= $ves->model->item_id?>" data-type="excl" class="btn-add active" name=""></a>
                                <? endif; ?>
                            </div>
                        </li>
                        <? endforeach; ?>
                    </ul>
                    <? endif; ?>
            </div>
        <? else: ?>
        <p class="text-status-0">Votre liste d'envies est vide.</p>
        <p class="text-status-0">Vous pouvez continuer à nagivuer notre site pour ajouter les idées voyages à votre liste, ou faites-nous savoir vos envies en remplissant ce formulaire de demande.</p>

        <? endif; ?>
