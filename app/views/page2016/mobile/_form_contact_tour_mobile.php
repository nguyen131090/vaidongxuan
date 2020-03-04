<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.theme-1.4.5.min.css'); ?>
<? $this->registerCssFile('/assets/css/mobile/jquery.mobile.icons-1.4.5.min.css'); ?>
<? $this->registerCssFile('/assets/css/mobile/form_contact.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?  $this->registerJs(' $(function() {
        $("#contactform-verificationcode").parent().css("border", "none");
        $("a#btn-valider-big").click(function() {
            $("form#contact-form").submit();
            return false;
        });
    });') ?>
<?
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>

<?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->model->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy banner" data-src="/timthumb.php?src='.$value->image.'&w=1000&h=500&a=c'.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" class="banner" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_contact.jpg'>
    <?php }?>
<div class="form-tour content-tour-single active">
    

   <div class="column row-2">
        
        <h1 class="title">CONTACTEZ-NOUS POUR PLUS DE DÉTAILS</h1>
    </div>
    

    <div class="tab-form-tour">
        <?
$form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'action' => '',
                    'fieldConfig' => [
                        'options' => [
                            'tag' => 'span',
                        ],
                        'template' => '{input}',
                    ],
        ]);
        ?>
        <table id="tbl-contact" class="form">
            <tr>
                <td colspan="2"><?= $form->errorSummary($model); ?></td>
            </tr>
            <tr class="note-form">
                <td colspan="2">* Champs obligatoires</td>
            </tr>
            <tr>
                <td colspan="2" class="ta-r">Votre nom* :</td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= $form->field($model, 'prefix')->dropDownList(Yii::$app->params['formUserPrefixList']) ?>
                    <?= $form->field($model, 'fullName', ['inputOptions' => ['class' => 'input_xxlarge']]) ?>
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
                        'inputOptions'=>['class'=>'fix-arrow input-country crs-country not-blank', 'data-value'=>'shortcode', 'data-default-value'=>$code_country, 'data-region-id'=>'contactformmobile-region'],
                        ])->dropDownList([
                                'prompt'=>'- Sélectionez -',

                        ])?>
                </td>
            </tr>
            
            <tr>
             <tr>
                <td class="ta-r" colspan="2">Sujet* :</td>
                
            </tr>
            <tr>
                <td colspan="2">
                    <?=$form->field($model, 'subjet', [
                        'inputOptions'=>['class'=>''],
                        ])->dropDownList(Yii::$app->params['subjetMobile'], 
                        [ 
                            'options'=> ['' => ['disabled' => true, 'Selected' => true],
                        ]])
                    ?>
                </td>
            </tr>
            <tr>
                <td class="ta-r" colspan="2">Votre message* :</td>
               
            </tr>
            <tr>
                 <td colspan="2">
                    <?=
                    $form->field($model, 'message', [
                        'inputOptions' => ['class' => 'input_full', 'rows' => 10],
                    ])->textArea()
                    ?>
                </td>    
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
           
            <tr>
                <td colspan="2">
                    <a id="btn-valider-big" class="fl-r ir" href="#"><span>ENVOYER LA DEMANDE</span> <img alt="" src="<?=DIR.'assets/img/mobile/arrow.png'?>"/> </a>
                    <p class="text-private">En validant ce formulaire, vous acceptez notre politique de confidentialité et de collecte. <a href="/politique-de-confidentialite" target="_blank">En savoir plus</a></p> 
                </td>
            </tr>
        </table>
        <?php ActiveForm::end(); ?>

    </div>
</div>

<? $this->registerCss('
#contactform-subjet-button > span{
    text-align: left;
    font-weight: normal;
}
') ?>

<?
$this->registerJsFile('/assets/js/jquery.crs.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/mobile/jquery.mobile-1.4.5.min.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$js=<<<JS
        $(window).bind('load', function(){
    $('select[name="ContactForm[region]"] option[value=""]').text('Sélectionner');
    
    $('.required').each(function(){
        var clas = $(this).attr('class');
        $(this).parent().parent().children('.fix-error-label').addClass(clas);
    });  
}); 
 
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
 ?>




