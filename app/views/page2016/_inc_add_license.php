<?php if(isset($imageBanner->photosArray['banner'][0])){
        if($imageBanner->photosArray['banner'][0]->model->caption){
    ?>
            <div class="amc-caption-license">
                <span class="text-caption">
                    <?php 

                        echo $imageBanner->photosArray['banner'][0]->model->caption;
                       
                     ?>
                </span>
            </div>

<?php
$css=<<<TXT
.amc-caption-license {
    position: absolute;
    bottom: 20px;
    right: 20px;
    background: url(/assets/img/page2016/icon_mayanh_2.png) right center no-repeat;
    padding-right: 25px;
    background-size: 24px;
    min-height: 24px;
    z-index: 2;    
    cursor: pointer;    
}

.amc-caption-license .text-caption {
    font-size: 12.5px;
    background: white;
    padding: 3px 10px;
    border-radius: 5px;
    font-family: 'Lato-Regular', sans-serif;
    max-width: 277px;
    opacity: 0;
    display: none;
    margin-right: 10px;
    color: #606060;
    padding: 3px 13px;
    box-shadow: 1px 2px 10px #606060;
}
.amc-caption-license:hover .text-caption {
    transition: all 0.2s;
    opacity: 1;
    display: block;    
   // width: 277px;
}
@media (max-width: 1650px){
    .contain.container-1{
        z-index: unset;
    }
    .contain.row-content-1{
        z-index: unset;  
    }
}
TXT;
$this->registerCss($css);
?>

<?php } } ?>