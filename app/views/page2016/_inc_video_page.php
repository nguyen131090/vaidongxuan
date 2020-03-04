<?
use yii\helpers\Markdown;
use app\helpers\Text;
$this->registerCssFile(DIR . 'assets/css/page2016/inc_video_page.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
?>
 <? if(!empty($theEntry->data->video)) { ?>
<div class="contain video-container lazy-background mb-60">      
    <div class="amc-column d-block">
       
        <?= $theEntry->data->video ?>
       
<!--        <h2><strong>testets</strong> fsdf fsdfsfs fs</h2>
        <p style="text-align: center;">Chez l'habitant sur les bords du lac Ba Be au Vietnam</p>

        <p style="text-align: center;"><iframe align="middle" frameborder="0" height="340" scrolling="no" src="https://www.youtube.com/embed/KNXO5rqOL-0?enablejsapi=1&amp;rel=0" width="610" id="video-ytb-1" data-name="video-ytb" allowfullscreen="allowfullscreen"></iframe></p>
    -->
    </div>
</div>
<? } ?>