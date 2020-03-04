<?php

namespace app\models;

use yii\base\Model;

class DevisForm extends Model
{

	public $tourName = null;
	public $tourUrl = null;
        
        public $vouspartez;
        public $numberOfTravelers18;
	public $numberOfTravelers12;
	public $numberOfTravelers2;
	public $numberOfTravelers0;
        public $agesOfTravelers12;
        
        public $howTraveler;
        public $countriesToVisit = null;
        
        public $departureDate;
        public $deretourDate;
        
        public $tourLength;
        
        public $howTicket;
        public $ticketDetail;
        public $helpTicket;
        
        public $tourThemes;
        public $hotelTypes;
        
        public $hotelRoomDbl = '';
	public $hotelRoomTwn = '';
	public $hotelRoomTrp = '';
	public $hotelRoomSgl = '';
        
        public $message;
        public $desSites;
        public $extension = '';
        public $mealsIncluded = 'Non';
        public $de_liberte = '';
        public $des_devis = '';
        public $se_baseront = '';
        
        public $pourCeProjet;
        public $budget;
        public $budgetPlafond = 0;
        public $premierVoyage = 0;
        public $howMessage;
	public $howHobby;
	
        public $callback = 'Non';
        public $phone = '';
	public $callTime = '';
	public $callDate = '';
	
	public $prefix;
        public $lname;
	public $fname;
        public $fullName;
        public $email;
        public $confirm_email;
        
        public $code_postal;

        public $age = '';
        public $country;
        public $region = '';
        public $ville = '';
	public $city;
	
        public $telephone;
        public $reference;
        
        public $newsletter = '0';
    
	// question
	public $whyCountry;

	
	public $countryCallingCode = '';
	
        public $dialcodeCountry;


       
	public $verificationCode;
	//question
	
	public $job;
        
       
        
    
    public $multipays;
    public $duraTime;

