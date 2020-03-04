 <!-- SUB Menu hover-->
            <div id="group-sub-mn" class="group-submenu">
               
                 <!--sub-mn-1-->
               <div id="sub-mn-1" class="mn-panel mn-panel-1">
                   <div class="clear-mn">
                    <div class="col col-left">
                        
                        <img alt="" class="img-responsive" src="<?= DIR?>assets/img/page2016/img-mn-panel-1.jpg">
                        <hr class="space-fix" />
                        <p class="tt tt-1">DES IMMANQUABLES AUX <br><span>PETITES MERVEILLES MÉCONNUES</span></p>
                        <hr style="height: 3px;" />
                        <p class="tt tt-2">Découvrez ici les plus beaux sites de l’ancienne Indochine et de la Birmanie</p>
                        <hr style="height: 29px;" class="space-fix" />
                        <a class="btn-link-come-back" href="<?=DIR?>destinations">VOIR TOUTES NOS DESTINATIONS</a>
                    </div>
                    <div class="col col-right">
                         
                        <ul class="desti-mn desti-mn-vietnam">
                            <li class="mn-country"><a href="<?=DIR?>vietnam">Vietnam</a></li>
                            <li class=""><a href="<?=DIR?>vietnam/itineraire">Idées de voyage</a></li>
                            <li class=""><a href="<?=DIR?>vietnam/formules">Formules</a></li>
                            <li class=""><a href="<?=DIR?>vietnam/visiter">Sites à visiter</a></li>
                            <li class=""><a href="<?=DIR?>vietnam/informations-pratiques">Infos pratiques</a></li>
                            <li class=""><a href="<?=DIR?>vietnam/guide">Guide culturel</a></li>
                        </ul>
                        <ul class="desti-mn desti-mn-cambodge">
                            <li class="mn-country"><a href="<?=DIR?>cambodge">Cambodge</a></li>
                            <li class=""><a href="<?=DIR?>cambodge/itineraire">Idées de voyage</a></li>
                            <li class=""><a href="<?=DIR?>cambodge/formules">Formules</a></li>
                            <li class=""><a href="<?=DIR?>cambodge/visiter">Sites à visiter</a></li>
                            <li class=""><a href="<?=DIR?>cambodge/informations-pratiques">Infos pratiques</a></li>
                            <li class=""><a href="<?=DIR?>cambodge/guide">Guide culturel</a></li>
                        </ul>
                        <ul class="desti-mn desti-mn-laos">
                            <li class="mn-country"><a href="<?=DIR?>laos">Laos</a></li>
                            <li class=""><a href="<?=DIR?>laos/itineraire">Idées de voyage</a></li>
                            <li class=""><a href="<?=DIR?>laos/formules">Formules</a></li>
                            <li class=""><a href="<?=DIR?>laos/visiter">Sites à visiter</a></li>
                            <li class=""><a href="<?=DIR?>laos/informations-pratiques">Infos pratiques</a></li>
                            <li class=""><a href="<?=DIR?>laos/guide">Guide culturel</a></li>
                        </ul> 
                        <ul class="desti-mn desti-mn-birmanie">
                            <li class="mn-country"><a href="<?=DIR?>birmanie">Birmanie</a></li>
                            <li class=""><a href="<?=DIR?>birmanie/itineraire">Idées de voyage</a></li>
                            <li class=""><a href="<?=DIR?>birmanie/visiter">Sites à visiter</a></li>
                            <li class=""><a href="<?=DIR?>birmanie/informations-pratiques">Infos pratiques</a></li>
                            <li class=""><a href="<?=DIR?>birmanie/guide">Guide culturel</a></li>
                        </ul>    
			
                       </div>
                    </div>   
                </div>    
                   
                <!--end-->
                <div id="sub-mn-2" class="mn-panel mn-panel-2">
                    <div class="clear-mn">
                     <div class="col col-left" style="">
                            
                            <img alt="" class="img-responsive" src="<?= DIR?>assets/img/page2016/img-mn-panel-2.jpg">
                            <hr style="height: 34px;" class="space-fix" />
                            <p class="tt tt-1">EXPÉRIENCE <span>ÉMOUVANTE GARANTIE</span></p>
                            <hr style="height: 23px;" class="space-fix" />
                            <p class="tt tt-2">Découvrez ici les étapes de “Nuits chez l’habitant” ou encore “Activités d’immersion”.</p>
                            <hr style="height: 28px;" class="space-fix" />
                            <a class="btn-link-come-back" href="<?=DIR?>formules/itineraire">VOIR TOUTES LES FORMULES</a>
                        </div>
                    <div class="col col-right">
                         <?php
                            $cnt = 0;
                           // var_dump($this->context->ideesMenu);exit;
                           
                            foreach ($this->context->excluMenu as $v) {
                                 $icon_img = NULL;
                                $cnt++;
                                foreach ($v->photos as $icon){
                                  // var_dump($icon->type);exit;
                                   if($icon->type == 'icon'){
                                      
                                       $icon_img = $icon->image;
                                   }
                               }
                               
                               if($cnt == 1){
                                   echo '<ul class="mn-1">';
                               } 
                               if($v->sub_title != ''){
                                       $sub_title = explode('-', $v->sub_title);
                                       $st_1 = '';
                                       $st_2 = '';
                                       if(isset($sub_title[0])){
                                           $st_1 = $sub_title[0];
                                       }
                                       if(isset($sub_title[1])){
                                           $st_2 = $sub_title[1];
                                       }
                                       $s_title = $st_1.'<br>'.$st_2;
                                   }else{
                                       $s_title = $v->sub_title;
                                   }
                        ?>
                        
                        
                        <li>
                            <a href="<?=DIR.$v->slug?>"><span class="icon" style="background-image: url(<?= isset($icon_img) ? $icon_img : '' ?>)"></span>
                                <span class="tt title-tt"><?= $v->title?></span>
                                <span class="tt sub-tt"><?= $s_title ?></span>
                            </a>
                        </li>
                        
                        <?php 
                               if($cnt == 3){
                                   echo '</ul><ul class="mn-2">';
                               } 
                               if($cnt == count($this->context->excluMenu)){
                                   echo '</ul>';
                               } 
                               } ?>

                        
                    </div>
                    </div>    
                </div>    
                
                <!-- sub-mn-3-->
                <div id="sub-mn-3" class="mn-panel mn-panel-3">
                    <div class="clear-mn">
                        <div class="col col-left" style="">
                            
                            <img alt="" class="" src="<?= DIR?>assets/img/page2016/img-mn-panel-3.jpg">
                            <hr class="space-fix" />
                            <p class="tt tt-1">BESOIN <span>D’INSPIRATION ?</span></p>
                            <hr style="height: 25px;" class="space-fix" />
                            <p class="tt tt-2">Trouver ici des idées de voyages que vous pourrez personnaliser à souhait.</p>
                            <hr class="space-fix" />
                            <a class="btn-link-come-back" href="<?=DIR?>voyage/itineraire">VOIR TOUS LES VOYAGES</a>
                        </div>

                        <div class="col col-right">


                            <?php
                                $cnt = 0;
                               // var_dump($this->context->ideesMenu);exit;

                                foreach ($this->context->ideesMenu as $v) {
                                     $icon_img = NULL;
                                    $cnt++;
                                    foreach ($v->photos as $icon){
                                       if($icon->type == 'icon'){
                                           $icon_img = $icon->image;
                                       }
                                   }
                                   if($cnt == 1){
                                       echo '<ul class="mn-1">';
                                   } 
                                   
                                   if($v->sub_title != ''){
                                       $sub_title = explode('-', $v->sub_title);
                                       $st_1 = '';
                                       $st_2 = '';
                                       if(isset($sub_title[0])){
                                           $st_1 = $sub_title[0];
                                       }
                                       if(isset($sub_title[1])){
                                           $st_2 = $sub_title[1];
                                       }
                                       $s_title = $st_1.'<br>'.$st_2;
                                   }else{
                                       $s_title = $v->sub_title;
                                   }
                                   
                            ?>


                                    <li>
                                        <a href="<?=DIR.$v->slug?>">
                                            <span class="icon" style="background-image: url(<?= $icon_img ?>)"></span>
                                            <span class="tt title-tt"><?= $v->title?></span>
                                            <span class="tt sub-tt"><?= $s_title ?></span>
                                        
                                        </a>
                                    
                                    </li>

                            <?php 
                                   if($cnt == 4){
                                       echo '</ul><ul class="mn-2">';
                                   } 
                                   if($cnt == count($this->context->ideesMenu)){
                                       echo '</ul>';
                                   } 
                                   } ?>

                        </div>
                    </div>    
                </div>    
                <!--end-->
                
                 
                
               
                
            </div>    
            <!--End sub menu-->
            