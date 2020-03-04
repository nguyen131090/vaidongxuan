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
              
		<table id="tbl-contact" class="form booking-form">
                        <tr>
                            <td colspan="2" class="extension ">
                                <div class="float-left amc-col amc-col-1 <?= empty($theProgram) ? 'col-xs-12 col-sm-12 col-md-12' : 'col-xs-6 col-sm-6 col-md-6'?>">
                                    <div class="<?= empty($theProgram) ? '' : 'float-right'?>">
                                    <span class="tt">Personnaliser<?= empty($theProgram) ? ' ' : '<br>'?>ce programme</span>
                                    <p><img alt="" src="<?=DIR?>assets/img/page2016/hot_gon_thao_100_100.jpg" style="border-radius: 100%;"></p>
                                    <p>Votre conseiller(ère) répondra sous 48H</p>
                                    </div>
                                </div>
                                
                                <div class="float-left amc-col amc-col-2 col-xs-6 col-sm-6 col-md-6 <?= empty($theProgram) ? 'hidden' : ''?>">
                                    <span class="tt">FORMULES EN OPTIONS</span>
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
                            <td colspan="2" align="center">
<!--                                <span class="line"></span>-->
                                <p style="" class="text-area text-area-1">Vos coordonnées</p>
                            </td>
                        </tr>
                       
			<tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                                    <span class="fix-middle-text text-label">Votre Nom et Prénom <span class="violet">*</span></span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-1 col-md-1" style="min-width: 90px;">
                                    <?=$form->field($model, 'prefix', ['inputOptions'=>['class'=>'fix-arrow input-prefix']])->dropDownList(Yii::$app->params['formUserPrefixList'])?>
                                </div>    
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3" style="min-width: 280px;">    
                                    <?=$form->field($model, 'fname', ['inputOptions'=>['class'=>'input_medium input-fullname','placeholder'=>'Prénom']]) ?>
                                </div>  
                                
                                <div class="amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 float-right" style="min-width: 280px;">    
                                    <?=$form->field($model, 'lname', ['inputOptions'=>['class'=>'input_medium input-fullname','placeholder'=>'Nom']]) ?>
                                </div>   
                            </td>
			</tr>
			<tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                                    <span class="fix-middle-text text-label">Votre adresse mail <span class="violet">*</span></span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3" style="min-width: 280px;">
                                    <?=$form->field($model, 'email', ['inputOptions'=>['class'=>'input_full disablecopypage']]) ?>
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
                        'inputOptions'=>['class'=>'fix-arrow input-country crs-country not-blank', 'data-value'=>'shortcode', 'data-default-value'=>$code_country, 'data-region-id'=>'devisform-region'],
                        ])->dropDownList([
                                'prompt'=>'- Sélectionez -',

                        ])?>
                     </div>       
                
                
            </td>
        </tr>
                        
			
                        <tr>
                            <td colspan="2">
                                <p class="text-area text-area-2">votre projet</p>
                            </td>
                        </tr>
                        
			<tr>
                            <td colspan="2">
								<div>
									<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
										<span class="text-label">Date d'arrivée<br>approximative <span class="violet">*</span></span>
									</div>
									<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-2 col-md-2" style="min-width: 190px;">
										<?=$form->field($model, 'departureDate', ['inputOptions'=>['class'=>'input_small input-departureDate datepicker']])?>
									 </div> 
								</div>
								<div>	
									<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-1 col-md-1 col-fix-align fix-error-label" style="padding-right:0px;">    
										<span class="text-label">Date de retour <span class="violet">*</span></span>
									</div>
									<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-2 col-md-2" style="min-width: 190px;">
										<?=$form->field($model, 'deretourDate', ['inputOptions'=>['class'=>'input_small input-deretourDate datepicker']])?>
									</div>
								</div>	
								<div>
									<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-1 col-md-1 col-fix-align fix-error-label" style="min-width: 95px; padding-right: 0px">
										<span class="text-label"><span class="fix-text">Durée</span> du voyage<span class="violet">*</span></span>
									</div>
									<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-1 col-md-1" style="min-width: 104px;">
						
										<?=$form->field($model, 'tourLength',['inputOptions'=>['class'=>'fix-arrow input-tourLength']])->dropDownList(range(0, 60))?>     
									</div>
								</div>	
                            </td>
			</tr>
            <tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-col-left fix-error-label" style="min-height: 135px;">
                                    <span class="middle-text text-label">Décrivez votre projet, votre vision du voyage et de quelle façon vous souhaitez découvrir notre pays</span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                                                    <?=$form->field($model, 'message', [
                                                            'inputOptions'=>['class'=>'input_full', 'rows'=>4,'style'=>'height: 135px;'],
                                                            ])->textArea()?>
                                </div>  
                            </td>
            </tr>
                        
			<!--
			<tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-3 col-fix-align" style="margin: 10px 0;">    
                                    Destination(s)<span class="violet">*</span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-9" style="margin: 10px 0;">
                                    <?//=$form->field($model, 'countriesToVisit')->checkboxList(Yii::$app->params['formCountriesToVisitList']) ?>
                                </div> 
                            </td>
			</tr>
			-->
			<!-- Question -->
                       
			<tr>
                            <td colspan="2" class="td-how-ticket">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-col-left" style="min-height: 70px;">
                                    <span class="middle-text">Avez-vous déjà acheté votre (vos) billet(s) d’avion internationaux aller-retour ?</span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9 ">
                
                                    <?=$form->field($model, 'howTicket', ['inputOptions' => ['class' => 'input_xxlarge', 'style' => 'display: inline-block;']])->radioList(
                                                            ['Oui' => 'Oui', 'Non' => 'Non']
                                                    )?>
                                </div>  
                                <div class="ticketDetail ticket-plus col amc-col-2 col-xs-12 col-sm-9 col-md-9 float-right">
                                    <label>En savoir plus :</label>
                                      <?=$form->field($model, 'ticketDetail', [
                        'inputOptions'=>['class'=>'input_full', 'rows'=>4]])->textArea();?>  
                                </div>
                                 <div class="help-ticket ticket-plus col amc-col-2 col-xs-12 col-sm-9 col-md-9 float-right">
                                      <?=$form->field($model, 'helpTicket')->checkbox(['label' => 'Souhaitez-vous être accompagné pour l\'achat de vos billets internationnaux ?']);?>  
                                </div>
                            </td>
                        </tr>
            
            <tr>
			
			<tr>
                            <td colspan="2">
                                 <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">
                                    <span class="fix-middle-text">Les participants *</span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                                    <div style="padding: 0;" class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-12">
                                        <div style="margin-bottom:20px; float: left; width: 100%;">
                                            <div style="padding: 0;" class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-4 width-225">
                                            <span class="f-t f-t-1 text-label">Adulte(s)</span>
                                                <?=$form->field($model, 'numberOfTravelers12',['inputOptions'=>['class'=>'fix-arrow input-numberOfTravelers12 float-right']])->dropDownList(range(0, 60)) ?>
                                            </div>
                                            
                                             <div style="padding: 0; margin: 0 0 10px 25px;" class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-6">
                                                 <span class="f-t f-t-4 text-label" style="margin: 0 22px 0 0;">Détails d'âges : </span>
                                                <?=$form->field($model, 'agesOfTravelers12', ['inputOptions'=>['class'=>'input_large input-agesOfTravelers12']])?>
                                            </div>	
                                    
                                           	
                                        </div>
                                    </div>
                                     <div style="padding: 0;" class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-12">
                                        <div style="padding: 0;" class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-4 width-225">
                                                    <span class="f-t f-t-2">Enfant(s) (2 - 12 ans)</span>
                                                    <?=$form->field($model, 'numberOfTravelers2',['inputOptions'=>['class'=>'fix-arrow input-numberOfTravelers2 float-right']])->dropDownList(range(0, 60))?>
                                        </div> 
                                        <div style="padding: 0; margin: 0 0 0px 25px;" class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-4">
                                            <span class="f-t f-t-3" style="margin-right: 18px;">Bébé(s) (<2 ans)</span>
                                                    <?=$form->field($model, 'numberOfTravelers0',['inputOptions'=>['class'=>'fix-arrow input-numberOfTravelers0']])->dropDownList(range(0, 60))?>
                                        </div>   
                                    </div>     
                                    
                                 </div>   
                            </td>
			</tr>
			<!-- Question -->
                        <tr>
                            <td colspan="2">
                                 <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-col-left">
                                    <span class="middle-text">La forme physique des participants :</span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                                    <?=$form->field($model, 'howTraveler', [
                                            'inputOptions'=>['class'=>'input_full', 'rows'=>1],
                                            ])->textArea()?>
                                </div>    
                            </td>
			</tr>
                        <tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">
                                     Quel(s) type(s) d’hébergement aimeriez-vous pour ce voyage ?
                                </div>
								<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                                    <?=$form->field($model, 'hotelTypes')->checkboxList(Yii::$app->params['formHotelTypeList'])?>
                                </div>    
                            </td>
			</tr>
                           
                        <tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">
                                    Repas
                                </div>
								<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
									<p class="">Le petit déjeuner est généralement déjà inclus dans le prix de l’hébergement. Souhaitez-vous d’autres repas ?</p>
                                
                                    <?=$form->field($model, 'mealsIncluded',['inputOptions'=>['class'=>'fix-arrow']])->dropDownList(Yii::$app->params['formIncludedMealList']);?>
                                </div>    
                            </td>
			</tr>
                        
                        <tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">
                                    Budget par personne
                                </div>
								<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
									<p class="">Mettez un montant plafond si vous souhaitez une offre en fonction de votre budget <br>(Budget total, incluant les vols internationaux aller-retour)</p>
                                
                                    <?=$form->field($model, 'budget', ['inputOptions'=>['class'=>'input_xxlarge']]) ?>
                                    <span style="display: inline-block; margin: 0 0 0 10px;">euros / personne</span>
                                </div>    
                            </td>
			</tr>
                        <tr>
                            <td colspan="2">
                                <p class="text-area text-area-3">pour mieux vous connaitre</p>
                            </td>
                        </tr>
			
			
			
			
			<!--
			<tr>
                            <td colspan="2" style="vertical-align: top;">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-3 col-fix-align">
                                    Thématiques
                                </div>
								<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-12 col-md-9">
                                    <?//=$form->field($model, 'tourThemes')->checkboxList(Yii::$app->params['formTourThemeList'])?>
                                </div>    
                            </td>
			</tr>
			-->
                        
			<!-- Question -->
			<tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-col-left" style="min-height: 116px;">
                                    <span class="middle-text" >Pouvez-vous nous raconter votre dernier voyage long-courrier ? (destination, type de voyage, expériences, ce que vous avez aimé, ...)</span>
                                </div>    
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                                    <?=$form->field($model, 'howMessage', [
                                            'inputOptions'=>['class'=>'input_full', 'rows'=>3,'style'=>'height: 116px;'],
                                            ])->textArea()?>
                                </div>  
                             </td>
			</tr>
			
			<!-- Question -->
			<tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-col-left" style="min-height: 76px;">
                                    <span class="middle-text" >Vos loisirs et passe-temps préférés (ce que vous aimez, ce que vous n’aimez pas…) :</span>
                                </div>    
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                                        <?=$form->field($model, 'howHobby', [
                                                'inputOptions'=>['class'=>'input_full', 'rows'=>1,'style'=>'height: 76px;'],
                                                ])->textArea()?>
                                </div>    
                            </td>
			</tr>
			 
                        <tr>
                            <td colspan="2">
                                <p class="text-area text-area-4">convenir d’un rdv téléphonique</p>
                            </td>
                        </tr>    
			
			
			
			
			
			<tr>
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">
                                    Nous vous rappelons gratuitement pour mieux comprendre votre projet !
                                </div>    
                            
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                                    <div id="radio-rdv">

                                        <span>Pouvons-nous convenir d’un entretien téléphonique ?</span>  <br><br>
                                                    <?=
                                                    $form->field($model, 'callback', ['inputOptions' => ['class' => 'input_xxlarge', 'style' => 'display: inline-block;']])->radioList(
                                                            ['Oui' => 'Oui', 'Non' => 'Non, merci']
                                                    )
                                                    ?>

                                    </div>
                                 </div>   
                            </td>
			</tr>
			<tr class="rdv" style="display:<?=$model->callback == 'Oui' ? 'auto' : 'none'?>">
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label field-devisform-phone">
                                    <span class="fix-middle-text text-label">Votre numéro de téléphone <span class="violet">*</span></span>
                                </div>    
								<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                                    <div style="padding: 0;" class="col-xs-4 col-sm-4 col-md-4">
                                        <?=$form->field($model, 'countryCallingCode', ['inputOptions' => ['class' => 'input_large fix-arrow','style'=>'width: 200px']])
                                        ->dropDownList(ArrayHelper::map($allDialCodes, 'code', 'xcode'), [
                                            'prompt' => '- Indicatif de pays -',
                                        ]) ?>
                                    </div>    
                                    <div style="padding: 0;" class="col-xs-6 col-sm-6 col-md-6">
                                        <?=$form->field($model, 'phone', ['inputOptions'=>['class'=>'input_medium not-blank']]) ?>
                                    </div>    
                                </div>    
                            </td>
			</tr>
                        <tr class="rdv" style="display:<?=$model->callback == 'Oui' ? 'auto' : 'none'?>">
                            <td colspan="2">
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label field-devisform-calldate">
                                    <span class="fix-middle-text text-label">Date pour le RDV <span class="violet">*</span></span>
                                </div>    
				<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
					<?=$form->field($model, 'callDate', ['inputOptions'=>['class'=>'input_large datepicker noWeekends']]) ?>
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
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">
                                     <span class="fix-middle-text">Heure pour le RDV :</span>
                                </div>
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-4 col-md-4">
					 
					<div id="tzSelectDiv">
                                            <select id="tzSelect" name="tz" class="fix-arrow input_full">
							<option value="">- Votre timezone -</option>
							<?php foreach ($tzi as $li) { ?>
							<option value="<?=$li?>" <?=$li == $tz ? 'selected="selected"' : ''?>><?=str_replace(['_', '/', 'Africa', 'Asia'], [' ', ' / ', 'Afrique', 'Asie'], $li)?></option>
							<?php } ?>
						</select>
						<span id="tzOK" style='display: inline-block;'></span>
					</div>
                                   </div>       
                            </td>
			</tr>
			<tr class="new-rdv rdv">
                <td class="float-left amc-col col-sx-3 col-sm-3 col-md-3 col-lg-3"></td>
                <td class="float-left amc-col col-sx-9 col-sm-9 col-md-9 col-lg-9" style="padding-bottom: 20px; position: relative;">
                    <div class="text-rdv">Ci-dessous, veuillez cliquer sur l'heure (votre heure locale) à laquelle vous souhaitez que l'on vous appelle (possibilité de choisir plusieurs créneaux horaires). </div>
                    <div class="times-to-call">
                        <? for($i=7; $i < 19; $i++)  : ?>
                        <span class="time col-xs-2 col-sm-2 col-md-2 col-lg-2"><?=$i.' - '. ($i+1).'H'?></span>
                    <? endfor; ?>
                    </div>
                    <?=$form->field($model, 'callTime', ['inputOptions'=>['class'=>'input_medium hidden timeutc']]);?>
                </td>
            </tr>

                        <!-- end test -->
                        
			<!--<tr><td colspan="2"><div style="margin:0 100px; border-top:2px dashed #eee;"></div></td></tr>-->
			 <tr>
				<td colspan="2">
					<p class="text-area text-area-5"></p>
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
                                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">
                                    Newsletters
                                </div>
				<div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
					<?=$form->field($model, 'newsletter')->checkbox(
						['label'=>'J\'aimerais ne pas recevoir des informations (reportages, promotions, conseils de voyages...) de la part de Amica Travel. (1 fois par semaine)']
					) ?>
                                </div>   
                            </td>
			</tr>
			
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
<?php ActiveForm::end();?>

