 <!-- SUB Menu hover-->
            <div id="group-sub-mn" class="group-submenu">
               
                
                
                <!-- sub-mn-1-->
                <div id="sub-mn-1" class="mn-panel mn-panel-1">
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
            