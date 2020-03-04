<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.theme-1.4.5.min.css'); ?>
<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.icons-1.4.5.min.css'); ?>

<? $this->registerCssFile('/assets/css/mobile/form_tour.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerCssFile('/assets/css/mobile/bootstrap-datetimepicker.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<? $this->registerCssFile(DIR . 'assets/js/jquery-ui/jquery-ui-1.9.2.custom.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? 
$this->registerJsFile('/assets/js/jquery.crs.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/jquery.mobile-1.4.4.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('assets/js/jquery-ui/jquery-ui-1.9.2.custom.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerJsFile(DIR . 'assets/js/mobile/form_tour.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>

<div class="form-tour text-top">
    <div class="column row-2">
        
        <h1 class="title"><?= $theEntry->title?></h1>
    </div>
    <div class="">
        <? if (SEG2 == 'formules' || SEG2 == 'formules') { ?>
            Comment intégrer cette formule dans un programme sur-mesure ? Via ce formulaire, demandez-nous les détails et poussez encore plus loin vos exigences de voyage ! Notre équipe prendra le temps de vous répondre dans les plus brefs délais.
            <?} else if(SEG2 != 'formules' && $theEntry->category_id == 5){ ?>
                Vous aimez voguer sur l’eau ? Mais comment tracer votre itinéraire idéal en croisière ?  Via ce formulaire, dites-nous en quelques minutes vos attentes et envies, pour un séjour au plus près de l’eau et de la personnalisation. 
            <? }else if(SEG2 != 'formules' && $theEntry->category_id == 4){ ?>
                Vous avez trouvé la station balnéaire idéale ? Adaptez-la encore selon vos exigences d’un voyage sur-mesure !  Via ce formulaire, précisez-nous plus vos attentes et envies balnéaires. Notre équipe vous aidera à établir l'itinéraire qui correspond le plus à vos envies de vitamine « sea » !
        <? }?> 
    </div>
</div>
<div class="area-steps-bar">
    <ul id="progressbar">
        <li class="step-1 active">Participants</li>
        <li class="step-2">Décrivez<br>votre projet</li>
        <li class="step-3">Vos<br>coordonnées</li>
    </ul>
</div>
<div class="form-tour area-form content-tour-single active">
   
    
        <?//= $theEntry->model->text ?>
        <?
        $form = ActiveForm::begin([
                    'id' => 'devisform',
                    'action' => '',
                    'fieldConfig' => [
                        'options' => [
                            'tag' => 'span',
                        ],
                        'template' => '{input}{error}',
                    ],
        ]);
        ?>
        <div class="field-form">
            
            <ul class="show-info m-0 pt-50" style="color: #e26640; padding-left: 2rem;"></ul>
        </div>
        <div id="step-1" class="steps step-1 active">
            <div class="field-form">
                <table id="tbl-form-tour" class="tbl-form">
<!--                    <tr>
                        <td class="" colspan="2">
                            <?//=$form->errorSummary($model);?>
                        </td>
                    </tr>-->
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50"><?= Yii::$app->params['questions_form']['vouspartez'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['vouspartez'][2] ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="check-step-1">
                            <?=$form->field($model, 'vouspartez')->radioList(Yii::$app->params['formVousPartez']) ?>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-1">
                        <td class="" colspan="2">
                            <p class="amc-text-warning m-0 mt-50" style="margin-bottom: 0rem !important;">
                            Si vous souhaitez voyager seul, votre devis aura un coût plus conséquent qu'un voyage à plusieurs. Nous vous remercions de votre compréhension.
                            </p>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-2">
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50"><?= Yii::$app->params['questions_form']['les_par'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['les_par'][2] ?></span></p>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-2">
                        <td colspan="">
                            <div class="">
                                <p class="amc-text-label m-0 amc-lineheight-fs32 pt-0"><?= Yii::$app->params['questions_form']['numberOfTravelers18'][0] ?></p>
                            </div>
                        </td>
                        <td colspan="" class="pt-25" style="">
                            <div class="">
                                
                                <div class="check-step-1 parent-cong-tru">
                                    <span class="tru">-</span>
                                    <?= $form->field($model, 'numberOfTravelers18',[
                                     'inputOptions'=>['class'=>'target-cong-tru','value'=>0],
                                     ]) ?>
                                    <span class="cong">+</span>
                                </div>    
                            </div>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-3">
                        <td colspan="">
                            <div class="">
                                 <p class="amc-text-label m-0 amc-lineheight-fs32 pt-0"><?= Yii::$app->params['questions_form']['numberOfTravelers12'][0] ?></p>
                            </div>
                        </td>
                        <td colspan="" class="parent-cong-tru pt-25" style="">
<!--                            <div class="parent-cong-tru">-->
                           
                                    <span class="tru">-</span>
                                    <?= $form->field($model, 'numberOfTravelers12',[
                                     'inputOptions'=>['class'=>'target-cong-tru','value'=>0],
                                     ]) ?>
                                    <span class="cong">+</span>
<!--                            </div>-->
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-3">
                         <td colspan="">
                            <div class="">
                                  <p class="amc-text-label m-0 amc-lineheight-fs32 pt-0"><?= Yii::$app->params['questions_form']['numberOfTravelers2'][0] ?></p>
                            </div>
                        </td>
                        <td colspan="" class="parent-cong-tru pt-25" style="">
                           
                            <span class="tru">-</span>
                           <?= $form->field($model, 'numberOfTravelers2',[
                            'inputOptions'=>['class'=>'target-cong-tru','value'=>0],
                            ]) ?>
                            <span class="cong">+</span>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-3">
                         <td colspan="">
                            <div class="">
                                 <p class="amc-text-label m-0 amc-lineheight-fs32 pt-0"><?= Yii::$app->params['questions_form']['numberOfTravelers0'][0] ?></p>
                            </div>
                        </td>
                        <td colspan="" class="parent-cong-tru pt-25" style="">
                            
                            <span class="tru">-</span>
                           <?= $form->field($model, 'numberOfTravelers0',[
                            'inputOptions'=>['class'=>'target-cong-tru','value'=>0],
                            ]) ?>
                            <span class="cong">+</span>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-3-4">
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50 text-opt-1"><?= Yii::$app->params['questions_form']['agesOfTravelers12_seul'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['agesOfTravelers12_seul'][2] ?></span></p>
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50 text-opt-2"><?= Yii::$app->params['questions_form']['agesOfTravelers12'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['agesOfTravelers12'][2] ?></span></p>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-3-4">
                        <td colspan="2" class="check-step-1">
                            <?= $form->field($model, 'agesOfTravelers12') ?>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-3-4">
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25 text-opt-1"><?= Yii::$app->params['questions_form']['howTraveler_seul'][0] ?></p>
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25 text-opt-2"><?= Yii::$app->params['questions_form']['howTraveler'][0] ?> </p>
                        </td>
                    </tr>
                    <tr class="amc-vouspartez amc-opt-3-4">
                        <td colspan="2" class="fix-field-margin">
                            <?= $form->field($model, 'howTraveler') ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25"><?= Yii::$app->params['questions_form']['departureDate'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['departureDate'][2] ?></span></p>
                            <p class="m-0 amc-color-949494 amc-lineheight-fs32 mt-10"><?= Yii::$app->params['questions_form']['departureDate'][1] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="amc-fix-arrow check-step-1">
                            <?= $form->field($model, 'departureDate', ['inputOptions' => ['class' => 'input_small input-departureDate', 'placeholder' => 'Choisissez la date', 'data-clear-btn' => "false", 'readonly' => 'readonly', 'data-role' => 'date']]) ?> </div>

                        </td>
                    </tr>
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25"><?= Yii::$app->params['questions_form']['tourLength'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['tourLength'][2] ?></span></p>
                            <p class="m-0 amc-color-949494 amc-lineheight-fs32 mt-10"><?= Yii::$app->params['questions_form']['tourLength'][1] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="amc-fix-arrow check-step-1">
                           <?= $form->field($model, 'tourLength',[
                            'inputOptions'=>['class'=>''],
                            ])->dropDownList(range(0, 60)) ?>
                        </td>
                    </tr>
                                   
                       
                     <tr>
                        <td class="" colspan="2">
                            <div id="check-step-1" class="next-steps next-steps-control mt-50 mb-50" style="margin-left: 0; margin-right: 0;" data-name="step-2">
                                Étape suivante
                            </div>
                        </td>

                    </tr>
                </table>
            </div>   
            
        </div>
    
     
        <div id="step-2" class="steps step-2">
            <div class="field-form">
                <table id="tbl-form-tour" class="tbl-form">
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50"><?= Yii::$app->params['questions_form']['tourThemes'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['tourThemes'][2] ?></span></p>
                            <p class="m-0 amc-color-949494 amc-lineheight-fs32 mt-10"><?= Yii::$app->params['questions_form']['tourThemes'][1] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="fix-tour-theme">
                            <?//= $form->field($model, 'tourThemes')->checkboxList(Yii::$app->params['formTourThemeListMobile']) ?>
                            <?=

                            $form->field($model, 'tourThemes')->checkboxList(Yii::$app->params['formTourThemeList'], [

                                    //  'onclick' => "$(this).val( $('input:checkbox:checked').val()); ",
                                    
                                    'item' => function($index, $label, $name, $checked, $value) {
                                    $first = NULL;
                                    $last = NULL;
                                    
                                //    if(($index + 1) % 3 == 1 && ($index + 1) != 13 ){
                                    if(($index + 1) == 1 || ($index + 1) == 5 || ($index + 1) == 8 || ($index + 1) == 11 ){
                                        $first = '<div class="group-opt">';
                                    }   
                                //    if((($index + 1) % 3 == 0 || $index == count(Yii::$app->params['formTourThemeList']) - 1) && ($index + 1) != 12 ){
                                    if(($index + 1) == 4 || ($index + 1) == 7 || ($index + 1) == 10 || ($index + 1) == 14){
                                        $last = '</div>';
                                        
                                    }   
                                    return $first."<label><input type='checkbox' {$checked} name='{$name}' value='{$value}'> {$label}</label>".$last;
                                    
                                    }

                            ])

                        ?>
                        </td>
                    </tr>
                  
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50"><?= Yii::$app->params['questions_form']['message'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['message'][2] ?></span></p>
                            <p class="m-0 amc-color-949494 amc-tt-fontsize-28 mt-10"><?= Yii::$app->params['questions_form']['message'][1] ?></p>
                        </td>
                    </tr>
                    
                   <tr>
                        <td colspan="2" class="">
                            <div class="check-step-2">
                                <?= $form->field($model, 'message', [
                                    'inputOptions' => ['class' => 'input_full mb-20 amc-count-characters', 'maxlength'=>1000, 'rows' => 6],
                                ])->textArea()
                                ?>
                            </div>
                            <div class="text-count-down">
                                <!-- <p class="amc-color-949494 amc-tt-fontsize-28 mt-0 mb-0 charNum" id="charNum">1000 caractères restants</p> -->
                            </div>
                        </td>
                    </tr>
                    <!-- count character field message -->
<!--                    <tr>
                        <td colspan="2">
                            <p style="color: #e65925; font-size: 1.2rem; display: none;" class="mt-0 mb-0 txt-err"> Votre projet de voyage ne peut être vide et doit contenir entre 100 et 1000 caractères.</p>  
                            <p class="amc-color-949494 amc-tt-fontsize-28 mt-0 mb-0" id="charNum">1000 caractères restants</p>
                        </td>
                    </tr>-->
                    <!-- end count character field message -->
                   
                   
                  
                    <tr>
                        <td class="" colspan="2">
                            <p style="padding-top: 2rem;" class="amc-text-label amc-tt-latolatin-semibold m-0 pt-25"><?= Yii::$app->params['questions_form']['pourCeProjet'][0] ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" class="">
                           <?=$form->field($model, 'pourCeProjet')->radioList(Yii::$app->params['listPourCeProjet']);?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 pt-50"><?= Yii::$app->params['questions_form']['budget'][0] ?></p>
                            <p class="m-0 amc-color-949494 amc-tt-fontsize-28 mt-10"><?= Yii::$app->params['questions_form']['budget'][1] ?></p>
                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="">
                           <?= $form->field($model, 'budget', ['inputOptions' => ['class' =>'text-placeholder-right', 'type'=>'number', 'pattern'=>'[0-9]*', 'placeholder'=>'€ par personne']]) ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">

                            <?=$form->field($model, 'budgetPlafond')->checkbox(
                                    ['label'=>Yii::$app->params['questions_form']['budgetPlafond'][0]]
                            ) ?>

                        </td>
                    </tr> 
                     <tr class="amc-opt-budget" style="display: none;">
                        <td class="" colspan="2">
                            <p class="amc-text-warning m-0 mt-0 mb-50" style="">
                                 À titre de prévention, le budget que vous avez estimé, risque de ne pas correspondre au montant moyen d’un voyage sur-mesure. Votre conseiller en voyage vous le précisera sûrement.
                           </p>
                        </td>
                    </tr>
                    
                   
                    <tr>
                        <td class="" colspan="2">
                            <div id="check-step-2" class="next-steps next-steps-control mt-25 mb-50" style="margin-left: 0; margin-right: 0;" data-name="step-3">
                                Étape suivante
                            </div>
                            <div class="back-steps back-steps-control mt-50 mb-50" style="margin-left: 0; margin-right: 0;" data-name="step-1" data-bar="step-2">
                                Étape précédente
                            </div>
                        </td>

                    </tr>
                </table>
            </div>   
           
        </div>
        
        <div id="step-3" class="steps step-3">
            <div class="field-form">
                <table id="tbl-form-tour" class="tbl-form">
                    <tr>
                        <td colspan="2">
                            <?=$form->errorSummary($model);?>
                        </td>
                    </tr>
                    <tr>
                        <td class="" colspan="2">
                            <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-50"><?= Yii::$app->params['questions_form']['prefix'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['prefix'][2] ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="amc-fix-arrow">
                            <?= $form->field($model, 'prefix',[
                        'inputOptions'=>['class'=>'input_xxlarge'],
                        ])->radioList(['Madame' => 'Madame', 'Monsieur' => 'Monsieur']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="" colspan="2">
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25"><?= Yii::$app->params['questions_form']['fullName'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['fullName'][2] ?></span></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?= $form->field($model, 'fullName') ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="" colspan="2">
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25"><?= Yii::$app->params['questions_form']['email'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['email'][2] ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?= $form->field($model, 'email', ['inputOptions' =>['placeholder' => 'email@domain.com']]) ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="" colspan="2">
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25"><?= Yii::$app->params['questions_form']['code_postal'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['code_postal'][2] ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?= $form->field($model, 'code_postal', ['inputOptions' =>['class'=>'','type'=>'number', 'pattern'=>'[0-9]*', 'placeholder'=>'10000']]) ?>
                        </td>
                    </tr>
                   
                    <tr>
                        <td class="" colspan="2">
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25"><?= Yii::$app->params['questions_form']['country'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['country'][2] ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="amc-fix-arrow">
                            <?php
                                $code_country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';     
                            ?>
                            <?=$form->field($model, 'country', [
                            'inputOptions'=>['class'=>'fix-arrow input-country crs-country not-blank', 'data-value'=>'shortcode', 'data-default-value'=>$code_country, 'data-region-id'=>'devisformmobile-region'],
                            ])->dropDownList([
                                    'prompt'=>'- Sélectionez -',

                            ])?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="" colspan="2">
                             <p class="amc-text-label amc-tt-latolatin-semibold m-0 amc-lineheight-fs32 pt-25"><?= Yii::$app->params['questions_form']['telephone'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['telephone'][2] ?></span></p>
                             <p class="m-0 amc-color-949494 amc-tt-fontsize-28 mt-10"><?= Yii::$app->params['questions_form']['telephone'][1] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="">
                            <div class="area_dial_code_country" style="display: none;">
                            <?=$form->field($model, 'dialcodeCountry', ['inputOptions'=>['class'=>'input_dial_code_country']]);?>
                            </div>   
                            <?=$form->field($model, 'telephone', ['inputOptions'=>['class'=>'dial-code-country','type'=>'tel', 'pattern'=>'[0-9]*','placeholder'=>'']]) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="" colspan="2">
                            <p style="padding-top: 1rem;" class="amc-text-label amc-tt-latolatin-semibold m-0 pt-25"><?= Yii::$app->params['questions_form']['reference'][0] ?></p>
                             
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?=
                            $form->field($model, 'reference', [
                                'inputOptions' => ['class' => '', 'rows' => 1,'style'=>'min-height: 4.5rem;'],
                            ])->textArea()
                            ?></td>
                    </tr>
                    
                  
                    
                </table>
                
            </div>
            <div class="field-form" style="padding: 0 1.6rem 2.5rem;">
                <table id="tbl-form-tour" class="tbl-form">
                    <tr>
                        <td colspan="2">

                            <?=$form->field($model, 'newsletter')->checkbox(
                                    ['label'=> Yii::$app->params['questions_form']['newsletter'][0] ]
                            ) ?>

                        </td>
                    </tr>    
                </table>
                <?=$form->field($model, 'duraTime', ['inputOptions'=>['class'=>'dura-time hidden d-none']]);?>
                <div id="btn-valider-form" style="padding: 0 1.6rem !important; margin-left: 0; margin-right: 0;" class=" next-steps mt-25 mb-50">
                    Envoyer votre demande de projet
                </div>
                <div class="back-steps back-steps-control mt-50 mb-0" style="margin-left: 0; margin-right: 0;" data-name="step-2" data-bar="step-3">
                    Étape précédente
                </div>
            </div>
            
        </div>
         
        <div class="" style="background: white;">
            <p class="m-0 amc-lineheight-fs32 pt-50 pb-25 amc-tt-fontsize-32" style="padding-left: 1.6rem;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>
            <p class="text-private mt-25 pb-50 mb-0" style="padding-left: 1.6rem;">En validant ce formulaire, vous acceptez notre <a href="/politique-de-confidentialite" target="_blank">politique de confidentialité et de collecte.</a></p>        
       
        </div> 
        <?php
        ActiveForm::end();
        ?>
    
</div>

<?php
$css=<<<CSS
    
    .btn-header li.navigation{
    display: none;
   }
   
        .btn-header li.logo{
        width: 100%;
        padding: 0;
   }
CSS;
$this->registerCss($css);
$js=<<<JS
      
        
        // End Fixed Menu
        
 

    var iScrollPos = 0;
var positionMenu = $('.tt-custom-btn-form').position();


  
  $(document).on('scroll', function(event) {
    
    if ($(document).scrollTop() > positionMenu.top + 100) {
        var iCurScrollPos = $(document).scrollTop();

        if (iCurScrollPos > iScrollPos) {
            
            
            $('.tt-custom-btn-form').removeClass('fixed-top');
            $('.fix-height').removeClass('active');

        } else {
           
            $('.tt-custom-btn-form').addClass('fixed-top');

            $('.fix-height').addClass('active');
        }
        iScrollPos = iCurScrollPos;

    } else {
        
        $('.tt-custom-btn-form').removeClass('fixed-top');
        $('.fix-height').removeClass('active')
    }
  });

 
JS;
// $this->registerJs($js,  \yii\web\View::POS_END);

?>
<?
$seg1 = SEG1;
$js=<<<JS
    $('#devisformmobile-departuredate').datepicker({
    beforeShowDay: $(this).hasClass('noWeekends') ? $.datepicker.noWeekends : null,
    changeYear: true,
    changeMonth: true,
    yearRange: '-0y-0m_:+5y',
    monthNamesShort: ['janvier', 'fèvrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
    dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
    closeText: 'fermer',
    minDate: '+1 d',
    currentText: 'aujourd\'hui',
    showOtherMonths: true,
    showButtonPanel: true,
    firstDay: 1,
    duration: 0,
    dateFormat: 'dd-mm-yy',
    onClose: function(selectedDate) {
        if (selectedDate != '') {
            selectedDate = selectedDate.split('-')[2] + '-' + selectedDate.split('-')[1] + '-' + selectedDate.split('-')[0];
            var dateObject = new Date(selectedDate);
            dateObject.setDate(dateObject.getDate() + 1);
            $("#devisformmobile-deretourdate").datepicker("option", "minDate", dateObject);
        }
    }
});
$('#devisformmobile-deretourdate').datepicker({
    beforeShowDay: $(this).hasClass('noWeekends') ? $.datepicker.noWeekends : null,
    changeYear: true,
    changeMonth: true,
    yearRange: '-0y-0m_:+5y',
    monthNamesShort: ['janvier', 'fèvrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
    dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
    closeText: 'fermer',
    minDate: '+2 d',
    currentText: 'aujourd\'hui',
    showOtherMonths: true,
    showButtonPanel: true,
    firstDay: 1,
    duration: 0,
    dateFormat: 'dd-mm-yy',
    onClose: function(selectedDate) {
        if (selectedDate != '') {
            selectedDate = selectedDate.split('-')[2] + '-' + selectedDate.split('-')[1] + '-' + selectedDate.split('-')[0];
            var dateObject = new Date(selectedDate);
            dateObject.setDate(dateObject.getDate() - 1);
            $("#devisformmobile-departuredate").datepicker("option", "maxDate", dateObject);
        }
    }
});
        
$('.datepicker').datepicker({
	//beforeShowDay: $(this).hasClass('noWeekends') ? $.datepicker.noWeekends : null,
	// beforeShowDay: function(date){
    //	$(this).hasClass('noWeekends') ? $.datepicker.noWeekends : null;
    //    var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
    //    return [ array.indexOf(string) == -1 ]
   // },
    beforeShowDay: $.datepicker.noWeekends,
	changeYear: true,
	changeMonth: true,
	yearRange: '-0y-0m_:+5y',
	monthNamesShort: ['janvier','fèvrier','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'],
	dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
	closeText: 'fermer',
	minDate: '+1 d',
	currentText: 'aujourd\'hui',
	showOtherMonths: true,
	showButtonPanel: true,
	firstDay: 1,
	duration: 0,
	dateFormat: 'dd-mm-yy',
       
	});       
        
$('.tru').click(function(){
    var input = $(this).parent('.parent-cong-tru').find('.target-cong-tru').val();
    if(parseInt(input) > 0){    
        $(this).parent('.parent-cong-tru').find('.target-cong-tru').val((parseInt(input) - 1)).change();
         
    }    
});        
  $('.cong').click(function(){
    var inputcong = $(this).parent('.parent-cong-tru').find('.target-cong-tru').val();
        
    $(this).parent('.parent-cong-tru').find('.target-cong-tru').val((parseInt(inputcong) + 1)).change();    
});  
$('select[name="DevisFormMobile[tourLength]"]').change(function(){
    $('input[name="DevisFormMobile[budget]"]').change();
});

$('input[name="DevisFormMobile[budget]"]').on("change keyup keydown",function(){
    var budget = $(this).val();
    var length = $('select[name="DevisFormMobile[tourLength]"]').val();
    //var destination = $('input[name="DevisFormMobile[countriesToVisit][]"]').is(':checked');
    var destination = '$seg1';   
     var xx = 80;  
     var yy = 100;   
     var zz = parseInt(length);   
     var kk = parseInt(budget);
     var budget80 = zz * xx;
     var budget100 = zz * yy;   
    
    if(zz > 0){
        
        
        
        if(destination == 'vietnam' || destination == 'laos' || destination == 'cambodge'){
            if(kk < budget80){
                $('.amc-opt-budget').show();
            
            }else{
               $('.amc-opt-budget').hide(); 
              
            }
        }
        if(destination == 'birmanie'){
            if(kk < budget100){
                $('.amc-opt-budget').show();
            
            }else{
               $('.amc-opt-budget').hide(); 
              
            }
        }
        
   }else{
       $('.amc-opt-budget').hide(); 
    }    
        
   
});                 
        
JS;
$this->registerJs($js,  yii\web\View::POS_END);
?>

<?
$this->registerCssFile('/assets/css/page2016/intlTelInput.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/intlTelInput.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

$js =<<<JS
           
//var input = document.querySelectorAll(".dial-code-country");
       // console.log(input);
 $('.dial-code-country').each(function(){ 
        
    var target = $(this);    
     //   console.log(target.context);
   
 var iti = window.intlTelInput(target.context, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["vn"],
      // formatOnDisplay: false,
       geoIpLookup: function(callback) {
         $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
           var countryCode = (resp && resp.country) ? resp.country : "";
           callback(countryCode.toLowerCase());
         });
       },
      // hiddenInput: "full_number",
       initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
       separateDialCode: true,
      utilsScript: "/assets/js/intl-tel-input/build/js/utils.js?1562189064761"
    });   
        
        var input = target.context;
    input.addEventListener('countrychange', function(e) {
        var dialcode = iti.getSelectedCountryData().dialCode;
      //  console.log(dialcode);
        $('.input_dial_code_country').val(dialcode);
      });    
        
});              
//  var iti = intlTelInput(input); 
//  iti.destroy();    
//  var countryData = iti.getSelectedCountryData();
//console.log(countryData);    

//$(window).bind('load',function(){
//    var dialcode = $('.selected-flag').attr('title');
//        var nb = dialcode.split('+');
//        $('.input_dial_code_country').val(nb[1]);
//       // console.log(dialcode);
//});        
//$('#country-listbox li').click(function(){
//    var dia = $(this).data('dial-code');
//         $('.input_dial_code_country').val(dia);
//      //  console.log(dia);
//});     
    
//$(document).on("click", "#country-listbox li", function(event){
//     var dia = $(this).data('dial-code');
//         $('.input_dial_code_country').val(dia);
//       // console.log(dia);
//});
        
//$(".amc-count-characters").keyup(function(){
//    var maxLength = $(this).attr('maxlength');    
//    el = $(this);
//    if(el.val().length > maxLength){
//        el.val( el.val().substr(0, maxLength) );
//    } else {
//        $("#charNum").text(maxLength - el.val().length + ' caractères restants');
//    }
//    if(el.val().length >= 100){
//        $('.txt-err').hide();      
//    }else{
//        $('.txt-err').show();      
//    }
//});         
        
        
$(".amc-count-characters").keyup(function(){
    var maxLength = $(this).attr('maxlength');   
    
    el = $(this);
        
    var hClass = el.parent().parent().parent().children('.text-count-down').children('.charNum').hasClass('amc-fix-disable');    
    if(el.val().length === 0){
        
        if(hClass){
            el.parent().parent().parent().children('.text-count-down').children('.charNum').addClass('yes');
        }
    }else if(el.val().length > maxLength){
        el.val( el.val().substr(0, maxLength) );
    } else {
        if(hClass){
            el.parent().parent().parent().children('.text-count-down').children('.charNum').removeClass('yes');
        }
        el.parent().parent().parent().children('.text-count-down').children('.charNum').text(maxLength - el.val().length + ' caractères restants');
    }
});          
    

$('input[name="DevisFormMobile[howTicket]"]').click(function(){
    var val = $(this).val();
    if (val == 'Oui') {
            $('.ticket-plus').hide();
            $('.ticketDetail').show();
            
    } else if(val == 'Non') {
            $('.ticket-plus').hide();
            $('.help-ticket').show();
           // $('.howTicket').hide();
    }else{
         $('.ticket-plus').hide();
            $('.help-ticket').hide();
           // $('.howTicket').hide();
    }
});       
        
        
  $(document).ready(function () {
    $("input[name='DevisFormMobile[tourThemes][]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='DevisFormMobile[tourThemes][]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
          //  alert('You can select maximum ' + maxAllowed + ' technologies!!');
        }
    });
});          
        
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
?>  