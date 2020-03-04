<?php

namespace app\models;

use yii\base\Model;

class ContactForm extends Model {

    public $tz = 'Europe/France';
    public $tourName = null;
    public $tourUrl = null;
    public $fullName = null; //mobile
    public $receiveName;
    
    public $prefix;
    public $lname;
    public $fname;


    public $email;
    public $confirm_email;
    
    public $code_postal;
    
    public $age;
    
    public $period;
    
    public $subjet;
    
    public $country;
    public $region;
    public $ville;
    
    public $telephone;
    
    public $phone;
    public $callDate;
    public $callTime;
    
    public $message;
   
    public $countryCallingCode;
    
    public $verificationCode;
    public $verificationImgCode; //mobile
    
    public $question;
    
    public $reference;
    public $newsletter = '0';
    
    
    public $reCaptcha;
    
    public $dialcodeCountry;
    public $duraTime;

    public function rules() {
        return [
            [['tourName', 'tourUrl', 'verificationImgCode','question', 'newsletter', 'duraTime'], 'safe'],
            [['fname', 'lname', 'email', 'confirm_email', 'country', 'message', 'countryCallingCode', 'phone', 'telephone', 'callDate', 'callTime', 'receiveName','region','ville'], 'filter', 'filter' => 'trim'],
            [['country', 'email', 'confirm_email'], 'filter', 'filter' => 'strtolower'],
            [['prefix', 'country', 'confirm_email', 'fullName', 'countryCallingCode', 'email', 'lname', 'fname', 'phone', 'code_postal'], 'required','message' => '{attribute} ne peut être vide.'],


			 // [['fname'],'required','message'=>'Merci d\'indiquer votre prénom'],
           // [['lname'],'required','message'=>'Merci d\'indiquer votre nom de famille'],
           // [['email'],'required','message'=>'Merci de nous donner votre adresse mail'],
            //[['phone'],'required','message'=>'Votre numéro de téléphone ne peut être vide'],
            [['verificationCode'],'required','message'=>'Merci de remplir le code anti-spam'],
            [['period', 'message', 'callDate'], 'required'],

			[['message'], 'required', 'on' => ['contact', 'rdv', 'contactce', 'contactce_mobile', 'rdv_mobile'],'message'=>'Votre message ne peut être vide '],
            [['subjet'], 'required', 'on' => ['contact', 'rdv', 'contactce', 'contactce_mobile', 'rdv_mobile', 'newsletter', 'newsletter_mobile'],'message'=>'Sujet requis'],

            [['telephone'],'required','on'=>['contactce','contactce_mobile','send-wishlist','rdv_mobile','rdv','rdv-surparis'],'message'=>'{attribute} ne peut être vide.'],
            
             
            
//            [['email'], 'required', 'on'=>['contact'], 'when' => function ($model) {
//                            return $model->subjet != 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactform-subjet option:nth-of-type(2)').is(':selected') == false;
//                                }",'message' => '{attribute} ne peut être vide.'],
//            [['lname'], 'required', 'on'=>['contact'], 'when' => function ($model) {
//                            return $model->subjet != 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactform-subjet option:nth-of-type(2)').is(':selected') == false;
//                                }",'message' => '{attribute} ne peut être vide.'],
//            [['fname'], 'required', 'on'=>['contact'], 'when' => function ($model) {
//                            return $model->subjet != 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactform-subjet option:nth-of-type(2)').is(':selected') == false;
//                                }",'message' => '{attribute} ne peut être vide.'],                    
                                
            
//            [['region'], 'required', 'on'=>['contact'], 'when' => function ($model) {
//                            return $model->subjet == 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactform-subjet option:nth-of-type(2)').is(':selected') == true;
//                                }",'message' => 'Département requis'],
//            [['ville'], 'required', 'on'=>['contact'], 'when' => function ($model) {
//                            return $model->subjet == 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactform-subjet option:nth-of-type(2)').is(':selected') == true;
//                                }",'message' => 'Ville requise'],
//            [['age'], 'required', 'on'=>['contact'], 'when' => function ($model) {
//                            return $model->subjet == 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactform-subjet option:nth-of-type(2)').is(':selected') == true;
//                                }",'message' => '{attribute} ne peut être vide.'],                      
            
            [['countryCallingCode', 'phone', 'callTime'], 'required', 'on' => 'rdv'],
            [['callDate'], 'required', 'on' => 'rdv', 'message'=>'Date de rendez-vous requise'],
            [['phone'], 'number'],
            [['phone'], 'string', 'min' => 8 , 'tooShort' => 'Le numéro de téléphone est trop court'],        
            [['phone'], 'string', 'max' => 10,  'tooLong' => 'Le numéro de téléphone est trop long'],  
            
            
           
            [['telephone'], 'number', 'on' => 'contact', 'when' => function ($model) {
                return $model->telephone == '';
            }, 'whenClient' => "function (attribute, value) {
                        return $('#contactform-telephone').val() != null;
                    }",'message' => 'Votre numéro de téléphone doit être un nombre'],   

            [['telephone'], 'string', 'min' => 8, 'on' => 'contact', 'when' => function ($model) {
                return $model->telephone == '';
            }, 'whenClient' => "function (attribute, value) {
                        return $('#contactform-telephone').val() != null;
                    }",'tooShort' => 'Votre numéro de téléphone est trop court'], 

            [['telephone'], 'string', 'max' => 10, 'on' => 'contact', 'when' => function ($model) {
                return $model->telephone == '';
            }, 'whenClient' => "function (attribute, value) {
                         return $('#contactform-telephone').val() != null;
                    }",'tooLong' => 'Votre numéro de téléphone est trop long'],    
            
            [['email', ' confirm_email'], 'email'],
            [['confirm_email'], 'compare', 'compareAttribute' => 'email'],
            // [['verificationCode'], 'captcha', 'captchaAction' => 'amica-fr/captcha'],
            // [['reCaptcha'],'require d','message'=>'Merci de remplir le code anti-spam'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(),
                    'secret' => '6Ld9iUwUAAAAAH_6hPeKP9QL_bRUQPz4adVN3iKt', 'uncheckedMessage' => 'Merci de remplir le code anti-spam']
        ];
    }

    public function attributeLabels() {
        $email = 'Votre adresse mail';
        if ($this->scenario == 'send-wishlist') {
            $email = 'Mail du destinataire';
        }
        return [
            'prefix' => 'Votre civilité',
            'fname' => 'Votre prénom',
            'lname' => 'Votre nom de famille',
            'email' => $email,
            'confirm_email' => 'Confirmez votre adresse é-mail',
            'age' => 'Année de naissance',
            'country' => 'Pays de résidence',
            'countryCallingCode' => 'Indicatif de pays',
            'phone' => 'Votre numéro de téléphone',
            'callTime' => 'Heure pour recevoir nos appels',
            'callDate' => 'Date pour recevoir nos appels',
            'message' => 'Votre message',
            'verificationCode' => 'Code anti-spam',
            'fullName' => 'Votre nom complet',
            'subjet' => 'Sujet',
            'region' => 'Département',
            'ville' => 'Votre ville',
            'newsletter'=>'Inscription à la newsletter',
            'period' => 'Lieu de RDV souhaité sur Paris',
            'telephone' => 'Téléphone',
            'dialcodeCountry' => 'Dial code',
        ];
    }

    public function scenarios() {
        return [
            'contact' => ['prefix', 'fullName', 'email', 'age', 'country', 'message', 'region', 'ville', 'newsletter', 'reference', 'subjet', 'telephone','dialcodeCountry', 'duraTime'],
            'send-wishlist' => ['prefix', 'email', 'age', 'verificationCode', 'message', 'receiveName', 'fullName', 'duraTime'],
            'contactce' => ['prefix', 'fname', 'lname','email', 'age', 'country', 'message', 'question','region','ville', 'newsletter', 'reference','telephone','dialcodeCountry', 'duraTime'],
            'contactce_mobile' => ['prefix', 'fullName', 'email', 'age', 'message', 'verificationCode','question', 'reference', 'duraTime'],
            'rdv_mobile' => ['prefix', 'fullName', 'email', 'age', 'message', 'verificationCode', 'countryCallingCode', 'phone', 'reference', 'duraTime'],
            'rdv' => ['prefix', 'fullName', 'email', 'country', 'countryCallingCode', 'phone', 'callDate', 'callTime', 'message', 'newsletter', 'reference','dialcodeCountry', 'duraTime', 'code_postal'],
            'rdv-surparis' => ['prefix', 'fname', 'lname', 'email', 'age', 'period', 'phone', 'callDate', 'message', 'newsletter', 'reference','dialcodeCountry', 'duraTime'],
            'rdv-surparis-mobile' => ['prefix', 'fname', 'lname', 'email', 'age', 'period', 'phone', 'callDate', 'message', 'newsletter', 'reference','dialcodeCountry', 'duraTime'],
        
            'newsletter' => ['email', 'country', 'duraTime'],
        ];
    }

}