<?php

$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerCssFile('/assets/css/page2016/devis.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);


$this->registerJsFile('/assets/js/jquery.crs.min.js?v=001',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

$this->registerCss(" #tzSelectDiv {margin-bottom:0px;}
    #tzTable {width:100%;}
    #tzTable div, #tzTable th {
        border:1px solid #fff; padding:5px 3px;
        width: 43px;
        height: 32px;
        float: left;
        margin: 10px 13px;
}
    div.time {text-align:center;}
    div.time.ok {background-color:#da521f; cursor:pointer; color: #fff;}
    div.time.nok {background-color:#eee; color:#ccc;}
    div.time.selected {background-color:#b5b5b0
    	; color:#fff;}
    div.date {font-weight:bold; text-align: center; background-color:#ccc;}
    #devisform-calltime{display: none;}
    .field-devisform-callback{
    display: inline-block;
    }
   
.form .extension .amc-col .tt{
    font-size: 22px;
    text-transform: uppercase;
}
.form .extension .amc-col-1{
    text-align: center;
}
.form .extension .amc-col-1 img{
    margin: 10px 0;
}
.form .extension .amc-col-1 .tt{
    color: #e75925;
    display: inline-block;
    font-family: 'LatoLatin-Bold';
    line-height: 24px;
    
}
.form .extension .amc-col-2 {
    padding-left: 30px;
}
.form .extension .amc-col-1 img{
    border: 2px solid  #cec3a3;
}
.form .extension .amc-col-2 .tt{
    width: 150px;
    display: inline-block;
    line-height: 24px;
    margin: 0 0 20px 0;
}
span.fix-middle-text.text-label {
    white-space: nowrap;
} 
.line{
    width: 100px;
    height: 1px;
    background-color:#c6b995;
    display: inline-block;
}
//#radio-rdv{
//   //  border: 1px solid rgb(189, 76, 156);
//   // border-radius: 5px;
//   // padding: 7px 80px 7px 7px;
//    text-align: left;
//    background: rgba(0, 0, 0, 0) url('/assets/img/rdv-icon.png') no-repeat scroll 348px 10px;
//}
//#devisform-callback label:first-of-type{
//   // font-weight: bold;
//   // color: #c74ca3;
//}
tr.rdv{
    display: none;
}
");

$dir_uri = DIR.URI;
$js_rdv3 =<<<JS
 
$(window).bind('load', function(){
    $('select[name="DevisForm[region]"] option[value=""]').text('Sélectionner');
	
	 $('.required').each(function(){
        var clas = $(this).attr('class');
        $(this).parent().parent().children('.fix-error-label').addClass(clas);
    });  
	
});    

$('#devisform-howticket > label').click(function(){
    var ticket = $('input[name="DevisForm[howTicket]"]:checked').val();
    if(ticket == 'Oui'){
        $('.ticket-plus').hide();
        $('.ticketDetail').show();
    } else{
        $('.ticket-plus').hide();
        $('.help-ticket').show();
    }
})
        
$("input[type=radio], input[type=checkbox]").after('<span></span>');        
 $(function(){
	$('input[type="submit"]').hide();
	$('#btn-valider-big').removeClass('hidden').bind('click', function(){
                $('form#devis-form').submit();  
					 $('html, body').animate({
                        scrollTop: $('form table').offset().top - 250
                    }, 300);
				return false;
        });
		$(".datepicker").parent().click(function() {
            $(this).children('input').focus();
        });
       
        
        $('input[name="DevisForm[callback]"]').click(function(){
		var val = $(this).val();
		if (val == 'Oui') {
			$('.rdv').show();
		} else {
			$('.rdv').hide();
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

//        $('.entry .btn-extension').click(function(){
//           
//            //$('.program a.active').removeClass('active');
//            //$(this).addClass('active');
//            
//           // $(this).addClass('active').siblings().removeClass('active');;
//            $(this).toggleClass("active");
//            if($(this).hasClass('active')){
//                $(this).text('AJOUTÉ AU PROGRAMME');
//                
//            } else{
//                $(this).text('AJOUTEZ AU PROGRAMME');
//            }
//            var name = $(this).attr("name");
//            var radio =  $('#devisform-extension').find('input[name="DevisForm[extension][]"][value="'+ name +'"]');
//            if(radio.is(':checked')){
//                radio.prop('checked', false);
//             }
//             else{
//                 radio.prop('checked', true);
//             }
//                
//            
//        });
        
       
        $('#devisform-extension input[name="DevisForm[extension][]"]').change(function(){
            var extension = $(this).attr('value');
        
            var namepopup = $(this).parent().children('.topopup').attr('name');
        
            if(!$(this).is(':checked')){
                var url = '$dir_uri';
                var target = $(this);
        
                $('.' + namepopup + ' .btn-extension').removeClass('active');
        
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
                var url = '$dir_uri';
                var target = $(this);
        
                $('.' + namepopup + ' .btn-extension').addClass('active');
        
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