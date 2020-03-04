<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.theme-1.4.5.min.css'); ?>
<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.icons-1.4.5.min.css'); ?>

<? $this->registerCssFile('/assets/css/mobile/form_tour.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerCssFile('/assets/css/mobile/bootstrap-datetimepicker.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<? $this->registerJsFile(DIR . 'assets/js/jquery-ui/jquery-ui-1.9.2.custom.min.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>


<div class="form-tour content-tour-single active" style="margin: 0;">
   <div class="column row-2">
        
        <h1 class="title">PERSONNALISER CE PROGRAMME</h1>
    </div>
    <div class="tab-form-tour">
        <?
        $form = ActiveForm::begin([
                    'id' => 'devisform',
                    'action' => '',
                    'fieldConfig' => [
                        'options' => [
                            'tag' => 'span',
                        ],
                        'template' => '{input}',
                    ],
        ]);
        ?>
         <table id="tbl-form-tour">
            <tr>
                <td colspan="2" class="colspan"><?= $form->errorSummary($model); ?></td>
            </tr>
            <tr>
                 <td colspan="2">
                     <h3 class="title" style="margin-top: 2rem;">FORMULES EN OPTIONS</h3>
                 <span class="space space-10"></span>
                 <?= $form->field($model, 'listFormules')->checkboxList(\yii\helpers\ArrayHelper::map($theProgram, 'slug', 'title')) ?></td>
            </tr>
            <tr class="note-form">
                <td colspan="2" style="padding-top: 2.5rem;">* Champs obligatoires</td>
            </tr>
            <tr>
                 <td colspan="2">
                 <h3 class="title">FORMULES EN OPTIONS</h3>
                 <span class="space space-10"></span>
                 <?= $form->field($model, 'listFormules')->checkboxList(\yii\helpers\ArrayHelper::map($theProgram, 'slug', 'title')) ?></td>
            </tr>
            <tr class="note-form">
                <td colspan="2" style="padding-top: 2.5rem;">* Champs obligatoires</td>
            </tr>
            <tr>
                <td colspan="2" class="colspan title-h3"><h3 class="title">VOS COORDONNÉES</h3></td>
            </tr>
            <tr>
                <td colspan="2"  class="ta-r"><span>Votre nom* :</span></td>
            </tr>
             <tr>
                <td colspan="2">
                    <?= $form->field($model, 'prefix',[
                        'inputOptions'=>['class'=>''],
                        ])->dropDownList(Yii::$app->params['formUserPrefixList']) ?>
                    <?= $form->field($model, 'fullName') ?>
                </td>
            </tr>
            <tr>
                <td class="ta-r" colspan="2">Votre mail* :</td>
            </tr>
             <tr>
                <td colspan="2">
                    <?= $form->field($model, 'email', ['inputOptions' => ['class' => 'input_xxlarge']]) ?>
                </td>
            </tr>
            
            <tr>
                <td class="ta-r" colspan="2">Votre pays* :</td>
            </tr>
            <tr>
                <td colspan="2">
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
                <td colspan="2" class="colspan ta-r"><h3 class="title-tbl">Comment préférez-vous communiquer avec nous?</h3></td>
            </tr>
            <tr>
                <td colspan="2" class="colspan contact-type">
                    <?= $form->field($model, 'contactEmail')->checkbox(['label' => 'Par email']) ?>
            </tr>   
            <tr>
                <td colspan="2" class="colspan contact-type telephone">
                    <?= $form->field($model, 'contactPhone')->checkbox(['label' => 'Par téléphone', 'uncheck' => false]) ?>
                    <?= $form->field($model, 'phone', ['inputOptions' => ['placeholder' => 'Votre numéro tel']]) ?></td>
            </tr>
            
            <tr>
                <td colspan="2" class="colspan"><h3 class="title">PROJET DE VOYAGE</h3></td>
            </tr>
            <tr class="date">
                <td colspan="2">
                    <div class="dp-table col col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        <span>Date d’arrivée sur place* :</span>
                    </div>
                <div class="col col-xs-5 col-sm-5 col-md-5 col-lg-5 pull-right">
                <?= $form->field($model, 'departureDate', ['inputOptions' => ['class' => 'input_small datepicker', 'data-clear-btn' => "false", 'readonly' => 'readonly', 'data-role' => 'date']]) ?> </div>
                </td>
            </tr>
            <tr class="date">
               <td colspan="2">
                <span  class="col col-xs-7 col-sm-7 col-md-7 col-lg-7 fix-lh">Durée* :</span>
                <div class="col col-xs-5 col-sm-5 col-md-5 col-lg-5 pull-right"><?= $form->field($model, 'tourLength',[
                        'inputOptions'=>['class'=>''],
                        ])->dropDownList(range(0, 60)) ?></div>
                </td>
            </tr>
            <!-- Question -->
            <tr>
                <td class="ta-r" colspan="2"><h3 class="title-tbl">Qu'est ce qui vous a donné envie de choisir cette (ou ces) destination(s) ?</h3></td>
            </tr>
            <tr>
                <td colspan="2"><?=$form->field($model, 'whyCountry', [
                        'inputOptions'=>['class'=>'input_full', 'rows'=>3],
                        ])->textArea()?></td>
            </tr>
            <!-- End -->
            <tr>
                <td colspan="2" class="ta-r"><span>Décrivez votre projet, votre vision du voyage et de quelle façon vous souhaitez découvrir notre pays* :</span></td>
            </tr>
            <tr>
                <td colspan="2"><?=
                    $form->field($model, 'message', [
                        'inputOptions' => ['class' => 'input_full', 'rows' => 3],
                    ])->textArea()
                    ?></td>
            </tr>
            <!--Question-->
            <tr>
                <td class="ta-r" colspan="2"><h3 class="title-tbl">Avez-vous déjà acheté votre (vos) billet(s) d’avion internationaux aller-retour ?</h3></td>
            </tr>
            <tr>
                <td colspan="2"><?=$form->field($model, 'howTicket')->radioList(['yes' => 'Oui', 'no' => 'Non'])?></td>
            </tr>
             <tr>
                <td class="ta-r" colspan="2"><h3 class="title-tbl">Budget par personne (budget total, incluant les vols internationaux)</h3></td>
            </tr>
            <tr>
                <td colspan="2"><?= $form->field($model, 'budget') ?></td>
            </tr>
             <tr>
                <td class="ta-r" colspan="2"><h3 class="title-tbl">Le petit déjeuner est généralement déjà inclus dans le prix de l’hébergement. Souhaitez-vous d’autres repas ?</h3></td>
            </tr>
            <tr>
                <td colspan="2"><?= $form->field($model, 'lepetit')->textArea() ?></td>
            </tr>
    
             <tr>
                <td colspan="2" class="colspan"><h3 class="title">TYPE DE VOYAGE</h3></td>
            </tr>
            <tr>
                <td colspan="2" class="ta-r"> <span>Vous partez</span><?= $form->field($model, 'typeGo',[
                        'inputOptions'=>['class'=>''],
                        ])->dropDownList(Yii::$app->params['typeGoMobile']) ?></td>
            </tr>
            <tr>
                <td colspan="2" class="ta-r">
                    <table>
                    <tr>
                        <td  class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <span>Adulte(s) (>12 ans)*</span></td>
                         <td  class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-right">
                    <span>Détails d'âges* :</span></td>    
                    </tr>
                        <tr>
                        <td  class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <?= $form->field($model, 'numberOfTravelers12',[
                        'inputOptions'=>['class'=>'','style' => 'width: 80%;'],
                        ])->dropDownList(range(0, 60)) ?>
                </td>
                 <td  class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-right">
                    <?= $form->field($model, 'agesOfTravelers12') ?>
                </td>
                
                        </tr>
                    </table>
                </td>
                
            </tr>

            <tr>
                <td colspan="2" class="ta-r">
                    <table>
                    <tr>
                         <td  class="col-xs-12 col-sm-6 col-md-6 col-lg-6  ">
                    <span>Enfant(s) (2 - 12 ans)</span></td>
                    <td  class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-right ">
                    <span>Bébé(s) (<2 ans)</span></td>

                    </tr>
                        <tr>
                       <td  class="col-xs-12 col-sm-6 col-md-6 col-lg-6  ">
                    <?= $form->field($model, 'numberOfTravelers2',[
                        'inputOptions'=>['class'=>''],
                        ])->dropDownList(range(0, 60)) ?>
                </td>
                <td  class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-right ">
                    <?= $form->field($model, 'numberOfTravelers1',[
                        'inputOptions'=>['class'=>''],
                        ])->dropDownList(range(0, 60)) ?>
                </td>
                        </tr>
                    </table>
                </td>
                
            </tr>
            
            <tr>
                <td colspan="2" class="colspan ta-r"><h3 class="title-tbl">Quel(s) types d'hébergement préférez-vous  pour 
                        ce voyage ? <i>(plusieurs choix possibles)</i></h3></td>
            </tr>
          
            <tr>
                <td colspan="2" class="colspan"><h3 class="title">CENTRES D’INTÉRÊT</h3></td>
            </tr>
             
            <tr>
                <td class="" colspan="2"><h3 class="title-tbl">Pouvez-vous nous raconter votre dernier voyage long-courrier ? (destination, type de voyage, expériences, ce que vous avez aimé, ...)</h3></td>
            </tr>
            <tr>
                <td colspan="2"><?=$form->field($model, 'howMessage', [
                        'inputOptions'=>['class'=>'input_full', 'rows'=>6],
                        ])->textArea()?></td>
            </tr>
            <tr>
                <td class="" colspan="2"><h3 class="title-tbl">Vos loisirs et passe-temps préférés (ce que vous aimez, ce que vous n’aimez pas…) :</h3></td>
            </tr>
            <tr>
                <td colspan="2"><?=$form->field($model, 'howHobby', [
                        'inputOptions'=>['class'=>'input_full', 'rows'=>6],
                        ])->textArea()?></td>
            </tr>
            <tr>
                <td colspan="2" class="ta-r"><span>Si vous êtes recommandé(e) par un ancien client d'Amica, merci de préciser son nom et prénom :</span></td>
            </tr>
            <tr>
                <td colspan="2"><?=
                    $form->field($model, 'reference', [
                        'inputOptions' => ['class' => 'input_full', 'rows' => 1],
                    ])->textArea()
                    ?></td>
            </tr>
            
            <!--Question-->


             <tr>
                 <td colspan="2">
                     <a id="btn-valider-big" class="fl-r ir" href="#"><span>ENVOYER LA DEMANDE</span> <img alt="" src="<?=DIR.'assets/img/mobile/arrow.png'?>"/> </a>
                     <p class="text-private">En validant ce formulaire, vous acceptez notre politique de confidentialité et de collecte. <a href="/politique-de-confidentialite" target="_blank">En savoir plus</a></p> 
                 </td>
             </tr>
        </table>
        <div class="info-bottom-form">
            <div data-role="none" class="bottom-copyright amica-tralvel-title-bottom">
                <img src="../../../upload/image/sticker.png" alt="Img" width="13" height="13">
                <span>Programme 100% <span style="text-transform: uppercase;">personnalisé</span></span>
            </div>
            <div data-role="none" class="bottom-copyright amica-tralvel-title-bottom">
                <img src="../../../upload/image/sticker.png" alt="Img" width="13" height="13">
                <span>Réponse <span style="text-transform: uppercase;">sous 48H</span></span>
            </div>
            <div data-role="none" class="bottom-copyright amica-tralvel-title-bottom">
                <img src="../../../upload/image/sticker.png" alt="Img" width="13" height="13">
                <span><span style="text-transform: uppercase;">Des experts</span> à votre service</span>
            </div>
        </div>

        <?php
        ActiveForm::end();
        ?>
    </div>
</div>
<? 
//$this->registerJsFile('/assets/js/jquery.crs.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
//$this->registerJsFile('/assets/js/mobile/jquery.mobile-1.4.4.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('assets/js/jquery-ui/jquery-ui-1.9.2.custom.min.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 
$this->registerJsFile(DIR . 'assets/js/mobile/form_tour.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); 

$this->registerCss('.container-3 .column{padding: 0}');
?>
