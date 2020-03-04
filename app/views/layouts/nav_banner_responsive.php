<?php
	use yii\helpers\Markdown;
?>

<!--Nav when Responsive-->
<nav style="display: none;" class="navbar navbar-default navbar-fixed-top">
    <div class="sologan-text">
        <p>Agence locale, spécialiste des voyages sur mesure : <br><span>Vietnam, Laos, Cambodge &amp; Birmanie</span></p>
    </div>
    <div class="container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
<!--                  <a class="navbar-brand" href="#"><img alt="Amica Travel" src="<?= DIR ?>assets/img/page2016/logo.png"></a>-->


            <ul>
                <li><a class="navbar-brand" href="<?=DIR?>"><img alt="Amica Travel" src="<?= DIR ?>assets/img/page2016/logo.png"></a></li>
                <!--<li class="search"><a href="javascript:void(0);" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">Search</a></li> -->
<!--                    <li class="devis"><a href="#"><span>Devis</span> sur mesure</a></li>
                <li class="rdv"><a href="#"><span>Rappel</span> gratuit</a></li>-->
                <li class="navigation"> 
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </li>
            </ul>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?= SEG1 == 'destinations' ? 'active' : ''?>"><a href="<?=DIR?>destinations">NOS DESTINATIONS <span class="sr-only">(current)</span></a></li>
                <li class="<?= SEG1 == 'formules' ? 'active' : ''?>"><a href="<?=DIR?>formules">Formules d'Amica</a></li>
                <li class="<?= SEG1 == 'voyage' ? 'active' : ''?>"><a href="<?=DIR?>voyage">IDÉES DE VOYAGE</a></li>
                <li class="<?= SEG1 == 'a-propos-de-nous' ? 'active' : ''?>"><a href="<?=DIR?>a-propos-de-nous">À PROPOS DE NOUS</a></li>
                

            </ul>


        </div><!-- /.navbar-collapse -->

       

    </div><!-- /.container-fluid -->
</nav>


