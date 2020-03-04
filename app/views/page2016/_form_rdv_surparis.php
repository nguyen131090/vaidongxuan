<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\captcha\Captcha;

$form = ActiveForm::begin([
    'id' => 'contact-form',
    'action' => '',
    'fieldConfig' => [
        'options' => [
            'tag' => 'span',
        ],
        'template' => '{input}{error}',
    ],
    'enableClientValidation' => TRUE,
]);
?>

    <table id="tbl-contact" class="form">
        <tr>
            <td colspan="2" class="info-error">
                <div class="float-left amc-col amc-col-1 col-xs-4 col-sm-4 col-md-4"></div>
                <div class="float-left amc-col amc-col-1 col-xs-4 col-sm-4 col-md-8">
                    <?= $form->errorSummary($model); ?>
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
                    <?= $form->field($model, 'prefix', ['inputOptions' => ['class' => 'fix-arrow input-fullname not-blank']])->dropDownList(Yii::$app->params['formUserPrefixList']) ?>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3" style="min-width: 280px;">
                    <?= $form->field($model, 'lname', ['inputOptions' => ['class' => 'input_medium input-fullname not-blank', 'placeholder' => 'Prénom']]) ?>
                </div>
                <div class="amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 float-right" style="min-width: 280px;">
                    <?= $form->field($model, 'fname', ['inputOptions' => ['class' => 'input_medium input-fullname not-blank', 'placeholder' => 'Nom']]) ?>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                    <span class="fix-middle-text text-label">Votre adresse mail <span class="violet">*</span></span>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-1 col-md-1" style="min-width: 290px;">
                    <?= $form->field($model, 'email', ['inputOptions' => ['class' => 'input_full disablecopypage not-blank']]) ?>
                </div>
                
            </td>
        </tr>

        <tr>
            <td colspan="2" class="address">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                    <span class="fix-middle-text text-label" style="margin: 0;">
                        Lieu de RDV souhaité<br>sur Paris <span class="violet">*</span>
                    </span>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3" style="min-width: 250px;">
                    <?php
                    $code_country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';
                    ?>
                    <?=
                    $form->field(
                        $model,
                        'period',
                        [
                            'inputOptions' => ['style' => 'min-width: 270px', 'class' => 'fix-arrow not-blank', 'data-value' => 'shortcode', 'data-default-value' => $code_country, 'data-arrondissement-id' => 'contactform-arrondissement'],
                        ]
                    )
                        ->dropDownList($listData, ['prompt' => '- Sélectionez -']); ?>
                </div>
            </td>
        </tr>


        <tr class="rdv">
            <td colspan="2">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label">
                    <span class="fix-middle-text text-label"> Votre numéro téléphone <span
                                class="violet">*</span></span>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-4 col-md-4" style="min-width: 250px;">
                    <?= $form->field($model, 'phone', ['inputOptions' => ['class' => 'input_full']]) ?>
                </div>
            </td>
        </tr>
        <tr class="rdv">
            <td colspan="2">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label" style="">
                    <span class="fix-middle-text text-label">Date de RDV souhaitée <span class="violet">*</span></span>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                    <?= $form->field($model, 'callDate', ['inputOptions' => ['class' => 'input_full datepicker noWeekends', 'style' => 'min-width: 270px;']]) ?>
                    <div style="padding-top:5px; display: none;"> NOTE: Les horaires disponibles pour demander un RDV
                        téléphonique chez Amica Travel sont entre 2:00 AM et 7:00 PM heure GMT (ou entre
                        <?= date_format(date_timezone_set(date_create('02:00:00'), timezone_open('Europe/Paris')), 'h A') ?>
                        et
                        <?= date_format(date_timezone_set(date_create('19:00:00'), timezone_open('Europe/Paris')), 'h A') ?>
                        heure locale français) tous les jours (sauf Dimanche)
                    </div>
                </div>
            </td>
        </tr>
        <?php
        $tzi = DateTimeZone::listIdentifiers();
        $country_code = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : 'FR';
        $cc = isset($_GET['cc']) ? $_GET['cc'] : $country_code;
        $timezone = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, strtoupper($cc));
        $tz = isset($_GET['tz']) && in_array($_GET['tz'], $tzi) ? $_GET['tz'] : $timezone[0];
        $tz = isset($_POST['tz']) && in_array($_POST['tz'], $tzi) ? $_POST['tz'] : $tz;

        date_default_timezone_set($tz);
        $startDate = isset($_GET['datepicker']) ? new DateTime($_GET['datepicker']) : new DateTime('tomorrow');
        $utcOKDate = new DateTime('tomorrow');
        ?>
        <tr>
            <td colspan="2">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align fix-error-label amica-votre-message">
                    <span class="fix-middle-text text-label">Votre message <span class="violet">*</span></span>
                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">
                    <?= $form->field($model, 'message', [
                        'inputOptions' => ['class' => 'input_full', 'rows' => 3],
                    ])->textArea() ?>
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
                    <?= $form->field($model, 'newsletter')->checkbox(
                        ['label' => 'J\'aimerais recevoir des informations (reportages, promotions, conseils de voyages...) de la part de Amica Travel. (1 fois par semaine)']
                    ) ?>
                </div>
            </td>
        </tr>
        <tr>

            <td colspan="2">
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-3 col-md-3 col-fix-align">

                </div>
                <div class="float-left amc-col amc-col-2 col-xs-12 col-sm-9 col-md-9">

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
$this->registerJsFile(DIR . 'assets/js/jquery.crs.min.js?v=001', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
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
    #contactform-calltime{display: none;}
   .field-contactform-callback{
    display: inline-block;
}
#devis-form{
margin-top: 40px;
}    
.form .extension .col .tt{
    font-size: 22px;
    text-transform: uppercase;
}
.form .extension .col-1{
    text-align: center;
}
.form .extension .col-1 img{
    margin: 10px 0;
}
.form .extension .col-1 .tt{
    color: #e75925;
    display: inline-block;
    font-family: 'LatoLatin-Bold';
    line-height: 24px;
}
.form .extension .col-2 {
    padding-left: 30px;
}
.form .extension .col-2 .tt{
    width: 150px;
    display: inline-block;
    line-height: 24px;
    margin: 0 0 20px 0;
}
span.fix-middle-text.text-label {
    white-space: nowrap;
}    
tr.rdv{
//background: #ebdcf3 !important;
}

