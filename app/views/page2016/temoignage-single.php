<?php $this->registerCssFile('/assets/css/page2016/temoignage-single.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>
<?php $this->registerCssFile('/assets/css/page2016/responsive.css',['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]); ?>

<div class="contain container-1">
    <img style="width: 100%; display: none;" alt="" data-src='<?=DIR?>upload/image/banner-thongnong.jpg'>
    <div class="amc-column row-1">
        <? include('_inc_breadcrumb.php') ?>
    </div>    
     
    
</div>
<div class="contain container-2">
    
    <div class="amc-column">
        <div class="rows row-1 pt-40">
<!--            <div class="amc-col amc-col-1 d-none d-sm-none d-lg-block">
               <div class="search-form">
                   <?//php include '_form_search_temoignage.php';?>

               </div>
            </div>-->
           
            <div class="amc-col amc-col-2 w-100">
                <h1 class="title"><?= $theEntry->model->seo->h1?></h1>
                <span class="nameClient"><?=$theEntry->data->nameclient ?></span>
                <ul class="gro-info">
                    <li class="calendar"><?//= isset($theEntry->data->from) ? $date_from=  date('F',strtotime($theEntry->data->from)).' '.date('Y',strtotime($theEntry->data->from)) : ''?>
						<?= date('d/m/Y',strtotime($theEntry->data->from)) .' - '. date('d/m/Y',strtotime($theEntry->data->to)) ?>
					</li>
                    <li class="posi">
                        <? if(isset($theEntry->data->countries)) : ?>
                        <? $countries = $theEntry->data->countries; ?>
                        <? foreach ($countries as $key => $value) {
                            echo Yii::$app->params['tsDestinationList'][$value];
                            if($key==count($countries)-1) break;
                            echo ", ";
                        } ?>
                    <? endif;?> 
                    </li>
                    <? if(isset($theEntry->data->emailclient) && $theEntry->data->emailclient != NULL ){ ?>
                    <li class="contact"><span class="email"><?= isset($theEntry->data->emailclient) ? base64_encode($theEntry->data->emailclient) : ''?></span><span class="text-contact">Contact</span></li>
                    <? } ?>
                </ul>
                <div class="list-posi">
                    <span>Son itinéraire en bref</span>
                    <?= isset($theEntry->data->itinerary) ? '<p>'.$theEntry->data->itinerary.'</p>' : ''?>
                </div>
                <div class="entry-body">
                    <?= str_replace(['<p>&nbsp;</p>','src="'], ['','data-src="'], $theEntry->model->description)?>
                </div>
                
<!--                <div class="search-form responsive-search-temoi d-none d-sm-block d-lg-none mt-40 mb-20">
                   <?//php include '_form_search_temoignage.php';?>

               </div>-->
            </div>    
        </div>
        
    </div>
</div>
<div class="contain container-5">

    
    <div class="amc-column">
        
        <div class="rows row-1 mt-40">
            <h3 class="tt">Notre équipe à votre écoute</h3><span class="btn-amica-basic btn-amica-basic-1 pugjd" data-title="<?= base64_encode(DIR.'devis') ?>">Faites-nous savoir vos attentes</span>
        </div>
            
    </div>
        
</div>

<!-- BACK BUTTON -->
<? include '_inc_back_button.php'; ?>
<!-- End BACK BUTTON -->

<?php
$url = DIR.URI;
$js=<<<JS
    var count = 0;   
    $('.contact').click(function(){
       
        count += 1;
        var hClass = $(this).find('.email').hasClass('active');
        
        if(hClass){
            $(this).find('.email').removeClass('active');
            $(this).find('.text-contact').removeClass('active');
        }else{
            $(this).find('.email').addClass('active');
            $(this).find('.text-contact').addClass('active');
            if(count == 1){
                var decodeemail = $(this).find('.email').text();
               var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}
               var decodedString = Base64.decode(decodeemail);
               $(this).find('.email').text(decodedString);
            }
        }
        
        
    })

JS;
$this->registerJs($js,  yii\web\View::POS_END);
$this->registerCss("
    .contact .text-contact{
        max-width: 100%;
        display: inline-block;
        height: 30px;
        overflow: hidden;
        display: block;
        cursor: pointer;
    }
.contact .email{
    display: none;
    height: 30px;
   // max-width: 0;
    overflow: hidden;
    
}
.contact .email.active{
   // max-width: 100%;
    //transition: max-width 0.5s;
    display: block;
}
 .contact .text-contact.active{
   // max-width: 0;
   // transition: max-width 0.2s;
   display: none;
 }
 .container-2 .fix-call{
    border: none;
    padding: 0;
 }
 .back-button{margin-top: 25px;}
");
?>
