<?
use yii\helpers\Markdown;
use app\helpers\Text;
$this->registerCssFile(DIR . 'assets/css/mobile/inc_video_page.css', ['depends' => 'app\assets\AppAsset', 'position' => $this::POS_END]);
?>
 <? if(!empty($theEntry->data->video)) { ?>  
<?
    $data_analy = NULL;
    if(Yii::$app->controller->action->id == 'exclusivites-single'){
        $data_analy = 'data-analytics="on" data-analytics-category="secret_single" data-analytics-action="video_section" data-analytics-label="control_play"';
    }
    if(Yii::$app->controller->action->id == 'idees-de-voyage-single'){
        $data_analy = 'data-analytics="on" data-analytics-category="tour_page" data-analytics-action="video_section" data-analytics-label="control_play"';
    }
?>
<div class="video-container">
    <div class="column">
        
        <?= str_replace('<iframe ', '<iframe '.$data_analy, $theEntry->data->video); ?>

<!--        <h2><strong>testets</strong> fsdf fsdfsfs fs</h2>
        <p style="text-align: center;">Chez l'habitant sur les bords du lac Ba Be au Vietnam</p>

        <p style="text-align: center;"><iframe align="middle" frameborder="0" height="340" scrolling="no" src="https://www.youtube.com/embed/KNXO5rqOL-0?enablejsapi=1&amp;rel=0" width="610" id="video-ytb-1" data-name="video-ytb" allowfullscreen="allowfullscreen"></iframe></p>
    -->
    <span class="space space-80"></span>
    </div>     
</div>
<? } ?>