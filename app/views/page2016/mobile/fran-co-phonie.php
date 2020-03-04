<?php $this->registerCssFile(DIR . 'assets/css/mobile/fran-co-phonie.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]) ?>
<div class="contain container-2">
    <div class="amc-column entry-body">
        <div class="amc-row amc-row-1">
            <div class="amc-col-left">
                
                <?= $theEntry->model->content ?>
            </div>
            <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][0]->image ?>">
           
<!--            <div class="amc-col-left">
                <h1>Amica Travel et la francophonie</h1>
                <p>
                    L’OIF (Organisation internationale de la Francophonie), estime qu’il y a, au Vietnam, au Laos et au Cambodge, près de 1 267 000 locuteurs francophones, soit à peine 1% de la population totale des trois pays. La langue française y décline depuis plusieurs décennies, notamment en raison de l’apprentissage de l’anglais en seconde langue.
                </p>
                <p>        
                    C’est dans ce contexte nécessitant d’agir, qu’Amica Travel en tant qu’opérateur économique francophone, souhaite participer aux efforts communs pour la promotion de la langue française dans cette région du monde. 
                </p>
            </div>
            <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/1.png">-->
        </div>
        <div class="amc-row amc-row-2">
            <p>
                <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][1]->image ?>">
                <br>
                <?= $theEntry->photosArray['custom'][1]->model->caption ?>
            </p>
<!--            <p>
                <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/2.jpg">
                <br>
                Lettre à l’encre noir sur le « oui » des autorités coloniales.
            </p>-->
            
        </div>
        <div class="amc-row amc-row-3">
            <?= $theEntry->data->block1 ?>
            
<!--            <h2>Amica Travel, créateur d’emplois francophones</h2>
            <p>
                Les fondateurs d’Amica Travel ont effectué leurs études en France et en sont tombés amoureux de laculture et surtout de la langue. De retour au Vietnam, ils décident de fonder Amica Travel en 2007. 
            </p>
            <p>
                Ainsi, depuis plus d’une décennie, l’agence concourt au maintien des liens historiques, culturels et affectifs entre la France et cette partie du monde. Soulignons également, que l’agence accueille une part importante de belges, suisses et canadiens francophones. Environ 40 à 50 000 francophones ont été accueillis depuis 10 ans. 
            </p>
            <p>
                Parmi les employés, nombreux sont des locaux francophones, on retrouve également quelquesviet-kieu (français d’origine vietnamienne de retour au pays) et des expatriés francophones. Ainsi, sur un effectif de 110 personnes, environ 70% sont francophones. L’ensemble forme une équipe harmonieuse, propice aux échanges culturels et des compétences. 
            </p>-->
        </div>
        <div class="amc-row amc-row-4">
            <div class="amc-col-left">
                <p>
                    <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][2]->image ?>">
                    <br>
                    <?= $theEntry->photosArray['custom'][2]->model->caption ?>
                </p>
<!--                <p>
                    <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/3.jpg">
                    <br>
                    Lettre à l’encre noir sur le « oui » des autorités coloniales.
                </p>-->
                
            </div>
            <div class="amc-col-right">
                <?= $theEntry->data->block2 ?>
<!--                <h2>Amica Travel soutient l’éducation du français</h2>
                <p>
                    Deux établissements d’enseignement avec des élèves en apprentissage du français, bénéficient de soutiens conventionnels et financiers de la part d’Amica Travel. Le Département de français de l’Université Nationale de Hanoï bénéficie par exemple, de l’attribution annuelle de 5 bourses, d'une valeur totale de 1000 euros par an. Cette récompense est destinée aux 5 meilleurs étudiants en deuxième année et dont le critère principal pour l’attribution de la bourse est leur note en français.
                </p><p>
                Dans ce même établissement, Amica s’engage également à accueillir des stagiaires, de courte ou de longue durée, avec des perspectives de recrutement. L’agence participe aussi aux forums d’orientation professionnelle et à l’élaboration des programmes du tourisme et de la langue française. Enfin, un prix est remis lors d’un concours annuel de jeunes guides francophones. 
                </p><p>
                Une convention similaire à l’Université Nationale de Hanoï est envisagée avec la Faculté de français de l’École normale supérieure de Hô-Chi-Minh-Ville.
                </p><p>
                Au lycée de Hai Duong, des élèves bénéficient de la venue de quelques voyageurs francophones, favorisant les échanges linguistiques et correspondant aux valeurs du tourisme responsable. 
                </p><p>
                Enfin, au sein des itinéraires de voyages, Amica aimerait renforcer les échanges culturels à travers le français lors des voyages d’immersion, proches des populations. 

                </p>-->
            </div>
        </div>
        <div class="amc-row amc-row-5">
            <div class="amc-col-left">
             <?= $theEntry->data->block3 ?>   
