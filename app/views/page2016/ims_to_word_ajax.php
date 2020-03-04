<?php

    header('Access-Control-Allow-Origin: http://voyager-au-laos.com', false);
//require_once '/var/www/__apps/www.amica-travel.com/helpers/phpdocx/classes/CreateDocx.inc';
require_once('D:/wamp/www/demo.amica-travel.com/helpers/phpdocx/classes/CreateDocx.inc');

$data = array(
    'file_name' => $_POST['file_name'],
    'template' => $_POST['template'],
    'img_banner_2' => $_POST['img_banner_2'],
    'devis_name' => $_POST['devis_name'],
    'devis_number' => $_POST['devis_number'],
    'devis_guest' => '<span style="font-family:Candara;color:white;font-size: 11pt;font-weight:bold;">'.$_POST['devis_guest'].'</span>',
    'devis_date' => '<span style="font-family:Candara;color:white;font-size: 10pt;font-weight:bold;">'.$_POST['devis_date'].'</span>',
	'devis_prix' => $_POST['devis_prix'],
    'devis_description' => $_POST['devis_description'],
    'sale_detail' => $_POST['sale_detail'],

    'devis_table_programe' => $_POST['devis_table_programe'],
    'devis_detail' => $_POST['devis_detail'],
    'tableau_devis' => $_POST['tableau_devis'],
    'devis_table_tarif' => $_POST['devis_table_tarif'],
    'devis_promotion' => $_POST['devis_promotion'],
    'devis_condition' => $_POST['devis_condition']
);
$color_text = 'white';
if($_POST['template']=='B2B-FR') {
	$data['devis_guest'] = '<p style="font-family:Candara;font-size: 11pt; color: black;"><b>Type du voyage:</b> en individuel</p><p style="font-family:Candara;font-size: 11pt; color: black;"><b>Devis personnalisé pour:</b> '.$_POST['devis_guest'].'</p>';
	$data['devis_date'] = '<p style="font-family:Candara;font-size: 11pt; color: black;"><b>Durée & Date du voyage:</b> '.$_POST['devis_date'].'</p>';
}
//if (!file_exists('/var/www/www.amica-travel.com/upload/ideas/tours/output/devis-ims')) {
//    mkdir('/var/www/www.amica-travel.com/upload/ideas/tours/output/devis-ims', 0777, true);
//}
if (!file_exists('D:/wamp/www/demo.amica-travel.com/upload/ideas/tours/output/devis-ims')) {
    mkdir('D:/wamp/www/demo.amica-travel.com/upload/ideas/tours/output/devis-ims', 0777, true);
}
//kiem tra va xoa file trong folder devis-ims
    $dir = 'D:/wamp/www/demo.amica-travel.com/upload/ideas/tours/output/devis-ims/';
        date_default_timezone_set("Asia/Ho_Chi_Minh");    
        $ngay = date("d");
        $gio = date('g');
        $phut = date("i");
        $giay = date("sa");
        $chuky = [01,11,21];
        foreach ($chuky as $t){
            if($ngay == $t){
                    foreach (glob($dir."*") as $file){
                         unlink($file);
                    }
            }
        }
//-----------        
$color = '#8A006C';
if(strpos('devis_base_02vietnam_immersion|devis_base_04laos_classique|devis_base_05laos_aventure|devis_base_06cambodge_classique|devis_base_07cambodge_aventure|devis_base_08cambodge_balneaire|devis_base_010_multipays_classique|devis_base_011_multipays_aventure|devis_base_13_thailande_classique',$data['template'])!==false){
	$color= '#FFFFFF';
}
$docx = new CreateDocx();
$setting = array(
    'zoom' => 100
);
$docx->enableCompatibilityMode();
//$docx->addTemplate('/var/www/__apps/www.amica-travel.com/helpers/template/devis/' . $data['template'] . '.docx');
$docx->addTemplate('D:/wamp/www/demo.amica-travel.com/helpers/template/devis/' . $data['template'] . '.docx');
$docx->replaceTemplateVariableByHTML('devis_name', 'block', "<span style='color: $color;font-weight: bold;font-size:22pt;margin:0; padding: 0;'>" .  $data['devis_name'] . "</span>");

$docx->replaceTemplateVariableByHTML('devis_number', 'block', "<span style='font-family:Candara; font-size: 14pt;font-weight:bold;color: $color;'>".$data['devis_number']."</span>");
$docx->replaceTemplateVariableByHTML('devis_guest', 'block', $data['devis_guest']);
$docx->replaceTemplateVariableByHTML('devis_date', 'block', $data['devis_date']);
$docx->replaceTemplateVariableByHTML('devis_prix', 'block', $data['devis_prix']);
$docx->replaceTemplateVariableByHTML('devis_description', 'block', $data['devis_description']);
$docx->replaceTemplateVariableByHTML('sale_detail', 'block', $data['sale_detail']);

if($data['img_banner_2']!='no'){
$docx->addTemplateImage('image-2','D:/wamp/www/demo.amica-travel.com/helpers/banner_2_devis/'.$data['img_banner_2'].'.jpg');
}
$docx->replaceTemplateVariableByHTML('devis_table_tarif', 'block', $data['devis_table_tarif']);
$docx->replaceTemplateVariableByHTML('devis_promotion', 'block', $data['devis_promotion']);
$docx->replaceTemplateVariableByHTML('devis_condition', 'block', $data['devis_condition']); 
$docx->replaceTemplateVariableByHTML('devis_table_programe', 'block', $data['devis_table_programe']);
$docx->replaceTemplateVariableByHTML('devis_detail', 'block', $data['devis_detail']);
$docx->replaceTemplateVariableByHTML('table_demo', 'block', $data['tableau_devis']);
//$docx->replaceTemplateVariableByHTML('devis_detail', 'block', $data['devis_detail'],array('isFile'=>FALSE,'strictWordStyles'=>true,'wordStyles'=>array('<em>'=>'Dark List Accent 4 PHPDOCX')));


//$docx->addText('In this first example we just add an image with a dashed border:');
//$options = array(
//'name' => 'D:/wamp/www/demo.amica-travel.com/helpers/banner_2_devis/banner2_2_hoian.jpg',
//'imageAlign' => 'center',
//'scaling' => 50,
//'spacingTop' => 10,
//'spacingBottom' => 0,
//'spacingLeft' => 0,
//'spacingRight' => 20,
//'textWrap' => 3,
//'borderStyle' => 'lgDash',
//'borderWidth' => 6,
//'borderColor' => 'FF0000',
//);
//$docx->addImage($options);
//$docx->addText('This is a closing paragraph.');


//$docx->setBackgroundColor('red');
  //$docx->addBackgroundImage('D:/wamp/www/demo.amica-travel.com/helpers/banner_2_devis/banner2_2_hoian.jpg');  
//$docx->createDocx('/var/www/www.amica-travel.com/upload/ideas/tours/output/devis-ims/' . $data['file_name']);

//$docx->addTemplateImage('image-2','D:/wamp/www/demo.amica-travel.com/helpers/banner_2_devis/banner2_2_hoian.jpg');




$docx->createDocx('D:/wamp/www/demo.amica-travel.com/upload/ideas/tours/output/devis-ims/' . $data['file_name']);
echo json_encode('success');
?>