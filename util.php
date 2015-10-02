<?php
require_once("api.php");

//Creating the curl_init
function curl($keys) {
      global $apiKey;
      global $preURL;

      $params = implode('/', $keys);

      $curlUrl = $preURL . $params . '/';

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-Key:' . $apiKey));
      curl_setopt($ch, CURLOPT_URL, $curlUrl);
      $response = curl_exec($ch);

      $json = json_decode($response);
      
      $errormessage = curl_error ($ch);
      if(!empty($errormessage)){
            die('we had some error with curl...');
      }

      return $json;
}