<!--                <h2>France Alumni Vietnam, un vivier de jeunes francophones</h2>
                <p>Amica fait partie des premiers partenaires de France Alumni Vietnam. Il s’agit d’une plateforme du réseau des anciens étudiants vietnamiens en France. Des activités sont régulièrement organisées en collaboration avec l’Ambassade de France au Vietnam, sous la forme de forums, tables rondes, tournois sportifs, concerts, défilés de mode et des galas. Dans ce programme diversifié, Amica ne manque pas d’y contribuer et d’y participer. 
                </p><p>
                Tout en valorisant leurs parcours, ce réseau d’échanges est déterminant pour maintenir ces étudiants au contact de leur pays d’études, afin de représenter la France au Vietnam. Plusieurs employés d’Amica sont membres de France Alumni. 

                </p>-->
            </div>
            <div class="amc-col-right">
                <p>
                    <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][3]->image ?>">
                    <br>
                    <?= $theEntry->photosArray['custom'][3]->model->caption ?>
                </p>
<!--                <p>
                    <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/4.jpg">
                    <br>
                    Lettre à l’encre noir sur le « oui » des autorités coloniales.
                </p>-->
               
            </div>
        </div>
        <div id="video" class="">
            <?= $theEntry->data->video ?> 
<!--            <h2 style="text-align: center;">Comment réserver votre voyage avec Amica Travel ?</h2>
            <p style="text-align: center;">En quelques clics, trouvez votre inspiration de voyage, décrivez-nous vos envies et attendez-vous d’être contacté depuis l’Indochine !</p>
            <p style="text-align: center;"><script type="text/javascript">(function(){window.pagespeed=window.pagespeed||{};var b=window.pagespeed;function c(){}c.prototype.a=function(){var a=document.getElementsByTagName("pagespeed_iframe");if(0<a.length){for(var a=a[0],f=document.createElement("iframe"),d=0,e=a.attributes,g=e.length;d<g;++d)f.setAttribute(e[d].name,e[d].value);a.parentNode.replaceChild(f,a)}};c.prototype.convertToIframe=c.prototype.a;b.b=function(){b.deferIframe=new c};b.deferIframeInit=b.b;})();
            pagespeed.deferIframeInit();</script><iframe frameborder="0" height="314" scrolling="no" data-src="https://www.youtube.com/embed/yb-77vSlyyw" width="560" id="video-ytb-1" data-name="video-ytb" allowfullscreen="allowfullscreen" src="https://www.youtube.com/embed/yb-77vSlyyw"></iframe></p>
        -->
        </div>
        <div class="amc-row amc-row-7">
            <div class="amc-col-left">
                <?= $theEntry->data->block4 ?> 
<!--                <h2>L’Ambassade de France au Vietnam, un organe francophone majeur</h2>
                <p>Organe diplomatique majeur des relations franco-vietnamiennes, Amica prend plaisir à participer et à promouvoir les nombreux événements culturels et environnementaux de l’Ambassade de France au Vietnam. Comme l’événement « Balades en France »qui s’est tenu en 2018, clôturant une année de célébration des 45 ans des relations bilatérales France-Vietnam. 
                </p><p>
                L’Ambassade de France au Vietnamsoutient nos actions en faveur de la francophonie, avec notamment le partage d’articles liés à l’histoire franco-vietnamienne provenant denos blogs de voyage. Enfin, de nombreux employés d’Amicaont l’honneur d’être invités à la traditionnelle fête du 14 Juillet, point d’orgue de célébration des relations franco-vietnamiennes ! 
                </p>-->
            </div>
            <div class="amc-col-right">
                <p>
                    <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][4]->image ?>">
                    <br>
                    <?= $theEntry->photosArray['custom'][4]->model->caption ?>
                </p>
