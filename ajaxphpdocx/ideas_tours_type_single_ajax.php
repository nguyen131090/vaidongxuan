<head>
	<meta charset="utf-8">
</head>


<?php
function convertHtml($str){
	return str_replace(array('&lt;','&gt;'),array('<','>'), htmlentities($str, ENT_NOQUOTES,'UTF-8',false));
}
$basePath = dirname(__DIR__);
$points = '<div style="font: 9pt Lato Regular,sans-serif;">'.$_POST['data']['data']['points'].'</div>';
$spirit  = htmlentities($_POST['data']['model']['spirit'], ENT_COMPAT, 'UTF-8');
$find  = [
	'/<h2>(.+?)<\/h2>/i',
	'/<h4>(.+?)<\/h4>/i',
	'/<ul>/',
	'/<li>(.+?)<\/li>/i'
];
$replace = [
	'<h2 style="font: 18pt Lato Regular,sans-serif; color:rgb(201,61,33); margin: 24pt 0; text-transform: uppercase;">$1</h2>',
	 '<h4  style="font: bold 11pt Lato Regular,sans-serif; color:rgb(201,61,33);">$1</h4>',
	 '<ul style="color:rgb(201,61,33);">',
	 '<li  style="color:#000;">$1</li>'
];
$points =  preg_replace($find, $replace, str_replace('<hr />', '',$points));

$tourDays = '<table border="0" cellpadding="5" style="font: 9pt Lato Regular,sans-serif; border: none;">'.$_POST['tourDays'].'</table>';
$find  = [
	'/<h3 class="first-jour">(.+?)<\/h3>/i',
	'/<span class="fix-jour">(.+?)<\/span>/i',
	'/<span class="tt">(.+?)<\/span>/i',
];
$replace = [
	'<tr>$1</tr>',
	'<td width="100"><span style="font:bold 9pt Lato Regular,sans-serif; color:rgb(201,61,33); margin-right: 20pt; text-transform: uppercase;">$1</span></td>',
	'<td><span style="font:9pt Lato Regular,sans-serif; color:#000; margin-right: 20pt;">$1</span></td>'
];
$tourDays =  preg_replace($find, $replace, $tourDays);
// echo $tourDays;exit;

$description = '<div style="font: 9pt Lato Regular,sans-serif;">'.$_POST['tourContent'].'</div>';
$find  = [
	'/<span class="fix-jour">(.+?)<\/span>/i',
	'/<span class="tt">(.+?)<\/span>/i',
	"/<img[^>]+\>/i",
	'/<ul .*?class="(.*?note.*?)">(.*?)<\/ul>/'
];
$replace = [
	'<span style="font:bold 11pt Lato Regular,sans-serif; color:rgb(201,61,33); margin-right: 20pt;">$1</span>',
	'<span style="font:11pt Lato Regular,sans-serif; color:rgb(201,61,33); margin-right: 20pt;">$1</span>',
	'',
	''
];
$description =  preg_replace($find, $replace, $description);
// var_dump($description);exit;
require_once $basePath.'/helpers/phpdocx/classes/CreateDocx.inc';


	$docx = new CreateDocx();
	$setting = array(
    'zoom' => 100
    );
    $docx->enableCompatibilityMode();
	$docx->addTemplate($basePath.'/tour-output/template/'.$_POST['temName'].'.docx');
	// $docx->addTemplate('D:/wamp/www/demo.amica-travel.com/helpers/template/tours/' . $data['template'] . '.docx');
	$docx->replaceTemplateVariableByHTML('h1', 'block','<span style="font:bold 18pt Lato Regular, sans-serif; color: #fff; text-transform: uppercase;">'.convertHtml($_POST['data']['model']['title']).'</span>');
	$docx->replaceTemplateVariableByHTML('sub_title', 'block', '<span style="font: 12pt Lato Regular, sans-serif; color: #fff; ">'.convertHtml($_POST['data']['model']['sub_title']).'</span>');
	
	$docx->replaceTemplateVariableByHTML('dlt', 'block', '<span style="font: 10pt Lato Regular, sans-serif; color: rgb(201,61,33); ">'.convertHtml($_POST['days']).' | '.convertHtml($_POST['locations']).' | '.convertHtml($_POST['tour_type']).'</span>');
	$docx->replaceTemplateVariableByHTML('spirit', 'block', '<span style="font: 9pt Lato Regular, sans-serif; color: #000; ">'.convertHtml($spirit).'</span>');
	$docx->replaceTemplateVariableByHTML('points', 'block', convertHtml($points));
	$docx->replaceTemplateVariableByHTML('map', 'block', '<img src="'.$_POST['map'].'" width="500" />');
	$docx->replaceTemplateVariableByHTML('tourDays', 'block', convertHtml($tourDays));
	$docx->replaceTemplateVariableByHTML('description', 'block', convertHtml($description));
	
	$docx->createDocx($basePath.'/tour-output/'.$_POST['fileName']);
	// $docx->transformDocx('/var/www/www.amica-travel.com/upload/ideas/tours/output/'.$_POST['tem'].'/'.$name.'.docx','/var/www/www.amica-travel.com/upload/ideas/tours/output/'.$_POST['tem'].'/'.$name.'.pdf',null, array('debug'=>true));
	 
?>