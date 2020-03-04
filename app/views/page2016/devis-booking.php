<?php $this->registerCssFile('/assets/css/page2016/devis.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/all-form.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>


<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

 <a class="btn-contactez-nous d-none d-sm-none d-lg-block" href="/rdv-telephonique">RDV téléphonique</a>


<div class="contain container-1">
    <div class="amc-column back-to-tour">
        <a alt="Revenir à la page précédente" href="<?=DIR.$theEntry->slug?>">< Revenir à la page précédente</a>
    </div>
    <?php
      
        if(!empty($theEntry->photos)){
            
            foreach ($theEntry->photos as $v) {
               
                if($v->model->type == 'banner'){
     ?>
    <img alt="" style="width: 100%" class="banner img-lazy" alt="<?= $v->description?>" data-src='<?= $v->image?>'>
        <?php
                }
            }
        
         }else{
       ?>
    <img alt="" class="img-lazy" style="width: 100%;" data-src='<?=DIR?>upload/image/banner-idees-de-voyage-single.jpg'>
         <?php } ?>
<!--    <div class="amc-column row-2 mb-txt-40">
        <h1 class="title"><?//= str_replace('|', '<br>',$this->context->pageT)?></h1>
        <p class="tt-s">
            <?//= $theEntry->model->sub_title?>
        </p>
    </div>-->
</div>

<!-- Form Booking Tour -->

<div class="contain container-2 area-form amc-fix-title-text">
    <div class="amc-column row-2 mb-0 pt-txt-40 text-center">
        <h1 class="title amc-fontsize-32 amc-latolatin-bold amc-color-e75925 m-0"><?= str_replace('|', '<br>',$this->context->pageT)?></h1>
        <? if($theEntry->model->sub_title != ''){?>
        <p class="tt-s m-0 mt-txt-20">
            <?= $theEntry->model->sub_title?>
        </p>
        <? } ?>
    </div>
    <div class="amc-column pt-0 pt-txt-40 pb-txt-40">
        <div class="text text-top-form">
            Vous avez trouvé le circuit idéal ? Adaptez-le encore selon vos exigences d’un voyage sur-mesure !
Ici, donnez un coup de pouce à votre conseiller(e) en voyage, en nous faisant partager vos émotions, 
attentes et envies, le tout en quelques minutes !
        </div>
        
    </div>
            
</div>

<!--End Form Booking Tour-->

<div class="contain container-form">
<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\captcha\Captcha;

$form = ActiveForm::begin([
        'id'=>'devis-form',
        'action'=>'',
        'fieldConfig'=>[
                'options'=>[
                        'tag'=>'span',
                ],
                'template'=>'{input}{error}',
        ],
      'enableClientValidation'=>TRUE,
]);
?>
    <div class="amc-bg-color-f7f7f7 area-1">
        <table id="" class="form">
            <tr>

                <td colspan="2" class="info-error">
                    
                    <div class="float-left w-100">
                        <?=$form->errorSummary($model);?>
                    </div>    
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2 class="amc-tt-area amc-tt-area-1 amc-fontsize-22 amc-latolatin-bold mt-40 mb-0" style=""><?= Yii::$app->params['questions_form']['title_partic'][0] ?></h2>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left p-0" style="">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['vouspartez'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['vouspartez'][2] ?></span></p>
                        <?=$form->field($model, 'vouspartez')->radioList(Yii::$app->params['formVousPartez']) ?>
                    </div> 
                </td>
            </tr>
        
            <tr>
                <td colspan="2">
                    <div class="float-left w-100 p-0">
                        <p class="amc-text-warning amc-fontsize-13 amc-color-e75925 amc-latolatin-medium mb-0 mt-10 amc-vouspartez amc-opt-1">
                            Si vous souhaitez voyager seul, votre devis aura un coût plus conséquent qu'un voyage à plusieurs. Nous vous remercions de votre compréhension.
                        </p>
                        <p class="amc-text-question amc-latolatin-semibold mt-25 mb-5 amc-vouspartez amc-opt-2"><?= Yii::$app->params['questions_form']['les_par'][0] ?></p>
                        <div class="float-left p-0 pr-5 amc-vouspartez amc-opt-2">
                            <p class=""><?= Yii::$app->params['questions_form']['numberOfTravelers18'][0] ?></p>
                            <div class="float-left amc-arrow p-0 input-width-150">
                                <?=$form->field($model, 'numberOfTravelers18', ['inputOptions'=>['class'=>'input-width-150 amc-iput-focus']])->dropDownList(range(0, 60))?>
                            </div>
                        </div>
                        <div class="float-left p-0 pl-20 pr-5 amc-vouspartez amc-opt-3">
                            <p class=""><?= Yii::$app->params['questions_form']['numberOfTravelers12'][0] ?></p>
                            <div class="float-left amc-arrow p-0 input-width-150">
                                <?=$form->field($model, 'numberOfTravelers12', ['inputOptions'=>['class'=>'input-width-150 amc-iput-focus']])->dropDownList(range(0, 60))?>
                            </div>
                        </div>
                        <div class="float-left p-0 pl-20 pr-5 amc-vouspartez amc-opt-3">
                            <p class=""><?= Yii::$app->params['questions_form']['numberOfTravelers2'][0] ?></p>
                            <div class="float-left amc-arrow p-0 input-width-150">
                                <?=$form->field($model, 'numberOfTravelers2', ['inputOptions'=>['class'=>'input-width-150 amc-iput-focus']])->dropDownList(range(0, 60))?>
                            </div>
                        </div>
                        <div class="float-left p-0 pl-20 amc-vouspartez amc-opt-3">
                            <p class=""><?= Yii::$app->params['questions_form']['numberOfTravelers0'][0] ?></p>
                            <div class="float-left amc-arrow p-0 input-width-150">
                                <?=$form->field($model, 'numberOfTravelers0', ['inputOptions'=>['class'=>'input-width-150 amc-iput-focus']])->dropDownList(range(0, 60))?>
                            </div>
                        </div>
                    </div>
                    <div class="float-left w-100 p-0 amc-vouspartez amc-opt-3-4">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10 text-opt-1"><?= Yii::$app->params['questions_form']['agesOfTravelers12_seul'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['agesOfTravelers12_seul'][2] ?></span></p>
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10 text-opt-2"><?= Yii::$app->params['questions_form']['agesOfTravelers12'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['agesOfTravelers12'][2] ?></span></p>
                        <div class="float-left p-0">
                            <?=$form->field($model, 'agesOfTravelers12', ['inputOptions'=>['class'=>'input-width-336']])?>
                        </div>    
                    </div>
                    <div class="float-left w-100 p-0 mb-10 amc-vouspartez amc-opt-3-4">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10 text-opt-1"><?= Yii::$app->params['questions_form']['howTraveler_seul'][0] ?></p>
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10 text-opt-2"><?= Yii::$app->params['questions_form']['howTraveler'][0] ?></p>
                        <?=$form->field($model, 'howTraveler', [
                                            'inputOptions'=>['class'=>'input-width-336', 'style'=>'height: 45px;','rows'=>1],
                                            ])->textArea()?>
                    </div> 
                </td>
            </tr>
           
            <tr>
                <td colspan="2">
                    <div class="float-left pr-10">
                        <p class="amc-text-question amc-latolatin-semibold mt-25 mb-10"><?= Yii::$app->params['questions_form']['departureDate'][0] ?> <span class="amc-color-b1b1b1 amc-latolatin-regular"><?= Yii::$app->params['questions_form']['departureDate'][1] ?></span> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['departureDate'][2] ?></span></p>

                        <div class="float-left amc-arrow p-0" style="min-width: 196px;">
                            <?=$form->field($model, 'departureDate', ['inputOptions'=>['class'=>'amc-iput-focus input-width-196 input-departureDate datepicker','placeholder'=>'Choisissez la date']])?>
                        </div> 
                    </div>
                    <div class="float-left pl-10">
                        <p class="amc-text-question amc-latolatin-semibold mt-25 mb-10"><?= Yii::$app->params['questions_form']['tourLength'][0] ?> <span class="amc-color-b1b1b1 amc-latolatin-regular"><?= Yii::$app->params['questions_form']['tourLength'][1] ?></span> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['tourLength'][2] ?></span></p>

                        <div class="float-left amc-arrow p-0" style="min-width: 116px;">
                            <?=$form->field($model, 'tourLength',['inputOptions'=>['class'=>'amc-iput-focus input-width-116 input-tourLength']])->dropDownList(range(0, 60))?>     
                        </div>
                    </div>

                </td>
            </tr>

        </table>                
    </div>
    <div class="area-2 pb-40">
        <table id="" class="form">
            <tr>
                <td colspan="2">
                    <h2 class="amc-tt-area amc-tt-area-2 amc-fontsize-22 amc-latolatin-bold mt-40 mb-0" style=""><?= Yii::$app->params['questions_form']['title_decrivez'][0] ?></h2>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="fix-tour-theme">
                    <div class="float-left">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['tourThemes'][0] ?> <span class="amc-color-b1b1b1 amc-latolatin-regular"><?= Yii::$app->params['questions_form']['tourThemes'][1] ?></span> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['tourThemes'][2] ?></span></p>
                        <?//=$form->field($model, 'tourThemes')->checkboxList(Yii::$app->params['formTourThemeList'])?>
                        
                        <?=

                            $form->field($model, 'tourThemes')->checkboxList(Yii::$app->params['formTourThemeList'], [

                                    //  'onclick' => "$(this).val( $('input:checkbox:checked').val()); ",
                                    
                                    'item' => function($index, $label, $name, $checked, $value) {
                                    $first = NULL;
                                    $last = NULL;
                                    
                                //    if(($index + 1) % 3 == 1 && ($index + 1) != 13 ){
                                    if(($index + 1) == 1 || ($index + 1) == 5 || ($index + 1) == 9 || ($index + 1) == 12 ){
                                        $first = '<div class="group-opt">';
                                    }   
                                //    if((($index + 1) % 3 == 0 || $index == count(Yii::$app->params['formTourThemeList']) - 1) && ($index + 1) != 12 ){
                                    if(($index + 1) == 4 || ($index + 1) == 8 || ($index + 1) == 11 || ($index + 1) == 14){
                                        $last = '</div>';
                                        
                                    }   
                                    return $first."<label><input type='checkbox' {$checked} name='{$name}' value='{$value}'> {$label}</label>".$last;
                                    
                                    }

                            ])

                        ?>
                        
                    </div>    
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['message'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['message'][2] ?></span></p>
                        <p class="amc-color-b1b1b1"><?= Yii::$app->params['questions_form']['message'][1] ?></p>
                        <?=$form->field($model, 'message', [
                            'inputOptions'=>['class'=>'input_full amc-count-characters', 'maxlength'=>1000, 'rows'=>4,'style'=>'height: 140px;'],
                            ])->textArea()?>
<!--                         <p class="amc-color-b1b1b1 charNum" id="charNum">1000 caractères restants</p>
 -->                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left p-0 <?= empty($theProgram) ? 'd-none' : ''?>">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['extension'][0] ?> <span class="amc-color-b1b1b1 amc-latolatin-regular"><?= Yii::$app->params['questions_form']['extension'][1] ?></span></p>
                        
                        <?=$form->field($model, 'extension', ['inputOptions'=>['class'=>'i-checks']])->checkboxList(\yii\helpers\ArrayHelper::map($theProgram, 'title', 'title'), ['item' =>
                            function ($index, $label, $name, $checked, $value) {
                                return Html::checkbox($name, $checked, [
                                    'value' => $value,

                                    'label' => '<span class="topopup" name="pop-'.($index + 1).'">' . $label . '</span>',

                                    //'id' => $label,
                                ]);
                        },])?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-25 mb-10">
                            <?= Yii::$app->params['questions_form']['pourCeProjet'][0] ?>
                            
                        </p>
                        <?=$form->field($model, 'pourCeProjet')->radioList(Yii::$app->params['listPourCeProjet']);?>
                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left col-12 p-0">
                        <p class="amc-text-question amc-latolatin-semibold mt-25 mb-5"><?= Yii::$app->params['questions_form']['budget'][0] ?></p> 
                        <p class="amc-color-b1b1b1"><?= Yii::$app->params['questions_form']['budget'][1] ?></p>
                        <div class="p-0 col-12 d-flex">
                            <div class="col-lg-4 col-sm-5 p-0">
                            <?=$form->field($model, 'budget', ['inputOptions'=>['class'=>'text-placeholder-right input-width-210', 'type'=>'number', 'pattern'=>'[0-9]*', 'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57', 'placeholder'=>'€ par personne']]) ?>
                            </div>
                            <div class="col-6 p-0 pt-5 d-flex align-items-center">
                            <?=$form->field($model, 'budgetPlafond')->checkbox(
                                    ['label'=> Yii::$app->params['questions_form']['budgetPlafond'][0]]
                            ) ?>
                            </div> 
                        </div>    
                        <p class="amc-text-warning amc-fontsize-13 amc-color-e75925 amc-latolatin-medium mb-0 mt-10 amc-opt-budget" style="display: none;">
                             À titre de prévention, le budget que vous avez estimé, risque de ne pas correspondre au montant moyen d’un voyage sur-mesure. Votre conseiller en voyage vous le précisera sûrement.
                        </p>
                    </div>  
                </td>
            </tr>
        </table>    
    </div>
    <div class="area-4 pb-txt-40 amc-bg-color-f7f7f7">
        <table id="" class="form">
            <tr>
                <td colspan="2">
                    <h2 class="amc-tt-area amc-tt-area-4 amc-fontsize-22 amc-latolatin-bold mt-40 mb-0" style=""><?= Yii::$app->params['questions_form']['title_convenir'][0] ?></h2>
                </td>
            </tr>
           <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['callback'][0] ?></p>
                        <p class="amc-color-b1b1b1"><?= Yii::$app->params['questions_form']['callback'][1] ?></p>
                        
                        <div id="radio-rdv">

                            
                            <?=
                            $form->field($model, 'callback', ['inputOptions' => ['class' => 'input_xxlarge', 'style' => 'display: inline-block;']])->radioList(
                                    ['Oui' => 'Oui', 'Non' => 'Non, pas dans l\'immédiat']
                            )
                            ?>

                        </div>
                     </div>   
                </td>
            </tr>
            <tr class="rdv" style="display:<?=$model->callback == 'Oui' ? 'auto' : 'none'?>">
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-25 mb-10"><?= Yii::$app->params['questions_form']['phone'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['phone'][2] ?></span></p>
                        
                        <div class="float-left amc-arrow p-0 pr-5" style="display: none;">
                            <?=$form->field($model, 'countryCallingCode', ['inputOptions' => ['class' => 'input-width-186 amc-iput-focus']])
                            ->dropDownList(ArrayHelper::map($allDialCodes, 'code', 'xcode'), [
                                'prompt' => '- Indicatif de pays -',
                            ]) ?>
                        </div>    
                        <div class="float-left p-0 pl-0">
                            <?=$form->field($model, 'phone', ['inputOptions'=>['class'=>'dial-code-country input-width-265 not-blank']]) ?>
                        </div>    
                    </div>    
                </td>
            </tr>
            <tr class="rdv" style="display:<?=$model->callback == 'Oui' ? 'auto' : 'none'?>">
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10"><?= Yii::$app->params['questions_form']['callDate'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['callDate'][2] ?></span></p>
                        
                        <div class="float-left amc-arrow p-0">
                                <?=$form->field($model, 'callDate', ['inputOptions'=>['class'=>'input-width-272 amc-iput-focus datepicker noWeekends','placeholder' =>'Choisissez la date']]) ?>
                                <!-- entre-->
                                <?//=$form->field($model, 'callTime')
                                //	->dropDownList(Yii::$app->params['formRdvTimeList'], [
                                        //	'prompt'=>'- Heure -',
                                //	]) ?>

                                <!--(heure GMT)-->
                                <div style="padding-top:5px; display: none;"> NOTE: Les horaires disponibles pour demander un RDV téléphonique chez Amica Travel sont entre 2:00 AM et 7:00 PM heure GMT (ou entre
                                        <?=date_format(date_timezone_set(date_create('02:00:00'), timezone_open('Europe/Paris')), 'h A')?>
                                        et
                                        <?=date_format(date_timezone_set(date_create('19:00:00'), timezone_open('Europe/Paris')), 'h A')?> heure locale français) tous les jours (sauf Dimanche)</div>
                        </div>  
                    </div>    
                </td>
            </tr>
            <!-- begin test-->
                        <?php
$tzi = DateTimeZone::listIdentifiers();
$country_code = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';       
$cc = isset($_GET['cc']) ? $_GET['cc'] : $country_code;
$timezone = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, strtoupper($cc)); 

$tz = isset($_GET['tz']) && in_array($_GET['tz'], $tzi) ? $_GET['tz'] : $timezone[0];
//$tz = isset($_GET['tz']) && in_array($_GET['tz'], $tzi) ? $_GET['tz'] : 'Europe/Paris';
//$tz = isset($_GET['tz']) && in_array($_GET['tz'], $tzi) ? $_GET['tz'] : 'Asia/Ho_Chi_Minh';
$tz = isset($_POST['tz']) && in_array($_POST['tz'], $tzi) ? $_POST['tz'] : $tz;

date_default_timezone_set($tz);
//$startDate = new DateTime('tomorrow');
$startDate = isset($_GET['datepicker']) ? new DateTime($_GET['datepicker']) : new DateTime('tomorrow');
$utcOKDate = new DateTime('tomorrow');
		?>
            <tr class="rdv" style="display:<?=$model->callback == 'Oui' ? 'auto' : 'none'?>">
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['callTime'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['callTime'][2] ?></span></p>
                        <p class="amc-color-b1b1b1"><?= Yii::$app->params['questions_form']['callTime'][1] ?></p>
                        
                        <div class="float-left p-0">

                            <div id="tzSelectDiv" class="amc-arrow">
                                    <span>
                                    <select id="tzSelect" name="tz" class="input-width-272 amc-iput-focus input_full">
                                                <option value="">- Votre timezone -</option>
                                                <?php foreach ($tzi as $li) { ?>
                                                <option value="<?=$li?>" <?=$li == $tz ? 'selected="selected"' : ''?>><?=str_replace(['_', '/', 'Africa', 'Asia'], [' ', ' / ', 'Afrique', 'Asie'], $li)?></option>
                                                <?php } ?>
                                        </select>
                                        <span id="tzOK" style='display: inline-block;'></span>
                                    </span>    
                                </div>
                           </div>
                    </div>    
                </td>
            </tr>
            <tr class="new-rdv rdv" style="display:<?=$model->callback == 'Oui' ? 'auto' : 'none'?>">
                <td colspan="2">
                   <div class="float-left w-100">
                       
                       <div class="float-left p-0" style="margin-top: 18px; margin-bottom: 5px;">
                            <div class="times-to-call" style="width: 72%; float:left;">
                                <? for($i=7; $i < 19; $i++)  : ?>
                                <span class="time col-xs-2 col-sm-2 col-md-2 col-lg-2"><?=$i.'-'. ($i+1).'H'?></span>
                            <? endfor; ?>
                            </div>
                            <?=$form->field($model, 'callTime', ['inputOptions'=>['class'=>'input_medium hidden timeutc']]);?>
                        </div> 
                    </div>    
                </td>
            </tr>
        <!-- end test -->
        </table>    
    </div>
    <div class="area-5 pb-40">
        <table id="" class="form">
            <tr>
                <td colspan="2">
                    <h2 class="amc-tt-area amc-tt-area-5 amc-fontsize-22 amc-latolatin-bold mt-40 mb-0" style=""><?= Yii::$app->params['questions_form']['title_vos'][0] ?></h2>
                </td>
            </tr>
             <tr>
                <td colspan="2">
                    <div class="float-left pr-20">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5"><?= Yii::$app->params['questions_form']['prefix'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['prefix'][2] ?></span></p>

                        <div class="float-left amc-arrow p-0">
                            <?=$form->field($model, 'prefix', ['inputOptions'=>['class'=>'amc-iput-focus input-width-116 input-prefix']])->radioList(
                                    ['Madame' => 'Madame', 'Monsieur' => 'Monsieur']
                            )?>
                                
                        </div> 
                    </div>
                   
                    
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    
                    <div class="float-left pl-0 pr-5">
                        <p class="amc-text-question amc-latolatin-semibold mt-25 mb-10"><?= Yii::$app->params['questions_form']['fullName'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['fullName'][2] ?></span></p>

                        <div class="float-left p-0" style="">
                            <?=$form->field($model, 'fullName', ['inputOptions'=>['class'=>'input-width-340','placeholder'=>'']]) ?>
                        </div>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    
                    <div class="float-left pr-5">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10"><?= Yii::$app->params['questions_form']['email'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['email'][2] ?></span></p>

                        <div class="float-left p-0" style="">
                           <?=$form->field($model, 'email', ['inputOptions'=>['class'=>'email input-width-340 disablecopypage','placeholder'=>'email@domain.com']]) ?>
                                
                        </div>
                    </div>
                    
                    <div class="float-left pl-20 pr-5">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10"><?= Yii::$app->params['questions_form']['code_postal'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['code_postal'][2] ?></span></p>

                        <div class="float-left p-0" style="">
                           <?=$form->field($model, 'code_postal', ['inputOptions'=>['class'=>'input-width-150','type'=>'number', 'pattern'=>'[0-9]*', 'onkeypress'=>'return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57', 'placeholder'=>'10000']]) ?>
                                
                        </div>
                    </div>
                    
                    <div class="float-left pl-20">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10"><?= Yii::$app->params['questions_form']['country-only-devis'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['country-only-devis'][2] ?></span></p>

                        <div class="float-left amc-arrow p-0 input-width-150" style="">
                        <?php
                            $code_country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';     
                        ?>
                        <?=$form->field($model, 'country', [
                        'inputOptions'=>['class'=>'input-width-150 amc-iput-focus input-country crs-country not-blank', 'data-value'=>'shortcode', 'data-default-value'=>$code_country, 'data-region-id'=>'devisform-region'],
                        ])->dropDownList([
                                'prompt'=>'- Sélectionez -',

                        ])?>  
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="telephone">
                <td colspan="2">
                    
                    
                    <div class="float-left p-0">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10"><?= Yii::$app->params['questions_form']['telephone'][0] ?> <span class="amc-color-e75925"><?= Yii::$app->params['questions_form']['telephone'][2] ?></span>
                            <br><span class="amc-color-b1b1b1 amc-latolatin-regular"><?= Yii::$app->params['questions_form']['telephone'][1] ?></span></p>
                        <div class="area_dial_code_country" style="display: none;">
                        <?=$form->field($model, 'dialcodeCountry', ['inputOptions'=>['class'=>'input_dial_code_country hidden']]);?>
                        </div>    
                        <div class="float-left p-0" style="">
                            <?=$form->field($model, 'telephone', ['inputOptions'=>['class'=>'dial-code-country input-width-272 not-blank','placeholder'=>'']]) ?>
                        </div>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10"><?= Yii::$app->params['questions_form']['reference'][0] ?></p>
                         <?=$form->field($model, 'reference', [
                            'inputOptions'=>['class'=>'input_full', 'rows'=>2,'style'=>'height: 42px; width: 704px; padding: 5px 10px;'],
                            ])->textArea()?>
                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left w-100 mt-txt-40">
                         <?=$form->field($model, 'newsletter')->checkbox(
                                 ['label'=> Yii::$app->params['questions_form']['newsletter'][0]]
                        ) ?>
                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
<!--                    <p class="mb-0" style="margin-top: 25px;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>-->
                    <div class="float-left w-100 text-center" style="">

                        <a id="btn-valider-big" class="btn-amica-basic btn-amica-basic-2 mt-txt-40 mb-0" href="javascript:void(0)">Envoyer votre demande de projet                                     
                        </a>
                    </div>
                </td>
            </tr>
            <?=$form->field($model, 'duraTime', ['inputOptions'=>['class'=>'dura-time hidden d-none']]);?>
        </table>    
    </div>
       <p class="mb-0 text-center text-champ" style="margin-top: 25px;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>
        <p class="text-private mt-txt-25">En validant ce formulaire, vous acceptez notre <a href="/politique-de-confidentialite" target="_blank">politique de confidentialité et de collecte.</a></p>        
                 
<?php ActiveForm::end();?>
   
</div>   

<div id="toPopup">
<div class="close"></div>
<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
<div id="popup_content"> 
</div> 
</div>
<div class="loader"></div>
<div id="backgroundPopup"></div>
<?php

$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
//$this->registerCssFile('/assets/css/page2016/devis.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);


$this->registerJsFile('/assets/js/jquery.crs.min.js?v=001',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);


$this->registerCssFile('/assets/js/intl-tel-input/build/css/intlTelInput.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/intl-tel-input/build/js/intlTelInput.min.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

$dir_uri = DIR.URI;
$seg1 = SEG1;
$js_rdv3 =<<<JS
        
$('#devisform-prefix label').click(function(){
    $('#devisform-prefix label').removeClass('active');
    $(this).addClass('active');    
});          
        
var currentdate = new Date();          
$(window).on("load resize",function(e){
        var sw = $(window).width();
        
        var wimage = $('.fix-img-bottom-left').width();
        var wimageright = $('.fix-img-middle-right').width();
        var dd = (sw - 900)/2;
        if(wimage > dd){
            
            $('.fix-img-bottom-left').css({'left': '-'+(wimage - dd)+'px'});
        }
        if(wimageright > dd){
            
            $('.fix-img-middle-right').css({'right': '-'+(wimageright - dd)+'px'});
        }
        
});        
        
$(window).bind('load', function(){
    $('select[name="DevisForm[region]"] option[value=""]').text('Sélectionner');
	
	 $('.required').each(function(){
        var clas = $(this).attr('class');
        $(this).parent().parent().children('.fix-error-label').addClass(clas);
    }); 
    
    $("select").change(function () {
        if($(this).val() == "" || $(this).val() == "0") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });
    $("select").change();     
        
    var count_click = 0;    
        
    if(/^((?!chrome|android).)*safari/i.test(navigator.userAgent)){     
        
        $("select.amc-iput-focus").parent()
        .mouseup(function() {
                  $(this).removeClass('amc-effect-arrow');
                  $(this).children('.amc-iput-focus').focus();
        })
        .mousedown(function() {
         $(this).addClass('amc-effect-arrow');
          $(this).children('.amc-iput-focus').focus();
        });

    }else{
        $("select.amc-iput-focus").parent().click(function() {
            count_click += 1;
            if (count_click%2 == 0) {
                $(this).removeClass('amc-effect-arrow');
                $(this).children('.amc-iput-focus').focus();
            }else{
                $(this).addClass('amc-effect-arrow');
                $(this).children('.amc-iput-focus').focus();
            }

            //$(this).addClass('amc-effect-arrow');
            //$(this).children('.amc-iput-focus').focus();

        });
    }
        
     $("input.amc-iput-focus").parent().click(function() {
            

            $(this).addClass('amc-effect-arrow');
            $(this).children('.amc-iput-focus').focus();

        });   

    $('.amc-iput-focus').blur(function(){
        count_click = 0;
        $('.amc-effect-arrow').removeClass('amc-effect-arrow');
    });    
   $('.amc-iput-focus').each(function(){
        var w = $(this).outerWidth();
        
        $(this).css({'background-position' : (w-27) +'px center'});
    });
        
});   

$('select[name="DevisForm[tourLength]"]').change(function(){
    $('input[name="DevisForm[budget]"]').change();
});

$('input[name="DevisForm[budget]"]').on("change keyup keydown",function(){
    var budget = $(this).val();
    var length = $('select[name="DevisForm[tourLength]"]').val();
    var destination = '$seg1';
       
     var xx = 80;  
     var yy = 100;   
     var zz = parseInt(length);   
     var kk = parseInt(budget);
     var budget80 = zz * xx;
     var budget100 = zz * yy;   
    // console.log(kk);
    // console.log(zz);   
    // console.log(test);   
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
        
$('input[name="DevisForm[howTicket]"]').click(function(){
    var val = $(this).val();
    if (val == 'Oui') {
            $('.ticket-plus').hide();
            $('.ticketDetail').show();
            
    } else {
            $('.ticket-plus').hide();
            $('.help-ticket').show();
           // $('.howTicket').hide();
    }
});   
   
$('input[name="DevisForm[vouspartez]"]').click(function(){
    var val = $(this).val();
        
    if (val == 'Seul(e)') {
            $('.amc-opt-1').show();
            $('.amc-opt-2').hide();
             $('.amc-opt-3').hide();
            $('.amc-opt-3-4').show();
            $('.text-opt-1').show();
            $('.text-opt-2').hide();
            
    } else if(val == 'En couple'){
        $('.amc-opt-1').hide();
        $('.amc-opt-2').hide();
        $('.amc-opt-3-4').show();
        $('.amc-opt-3').hide();
         $('.text-opt-1').hide();
            $('.text-opt-2').show();
    }else{
            $('.amc-opt-2').show();
             $('.amc-opt-3').show();
            $('.amc-opt-1').hide();
            $('.amc-opt-3-4').show();
        $('.text-opt-1').hide();
            $('.text-opt-2').show();
    }
});   
        
     
$("input[type=radio], input[type=checkbox], input[type=text], select").after('<span class="amc-arrow-fix"></span>');        
 $(function(){
	$('input[type="submit"]').hide();
	$('#btn-valider-big').removeClass('hidden').bind('click', function(){
         var submitTime = new Date();
            var duraTime = Math.abs(submitTime - currentdate);
            duraTime = Math.floor((duraTime/1000));
            duraTime = parseInt(duraTime/60) + ':'+ ((duraTime%60) < 10 ? '0'+(duraTime%60) : (duraTime%60));
            $('.dura-time').val(duraTime);
            $('form#devis-form').submit(); 
//            $('html, body').animate({
//                scrollTop: $('form table').offset().top - 250
//            }, 300);
            return false;
        });
        $(".datepicker").parent().click(function() {
            $(this).children('input').focus();
           
        });

         $("form#devis-form").on("beforeSubmit", function (event) {
            $('#btn-valider-big').prepend('<span class="spinner"></span>');
            $('#btn-valider-big').addClass('ok-valid');     
        });
        
        
        
        
        $('input[name="DevisForm[callback]"]').click(function(){
		var val = $(this).val();
		if (val == 'Oui') {
			$('.rdv').show();
                        $('.telephone').hide();
		} else {
			$('.rdv').hide();
                        $('.telephone').show();
		}
	});
        
        $('.times-to-call .time').click(function(){
            if($(this).hasClass('selected'))
                $(this).removeClass('selected');    
            else 
                $(this).addClass('selected');
            var time = '';
            $('.times-to-call .time.selected').each(function(){
                if(time){
                   time += ', '+$(this).text();
               }
               else{
                   time += $(this).text();
               }
           })
           $('#devisform-calltime').val(time);
           $('#devisform-calltime').change();

        })
        $('#prevWeek').click(function(){
                return false;
        });
        
        // JS EXTENSION BTN

        $('.entry a.btn-extension').click(function(){
            console.log('a');
           
            //$('.program a.active').removeClass('active');
            //$(this).addClass('active');
            
           // $(this).addClass('active').siblings().removeClass('active');

            $(this).toggleClass("active");
             if($(this).hasClass('active')){
                $(this).text('AJOUTÉ AU PROGRAMME');
                
            } else{
                $(this).text('AJOUTEZ AU PROGRAMME');
            }

            var name = $(this).attr("name");
            var radio =  $('#devisform-extension').find('input[name="DevisForm[extension][]"][value="'+ name +'"]');
            if(radio.is(':checked')){
                radio.prop('checked', false);
             }
             else{
                 radio.prop('checked', true);
                
             }
                
            
        });
        
       
        $('#devisform-extension input[name="DevisForm[extension][]"]').change(function(){
            $('.entry a.btn-extension').removeClass('active');
            var value = $(this).val().replace(' ','-').toLowerCase();
            $('#popup_content .'+value+' .entry a.btn-extension').toggleClass('active');
           
        }); 
        
        
});       
   

//    $('.input_xxlarge').bind("cut copy paste",function(e) {
//         e.preventDefault();
//         });
$('#devisform-departuredate').datepicker({
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
            $("#devisform-deretourdate").datepicker("option", "minDate", dateObject);
        }
    }
});
$('#devisform-deretourdate').datepicker({
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
            $("#devisform-departuredate").datepicker("option", "maxDate", dateObject);
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
        
JS;
$this->registerJs($js_rdv3,  yii\web\View::POS_END);
?>
<?
$dir_uri = DIR.URI;

$js=<<<JS
      jQuery(function($) {
     
    var htmlExtenstion = false;

    function getExcl(target){
        if(!htmlExtenstion){
                    $.post('/amica-fr/extension-exclusives-tour-single', function(data){
                        $('#popup_content').prepend(data);
                        htmlExtenstion = true;
                        openPopup(target);
        
                        $('#popup_content iframe').each(function(index) {
                                var src = $(this).attr('src').split('?');

                                $(this).attr('src', src[0] + '?rel=0');


                        });    
                        $('a[href$="pdf"]').addClass('download-link download-pdf');
                    });
            }  
    }

    function openPopup(target){
        var name = target.attr('name');
           loading(); // loading
           setTimeout(function(){ // then show popup, deley in .5 second
            loadPopup(); // function show popup
            $('.' + name).show();
            }, 500); // .5 second
    }
    
    $("span.topopup, a.topopup").click(function() {
        var target = $(this);
        if(!htmlExtenstion){
            getExcl(target);
        } else openPopup(target);
        return false;
    });
     
    /* event for close the popup */
    $("div.close").hover(
                    function() {
                        $('span.ecs_tooltip').show();
                    },
                    function () {
                        $('span.ecs_tooltip').hide();
                      }
                );
     
    $("div.close").click(function() {
        disablePopup();  // function close pop up
    });
     
    $(this).keyup(function(event) {
        if (event.which == 27) { // 27 is 'Ecs' in the keyboard
            disablePopup();  // function close pop up
        }      
    });
     
    $("div#backgroundPopup").click(function() {
        disablePopup();  // function close pop up
    });
     
    $('a.livebox').click(function() {
        alert('Hello World!');
    return false;
    });
     
 
     /************** start: functions. **************/
    function loading() {
        $("div.loader").show();  
    }
    function closeloading() {
        $("div.loader").fadeOut('normal');  
    }
     
    var popupStatus = 0; // set value
     
    function loadPopup() {
        if(popupStatus == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#toPopup").fadeIn(0500); // fadein popup div
            $("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup").fadeIn(0001);
            popupStatus = 1; // and set value to 1
        }    
    }
         
     
    function disablePopup() {
        if(popupStatus == 1) { // if value is 1, close popup
            $("#toPopup").fadeOut("normal");  
            $("#backgroundPopup").fadeOut("normal");  
            popupStatus = 0;  // and set value to 0
        }
        $('.popup').hide();
    }
    /************** end: functions. **************/
}); // jQuery End
	
   
        //Jquery select option extensions
    
   var addextension = '.btn-extension';

   $('#popup_content').on('click', addextension, function(){
        var hClass = $(this).hasClass('active');
        var extension = $(this).attr('name');
        
       
            var radio =  $('#devisform-extension').find('input[name="DevisForm[extension][]"][value="'+ extension +'"]');
            if(radio.is(':checked')){
                radio.prop('checked', false);
             }
             else{
                 radio.prop('checked', true);
             }
                
           
        if(hClass){
           // $(this).text('AJOUTÉ AU PROGRAMME');
            $(this).removeClass('active');
            var url = '$dir_uri';
            var target = $(this);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        type: 'remove-selected',
                        extension: extension,
                        
                    },
                    dataType: 'html',
                    success: function(data) {
                       
                    }

                });
		return false;
        }else{
           // $(this).text('AJOUTEZ AU PROGRAMME');
            $(this).addClass('active');
            var url = '$dir_uri';
            var target = $(this);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        type: 'selected',
                        extension: extension,
                        
                    },
                    dataType: 'html',
                    success: function(data) {
                       
                    }

                });
		return false;
        }
   });     
        
