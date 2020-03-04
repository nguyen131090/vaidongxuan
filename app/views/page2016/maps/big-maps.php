<? $et = \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter'); ?>
<?php
$highlight = '';
?>
<? $ext = 'large';
if($this->context->action->id == 'maps')  $ext = 'full';?>
<!--    <div id="big-maps">-->
        <? if(!empty($et->photosArray['map'])) : 
            $map = $et->photosArray['map'][0];
            ?>
        <img alt="" src="<?=$map->image ?>">
        <? endif; ?>
        <?
        $list = [];
        $region = \app\modules\destinations\api\Catalog::cat(SEG1.'/visiter')->children(1);
        foreach ($region as $key => $value) {
            $listItem = $value->getItems()->all();
            $list = array_merge($list, $listItem);
        }
        
        foreach ($list as $key => $value) :?>
            <?
            $arr = explode('/', $value->slug);
            $class = end($arr);
            $left = $top = 0;
            if(isset($value->data->left)) $left = $value->data->left;
            if(isset($value->data->top)) $top = $value->data->top;
            ?>
            <?php
            if(SEG2 == $class) {
                $class .= ' active';
            } ?>
            <a style="left: <?=$left ?>px; top: <?=$top ?>px; <?=!$left && !$top ? 'display: none;' : ''; ?>" class="item-visiter <?=$class?>" href="<?=DIR.$value->slug ?>"><?=$value->summary_title ? $value->summary_title : $value->title; ?></a>
        <? endforeach; ?>
<!--    </div>-->



<?
//$css = <<<CSS
//#big-maps{
//	display: none;
//	position: relative;
//}
//body{
//	magrin: 0;
//	padding: 0;
//}
//#big-maps .item-visiter{
//	text-transform: uppercase;
//	color: #404041;
//	font: 10pt "LatoLatin-Regular",sans-serif;
//	position: absolute;
//	text-decoration: none;
//	top: 0;
//	left: 0;
//}
//#big-maps .item-visiter.active{
//    color: #e75925;
//    font-weight: bold;
//}
//
//.hanoi{
//	font-size: 12.5pt;
//	font-weight: bold;
//}
//.fancybox-inner{
//    width: 595px;
//    height: auto;
//    max-height: 850px !important;
//}
//
//.fancybox-wrap {
//    top: 34px !important;
//}
//
//#big-maps a:hover {
//    text-decoration: none;
//    color: #e1653f !important;
//}
//
//CSS;
//$this->registerCss($css);
?>

<style>
    #big-maps{
	
	position: relative;
}
body{
	magrin: 0;
	padding: 0;
}
#big-maps .item-visiter{
	text-transform: uppercase;
	color: #404041;
	font: 10pt "LatoLatin-Regular",sans-serif;
	position: absolute;
	text-decoration: none;
	top: 0;
	left: 0;
}
#big-maps .item-visiter.active{
    color: #e75925;
    font-weight: bold;
}

.hanoi{
	font-size: 12.5pt;
	font-weight: bold;
}
.fancybox-inner{
    width: 595px !important;
    height: auto !important;
    max-height: 850px !important;
}

.fancybox-wrap {
    top: 34px !important;
}

#big-maps a:hover {
    text-decoration: none;
    color: #e1653f !important;
}

</style>
<? if($this->context->action->id == 'maps') : ?>
    <style>
        #big-maps{
            position: relative;
        }
        body{
            margin: 0;
            padding: 0;
        }
        .item-visiter{
            text-transform: uppercase;
            color: #404041;
            font: 10pt "LatoLatin-Regular",sans-serif;
            position: absolute;
            text-decoration: none;
            top: 0;
            left: 0;
        }
        .hanoi{
            font-size: 12.5pt;
            font-weight: bold;
        }
    </style>
<? endif; ?>