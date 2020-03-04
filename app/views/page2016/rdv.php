<?php $this->registerCssFile('/assets/css/page2016/rdv.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/all-form.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>

<?php $this->registerCssFile('/assets/css/page2016/fix-banner-top.css?v=001',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<?php $this->registerJsFile('/assets/js/fix-banner-top.js',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
    <?php
        if(!empty($theEntry->photos)){
            foreach ($theEntry->photos as $value) {
                if($value->type == 'banner'){
                    echo '<img style="width: 100%;" alt="'.$value->description.'" class="img-lazy" data-src="'.$value->image.'">';
                }
            }
        }else{
            
    ?>
    
    <img alt="" style="width: 100%;" class="img-lazy" data-src='<?=DIR?>upload/image/banner_contact.jpg'>
    <?php }?>
    
    
<!--    <div class="amc-column row-2 mb-txt-40">
        
        <h1 class="title"><?//= $this->context->pageT?></h1>
    </div>-->
    
</div>
<div class="contain container-2 amc-fix-title-text">
    <div class="amc-column row-2 pt-txt-40">
        
        <h1 class="title amc-fontsize-32 amc-latolatin-bold text-center amc-color-e75925 m-0"><?= $this->context->pageT?></h1>
    </div>
    <div class="amc-column pt-0 pt-txt-40 pb-txt-40">
        <div class="text text-top-form">
            <?= $theEntry->model->text ?>
               <!-- <p class="tt">DEMANDER UN DEVIS SUR MESURE</p>
                <p>Nos conseillères étudieront votre demande et vous répondra sous 48h !</p>
				-->

         
        </div>
        <?//php include_once '_form_devis.php';?>
    </div>
</div>
<div class="contain container-form">
<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\captcha\Captcha;

$form = ActiveForm::begin([
        'id'=>'contact-form',
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
    
    
    <div class="amc-bg-color-f7f7f7 area-5 pb-40">
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
                    <div class="float-left pr-20">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5">Civilité <span class="amc-color-e75925">*</span></p>

                        <div class="float-left p-0">
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
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">Email <span class="amc-color-e75925">*</span></p>

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
                        'inputOptions'=>['class'=>'input-width-150 amc-iput-focus input-country crs-country not-blank', 'data-value'=>'shortcode', 'data-default-value'=>$code_country, 'data-region-id'=>'contactform-region'],
                        ])->dropDownList([
                                'prompt'=>'- Sélectionez -',

                        ])?>  
                        </div>
                    </div>
                </td>
            </tr>
            
            <tr class="rdv">
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10"><?= Yii::$app->params['questions_form']['phone'][0] ?> <span class="amc-color-e75925">*</span>
                        <br><span class="amc-color-b1b1b1 amc-latolatin-regular"><?= Yii::$app->params['questions_form']['telephone'][1] ?></span></p>
                        
                        <div class="float-left amc-arrow p-0 pr-5" style="display: none;">
                            <?=$form->field($model, 'countryCallingCode', ['inputOptions' => ['class' => 'input-width-186 amc-iput-focus']])
                            ->dropDownList(ArrayHelper::map($allDialCodes, 'code', 'xcode'), [
                                'prompt' => '- Indicatif de pays -',
                            ]) ?>
                        </div> 
                        <div class="area_dial_code_country" style="display: none;">
                        <?=$form->field($model, 'dialcodeCountry', ['inputOptions'=>['class'=>'input_dial_code_country hidden']]);?>
                        </div>   
                        <div class="float-left p-0 pl-0">
                            <?=$form->field($model, 'phone', ['inputOptions'=>['class'=>'dial-code-country input-width-265 not-blank', 'placeholder'=>'']]) ?>
                        </div>    
                    </div>    
                </td>
            </tr>
            <tr class="rdv">
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">Date pour le RDV <span class="amc-color-e75925">*</span></p>
                        
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
            <tr class="rdv">
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-5">Veuillez cliquer sur l'heure (votre heure locale) à laquelle vous souhaitez que l'on vous appelle. <span class="amc-color-e75925">*</span></p>
                        <p class="amc-color-b1b1b1">(possibilité de choisir plusieurs créneaux horaires)</p>
                        
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
            <tr class="new-rdv rdv">
                <td colspan="2">
                   <div class="float-left w-100">
                       
                       <div class="float-left p-0" style="margin-top: 18px;">
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
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">Votre message <span class="amc-color-e75925">*</span></p>
                        <?=$form->field($model, 'message', [
                            'inputOptions'=>['class'=>'input_full', 'rows'=>4,'style'=>'height: 140px;'],
                            ])->textArea()?>
                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">Si vous êtes recommandé(e) par un ancien client d'Amica, merci de préciser son nom et prénom</p>
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
            <?=$form->field($model, 'duraTime', ['inputOptions'=>['class'=>'dura-time hidden d-none']]);?>
            <tr>
                <td colspan="2">
<!--                    <p class="mb-0" style="margin-top: 25px;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>-->
                    <div class="float-left w-100 text-center" style="">

                        <a id="btn-valider-big" class="btn-amica-basic btn-amica-basic-2 mt-txt-40 mb-0" href="javascript:void(0)">
                            Envoyer la demande                                       
                        </a>
                    </div>
                </td>
            </tr>
            
        </table>    
    </div>
       <p class="mb-0 text-center text-champ" style="margin-top: 25px;"><span class="amc-color-e75925">*</span> Champs obligatoires</p>
        <p class="text-private mt-txt-25">En validant ce formulaire, vous acceptez notre <a href="/politique-de-confidentialite" target="_blank">politique de confidentialité et de collecte.</a></p>        
             
<?php ActiveForm::end();?>
   
</div>   

<?
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
//$this->registerCssFile('/assets/css/page2016/devis.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);


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
    #contactform-calltime{display: none;}
   .field-contactform-callback{
    display: inline-block;
}
#devis-form{
margin-top: 40px;
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
.form .extension .amc-col-2 .tt{
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

$dir_uri = DIR.URI;
$js_rdv3 =<<<JS
        
$('#contactform-prefix label').click(function(){
    $('#contactform-prefix label').removeClass('active');
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
    $('select[name="ContactForm[region]"] option[value=""]').text('Sélectionner');

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

$("input[type=radio], input[type=checkbox], input[type=text], select").after('<span class="amc-arrow-fix"></span>');      
$(function(){
	$('input[type="submit"]').hide();
    $('#btn-valider-big').removeClass('hidden').bind('click', function(){
        var submitTime = new Date();
            var duraTime = Math.abs(submitTime - currentdate);
            duraTime = Math.floor((duraTime/1000));
            duraTime = parseInt(duraTime/60) + ':'+ ((duraTime%60) < 10 ? '0'+(duraTime%60) : (duraTime%60));
            $('.dura-time').val(duraTime);
        $('form#contact-form').submit();  
//        $('html, body').animate({
//            scrollTop: $('form table').offset().top - 250
//        }, 300);
        return false;
    });
    $(".datepicker").parent().click(function() {
        $(this).children('input').focus();
    });
     
    $("form#contact-form").on("beforeSubmit", function (event) {
        $('#btn-valider-big').prepend('<span class="spinner"></span>');
        $('#btn-valider-big').addClass('ok-valid');     
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
$this->registerJs($js_rdv3,  yii\web\View::POS_END);
?>

<?
$this->registerCssFile('/assets/js/intl-tel-input/build/css/intlTelInput.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/intl-tel-input/build/js/intlTelInput.min.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

$js =<<<JS
var currentdate = new Date();            
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
//       // console.log(dialcode);
//});        
//$('#country-listbox li').click(function(){
//    var dia = $(this).data('dial-code');
//         $('.input_dial_code_country').val(dia);
//      //  console.log(dia);
//});   
      
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
?>         