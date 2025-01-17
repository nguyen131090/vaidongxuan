<?php

$path = '/var/www/www.amica-travel.com/';

require_once $path . 'helpers/phpdocx/classes/CreateDocx.inc';
require_once $path . 'helpers/phpdocx/classes/DocxUtilities.inc';

$data = [
    'file_name' => $_POST['file_name'],
    'template' => $_POST['template'],

    'devis_intro' => $_POST['devis_intro'],
    'image_header' => $_POST['image_header'],
    'devis_name' => $_POST['devis_name'],
    'devis_guest' => $_POST['devis_guest'],
    'devis_description' => $_POST['devis_description'],

    'devis_table_programe' => $_POST['devis_table_programe'],
    'devis_detail' => $_POST['devis_detail'],
    'devis_table_tarif' => $_POST['devis_table_tarif'],
    'devis_condition' => $_POST['devis_condition'],
    'devis_others' => $_POST['devis_others']
];

$docx = new CreateDocx();
$setting = [
    'zoom' => 100
];
$docx->enableCompatibilityMode();
$docx->addTemplate($path . 'helpers/template/devis/' . $data['template'] . '.docx');

$docx->replaceTemplateVariableByHTML('devis_name', 'block', $data['devis_name']);
$docx->replaceTemplateVariableByHTML('devis_guest', 'block', $data['devis_guest']);
$docx->replaceTemplateVariableByHTML('devis_description', 'block', $data['devis_description']);
$docx->replaceTemplateVariableByHTML('devis_intro', 'block', $data['devis_intro']);
$docx->replaceTemplateVariableByHTML('devis_table_tarif', 'block', $data['devis_table_tarif']);
$docx->replaceTemplateVariableByHTML('devis_condition', 'block', $data['devis_condition']);
$docx->replaceTemplateVariableByHTML('devis_others', 'block', $data['devis_others']); 
$docx->replaceTemplateVariableByHTML('devis_table_programe', 'block', $data['devis_table_programe']);
$docx->replaceTemplateVariableByHTML('devis_detail', 'block', $data['devis_detail']);

$docx->addTemplateImage('image_header', $path . 'upload/banner_2_devis/b2b/banner_new/'.$data['image_header']);

$docx->createDocx($path . 'upload/output/devis-ims/' . $data['file_name']);

echo json_encode('success');
