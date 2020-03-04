<!-- Start of second page -->
<div data-role="page" class="menu-page" id="search-page" data-theme="b">

	<div data-role="header">
		<nav style="" class="navbar navbar-default navbar-fixed-top">

			<div class="container-fluid">

				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<ul class="btn-header">
						<li class="search"><a class="btn-search" href="javascript:void(0);" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">Search</a></li>
						<li class="logo"><a class="" href="<?=DIR?>"><img alt="Amica Travel" data-src="<?= DIR ?>assets/img/mobile/logo_amica_149_59.png"></a></li>
						<li class="navigation"> 
						<a href="<?=DIR?>#page1" data-transition="slide" data-direction="reverse" class="btn-hum btn-hum-active" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								humberger
							</a>
						</li>
					</ul>

				</div>
			</div><!-- /.container-fluid -->
		</nav>
	</div><!-- /header -->

	<div role="main" class="ui-content">
		<h3>Type de voyage</h3>
		<ul class="voyage">
			<? foreach ($type = \app\modules\programmes\models\Category::find()->roots()->all() as $key => $value) : ?>
                            <li data-option="" data-value="<?=$value->category_id ?>"><?=$value->title ?></li>
                            <? endforeach; ?>
		</ul>
		<div class="clearfix"></div>
		<h3>Durée</h3>
		<ul class="tour-length">
                                    <? foreach (Yii::$app->params['tsDurationListNew'] as $key => $value) : ?>
                                       <li data-option="" data-value="<?=$key?>"><?=$value ?></li>
                                    <? endforeach; ?>
                                     
                                </ul> 
        <div class="clearfix"></div>
        <div class="cs-select submit">34 VOYAGES </div>                  
	</div><!-- /content -->

	<div data-role="footer" class="menu-footer">
		<h4><img alt="" data-src="<?=DIR?>assets/img/mobile/icon_info_86_35.png"/>info@amica-travel.com</h4>
	</div><!-- /footer -->
</div><!-- /page -->
