<?php

namespace app\models;

use yii\base\Model;

class DevisFormMobile extends Model {

    public $has_date = 1;
    public $tourName = null;
    public $tourUrl = null;
    public $typeGo = null;
    public $interest = null;
    public $contactEmail = 1;
    public $contactPhone = 0;
    
    public $vouspartez;
    public $numberOfTravelers18;
    public $numberOfTravelers12;
    public $numberOfTravelers2;
    public $numberOfTravelers0;
    public $agesOfTravelers12;
    
    public $howTraveler;
    public $countriesToVisit = '';
    
    public $departureDate;
    public $deretourDate;
    
    public $tourLength;
    
    public $howTicket;
    public $ticketDetail;
    
    public $tourThemes;
    public $hotelTypes;
    
    public $hotelRoomDbl = '';
    public $hotelRoomTwn = '';
    public $hotelRoomTrp = '';
    public $hotelRoomSgl  = '';
    
    public $message;
    public $desSites;
    public $extension = '';
    public $mealsIncluded;
    public $de_liberte = '';
    public $des_devis = '';
    public $se_baseront = '';
    
    public $pourCeProjet;
    public $budget;
    public $budgetPlafond = 0;
    
    public $premierVoyage = 0;
    public $howMessage;
    public $howHobby;
    
    public $prefix;
    public $lname;
    public $fname;
    public $fullName = null;
    public $email;
    
    public $code_postal;
    
    public $age = '';
    public $country;
    public $region = '';
    public $ville = '';
    
    public $telephone;
    
    public $reference;
    public $newsletter = '0';
    
    
    
    
    public $phone='';
    
    public $countryCallingCode;
    
    public $verificationCode;
    public $verificationImgCode;
	
    // question
    public $whyCountry;
    
    public $job;
    public $lepetit;

    public $listFormules;
    public $multipays;
    
    
    public $dialcodeCountry;
    public $duraTime;

