<?php

namespace app\models;

use yii\base\Model;

class ContactFormMobile extends Model {

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
   
    public $dialcodeCountry;
    public $duraTime;

    public function rules() {
        return [
            [['tourName', 'tourUrl', 'verificationImgCode','question', 'newsletter', 'duraTime'], 'safe'],
            [['fname', 'lname', 'email', 'confirm_email', 'message', 'countryCallingCode', 'phone', 'receiveName','region','ville'], 'filter', 'filter' => 'trim'],
            [['country', 'email', 'confirm_email'], 'filter', 'filter' => 'strtolower'],
            [['prefix', 'fname', 'lname', 'email', 'confirm_email', 'fullName', 'message', 'phone', 'countryCallingCode','verificationCode', 'subjet', 'country', 'period', 'code_postal'], 'required','message' => '{attribute} ne peut pas être vide.'],
            [['message', 'subjet', 'telephone'], 'required', 'on' => ['contact', 'rdv', 'contactce', 'rdv_mobile']],
            [['countryCallingCode', 'phone', 'callDate', 'callTime'], 'required', 'on' => ['rdv','rdv_mobile','rdv-surparis-mobile']],
            [['email', ' confirm_email'], 'email'],
            [['confirm_email'], 'compare', 'compareAttribute' => 'email'],
            
            [['country'],'required','on'=>['contactce_mobile','rdv_mobile'],'message'=>'{attribute} ne peut être vide.'],
            
            
            [['phone'], 'number'],
            [['phone'], 'string', 'min' => 8 , 'tooShort' => 'Le numéro de téléphone est trop court'],        
            [['phone'], 'string', 'max' => 10,  'tooLong' => 'Le numéro de téléphone est trop long'],  
            
            
            [['telephone'], 'number', 'on' => 'contact_mobile', 'when' => function ($model) {
                return $model->telephone == '';
            }, 'whenClient' => "function (attribute, value) {
                        return $('#contactformmobile-telephone').val() != null;
                    }",'message' => 'Votre numéro de téléphone doit être un nombre'],   

            [['telephone'], 'string', 'min' => 8, 'on' => 'contact_mobile', 'when' => function ($model) {
                return $model->telephone == '';
            }, 'whenClient' => "function (attribute, value) {
                        return $('#contactformmobile-telephone').val() != null;
                    }",'tooShort' => 'Votre numéro de téléphone est trop court'], 

            [['telephone'], 'string', 'max' => 10, 'on' => 'contact_mobile', 'when' => function ($model) {
                return $model->telephone == '';
            }, 'whenClient' => "function (attribute, value) {
                         return $('#contactformmobile-telephone').val() != null;
                    }",'tooLong' => 'Votre numéro de téléphone est trop long'],    
            
//            [['country'], 'required', 'on'=>['contact_mobile'], 'when' => function ($model) {
//                            return $model->subjet == 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactformmobile-subjet option:nth-of-type(2)').is(':selected') == true;
//                                }",'message' => 'Pay requis'],
//            
//            [['region'], 'required', 'on'=>['contact_mobile'], 'when' => function ($model) {
//                            return $model->subjet == 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactformmobile-subjet option:nth-of-type(2)').is(':selected') == true;
//                                }",'message' => 'Département requis'],
//            [['ville'], 'required', 'on'=>['contact_mobile'], 'when' => function ($model) {
//                            return $model->subjet == 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactformmobile-subjet option:nth-of-type(2)').is(':selected') == true;
//                                }",'message' => 'Ville requise'],
//            [['age'], 'required', 'on'=>['contact_mobile'], 'when' => function ($model) {
//                            return $model->subjet == 'pdv';
//                        }, 'whenClient' => "function (attribute, value) {
//                                    return $('#contactformmobile-subjet option:nth-of-type(2)').is(':selected') == true;
//                                }",'message' => '{attribute} ne peut être vide.'],        
            
             // [['verificationCode'], 'captcha', 'captchaAction' => 'amica-fr/captcha'],
        ];
    }

    public function attributeLabels() {
        $email = 'Votre adresse e-mail';
        if ($this->scenario == 'send-wishlist') {
            $email = 'Mail du destinataire';
        }
        return [
            'prefix' => 'Votre civilité',
            'fname' => 'Votre Prénom',
            'lname' => 'Votre Nom',
            'email' => $email,
            'confirm_email' => 'Confirmez votre adresse é-mail',
            'age' => 'Année de naissance',
            'country' => 'Pays',
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
            'telephone' => 'Téléphone',
            'period' => 'Lieu de RDV souhaité sur Paris',    
        ];
    }

    public function scenarios() {
        return [
            'contact' => ['prefix', 'fname', 'lname', 'email', 'age', 'country', 'message', 'verificationCode', 'region', 'ville','subjet', 'newsletter', 'reference','dialcodeCountry', 'duraTime'],
            'send-wishlist' => ['prefix', 'email', 'age', 'verificationCode', 'message', 'receiveName', 'fullName','dialcodeCountry', 'duraTime'],
            'contactce' => ['prefix', 'fname', 'lname','email', 'age', 'country', 'message', 'verificationCode', 'question','region','ville', 'newsletter', 'reference', 'dialcodeCountry', 'duraTime'],
            'contact_mobile' => ['prefix', 'fullName', 'email', 'age', 'message', 'question', 'subjet', 'country', 'region','ville', 'reference','newsletter','telephone', 'dialcodeCountry', 'duraTime'],
            'contactce_mobile' => ['prefix', 'fullName', 'email', 'age', 'message', 'question', 'country', 'region','ville', 'reference','newsletter', 'dialcodeCountry', 'duraTime'],
            'rdv_mobile' => ['prefix', 'fullName', 'email', 'message', 'countryCallingCode',  'phone', 'country', 'reference','newsletter', 'dialcodeCountry', 'callDate', 'callTime', 'duraTime', 'code_postal'],
            'rdv' => ['prefix', 'fname', 'lname', 'email', 'country', 'age', 'region', 'ville', 'countryCallingCode', 'phone', 'callDate', 'callTime', 'verificationCode', 'newsletter', 'reference', 'dialcodeCountry', 'duraTime'],
            'rdv-surparis-mobile' => ['prefix', 'fname', 'lname', 'email', 'age', 'period', 'phone', 'callDate', 'message', 'newsletter', 'reference','dialcodeCountry', 'duraTime'],
        
            'newsletter_mobile' => ['email', 'country', 'duraTime'],
        ];
    }

}
