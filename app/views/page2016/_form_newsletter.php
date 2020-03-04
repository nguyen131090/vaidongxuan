<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
$userPrefixList = [
	'M.'=>'M.',
	'Mme.'=>'Mme.',
	'Mlle.'=>'Mlle.',
];


$form = ActiveForm::begin([
	'id'=>'contact-form',
	'action'=>'',
	'fieldConfig'=>[
		'options'=>[
			'tag'=>'span',
		],
		'template'=>'{input}',
                
	],
        'enableClientValidation'=>true,
       
]);
?>
<table id="tbl-contact" class="form">
        
	 <tr>
				
            <td colspan="2" class="info-error">
                <div class="col col-1 col-xs-4 col-sm-4 col-md-4"></div>
                <div class="col col-1 col-xs-4 col-sm-4 col-md-8">
                    <?=$form->errorSummary($model); ?>
                </div>    
            </td>
        </tr>


        <tr>

            <td colspan="2">
                <div class="col col-2 col-xs-12 col-sm-12 col-md-4"></div>
                <div class="col col-2 col-xs-12 col-sm-12 col-md-8">
                    <span class="violet">*</span> Champs obligatoires
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="col col-2 col-xs-12 col-sm-12 col-md-3">
                    Votre Nom et Prénom <span class="violet">*</span>
                </div>
                <div class="col col-2 col-xs-12 col-sm-12 col-md-2">
                    <?=$form->field($model, 'prefix', ['inputOptions'=>['class'=>'fix-arrow input-prefix']])->dropDownList(Yii::$app->params['formUserPrefixList'])?>
                </div>    
                <div class="col col-2 col-xs-12 col-sm-12 col-md-7">    
                    <?=$form->field($model, 'fullName', ['inputOptions'=>['class'=>'input_full input-fullname']]) ?>
                </div>        
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="col col-2 col-xs-12 col-sm-12 col-md-3">
                    Votre adresse mail<span class="violet">*</span>
                </div>
                <div class="col col-2 col-xs-12 col-sm-12 col-md-9">
                    <?=$form->field($model, 'email', ['inputOptions'=>['class'=>'input_full disablecopypage']]) ?>
                </div>    
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <div class="col col-2 col-xs-12 col-sm-12 col-md-3">
                    Votre pays
                </div>
                <div class="col col-2 col-xs-12 col-sm-12 col-md-3">

					<?php
						$code_country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';     
					?>
                    <?=$form->field($model, 'country', [
                    'inputOptions'=>['class'=>'fix-arrow input_full input-country crs-country', 'data-value'=>'shortcode', 'data-default-value'=>$code_country, 'data-region-id'=>'contactform-region'],
                    ])->dropDownList([
                            'prompt'=>'- Sélectionez -',

                    ])?>
                 </div>   

            </td>
        </tr>
       
	
	<tr>
            <td colspan="2" class="code-anti">
                 <div class="col col-2 col-xs-12 col-sm-12 col-md-3">
                    Code anti-spam <span class="violet">*</span>
                </div>
		 <div class="col col-2 col-xs-12 col-sm-12 col-md-9">
			<?=$form->field($model, 'verificationCode')->widget(Captcha::className(), [
				'options' => ['class' => 'input_full'],
				'template' => '{input} <p class="fix-text-code">Recopiez la valeur : <span>{image}</span></p>',
			]); ?>
                 </div>    
            </td>
	</tr>
	<tr>
		
            <td colspan="2">
                <div class="col col-2 col-xs-12 col-sm-12 col-md-3"></div>
                 <div class="col col-2 col-xs-12 col-sm-12 col-md-9">
			<input type="submit" value="Valider" />
			<span id="btn-valider-big" class="fl-r ir pointer">Valider</span>
                 </div>       
            </td>
	</tr>
</table>
<?php ActiveForm::end(); ?>
<?php
//$this->registerCssFile('/assets/nathansmith/formalize/css/formalize.css',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

//$this->registerJsFile('/assets/nathansmith/formalize/js/jquery.formalize.min.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

$this->registerJsFile('/assets/js/jquery.crs.min.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);
$js=<<<JS
      $(function(){
	$('input[type="submit"]').hide();
	$('#btn-valider-big').removeClass('hidden').bind('click', function(){
            $('form#contact-form').submit();  
				 $('html, body').animate({
                        scrollTop: $('form table').offset().top - 250
                    }, 300);
			return false;
                });
});      
         $('.disablecopypaste').bind('copy cut paste',function(e){
        e.preventDefault();
    });
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
?>