//END Jquery select option extensions
        
        
//var input = document.querySelectorAll(".dial-code-country");
       // console.log(input);
 $('.dial-code-country').each(function(){ 
        
        var target = $(this);    
         //   console.log(target.context);

        var iti =  window.intlTelInput(target.context, {
              // allowDropdown: false,
              // autoHideDialCode: false,
              // autoPlaceholder: "off",
              // dropdownContainer: document.body,
              // excludeCountries: ["vn"],
              // formatOnDisplay: false,
               geoIpLookup: function(callback) {
                 $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                   var countryCode = (resp && resp.country) ? resp.country : "";
               // console.log(countryCode.toLowerCase());
                   callback(countryCode.toLowerCase());
                 });
               },
              // hiddenInput: "full_number",
               initialCountry: "auto",
              // localizedCountries: { 'de': 'Deutschland' },
        //       nationalMode: false,
              // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
             // placeholderNumberType: "MOBILE",
              // preferredCountries: ['cn', 'jp'],
              separateDialCode: true,
             utilsScript: "/assets/js/intl-tel-input/build/js/utils.js?1562189064761"
        });   
        
        var input = target.context,
          errorMsg = document.querySelector("#error-msg"),
          validMsg = document.querySelector("#valid-msg");

        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialise plugin
        //var iti = window.intlTelInput(input, {
        //   
        //    separateDialCode: true,    
        //    initialCountry: "auto",    
        //    geoIpLookup: function(callback) {
        //      $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //        var countryCode = (resp && resp.country) ? resp.country : "";
        //    // console.log(countryCode.toLowerCase());
        //        callback(countryCode.toLowerCase());
        //      });
        //    },      
        //    utilsScript: "/assets/js/intl-tel-input/build/js/utils.js?1562189064761"
        //});

        var reset = function() {
          input.classList.remove("error");
          errorMsg.innerHTML = "";
          errorMsg.classList.add("hide");
          validMsg.classList.add("hide");
        };

        // on blur: validate
        input.addEventListener('blur', function() {
          reset();
          if (input.value.trim()) {
            if (iti.isValidNumber()) {
              validMsg.classList.remove("hide");
            } else {
              input.classList.add("error");
              var errorCode = iti.getValidationError();
              errorMsg.innerHTML = errorMap[errorCode];
              errorMsg.classList.remove("hide");
            }
          }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);        
           
        
        input.addEventListener('countrychange', function(e) {
            var dialcode = iti.getSelectedCountryData().dialCode;
            $('.input_dial_code_country').val(dialcode);
          });
      
});                 
//  var iti = intlTelInput(input); 
//  iti.destroy();    
//  var countryData = iti.getSelectedCountryData();
//console.log(countryData);    