    public function rules() {
        return [
            [['tourName', 'tourUrl', 'tourThemes', 'verificationImgCode', 'prefix',  'budget','hotelRoomDbl','hotelRoomTwn','hotelRoomTrp','hotelRoomSgl', 'whyCountry', 'howTraveler', 'howMessage', 'howHobby', 'contactEmail', 'howTicket', 'job', 'lepetit', 'numberOfTravelers0', 'verificationCode', 'duraTime', 'region', 'age', 'ville'], 'safe'],
            [['countriesToVisit'],'required', 'message'=>'Destination(s) requise(s)'],
           // [['tourThemes'],'required','on'=>['devis_mobile', 'mobileBooking', 'mobile_contact_booking']],
            [['email'], 'filter', 'filter' => 'strtolower'],
            [['email'], 'email'],
            [['prefix', 'fullName', 'email','numberOfTravelers18', 'lname', 'fname', 'telephone', 'code_postal'], 'required', 'message' => '{attribute} ne peut être vide.'],
            [['vouspartez'],'required','message'=>'Ce champs ne peut pas être vide.'],  
            [['departureDate'],'required','message'=>'Date d\'arrivée requise'],
            [['agesOfTravelers12'],'required','message'=>'Âge des participants requis'],
            [['tourLength'], 'number', 'integerOnly'=>true, 'min'=>1, 'tooSmall'=>'Durée requise'],
            [['message'],'required','message'=>'Merci de préciser votre projet de voyage.'],
            
            [['mealsIncluded', 'de_liberte', 'des_devis', 'se_baseront', 'hotelTypes'],'required', 'message' => 'Ce champs ne peut pas être vide.', 'on'=>['devis_long_mobile']],
            [['budget'],'required', 'message' => 'Votre budget ne peut pas être vide.' ,'on'=>['devis_long_mobile']],     
            
            // [['message'], 'string', 'min' => 100, 'max' => 1000, 'tooShort' => 'Votre projet de voyage ne peut être vide et doit contenir entre 100 et 1000 caractères.'],    
            [['phone'], 'required', 'when' => function ($model) {
            return $model->contactPhone == 1;
        }, 'whenClient' => "function (attribute, value) {
                    return $('#devisformmobile-contactphone').is(':checked') == true;
                }", 'on' => ['mobileTour', 'devis_mobile']],
             
            [['telephone'], 'number'],
            [['telephone'], 'string', 'min' => 8 , 'tooShort' => 'Le numéro de téléphone est trop court'],        
            [['telephone'], 'string', 'max' => 10,  'tooLong' => 'Le numéro de téléphone est trop long'], 
                
            // [['howMessage'], 'string', 'min' => 100, 'max' => 1000, 'tooShort' => 'Merci d\'être plus précis en tapant au minimum 100 caractères'],  
            // [['howHobby'], 'string', 'min' => 100, 'max' => 1000, 'tooShort' => 'Merci d\'être plus précis en tapant au minimum 100 caractères'],     
                
                
//            [['multipays'], 'required', 'when' => function ($model) {
//                            
//                            return $model->countriesToVisit == 'Multi-pays';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#devisformmobile-countriestovisit .ui-radio:last-of-type input[type=radio]').is(':checked') == true;
//                                }",'message' => 'Multi-pays requis'],     
                                
            [['numberOfTravelers18'], 'number', 'integerOnly'=>true, 'min'=>1, 'when' => function ($model) {
                            
                return $model->vouspartez == 'Entre amis';
            }, 'whenClient' => "function (attribute, value) {
                        return $('#devisformmobile-vouspartez .ui-radio:nth-of-type(4) input[type=radio]').is(':checked') == true;
                    }",'tooSmall' => 'Nombre des participants requis'],
            [['numberOfTravelers18'], 'number', 'integerOnly'=>true, 'min'=>1, 'when' => function ($model) {

                return $model->vouspartez == 'En famille';
            }, 'whenClient' => "function (attribute, value) {
                        return $('#devisformmobile-vouspartez .ui-radio:nth-of-type(3) input[type=radio]').is(':checked') == true;
                    }",'tooSmall' => 'Nombre des participants requis'],
//            [['numberOfTravelers18'], 'number', 'integerOnly'=>true, 'min'=>1, 'when' => function ($model) {
//
//                return $model->vouspartez == 'En couple';
//            }, 'whenClient' => "function (attribute, value) {
//                        return $('#devisformmobile-vouspartez .ui-radio:nth-of-type(2) input[type=radio]').is(':checked') == true;
//                    }",'tooSmall' => 'Nombre des participants requis'],                      
                
          //  ['numberOfTravelers18', 'number', 'integerOnly' => true, 'min' => 1],
            // ['verificationCode', 'captcha', 'captchaAction' => 'amica-fr/captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'prefix' => 'Votre civilité',
            'fname' => 'Votre prénom',
            'lname' => 'Votre nom',
            'email' => 'Votre adresse mail',
            'age' => 'Année de naissance',
            'departureDate' => 'Date d\'arrivée approximative',
            'tourLength' => 'Durée du voyage',
            'numberOfTravelers18'=>'Adulte(s) (>18 ans)',
            'numberOfTravelers12' => 'Nombre de voyageurs + de 12 ans',
            'numberOfTravelers2' => 'Nombre de voyageurs - de 12 ans',
            'message' => 'Votre message',
            'countriesToVisit' => 'Destination(s)',
            'tourThemes' => 'Thématiques',
            'phone' => 'Numéro de téléphone',
            'telephone' => 'Téléphone',
            'verificationCode' => 'Code anti-spam',
            'fullName' => 'Votre nom complet',
            'agesOfTravelers12' => "Détails d'âges",
            'budget' => 'Budget par personne',
            'hotelRoomDbl' => 'Nombre de chambres doubles',
            'hotelRoomTwn' => 'Nombre de chambres twin',
            'hotelRoomTrp' => 'Nombre de chambres pour 3 personnes',
            'hotelRoomSgl' => 'Nombre de chambres individuelle',
            'region' => 'Département',
            'ville' => 'Votre ville',
            'vouspartez' => 'Votre partez...',
            'deretourDate' => 'Date de retour',
            'dialcodeCountry' => 'Dial code',
            'des_devis' => 'Avez-vous réalisé des devis auprès d’autres agences ?',
            'se_baseront' => 'Mes critères de décision se baseront sur...',
            'code_postal' => 'Code postal'
        ];
    }
        
