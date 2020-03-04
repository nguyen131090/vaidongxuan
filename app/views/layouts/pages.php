<!-- Start of second page  -->
<div data-role="page" class="menu-page" id="page2" data-theme="b">

	<div data-role="header">
            <nav style="" class="navbar navbar-default navbar-fixed-top">

                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="btn-header">
                            <li class="navigation"> 
                                <a href="<?=DIR ?>#page1" data-transition="slide" data-direction="reverse" class="btn-hum" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="icon_close">
                                    <span></span>
                                </a>
                            </li>
                            <li class="logo"><a data-ajax="false" class="" href="<?=DIR?>"><img alt="Amica Travel" data-src="<?= DIR ?>assets/img/mobile/logo-amica.png" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica"></a></li>
                            
                        </ul>

                    </div>
                </div><!-- /.container-fluid -->
            </nav>
	</div><!-- /header -->
	<div role="main" class="ui-content">
		<ul>
			<li data-page="#menu-destinations" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_list_dest"><a href="<?=DIR?>#menu-destinations"  data-transition="slide">Nos destinations</a></li>
                        <li data-page="#menu-secret" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_list_secrets"><a href="<?=DIR?>#menu-secret" data-transition="slide">Formules d'Amica</a></li>
			<li data-page="#menu-voyage" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_list_voyage"><a href="<?=DIR?>#menu-voyage" data-transition="slide">Idées de voyage</a></li>
			<li><a href="<?=DIR?>a-propos-de-nous" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_qui">Qui sommes-nous</a></li>
		</ul>
	</div><!-- /content -->

	<div data-role="footer" class="menu-footer">
		
	</div><!-- /footer -->
</div><!-- /page -->

<!-- Start of second page -->
<div data-role="page" class="menu-page menu-page-sub" id="menu-destinations" data-theme="b">

	<div data-role="header">
            <nav style="" class="navbar navbar-default navbar-fixed-top">

                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="btn-header">
                            <li class="navigation"> 
                                <a href="<?=DIR ?>#page1" data-transition="slide"  class="btn-hum">
                                    <span></span>
                                </a>
                            </li>
                            <li class="logo"><a data-ajax="false"  class="" href="<?=DIR?>"><img alt="Amica Travel" data-src="<?= DIR ?>assets/img/mobile/logo-amica.png" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica"></a></li>
                            
                        </ul>

                    </div>
                </div><!-- /.container-fluid -->
            </nav>
            <a class="back-menu" href="<?=DIR?>#page2" data-transition="slide" data-direction="reverse" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_back"><img data-src="<?=DIR?>assets/img/mobile/arrow-white-back-28-49.png"> Retour</a>
	</div><!-- /header -->
	
	<div role="main" class="ui-content">
		<span data-ajax="false"  class="main-link">nos destinations</span>
		<ul>
	        <?
	            $cnt = 0;
                    
	            foreach ($this->context->destiMenu as $v) {
	                
	                if($v->depth == 0){
                             $cnt++;
                            
	                   
	        ?>
	                <li><a rel="external" data-ajax="false" href="<?= DIR.$v->slug?>" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_<?= $v->slug ?>"><?= $v->title?></a></li>
	            <? } }?>
		</ul>
	</div><!-- /content -->
</div><!-- /page -->

<!-- Start of second page -->
<div data-role="page" class="menu-page menu-page-sub" id="menu-secret" data-theme="b">

	<div data-role="header">
            <nav style="" class="navbar navbar-default navbar-fixed-top">

                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="btn-header">
                            <li class="navigation"> 
                                <a href="<?=DIR ?>#page1" data-transition="slide"  class="btn-hum">
                                    <span></span>
                                </a>
                            </li>
                            <li class="logo"><a  data-ajax="false" class="" href="<?=DIR?>"><img alt="Amica Travel" data-src="<?= DIR ?>assets/img/mobile/logo-amica.png" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica"></a></li>
                            
                        </ul>

                    </div>
                </div><!-- /.container-fluid -->
            </nav>
            <a class="back-menu" href="<?=DIR?>#page2" data-transition="slide" data-direction="reverse" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_back"><img data-src="<?=DIR?>assets/img/mobile/arrow-white-back-28-49.png"> Retour</a>
	</div><!-- /header -->
	
	<div role="main" class="ui-content">
		<a href="/formules" data-ajax="false"  class="main-link" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_formules">Formules d'Amica</a>
		<ul>
			<?php
                foreach ($this->context->excluMenu as $v) {
            ?>
                <li><a rel="external" data-ajax="false"  href="<?=DIR.$v->slug?>" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_formule_<?= $v->category_id ?>"><?= $v->title?></a></li>
            <?php  } ?>
		</ul>
	</div><!-- /content -->
</div><!-- /page -->

<!-- Start of second page -->
<div data-role="page" class="menu-page menu-page-sub" id="menu-voyage" data-theme="b">
	<div data-role="header">
            <nav style="" class="navbar navbar-default navbar-fixed-top">

                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="btn-header">
                            <li class="navigation"> 
                                <a href="<?=DIR ?>#page1" data-transition="slide"  class="btn-hum">
                                    <span></span>
                                </a>
                            </li>
                            <li class="logo"><a  data-ajax="false" class="" href="<?=DIR?>"><img alt="Amica Travel" data-src="<?= DIR ?>assets/img/mobile/logo-amica.png" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica"></a></li>
                            
                        </ul>

                    </div>
                </div><!-- /.container-fluid -->
            </nav>
            <a class="back-menu" href="<?=DIR?>#page2" data-transition="slide" data-direction="reverse" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_back"><img data-src="<?=DIR?>assets/img/mobile/arrow-white-back-28-49.png"> Retour</a>
	</div><!-- /header -->
	
	<div role="main" class="ui-content">
		<a href="/voyage" data-ajax="false"  class="main-link" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_voyage">IDÉES DE VOYAGE </a>
		<ul>
			<?php
                foreach ($this->context->ideesMenu as $v) {
            ?>
                <li><a rel="external" data-ajax="false" href="<?=DIR.$v->slug?>" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_voyage_<?= $v->category_id ?>"><?= $v->title?></a></li>
            <?php  } ?>
			
		</ul>
	</div><!-- /content -->