<!--                <p>
                    <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/5.jpg">
                    <br>
                    Lettre à l’encre noir sur le « oui » des autorités coloniales.
                </p>-->
                
            </div>
        </div>
         <div class="amc-row amc-row-8">
            <div class="amc-col-left">
                <p>
                    <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][5]->image ?>">
                    
                </p>
                <p>
                    <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][6]->image ?>">
                    <br>
                    <?= $theEntry->photosArray['custom'][6]->model->caption ?>
                </p>
<!--                <p>
                    <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/6.jpg">
                </p>
                <p>
                    <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/7.jpg">
                    <br>
                    Lettre à l’encre noir sur le « oui » des autorités coloniales.
                </p>-->
               
            </div>
            <div class="amc-col-right">
                <p>
                    <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][7]->image ?>">
                    <br>
                    <?= $theEntry->photosArray['custom'][7]->model->caption ?>
                </p>
<!--                <p>
                    <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/8.jpg">
                    <br>
                    Lettre à l’encre noir sur le « oui » des autorités coloniales.
                </p>-->
               
            </div>
        </div>
        
        <div class="amc-row amc-row-9">
            <?= $theEntry->data->block5 ?> 
<!--            <h2>Amica Travel avance avec ses partenaires associatifs francophones</h2>
            <p>
                L’agence œuvre depuis une décennie dans la mise en place d’une politique de tourisme responsable. Nos voyageurs sont sollicités à voyager de manière proactive, responsable et participative. Au bout de chaque séjour, ce tourisme gagnant-gagnant, profite à de nombreuses personnes. 
            </p><p>
            Nos projets solidaires, intervenant le plus souvent dans des régions reculées, s’élaborent pour quelques-uns d’entre-eux, avec nos associations humanitaires partenaires : VITAM (Vietnam terre d’Amour), L’A.P.P.E.L – Lorient, Les Grains de Riz, Fleurs des Rizières, Un projet pour tous, Cœur &Act, Espoir Asie, Coup de Pouce Vietnam et la dernière en date, EPVN (Enfance Partenariat Vietnam). La collaboration est aussi culturelle, avec la participation aux événements de nos partenaires associatifs.  

            </p>-->
        </div>
        
        <div class="amc-row amc-row-10">
            <div class="amc-col-left">
                 <p>
                    <img alt="" class="lazyload" data-src="<?= $theEntry->photosArray['custom'][8]->image ?>">
                    <br>
                    <?= $theEntry->photosArray['custom'][8]->model->caption ?>
                </p>
<!--                <p>
                    <img alt="" class="lazyload" data-src="<?=DIR?>assets/img/francophonie/9.jpg">
                    <br>
                    Lettre à l’encre noir sur le « oui » des autorités coloniales.
                </p>-->
                
               
            </div>
            <div class="amc-col-right">
                <?= $theEntry->data->block6 ?> 
<!--                <h2>Amica Travel et la CCI France Vietnam </h2>
                <p>Amica Travel a co-organisé avec la CCIFV, deux tournois de foot en 2015 et 2017, qui ont permis de rassembler des acteurs de la vie francophone à Hanoï autour des valeurs du sport, de la francophonie, de la convivialité et surtout de la solidarité. En effet, les fonds récoltés étaient destinés à l’association Coup de Pouce Vietnam, qui aide une trentaine d’enfants défavorisés de Hanoï à continuer d’aller à l’école. 
                </p><p>
                La Chambre de Commerce et d'Industrie France-Vietnam est installée à Hanoï, elle a pour missions principales, d’animer la communauté d’affaires française au Vietnam, en favorisant l’échange entre les membres du réseau. La CCIFV apporte surtout son soutien aux sociétés françaises, dans leur projet de développement au Vietnam. 
                </p>-->
            </div>
        </div>
    </div>
</div>