");

$dir_uri = DIR . URI;
$js_rdv3 = <<<JS
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
    $(".datepicker").parent().click(function() {
        $(this).children('input').focus();
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
       $('#contactform-calltime').val(time);
       $('#contactform-calltime').change();

    })

    $('#prevWeek').click(function(){
        return false;
    });

            // JS EXTENSION BTN

    $('.entry a.btn-extension').click(function(){

                //$('.program a.active').removeClass('active');
                //$(this).addClass('active');

               // $(this).addClass('active').siblings().removeClass('active');;
        $(this).toggleClass("active");
        var name = $(this).attr("name");
        var radio =  $('#contactform-extension').find('input[name="DevisForm[extension][]"][value="'+ name +'"]');
        if(radio.is(':checked')){
            radio.prop('checked', false);
        }
        else{
           radio.prop('checked', true);
       }


    });


    $('#contactform-extension input[name="DevisForm[extension][]"]').change(function(){
        $('.entry a.btn-extension').removeClass('active');
        var value = $(this).val().replace(' ','-').toLowerCase();
        $('#popup_content .'+value+' .entry a.btn-extension').toggleClass('active');

    }); 


});       


//    $('.input_xxlarge').bind("cut copy paste",function(e) {
//         e.preventDefault();
//         });



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
$this->registerJs($js_rdv3, yii\web\View::POS_END);
?>