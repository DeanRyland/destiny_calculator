<?php
      require_once("../kint/Kint.class.php");

      error_reporting(E_ALL);
      ini_set('display_errors', '1');

      $apiKey = '1a727ce6000d470db117db15a7331f20';
      $preURL = 'http://www.bungie.net/Platform/Destiny/'; 

      //$gamertag = 'SNIPEOUTdaLIGHTS'; //DisplayName
      //$platform = '2'; //MembershipType
      //$destinyID = '9864325'; //UniqueID
      //$charID = '2305843009326718576'; //CharacterID 'Titan'
      //$memID = '4611686018446942754'; //MembershipID

      
      //Get MemberID from Gamertag
      //$gametagToMemID = $preURL .'/'. $platform .'/'. $gamertag .'/';
      
      //$memID = $GametagToMemID->Response[0]->membershipId;

      //Get Summary from MembershipID
      //$sumFromMemID = $preURL . $platform .'/Account/'. $memID .'/Summary/';
      //$sumFromMemID = curl(array($platform, 'Account', $memID, 'Summary'));

      //Array holding URL Info
      //$keys = array($gamertag, $platform, 'Account', 'Summary');