</div><!-- /page -->

<!-- Start of second page -->
<div data-role="page" class="menu-page menu-page-sub" id="menu-about-us" data-theme="b">

	<div data-role="header">
            <nav style="" class="navbar navbar-default navbar-fixed-top">

                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <ul class="btn-header">
                            <li class="navigation"> 
                                <a href="<?=DIR ?>#page1" data-transition="slide"  class="btn-hum">
                                    <span></span>
                                </a>
                            </li>
                            <li class="logo"><a  data-ajax="false" class="" href="<?=DIR?>"><img alt="Amica Travel" data-src="<?= DIR ?>assets/img/mobile/logo-amica.png" data-analytics="on" data-analytics-category="header" data-analytics-action="header_section" data-analytics-label="logo_amica"></a></li>
                            
                        </ul>

                    </div>
                </div><!-- /.container-fluid -->
            </nav>
            <a class="back-menu" href="<?=DIR?>#page2" data-transition="slide" data-direction="reverse" data-analytics="on" data-analytics-category="header" data-analytics-action="menu_section" data-analytics-label="link_back"><img data-src="<?=DIR?>assets/img/mobile/arrow-white-back-28-49.png"> Retour</a>
	</div><!-- /header -->
	
	<div role="main" class="ui-content">
		<a href="/a-propos-de-nous" data-ajax="false"  class="main-link">QUI SOMMES-NOUS</a>
		<ul>
			<?php
			foreach ($this->context->aproMenu as $v) {
                if(empty($v->slug)) continue;
				?>
				<li><a rel="external" data-ajax="false" href="<?=DIR.$v->slug?>"><?= $v->title?></a></li>
				<?php  } ?>
			
		</ul>
	</div><!-- /content -->
</div><!-- /page -->

<!-- page for bureaux -->
<div data-role="page" id="bureaux" data-theme="a">
    <div data-role='header' class="title-popup">
        <a href="#page1" data-transition='fade'  data-rel="back"  class="ui-btn ui-btn-left" data-analytics="on" data-analytics-category="bottom" data-analytics-action="office_section" data-analytics-label="icon_close">
            
            <span>Nos bureaux</span>
            <img data-src="/assets/img/mobile/icon_x_white_45_46.png" class="btn-back-left">
        </a>
        
    </div>
    <div data-role="main" class="ui-content">
        <ul class="add-offices">
            <li class="active">
                <p class="title-row pugjd" data-title="<?= base64_encode(DIR.'nos-bureaux/hanoi-vietnam') ?>" data-analytics="on" data-analytics-category="bottom" data-analytics-action="office_section" data-analytics-label="link_hanoi">Hanoi</p>
                <div class="info-office">

                    <p> Building NIKKO, 2ème étage,
                        <span>27 Rue Nguyen Truong To, Ba Dinh</span>,
                        <span>Hanoi, Vietnam</span>
                    </p>
                    <p>
                        Tél : <span>(+84) 9 8456 6676</span>
                    </p>
                </div>
            </li>
            <li class="">
                <p class="title-row pugjd" data-title="<?= base64_encode(DIR.'nos-bureaux/ho-chi-minh-ville-vietnam') ?>" data-analytics="on" data-analytics-category="bottom" data-analytics-action="office_section" data-analytics-label="link_hcm">ho chi minh ville</p>
                <div class="info-office">

                    <p>Building Resco, 4ème étage,
                        <span>94-96 rue Nguyen Du, 1è Disctrict, </span>
                        <span>Ho Chi Minh Ville, Vietnam</span>
                    </p>
                    <p>
                        Tél : <span>(+84) 8 6685 4079</span>
                    </p>
                </div>
            </li>
            <li class="">
                <p class="title-row pugjd" data-title="<?= base64_encode(DIR.'nos-bureaux/siem-reap-cambodge') ?>" data-analytics="on" data-analytics-category="bottom" data-analytics-action="office_section" data-analytics-label="link_sp">Siem Reap</p>
                <div class="info-office">

                    <p>Borey Angkor Palace, Building B49 &amp; B50,
                        <span>Phum Kruos, Sangkat Svay Dangkum, </span>
                        <span>Siem Reap, Cambodge</span>
                    </p>
                    <p>
                        Tél : <span>(+85) 5 6396 6139</span>
                    </p>
                </div>
            </li>
            <li class="">
                <p class="title-row pugjd" data-title="<?= base64_encode(DIR.'nos-bureaux/luang-prabang-laos') ?>" data-analytics="on" data-analytics-category="bottom" data-analytics-action="office_section" data-analytics-label="link_lp">Luang Prabang</p>
                <div class="info-office">

                    <p>102/3 Kounxoau Road, Phoneheuang
                             <span>Village, Luang Prabang, 06000, </span>
                             <span>Laos</span>
                            </p>
                            <p>
                             Tél. <span>(+856) 71 21 22 18</span>
                             
                            </p>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- end popup bureaux  