<nav style="display: none;" class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid">

       
            
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <form>
                <div class="cs-select-mb destination search-destination">
                    <span class="cs-placeholder-mb" name="">Destination</span>
                        <div class="cs-options-mb" style="display: none;">
                                <ul>
                                    <li data-option="" data-value="vietnam">Vietnam</li>
                                    <li data-option="" data-value="laos">Laos</li>
                                    <li data-option="" data-value="cambodge">Cambodge</li>
                                    <li data-option="" data-value="birmanie">Birmanie</li>
                                </ul>
                        </div>
                        <div class="list-option-mb">
                            <ul>

                            </ul>    
                        </div>
                </div>
                <div class="cs-select-mb search-envies une-envie single">
                    <span class="cs-placeholder-mb" name="">Une envie</span>
                        <div class="cs-options-mb" style="display: none;">
                            <ul>
                                <? foreach ($type = \app\modules\exclusives\models\Category::find()->roots()->all() as $key => $value) : ?>
                                   <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?></li>
                                <? endforeach ?>
                                </ul>

                        </div>
                        <div class="list-option-mb">
                            <ul>

                            </ul>    
                        </div>

                </div>
                <div class="cs-select-mb submit-mb">
                    submit
                </div>
            </form>


        </div><!-- /.navbar-collapse -->
        
         <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header navbar-bottom">



            <ul>
                <li class="contact"><span data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false"><img alt="Amcia Travel" src="data:image/png;base64,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"></span></li>
                <li class="devis"><a href="<?=DIR?>devis"><img alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH4AAABLCAQAAAAcnfsdAAAMUUlEQVR4Xu2bbZAV1ZnHf6e7b5/hLcxIGHzZgkAMZuNWcGGSMpUtSyMmqLWasICWu8Y1ssAorBqEGcTZNfI2InElwXVASgUmGDXZqLhRGRCRSkVldJVYVmVVmLGyuwkww1wF5p5+OWfX2119X6bvClVxa7zs/3zp2336POd3nznPPf2fe4Xh1JXFKSyHT1CCSIaChCBuDJRJWiLz6YNPlxDYyCVnfe3zytYp8I4emru0k34C9Kc58+noGYbvmHHRjyxJRR18rv5aPsCrGngDWIIMI3521YVrhaO869ffMe1Pv0CKhjQwilxVwdsChxE/nXnFPwnHEPDo0cbQkKbAZiQHq6fax+hbrpy+1naJGY0gVdqiBguqJfN59If/ctYDlmsAMHDMrpB5AyCqAT5B33D51W0RegxojKkMD9UBL7AZ0fatv26za0wJoKH64S2Grr3wbzY6Qw2ccvAOtdNbStEBg5+GmVzT1QHv8hl71Lvdv+jWlohpa47ZWY6Tuuaf2LtgI0cJqiXzNaHV/YeWPfTjE+koavJp484cCP/gyzc/fu6RbD8GC10VBc9wYcOxho9f3T/e0/xMc/3trb//5cSb8PHQn3Z4sEPL8PFau3vpL79/evN8K3Pmtzs/bGimBw/zaYcXWnw8w327Wp699YyW+XbGAOdcu/MPF7eSJah6eG3W7Fz+/KKzltwUoQPUnccwPqyC7a3B/K/oq3eser557KLGAvpv3rniAQSiyuG1ad2+envz2NuK0F/r/va6D39PP2EVwFMRPtDLn1u7s3nswhsL6J1d31l39C1+x1F0FWc+0P/4zAMvNo1dON+2C+jT1x19g/c4TK464RP0tl1N4xYusBL0V7pmrR/7/ttd9EToVQrvhXc8/dDupeP/fn4J+iOTsw8t/sKVBGioUngvXPSLrXuWTlhQhP5q16xNX+rf/A+ORQ0ZclUL/+Cerb9qOfvGG4vRpz/yZbX1tmGjj/Uwkj6oUvjf9ax4fvboxmL0A9MfmeT95JbPjDaEFkOxqhZ+9Ta/d8HcorW+f8am89SWW0eOMUBoYUOVwr/y74/928qv1H+ugD7zf9A3R+ixqhReBS1PnhnOmBmD8ut3r970JbVpYQHdVBW81gGJdrz2m+6Hpw4fCdBzfPOv79k5KXh0Ye0YEoUhulpsrIDjHTtmXeNmAD44uvSpr9Z84zJDznv89dadtYc2Tfn65UNOM4XuwYsvcJywOuB9sk2PNu2lHpfjHKLnJ404L76y5IX39/Of2b7r9vIYZzCaYTiAx2HepQ+/WuB7eYdehmHjoeDl7auf7DjMEf6LXnK49NHDEGwAQo7RQy9eFcDHOD5HcBBowG15iiH4ZOkjBzgc4xCCSIYAhU/I/4mE4ZOToEw2LhKLgNzH7N+r75sZaBQqPjpRVQ28wTCIZHEKSxhOXf3/9/AUfwR1MJVYvMBOscHtUYZIU+mgVDdxA5OBA3IiYdLvPSYAS+nlAQDpEioNzGVOvjcsZb98HKMMJyH5iWdeUNA3WGEOqdulLUX6Z55wxX0AjPcuS4ru3Dx6t/zn5MxQbKCVthgdVjAHFzH4C95y9SCOFKTJdp+iC8AsJCMtAGYCiHUIDJEcLKbQNGCvYA1KeLFYjpGjxTLeBOB6r7EIv1ueIevlZz9q7kP4rAHgAn8iNjCVi4Fud3PZlxMaonudL8p6q0EsowsxWDNvUBx1V8q/YDeA+V5JngKOczTfjuHJtij3+lYcKZgFINoJ8DEUdAQA9HD6M2+5q+RNeOjBaWYYQnw0vmg0bwOT/ImZt4g0Th0i0kbZiAbu4X7gyqBFS/4OyNqb8QgokthpDjCecbpTPSQ2uJ0A6EG85pVRoftbDgCYCdgISpVBYikj19MFjNQ3mKui9W4fxi9Fc3vFNfQB8D3zstrgnYZWZpAXPKUrx8CK3xDNPQDmOhbGefcJStGUcV8VX2cTxG/Aq9450hrsZkYd4wHsfZik4J1PiI4Xh4GPcq9WUMs4ALHF7klbz0rL3zLPv1cv5LvA50wT86SnzCDOPOsB2Gf3ojEDCp6KITVriGVtwSdMg1IhKvO2nMedAFyEiz14M9/MTCZHqzjKdSyNr7wSLCPWm9uoBdqd9/AIKddU5vI6qwkJ+RMAsjiIQQhv1qg1FNTuPolPmFT7HmKxVN4dFS63R61hOdg/jtd7uQ4wgxlqJYnENgZ7wQOxQn6fHF7qVF1cBHHu6WOL814F++oIpdpnbyZAD96Ct09sszfbPShUajYRNg4eQJR78Ss8/LSe9HIHX+FKALpFu/sjFN4gg5fTqMFFFFY3AT5aGZA7qIkc2kSagBhVGdlKBl0AkhvYRA1WlGHZisTFQsTjegTKDCp4QnJ4iMSu0mhVwPPRWGU7wQKAxsMUARk8QgSaENAofASiMO4f0clRVLdk5cwnHygzANjIfnl3Pg9zaQNekN9K7IYOpiaVuolVRRV5Y1y9B6qZnbKz7EodTfL2fIxUo0Ouz4/VzGLqotHpiMaI7Y5L5XalE5ukYHsUR9nIz2RH1EtViGEBMIuOGB1ms7LkJz42NclqFaWVOtF4Vqi9fn3qtnMKbbhlV1q5hAxWBaMjGr+TVdQRj840MlLEvRE18SsQRbZHqWbznGqUjhSVY0SQbZRKYieoAgdRXqlTnqn/XLfGUyqHn+zNLTE1JjCHycEYLNJlY6smppTEzJApSYhdBuSkjrbO/yJWpRh5eDWBOgBrWmxEvITgRNUuT3cm8jQAf4vETtvhmx8E9UWoGwB0A5YUkGp0hEwAYJs8XdaLGWIZnPic7K/JMeIG+gDMzCghqTGMBVE3MCPI5Y2Iy1FoTlSe/R/WPADwzx6QzUsAqA2XJ5OYxcUAnBdlL93oiC2Mkfgcc59xW927CTCckExIv7uVhwHMeJxKZgrGAdmrfs5fgXlC7eJB+Tg+oE/CvPCMB0A28z5iwIqPdJ33L+6z+BCXSUwCn2p0PMEi4ALVQ4tY7/ae1H97ND6KAEB0V44RZR7RyBsAXMRW1eE1nJw17NWZNgC2oQdMcAKxzF15o7I5OXMBVgSfZnTI15hPpGXmoGqGk5uTmslsAPE0plIMsADcw/J87iTSReZl71Jpc2K6VmXNQWYA+5xlKb+LuphYTFKL/dEsJhYjg1FYkG50KC3XiyvYnfjAHWnFNF26U/XzGHUgFmX2E6DTY8TwyuDLVXKEuAsAzP3IxC2ppVx9GMq1T37TPjjgkXQKdcA+cT8AN+vow6udfQD6QqyUYnQLIQYI3WflZeI7vBSlxJuHI0WFOXXDwDmJOe4jKHxlKsWIEZXGp99dKS4AYJx/DnZcdL4c1CHiyj0ZgCwFtYt1US/v8pRHk88DiJfcO+kCarkeyDrLeLF41acbHcqogJz7r/JSngIwU3AR0ZzMJERJTckWo4uryAKY+fjRWBVixPCdLPFGofHMuQBgfYgldtAHED7snS0t6niCOiBr7y5e2+6dUb0wP/QnVCh3ffhiPkBsUvZwGIBJWIgSo+MjeSpQhmbu5iog8IYwFkB8kO/9cwAWeLOx83b3KgBRUm3EAXFLlBD1A6yUUqjwCJKfdeb250xJe8mMMtKI3NKcKW9quTktf21J/vVmM1KdmzuSP37DDDFWjqL22kfnvUvMcJPJ/TDf501Tb4ar8/PHfabWZHKXDIhxu7Fz8wbEnWlGGFt9NopV0vqCiWa4sXNEBF6DGZa7N77ru8YxIj2GEVaKYZC1lhOg84+auyjVNndt2SOlcd9hflzSVpbs5GA8gNWFJhStdIG1CA+PdwAY6U/GqmB09FGqdncXAcbt4RpKlRVzygxvg5ZN8d/j2gp7vKLt7UbuK/gvzlcze1GEgJbTxM1xyYE9YpG8ATVgC6TlT7kXgFtUc4KflDu7lxDjHmYpazOdeARuL68DmAuxEGlGh3idFt5M4s6Rt6LwlVZGbhd/Ju4qzNb+pruDXJllYgjF1fQBtbrdOwcrLQZCGAAbl0xsCxp8vOSdFDj5azYAIX6yXiwkNQgUOTR2bGUE5IruzTAEB49+AsAmg5W/HxyG4KLJ4eGUGh3xWQuZ7OdDPPwobjROvhVmGxACkGEoDgH9+AhcarDReHj5+ZXHUBG8QGBhxfBhoXzE1+zESgiTnZbAwgY0ISZ+JUrvjs5FPeIoYOJjGwsI0fFxongMsLBS4gJJNFLiWejo/qSPRkd85TH+G0t7NVLRFVeOAAAAAElFTkSuQmCC"></a></li>
                <li class="rdv"><a href="<?=DIR?>rdv-telephonique"><img alt="" src="data:image/png;base64,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"></a></li>

            </ul>

        </div>




    </div><!-- /.container-fluid -->
