<?php $this->registerCssFile('/assets/css/page2016/contact.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
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
                <td colspan="2" class="">
                    
                    <div class="float-left pr-5">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">Email <span class="amc-color-e75925">*</span></p>

                        <div class="float-left p-0" style="">
                           <?=$form->field($model, 'email', ['inputOptions'=>['class'=>'email input-width-340 disablecopypage','style'=>'width: 407px;','placeholder'=>'email@domain.com']]) ?>
                                
                        </div>
                    </div>
                     <div class="float-left pl-20">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">Téléphone</p>
                        <div class="area_dial_code_country" style="display: none;">
                        <?=$form->field($model, 'dialcodeCountry', ['inputOptions'=>['class'=>'input_dial_code_country hidden']]);?>
                        </div>   
                        <div class="float-left p-0" style="">
                            <?=$form->field($model, 'telephone', ['inputOptions'=>['class'=>'dial-code-country input-width-272 input-ville not-blank','placeholder'=>'']]) ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="float-left amc-arrow p-0">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">Veuillez choisir le sujet de votre message <span class="amc-color-e75925">*</span></p>
                        <?=$form->field($model, 'subjet', [
                                'inputOptions'=>['class'=>'amc-iput-focus','style'=>'width: 407px;'],
                                ])->dropDownList(Yii::$app->params['subjet']);
//                                [ 
//                                        'options'=> ['' => ['disabled' => true, 'Selected' => true],
//                                ]])
                        ?>
                    </div>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    
                    <div class="float-left pr-5 amc-sujet-pdv">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10">Pays <span class="amc-color-e75925">*</span></p>

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
           
            <tr>
                <td colspan="2">
                    <div class="float-left w-100">
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10 amc-sujet-default">Votre message <span class="amc-color-e75925">*</span></p>
                        <p class="amc-text-question amc-latolatin-semibold mt-txt-40 mb-10 amc-sujet-pdv">Décrivez votre projet <span class="amc-color-e75925">*</span></p>
                        <?=$form->field($model, 'message', [
                            'inputOptions'=>['class'=>'input_full', 'rows'=>4,'style'=>'height: 140px;'],
                            ])->textArea()?>
                    </div>  
                </td>
            </tr>
            <?=$form->field($model, 'duraTime', ['inputOptions'=>['class'=>'dura-time hidden d-none']]);?>
            
            <? if( $model->scenario == 'contact') : ?>
<!--                <tr>
                    <td colspan="2" align="">
                        <div class="float-left recaptcha p-0 m-0 mt-40">
                        <?//= $form->field($model, 'reCaptcha',['inputOptions'=>['class'=>'']])->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
                         </div>   
                    </td>
                </tr>-->
                <? endif; ?>
            <tr>
                <td colspan="2">
<!--                    <p class="mb-0 mt-txt-40"><span class="amc-color-e75925">*</span> Champs obligatoires</p>-->
                    <div class="float-left w-100 text-center" style="">

                        <a id="btn-valider-big" class="btn-amica-basic btn-amica-basic-2 mt-txt-40 mb-0" href="javascript:void(0)">Envoyer la demande                                       
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
<?php
//$this->registerCssFile('/assets/nathansmith/formalize/css/formalize.css',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

//$this->registerJsFile('/assets/nathansmith/formalize/js/jquery.formalize.min.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

$this->registerJsFile('/assets/js/jquery.crs.min.js?v=001',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);
$js=<<<JS
        
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
        
        $('#contactform-subjet').change(function() {
            
            var val = $(this).val();
            
            if (val == 'pdv') {
                    $('.amc-sujet-pdv').show();
                    $('.amc-sujet-default').hide();

            } else {
                    $('.amc-sujet-pdv').hide();
                    $('.amc-sujet-default').show();
            }
        });
       
        
      $(function(){
	$('input[type="submit"]').hide();
	$('#btn-valider-big').removeClass('hidden').bind('click', function(){
            var submitTime = new Date();
            var duraTime = Math.abs(submitTime - currentdate);
            duraTime = Math.floor((duraTime/1000));
            duraTime = parseInt(duraTime/60) + ':'+ ((duraTime%60) < 10 ? '0'+(duraTime%60) : (duraTime%60));
            $('.dura-time').val(duraTime);
            $('form#contact-form').submit();  
//            $('html, body').animate({
//                scrollTop: $('form table').offset().top - 250
//            }, 300);
            return false;
            });
	});  
            
        
        $("form#contact-form").on("beforeSubmit", function (event) {
            $('#btn-valider-big').prepend('<span class="spinner"></span>');
            $('#btn-valider-big').addClass('ok-valid');     
        });
        
        
        
        
         $('.disablecopypaste').bind('copy cut paste',function(e){
        e.preventDefault();
    });        
JS;
$this->registerJs($js,  \yii\web\View::POS_END);
?>
<?
$this->registerCssFile('/assets/js/intl-tel-input/build/css/intlTelInput.min.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
$this->registerJsFile('/assets/js/intl-tel-input/build/js/intlTelInput.min.js',['depends'=>'app\assets\AppAsset','position'=>$this::POS_END]);

$js =<<<JS
           
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