    public function isderetourDateGreater($attribute, $params) {
           
           
            if( strtotime($this->deretourDate) < strtotime($this->departureDate) ) {
                $this->addError('deretourDate', 'Date de retour must be greater than Date d\'arrivée approximative .');
            }
        }
	public function rules() {
            
		return [
			['tourName, tourUrl, whyCountry, howTraveler, howMessage, howHobby, howTicket, job, ticketDetail, helpTicket, duraTime', 'safe'],
			['fullName, fname, lname, country, email,confirm_email ,phone, telephone, callTime, callDate, message', 'filter', 'filter'=>'trim'],
			['email , confirm_email', 'filter', 'filter'=>'strtolower'],
			[['email' , 'confirm_email'], 'email'],
			[[
'prefix', 
'fname', 
'lname', 
'fullName',
'email', 
'confirm_email',
'country', 
'city', 
//'departureDate', 
//'deretourDate',
'tourLength', 
'numberOfTravelers18',
'numberOfTravelers12', 
'numberOfTravelers2', 
'numberOfTravelers0', 
//'agesOfTravelers12',
//'message',

// 'hotelRoomDbl', 
// 'hotelRoomTwn', 
// 'hotelRoomTrp', 
// 'hotelRoomSgl', 
//'mealsIncluded', 
//'countriesToVisit',
'callback', 
// 'tourThemes',
'newsletter', 
//'verificationCode',
//'region',
//'ville',
//'vouspartez',
//'howTraveler',
//'telephone', 
'code_postal',                            
], 'required', 'message' => '{attribute} ne peut être vide.'],

[['vouspartez'],'required','message'=>'Ce champs ne peut pas être vide.'],                    
                    
//[['fname'],'required','message'=>'Merci d\'indiquer votre prénom'],
//[['lname'],'required','message'=>'Merci d\'indiquer votre nom de famille'],
//[['email'],'required','message'=>'Merci de nous donner votre adresse mail'],
[['departureDate'],'required','message'=>'Date d\'arrivée requise'],
//[['deretourDate'],'required','message'=>'Date de retour requise'],
[['countriesToVisit'],'required','message'=>'Destination(s) requise(s)'],
[['agesOfTravelers12'],'required','message'=>'Âge des participants requis'],
[['message'],'required','message'=> 'Merci de préciser votre projet de voyage'],
// [['message'], 'string', 'min' => 100, 'max' => 1000, 'tooShort' => 'Votre projet de voyage ne peut être vide et doit contenir entre 100 et 1000 caractères.'],                          
[['verificationCode'],'required','message'=>'Merci de remplir le code anti-spam'],
  
[['mealsIncluded', 'de_liberte', 'des_devis', 'se_baseront', 'hotelTypes'],'required', 'message' => 'Ce champs ne peut pas être vide.' ,'on'=>['devis_long']],                    
[['budget'],'required', 'message' => 'Votre budget ne peut pas être vide.' ,'on'=>['devis_long']],                    
                       
// [['howMessage'], 'string', 'min' => 100, 'max' => 1000, 'tooShort' => 'Merci d\'être plus précis en tapant au minimum 100 caractères'],  
// [['howHobby'], 'string', 'min' => 100, 'max' => 1000, 'tooShort' => 'Merci d\'être plus précis en tapant au minimum 100 caractères'],                    

                        ['deretourDate','isderetourDateGreater'],
                   
                       // ['deretourDate,departureDate','date','format'=>'dd/MM/yyyy'],
                        // ['deretourDate','compare','compareAttribute'=>'departureDate','operator'=>'>' , 'message'=>'{attribute} must be greater than "{compareValue}".'],
                        //['email','compare','compareAttribute'=>'confirm_email'],
			['callback', 'boolean', 'trueValue'=>'Oui', 'falseValue'=>'Non'],
						[['callTime', 'countryCallingCode'], 'required', 'when' => function ($model) {
                            return $model->callback == 'Oui';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:first-of-type input[type=radio]').is(':checked') == true;
                                }",'message' => '{attribute} ne peut pas être vide.'],
                                
                        [[ 'callDate'], 'required', 'when' => function ($model) {
                            return $model->callback == 'Oui';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:first-of-type input[type=radio]').is(':checked') == true;
                                }",'message' => 'Date de rendez-vous requise'],
                          
                        [['phone'], 'required', 'when' => function ($model) {
                            return $model->callback == 'Oui';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:first-of-type input[type=radio]').is(':checked') == true;
                                }",'message' => 'Votre numéro de téléphone ne peut être vide'],
                                
                        [['phone'], 'number', 'when' => function ($model) {
                            return $model->callback == 'Oui';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:first-of-type input[type=radio]').is(':checked') == true;
                                }",'message' => 'Votre numéro de téléphone doit être un nombre'],   
                        
                        [['phone'], 'string', 'min' => 8, 'when' => function ($model) {
                            return $model->callback == 'Oui';
                         }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:first-of-type input[type=radio]').is(':checked') == true;
                                }",'tooShort' => 'Votre numéro de téléphone est trop court'], 
                                
                        [['phone'], 'string', 'max' => 10, 'when' => function ($model) {
                            return $model->callback == 'Oui';
                         }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:first-of-type input[type=radio]').is(':checked') == true;
                                }",'tooLong' => 'Votre numéro de téléphone est trop long'],           
                                
                                
                                
                        [['telephone'], 'required', 'when' => function ($model) {
                            return $model->callback == 'Non';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:last-of-type input[type=radio]').is(':checked') == true;
                                }",'message' => 'Votre numéro de téléphone ne peut être vide'],           
                        
                        [['telephone'], 'number', 'when' => function ($model) {
                            return $model->callback == 'Non';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:last-of-type input[type=radio]').is(':checked') == true;
                                }",'message' => 'Votre numéro de téléphone doit être un nombre'],   
                        
                        [['telephone'], 'string', 'min' => 8, 'when' => function ($model) {
                            return $model->callback == 'Non';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:last-of-type input[type=radio]').is(':checked') == true;
                                }",'tooShort' => 'Votre numéro de téléphone est trop court'], 
                                
                        [['telephone'], 'string', 'max' => 10, 'when' => function ($model) {
                            return $model->callback == 'Non';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-callback label:last-of-type input[type=radio]').is(':checked') == true;
                                }",'tooLong' => 'Votre numéro de téléphone est trop long'],         
                                
                        //[['telephone'], 'number'],  
                        //[['telephone'], 'length', 'max' => 10],  
                      // [['telephone'], 'number'],
                       // [['telephone'], 'string', 'min' => 9 , 'tooShort' => 'Le numéro de téléphone est trop court'],        
                      //  [['telephone'], 'string', 'max' => 10,  'tooLong' => 'Le numéro de téléphone est trop long'],             
                                
                        [['multipays'], 'required', 'when' => function ($model) {
                            
                            return $model->countriesToVisit == 'Multi-pays';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-countriestovisit label:last-of-type input[type=radio]').is(':checked') == true;
                                }",'message' => 'Multi-pays requis'],   
                                
                        [['numberOfTravelers18'], 'number', 'integerOnly'=>true, 'min'=>1, 'when' => function ($model) {
                            
                            return $model->vouspartez == 'Entre amis';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-vouspartez label:nth-of-type(4) input[type=radio]').is(':checked') == true;
                                }",'tooSmall' => 'Nombre des participants requis'],
                        [['numberOfTravelers18'], 'number', 'integerOnly'=>true, 'min'=>1, 'when' => function ($model) {
                            
                            return $model->vouspartez == 'En famille';
                        }, 'whenClient' => "function (attribute, value) {
                                    return $('#devisform-vouspartez label:nth-of-type(3) input[type=radio]').is(':checked') == true;
                                }",'tooSmall' => 'Nombre des participants requis'],
                                
                                
                        
//                        [['numberOfTravelers18'], 'number', 'integerOnly'=>true, 'min'=>1, 'when' => function ($model) {
//                            
//                            return $model->vouspartez == 'En couple';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#devisform-vouspartez label:nth-of-type(2) input[type=radio]').is(':checked') == true;
//                                }",'tooSmall' => 'Nombre des participants requis'],        
                                
          //	[['callTime', 'callDate', 'countryCallingCode', 'phone'], 'required'],
			['newsletter', 'boolean'],
			['budget, countriesToVisit, tourThemes, hotelTypes, age, region, ville, hotelRoomDbl, hotelRoomTwn, hotelRoomTrp, hotelRoomSgl', 'safe'],
			[['tourLength'], 'number', 'integerOnly'=>true, 'min'=>1, 'tooSmall'=>'Durée requise'],
//			[['numberOfTravelers18'], 'number', 'integerOnly'=>true, 'min'=>1, 'tooSmall'=>'Nombre des participants requis'],   
                        [['age'], 'number', 'integerOnly'=>true],                         
			[['verificationCode'], 'captcha', 'captchaAction' => 'amica-fr/captcha'],
		];
	}
        
	public function attributeLabels()
	{
		return [
			'prefix'=>'Votre civilité',
			'fname'=>'Votre prénom',
			'lname'=>'Votre nom de famille',
			'email'=>'Votre adresse mail',
                        'confirm_email'=>'Confirmez votre adresse mail',
                        'age' => 'Année de naissance',
			'country'=>'Votre pays de résidence',
			'city'=>'Votre ville de résidence',
			'departureDate'=>'Date d\'arrivée approximative',
                        'deretourDate'=>'Date de retour',
			'tourLength'=>'Durée du voyage',
			'countriesToVisit'=>'Destination(s)',
			'agesOfTravelers12'=>'Age des voyageurs',
                        'numberOfTravelers18'=>'Adulte(s) (>18 ans)',
			'numberOfTravelers12'=>'Nombre de voyageurs + de 12 ans',
			'numberOfTravelers2'=>'Nombre de voyageurs - de 12 ans',
			'numberOfTravelers0'=>'Nombre de voyageurs - de 2 ans',
			'message'=>'Votre projet de voyage',
			'budget'=>'De quel budget approximatif disposez-vous par personne ?',
			'tourThemes'=>'Thématiques',
			'hotelTypes'=>'Quel(s) type(s) d’hébergement aimeriez-vous pour ce voyage ?',
			'hotelRoomDbl'=>'Nombre de chambres doubles',
			'hotelRoomTwn'=>'Nombre de chambres twin',
			'hotelRoomTrp'=>'Nombre de chambres pour 3 personnes',
			'hotelRoomSgl'=>'Nombre de chambres individuelle',
			'mealsIncluded'=>'A quel rythme souhaiteriez-vous voyager ?',
                        'de_liberte' => 'A quel degré de liberté souhaiteriez-vous voyager',
                        'des_devis' => 'Avez-vous réalisé des devis auprès d’autres agences ?',
                        'se_baseront' => 'Mes critères de décision se baseront sur...',
			'callback'=>'RDV téléphonique',
			'callTime'=>'Heure pour recevoir nos appels',
			'callDate'=>'Date pour recevoir nos appels',
			'countryCallingCode'=>'Indicatif de pays',
			'phone'=>'Votre numéro de téléphone',
                        'telephone'=>'Téléphone',
			'newsletter'=>'Inscription à la newsletter',
			'verificationCode'=>'Code anti-spam',
                        'region' => 'Département',
                        'ville' => 'Votre ville',
                        'fullName' => 'Votre nom complet',
                        'job' => 'Votre (vos) professions ?',
                        'vouspartez' => 'Vous partez',
                        'howTraveler' => 'La forme physique des participants',
                        'howMessage' => 'Votre dernier voyage long-courrier',
                        'howHobby' => 'Vos loisirs et passe-temps préférés',
                        'code_postal' => 'Code postal',
		];
	}

	public function beforeValidate()
	{
		if ($this->callback == 'Non') {
			$this->setAttributes([
				'callDate'=>'none',
				'callTime'=>'none',
				'countryCallingCode'=>'none',
				'phone'=>'none',
			]);
		}
		return true;
	}

	public function afterValidate()
	{
		if ($this->callback == 'Non') {
			$this->setAttributes([
				'callDate'=>'',
				'callTime'=>'',
				'countryCallingCode'=>'',
				'phone'=>'',
			]);
		}
		return true;
	}
	
	 public function scenarios()
    {
        return [
        'landing' => [
        'prefix',
        'fname',
        'lname',
        'email',
        'confirm_email',    
        'country',
        'city',
        'departureDate',
        'agesOfTravelers12',
         'numberOfTravelers18',   
        'numberOfTravelers12',
        'numberOfTravelers2',
        'numberOfTravelers0',
        'message',

        'callback',
        'callTime',
        'callDate',
        'countryCallingCode',
        'phone',
        'newsletter',
        'verificationCode'],
            
        'default'=>['tourName', 'tourUrl', 'prefix', 'fname', 'lname', 'email','confirm_email', 'country', 'city', 'departureDate','deretourDate', 'tourLength', 'countriesToVisit', 'multipays', 'numberOfTravelers18', 'agesOfTravelers12', 'numberOfTravelers12', 'numberOfTravelers2',
        'numberOfTravelers0',
        'message',
        'budget',
        'tourThemes',
        'hotelTypes',
        'hotelRoomDbl',
        'hotelRoomTwn',
        'hotelRoomTrp',
        'hotelRoomSgl',
        'mealsIncluded' ,
        'callback' ,
        'callTime',
        'callDate',
        'countryCallingCode',
        'phone',
        'newsletter',
        'verificationCode',

        'whyCountry',
        'howMessage',
        'howTraveler',
        'howHobby',
        'howTicket',
        'job',
        'region',
        'ville',  
        'fullName',   
        'ticketDetail',
        'helpTicket',
        'reference',  
        'age',
        'vouspartez',      
        'telephone',  
        'duraTime'   
	 ],
            
        'booking'=> [
             'prefix', 
            'fullName', 
            'email', 
            'country', 
            'departureDate', 
            'numberOfTravelers18', 
            'agesOfTravelers12', 
            'numberOfTravelers12', 
            'numberOfTravelers2',
           // 'countriesToVisit', 
            'tourLength', 
            'tourThemes',
            'numberOfTravelers0',
            'message',
            'extension',
            'budget',
            'budgetPlafond',   
           // 'hotelTypes',
          //  'hotelRoomDbl',
          //  'hotelRoomTwn',
          //  'hotelRoomTrp',
          //  'hotelRoomSgl',
         //   'mealsIncluded' ,
          //  'de_liberte',         
            'callback' ,
            'callTime',
            'callDate',
            'countryCallingCode',
            'phone',
            'newsletter',
            //'verificationCode',
           // 'whyCountry',
          //  'premierVoyage',     
           // 'howMessage',
            'howTraveler',
          //  'howHobby',
          //  'howTicket',
          //          'job',
         //   'ticketDetail',
         //   'helpTicket',
            'reference',      
         //   'age', 
            'vouspartez',      
            'telephone', 
          //  'desSites',   
          //  'deretourDate',
            'dialcodeCountry',
            'duraTime',
            'pourCeProjet',
             'code_postal',               
	 ],
        'devis_short'=> [
            'prefix', 
            'fullName', 
            'email', 
            'country', 
            'departureDate', 
            'numberOfTravelers18', 
            'agesOfTravelers12', 
            'numberOfTravelers12', 
            'numberOfTravelers2',
            'countriesToVisit', 
            'tourLength', 
            'tourThemes',
            'numberOfTravelers0',
            'message',
            'budget',
            'budgetPlafond',   
           // 'hotelTypes',
          //  'hotelRoomDbl',
          //  'hotelRoomTwn',
          //  'hotelRoomTrp',
          //  'hotelRoomSgl',
         //   'mealsIncluded' ,
          //  'de_liberte',         
            'callback' ,
            'callTime',
            'callDate',
            'countryCallingCode',
            'phone',
            'newsletter',
            //'verificationCode',
           // 'whyCountry',
          //  'premierVoyage',     
           // 'howMessage',
            'howTraveler',
          //  'howHobby',
          //  'howTicket',
          //          'job',
         //   'ticketDetail',
         //   'helpTicket',
            'reference',      
         //   'age', 
            'vouspartez',      
            'telephone', 
          //  'desSites',   
          //  'deretourDate',
            'dialcodeCountry',
            'duraTime',
            'pourCeProjet',
            'code_postal',        
	 ],
            
            
        'devis_long'=> [
          //  'prefix',
          //  'fname', 
          //  'lname', 
          //  'email', 
          //  'country',
         //   'region', 
          //  'ville',
           // 'departureDate',
           // 'numberOfTravelers18',
           // 'agesOfTravelers12',
           // 'numberOfTravelers12',
           // 'numberOfTravelers2',
          //  'countriesToVisit',
           // 'multipays', 
           // 'tourLength',
           // 'tourThemes',
           // 'numberOfTravelers0',
            'message',
            'des_devis',
            'se_baseront',
            'budget',
            'hotelTypes',
            'hotelRoomDbl',
            'hotelRoomTwn',
            'hotelRoomTrp',
            'hotelRoomSgl',
            'mealsIncluded' ,
            'de_liberte',         
          //  'callback' ,
           // 'callTime',
           // 'callDate',
           // 'countryCallingCode',
           // 'phone',
         //   'newsletter',
            //'verificationCode',
          //  'whyCountry',
            'premierVoyage',     
            'howMessage',
           // 'howTraveler',
            'howHobby',
           // 'howTicket',
          //          'job',
           // 'ticketDetail',
            'helpTicket',
          //  'reference',      
         //   'age', 
           // 'vouspartez',      
         //   'telephone', 
           // 'desSites',   
           // 'deretourDate',
         //   'dialcodeCountry',
            'duraTime',
           // 'pourCeProjet',
             'budgetPlafond',          
	 ],
            
            
             'devis'=> ['prefix', 'fname', 'lname', 'email', 'country', 'region', 'ville', 'departureDate', 'numberOfTravelers18', 'agesOfTravelers12', 'numberOfTravelers12', 'numberOfTravelers2','countriesToVisit', 'multipays', 'tourLength', 'tourThemes',
        'numberOfTravelers0',
        'message',
        'budget',
        'hotelTypes',
        'hotelRoomDbl',
        'hotelRoomTwn',
        'hotelRoomTrp',
        'hotelRoomSgl',
        'mealsIncluded' ,
        'de_liberte',         
        'callback' ,
        'callTime',
        'callDate',
        'countryCallingCode',
        'phone',
        'newsletter',
        //'verificationCode',
        'whyCountry',
        'premierVoyage',     
        'howMessage',
        'howTraveler',
        'howHobby',
        'howTicket',
		'job',
        'ticketDetail',
        'helpTicket',
        'reference',      
        'age', 
        'vouspartez',      
        'telephone', 
        'desSites',   
        'deretourDate',
        'dialcodeCountry',
        'duraTime',
        'pourCeProjet',
         'budgetPlafond',          
	 ],
            
            
        'contact_booking'=> [
            'prefix', 
            'fullName', 
            'email', 
            'country', 
            'departureDate', 
            'numberOfTravelers18', 
            'agesOfTravelers12', 
            'numberOfTravelers12', 
            'numberOfTravelers2',
           // 'countriesToVisit', 
            'tourLength', 
            'tourThemes',
            'numberOfTravelers0',
            'message',
            'budget',
            'budgetPlafond',   
           // 'hotelTypes',
          //  'hotelRoomDbl',
          //  'hotelRoomTwn',
          //  'hotelRoomTrp',
          //  'hotelRoomSgl',
         //   'mealsIncluded' ,
          //  'de_liberte',         
            'callback' ,
            'callTime',
            'callDate',
            'countryCallingCode',
            'phone',
            'newsletter',
            //'verificationCode',
           // 'whyCountry',
          //  'premierVoyage',     
           // 'howMessage',
            'howTraveler',
          //  'howHobby',
          //  'howTicket',
          //          'job',
         //   'ticketDetail',
         //   'helpTicket',
            'reference',      
         //   'age', 
            'vouspartez',      
            'telephone', 
          //  'desSites',   
          //  'deretourDate',
            'dialcodeCountry',
            'duraTime',
            'pourCeProjet',
             'code_postal',               
	 ],
            
        ];
    }
    
}