//$(window).bind('load',function(){
//    var dialcode = $('#country-listbox li[aria-selected="true"]').data('dial-code');
//        $('.input_dial_code_country').val(dialcode);
//      
//        
//});        
//$('#country-listbox li').click(function(){
//    var dia = $(this).data('dial-code');   
//         $('.input_dial_code_country').val(dia);
//});          
       
        
$(".amc-count-characters").keyup(function(){
    var maxLength = $(this).attr('maxlength');   
    
    el = $(this);
        
    var hClass = el.parent().parent().children('.charNum').hasClass('amc-fix-disable');    
    if(el.val().length === 0){
        
        if(hClass){
            el.parent().parent().children('.charNum').addClass('yes');
        }
    }else if(el.val().length > maxLength){
        el.val( el.val().substr(0, maxLength) );
    } else {
        if(hClass){
            el.parent().parent().children('.charNum').removeClass('yes');
        }
        el.parent().parent().children('.charNum').text(maxLength - el.val().length + ' caractères restants');
    }
});   
                
 
   $(document).ready(function () {
    $("input[name='DevisForm[tourThemes][]']").change(function () {
        var maxAllowed = 3;
        var cnt = $("input[name='DevisForm[tourThemes][]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
          //  alert('You can select maximum ' + maxAllowed + ' technologies!!');
        }
    });
});
        
JS;
$this->registerJs($js,  yii\web\View::POS_END);
?>