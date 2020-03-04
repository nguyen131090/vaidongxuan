<div data-role="page" class="formules-page" id="comment-combien-page" data-url="comment-combien-page" data-theme="b">
    
    <div class="header" data-role="header">
        <a class="back-menu tt-fontsize-32 tt-latolatin-bold" href="<?=URI?>" data-rel="back" data-transition="fade" data-direction="reverse">Quand, Comment & Combien <img alt="" data-src="<?=DIR?>assets/img/mobile/icon_x_white_45_46.png" data-ajax='false'></a>
        <div class="menu-content-secret">
            <div class="menu-secret-slider menu-comment-combien-slider">
                <div class="swiper-wrapper">
                   <div class="swiper-slide active">
                        <span class="title tt-latolatin-semibold tt-fontsize-32" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_climat">Climat</span>
                    </div>
                    <div class="swiper-slide">
                        <span class="title tt-latolatin-semibold tt-fontsize-32" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_hebergement">Hébergement</span>
                    </div>
                    <div class="swiper-slide">
                        <span class="title tt-latolatin-semibold tt-fontsize-32" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_transport">Transport</span>
                    </div>
                    <div class="swiper-slide">
                        <span class="title tt-latolatin-semibold tt-fontsize-32" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_visa">Visa</span>
                    </div>
                    <div class="swiper-slide">
                        <span class="title tt-latolatin-semibold tt-fontsize-32" data-analytics="on" data-analytics-category="tour_page" data-analytics-action="how_section" data-analytics-label="subtab_tarif">Tarif</span>
                    </div>
                </div>
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </div><!-- /header -->

    <div role="main" class="ui-content">
        <? $j = 0;
            foreach ($infos_pratiques as $v) :
        ?>
        <div id="<?= $v->slug?>" class="item  item-<?= $j ?> <?= $j == 0 ? 'active' : ''?>">
           <? if($v->slug == 'tarif' || $v->slug =='climat' || $v->slug =='visa'){
                    $body = preg_replace('/<h3>/', '<div class="jour tab-children"><p class="tt-info first-jour"><span>', $v->model->description, 1);
                    $body = str_replace('<h3>', '</div></div><div class="jour tab-children no-switch"><p class="tt-info first-jour"><span>', $body);
                    $body = str_replace('</h3>', '</span></p><div class="entry-content">', $body);
                    echo $body . "</div></div>";
                }else{
                   
                    echo $v->model->description;
               }         
            ?>
        </div>    
        <?
        $j++;
         endforeach; ?>

    </div><!-- /content -->
</div><!-- /page -->

?>