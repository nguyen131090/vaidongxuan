<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0" />
        <title>Browser</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/assets/js/browser/browser.css">
        <link rel="stylesheet" href="/assets/js/browser/weather.css">
        <script src="/assets/js/browser/browser.js"></script>
    </head>
    <body>
<? $month = ['jan', 'fév', 'mar', 'avr', 'mai', 'jui', 'juil', 'aoû', 'sep', 'oct', 'nov', 'déc']; ?>
<? foreach ($widgets as $kw => $vw) : ?>
  <div>
  <h2 class="ml-5"><?=$vw->title?></h2>
  <div class="block-info-custom" data-block="<?=$vw->text_id?>">
    <?
      if(strpos($vw->code, '|') !== false) : 
         $line = explode('|', $vw->code);
         $code1 = explode(',', $line[0]);
         $code2 = explode(',', $line[1]);
         $tt = explode('|', $vw->sub_title);
      ?>
   <div class="weather-container row mx-0 mb-0" style="background: #efece2; <?=$vw->style; ?>">
     
        <div class="col-xs-12 col-lg-6 px-0">
            <div class="row-1">
            <div class="row-months row px-0 mx-0 mt-0 mb-10">
                <?
                $n = 0;
                 while ( $n <= 5) : ?>
                  <div class="col text-left px-0"><span><?=$month[$n] ?></span></div>
                <? $n++;
              endwhile; ?>
            </div>
            <p class="tt-widget mt-0 mb-10"><?=$tt[0] ?></p>

            <div class="row px-0  mx-0 mt-0 mb-10">
              <? foreach ($code1 as $kc => $vc) : ?>
                  <? if($kc < 6 ) :  ?>
                  <div class="col p-0">
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: <?=(int)$vc*33.333; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <? endif; ?>
              <? endforeach; ?>
            </div>
          </div>
          <p class="tt-widget mt-0 mb-10"><?=!empty($tt[1]) ? $tt[1] : '' ?></p>
          <div class="row row-2 px-0  mx-0">
          <? foreach ($code2 as $kc => $vc) : ?>
              <? if($kc < 6 ) :  ?>
              <div class="col p-0">
                <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: <?=(int)$vc*33.333; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <? endif; ?>
          <? endforeach; ?>
          </div>
        </div>

        <div class="col-xs-12 col-lg-6 px-0 mt-3 mt-lg-0">
            <div class="row-1">
            <div class="row-months row px-0 mx-0 text-left mt-0 mb-10">
                <?
                $n = 6;
                 while ( !empty($month[$n])) : ?>
                  <div class="col px-0"><span><?=$month[$n] ?></span></div>
                <? $n++;
              endwhile; ?>
            </div>
              <p class="tt-widget mt-0 mb-10 d-lg-none"><?=$tt[0] ?></p>
              <p class="tt-widget mt-0 mb-10 d-none d-lg-block">&nbsp</p>

            <div class="row px-0  mx-0 mt-0 mb-10">
              <? foreach ($code1 as $kc => $vc) : ?>
                  <? if($kc > 5 ) :  ?>
                  <div class="col p-0">
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: <?=(int)$vc*33.333; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <? endif; ?>
              <? endforeach; ?>
            </div>
          </div>
          <p class="tt-widget mt-0 mb-10 d-lg-none"><?=$tt[1] ?></p>
          <p class="tt-widget mt-0 mb-10 d-none d-lg-block">&nbsp</p>
          <div class="row row-2 px-0  mx-0">
          <? foreach ($code2 as $kc => $vc) : ?>
              <? if($kc > 5 ) :  ?>
              <div class="col p-0">
                <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: <?=(int)$vc*33.333; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <? endif; ?>
          <? endforeach; ?>
          </div>
        </div>
      </div>
      <? else:  ?>
        <?
         $line = $vw->code;
         $code1 = explode(',', $line);
         $tt = $vw->sub_title;
      ?>
      <div class="weather-container row mx-0 " style="<?=$vw->style; ?>">
        <div class="col-xs-12 col-lg-6 px-0">
            <div class="row-1">
            <div class="row-months row  mx-0 px-0 mt-0 mb-10">
                <?
                $n = 0;
                 while ( $n <= 5) : ?>
                  <div class="col text-left px-0"><span><?=$month[$n] ?></span></div>
                <? $n++;
              endwhile; ?>
            </div>
            <? if($tt) : ?>
              <p class="tt-widget  mt-0 mb-10"><?=$tt?></p>
            <? endif; ?>

            <div class="row px-0  mx-0 my-0">
              <? foreach ($code1 as $kc => $vc) : ?>
                  <? if($kc < 6 ) :  ?>
                  <div class="col p-0">
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: <?=(int)$vc*33.333; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <? endif; ?>
              <? endforeach; ?>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-lg-6 px-0 mt-3 mt-lg-0">
            <div class="row-1">
            <div class="row-months row px-0 mx-0 text-left  mt-0 mb-10">
                <?
                $n = 6;
                 while ( !empty($month[$n])) : ?>
                  <div class="col px-0"><span><?=$month[$n] ?></span></div>
                <? $n++;
              endwhile; ?>
            </div>
            <? if($tt) : ?>
              <p class="tt-widget  mt-0 mb-10 d-none d-lg-block">&nbsp</p>
            <? endif; ?>
            <div class="row px-0  mx-0  my-0">
              <? foreach ($code1 as $kc => $vc) : ?>
                  <? if($kc > 5 ) :  ?>
                  <div class="col p-0">
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: <?=(int)$vc*33.333; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <? endif; ?>
              <? endforeach; ?>
            </div>
          </div>
        </div>

      <? endif; ?>
    </div>
    </div>
</div>
<? endforeach; ?>
<div class="block-info-custom" data-block="2">
    <div class="weather-note d-flex">
        <p class="region-text d-inline-flex mb-0 col-auto" style="width: 2rem"></p>
        <div class="col d-inline-flex flex-wrap">
        <div class="weather-bar note-bar d-inline-flex align-items-center">
            <span>Très favorable</span>
            <div class="progress">
              <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
      </div>
      <div class="weather-bar note-bar d-inline-flex align-items-center">
        <span>Favorable</span>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: 66.66%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
  </div>
  <div class="weather-bar note-bar d-inline-flex align-items-center">
    <span>Peu favorable</span>
    <div class="progress">
      <div class="progress-bar bg-success" role="progressbar" style="width: 33.33%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
    </div>
</div>
</div>

</div>
        
    </body>
</html>