</nav>
<!---->


<!-- Slide Responsive -->
<?php if (SEG1 == '') { ?>

    <div style="display: none;" class="slider-mb fix-top">

        <div id="mobileCarousel" class="carousel slide carousel-fade">
        <!-- Indicators -->
<!--      <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>-->

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
			 <?   $home = \yii\easyii\modules\page\api\Page::get(31); 
            if(!empty($home->photos)) :  ?>
                <? foreach ($home->photos as $key => $value) : ?>
                    <? if($value->type == 'banner') : ?>
                    <div class="item item-<?=$key ?> <?=$key==0 ? 'active' : '' ?>">
                        <a class="fill"><img alt="" style="width: 100%;" src="<?=DIR?>timthumb.php?src=<?=$value->image?>&w=960&h=960&zc=1"></a>
                        <div class="carousel-caption">
                             <h2><?=str_replace('|', '<br>', preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', '$1', Markdown::process($value->model->caption)));?></h2>
                            <a href="<?= $value->description?>">En savoir plus</a>
                        </div>
                    </div>
                    <?  endif;?>
                <? endforeach; ?>
            <? endif;?>
            
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#mobileCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#mobileCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>  
    </div>   

<?php } ?>

<?php
 $js=<<<JS
$('.cs-select-mb.submit-mb').click(function(){
        var url = '/formules/itineraire';
        var des = '';
        $('.search-destination .list-option .active').each(function(index){
            des += $(this).data('value');
            if(index != $('.search-destination .list-option .active').length -1)
                des += '-';
        })
        if(!des) des = 'all';
        var type = $('.search-envies .list-option .active').data('value');
        if(!type) type= 'all';
        var pr = {'country': des, 'type': type};
        var url2 = $.param( pr );
        url = url + '?'+url2;
        window.location = url;
    })              
                  
     
JS;


$this->registerJs($js,  yii\web\View::POS_END);
?>
<!-- End Sldie Responsive-->
