<?php
    $theText = explode(chr(10), $data2);
    
    echo '<div>';
    foreach ($theText as $value) {
        $text = str_replace(['}}','<*','*>'], ['</span>','<b>','</b>'], $value);
       //echo $text;
        //$subject = 'Hello "Everybody", {{ dkfhdk : fdsaffdf }} welcome to "freetuts.net" {{ adb : abc }}';
        //preg_match_all('/{{(.+?):/', $subject, $matches);
        $text = preg_replace('/{{(.+?):/', '<span style="color: brown;">', $text);
        echo $text;
       // echo str_replace(['tourUrl :','extension :','prefix :','fname :', 'lname :','email :', 'age :', 'country :', 'region :', 'ville :', 'departureDate :', 'deretourDate :', 'tourLength :', 'countriesToVisit :', 'multipays :', 'whyCountry :', 'howTicket :', 'numberOfTravelers12 :', 'agesOfTravelers12 :', 'numberOfTravelers2 :', 'numberOfTravelers0 :', 'howTraveler :', 'hotelTypes :', 'hotelRoomDbl :', 'hotelRoomTwn :', 'hotelRoomTrp :', 'hotelRoomSgl :', 'mealsIncluded :', 'budget :', 'message :', 'tourThemes :', 'howMessage :', 'howHobby :', 'job :', 'callback :', 'countryCallingCode :', 'phone :', 'callDate :', 'callTime :', 'newsletter :', 'ticketDetail :', 'helpTicket :', 'reference :'], '', $text);
        echo '<br>';
    }
    echo '</div>';
?>