    public function scenarios() {
        return [
            'mobileBooking' => ['typeGo', 'numberOfTravelers18', 'numberOfTravelers12', 'numberOfTravelers2', 'interest', 'phone', 'email', 'age', 'message', 'extension', 'multipays', 'tourThemes', 'tourLength', 'contactPhone', 'departureDate', 'has_date', 'agesOfTravelers12','hotelRoomDbl', 'hotelRoomTwn','hotelRoomTrp','hotelRoomSgl','budget', 'budgetPlafond', 'whyCountry', 'howTraveler', 'contactEmail', 'job', 'lepetit', 'region', 'ville', 'numberOfTravelers0', 'reference','newsletter', 'vouspartez', 'fullName', 'telephone', 'prefix','country','dialcodeCountry', 'duraTime', 'pourCeProjet', 'code_postal'],
            'devis_mobile' => ['typeGo', 'numberOfTravelers18', 'numberOfTravelers12', 'numberOfTravelers2', 'interest', 'phone', 'email', 'age', 'message', 'countriesToVisit', 'multipays', 'tourThemes', 'tourLength', 'contactPhone', 'departureDate', 'has_date', 'agesOfTravelers12','hotelRoomDbl', 'hotelRoomTwn','hotelRoomTrp','hotelRoomSgl','budget', 'whyCountry', 'howTraveler', 'premierVoyage', 'howMessage', 'howHobby', 'contactEmail', 'howTicket', 'ticketDetail', 'job', 'lepetit', 'region', 'ville', 'numberOfTravelers0', 'reference','newsletter', 'vouspartez', 'hotelTypes', 'mealsIncluded', 'de_liberte', 'lname', 'fname', 'telephone', 'prefix','country','desSites','deretourDate','dialcodeCountry', 'duraTime', 'pourCeProjet', 'budgetPlafond'],
            'devis_short_mobile' => ['typeGo', 'numberOfTravelers18', 'numberOfTravelers12', 'numberOfTravelers2', 'interest', 'phone', 'email', 'age', 'message', 'countriesToVisit', 'multipays', 'tourThemes', 'tourLength', 'contactPhone', 'departureDate', 'has_date', 'agesOfTravelers12','hotelRoomDbl', 'hotelRoomTwn','hotelRoomTrp','hotelRoomSgl','budget', 'budgetPlafond', 'whyCountry', 'howTraveler', 'contactEmail', 'job', 'lepetit', 'region', 'ville', 'numberOfTravelers0', 'reference','newsletter', 'vouspartez', 'fullName', 'telephone', 'prefix','country','dialcodeCountry', 'duraTime', 'pourCeProjet', 'code_postal'],
            'devis_long_mobile' => ['message','budget', 'premierVoyage', 'howMessage', 'howHobby', 'hotelTypes', 'mealsIncluded', 'de_liberte', 'duraTime', 'budgetPlafond', 'des_devis', 'se_baseront'],
            
            'landing' => ['numberOfTravelers12', 'numberOfTravelers2', 'phone', 'fullName', 'email', 'age', 'message', 'verificationCode', 'contactPhone', 'departureDate', 'agesOfTravelers12'],
            'mobile_contact_booking' => ['typeGo', 'numberOfTravelers18', 'numberOfTravelers12', 'numberOfTravelers2', 'interest', 'phone', 'email', 'age', 'message', 'multipays', 'tourThemes', 'tourLength', 'contactPhone', 'departureDate', 'has_date', 'agesOfTravelers12','hotelRoomDbl', 'hotelRoomTwn','hotelRoomTrp','hotelRoomSgl','budget', 'budgetPlafond', 'whyCountry', 'howTraveler', 'contactEmail', 'job', 'lepetit', 'region', 'ville', 'numberOfTravelers0', 'reference','newsletter', 'vouspartez', 'fullName', 'telephone', 'prefix','country','dialcodeCountry', 'duraTime', 'pourCeProjet', 'code_postal'],
            
            ];
    }

}
