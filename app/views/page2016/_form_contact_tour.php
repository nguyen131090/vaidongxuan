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
		'template'=>'{input}{error}',
                
	],
        'enableClientValidation'=>true,
       
]);
?>
<table id="tbl-contact" class="form">
        
	
                         <tr>
                            <td colspan="2" class="extension ">
                                <div class="float-left amc-col amc-col-1 col-xs-12 col-sm-12 col-md-12">
                                    <span class="tt">CONTACTEZ-NOUS POUR PLUS DE DÉTAILS</span>
                                   
                                </div>

                            </td>
			</tr>
             <tr>
                
                            <td colspan="2" class="info-error">
                                <div class="float-left amc-col amc-col-1 col-xs-4 col-sm-4 col-md-4"></div>
                                <div class="float-left amc-col amc-col-1 col-xs-4 col-sm-4 col-md-8">
                                    <?=$form->errorSummary($model); ?>
                                </div>    
                            </td>
            </tr>          
                       
			<tr>
                            
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-12 text-center">
                                    <span class="violet">*</span> Champs obligatoires
                                </div>
                            </td>
                        </tr>
			<tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                                    <span class="fix-middle-text text-label">Votre Nom et Prénom <span class="violet">*</span></span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-1 col-md-1" style="min-width: 90px;">
                                    <?=$form->field($model, 'prefix', ['inputOptions'=>['class'=>'fix-arrow input-prefix not-blank']])->dropDownList(Yii::$app->params['formUserPrefixList'])?>
                                </div>    
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3" style="min-width: 280px;">    
                                    <?=$form->field($model, 'fname', ['inputOptions'=>['class'=>'input_medium input-fullname not-blank','placeholder'=>'Prénom']]) ?>
                                </div>  

                                <div class="amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 float-right" style="min-width: 280px;">    
                                    <?=$form->field($model, 'lname', ['inputOptions'=>['class'=>'input_medium input-fullname not-blank','placeholder'=>'Nom']]) ?>
                                </div>      
                            </td>
			</tr>
			<tr>
                            <td colspan="2">
                                 <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                                    <span class="fix-middle-text text-label">Votre adresse mail <span class="violet">*</span></span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3" style="min-width: 280px;">
                                    <?=$form->field($model, 'email', ['inputOptions'=>['class'=>'input_full disablecopypage not-blank']]) ?>
                                </div>   
                            </td>
			</tr>
                       
			<tr>
            <td colspan="2" class="address">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                    <span class="fix-middle-text text-label">Votre pays <span class="violet">*</span></span>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-1 col-md-1" style="min-width: 125px;">

                        <?php
                            $code_country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';     
                        ?>
                        <?=$form->field($model, 'country', [
                        'inputOptions'=>['class'=>'fix-arrow input-country crs-country not-blank', 'data-value'=>'shortcode', 'data-default-value'=>$code_country, 'data-region-id'=>'contactform-region'],
                        ])->dropDownList([
                                'prompt'=>'- Sélectionez -',

                        ])?>
                     </div>       
                
            </td>
        </tr>
                       
        
	<tr>
            <td colspan="2">
                 <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-col-left fix-error-label" style="height: 135px;">
                    <span class="middle-text text-label">Votre message <span class="violet">*</span></span>
                </div>
				<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
				<?=$form->field($model, 'message', [
					'inputOptions'=>['class'=>'input_full', 'rows'=>4,'style'=>'height: 135px;'],
					])->textArea()?>
						
                    
                </div>     
            </td>
	</tr>
	
        <tr>
            <td colspan="2">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-col-left" style="height: 135px;">
                   <span class="middle-text">  Souhaitez-vous recevoir une proposition de programme avec devis personnalisé sur d'autres régions du pays ? Si oui, décrivez votre projet. </span>
                </div>
				<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
		<!--			<p>Si oui, décrivez votre projet :</p>-->
					<?=$form->field($model, 'question', [
						'inputOptions'=>['class'=>'input_full', 'rows'=>4,'style'=>'height: 135px;'],
						])->textArea()?>
							
                    
                </div>    
            </td>
	</tr>
        
        <tr>
            <td colspan="2">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-col-left fix-error-label" style="min-height: 85px;">
                    <span class="middle-text text-label"> Si vous êtes recommandé(e) par un ancien client d'Amica, merci de préciser son nom et prénom :</span>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                    <?=$form->field($model, 'reference', [
                            'inputOptions'=>['class'=>'input_full', 'rows'=>2,'style'=>'height: 85px;'],
                            ])->textArea()?>
                </div>  
            </td>
        </tr>
        
    <tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                                    Newsletters
                                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                    <?=$form->field($model, 'newsletter')->checkbox(
                        ['label'=>'J\'aimerais recevoir des informations (reportages, promotions, conseils de voyages...) de la part de Amica Travel. (1 fois par semaine)']
                    ) ?>
                                </div>   
                            </td>
            </tr>
	<!--		
	<tr>
            <td class="code-anti" colspan="2">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-3 col-fix-align fix-error-label">
                    <span class="fix-middle-text text-label">Code anti-spam <span class="violet">*</span></span>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-4">
                        <?//=$form->field($model, 'verificationCode')->widget(Captcha::className(), [
                          //      'options' => ['class' => 'not-blank','style'=>'width: 225px;'],
                          //      'template' => '{input} <p class="fix-text-code">Recopiez la valeur <span>{image}</span></p>',
                        //]); ?>
                </div>    
            </td>
	</tr>
	-->
	<tr>
		
            <td colspan="2">
               
                 <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">
                                    
				</div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9" style="">
					
					<a id="btn-valider-big" class="fl-r ir" href="javascript:void(0)">envoyer la demande                                       
						</a>
				</div> 
                 <p class="text-private">En validant ce formulaire, vous acceptez notre politique de confidentialité et de collecte. <a href="/politique-de-confidentialite" target="_blank">En savoir plus</a></p>           
            </td>
	</tr>
</table>
<?php ActiveForm::end(); ?>
<?php
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerCssFile('/assets/css/page2016/contact.css?v=002',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);

$this->registerJsFile('/assets/js/jquery.crs.min.js?v=001',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);
$js=<<<JS
               $(window).bind('load', function(){
    $('select[name="ContactForm[region]"] option[value=""]').text('Sélectionner');
	
	$('.required').each(function(){
        var clas = $(this).attr('class');
        $(this).parent().parent().children('.fix-error-label').addClass(clas);
    }); 
}); 
      $("input[type=radio], input[type=checkbox]").after('<span></span>');    
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



