<?php
/*
* @category   Class
* @author     Fábio Pereira <fabio.pereira.gti@gmail.com>
* @copyright  Copyright (c) 2016 Fábio Pereira
* @license    The MIT License (MIT)
*/
class FCM {

   private $url = "https://fcm.googleapis.com/fcm/send";
   private $key = "key="; // adicionar sua chave
   private $package = ""; // adicionar o pacote do configi xml do app

   public function sendToUser($msg){

    $curl = curl_init();

    $fields = "{\"notification\":{
      \"title\": \"". $msg['title'] ."\",
      \"body\":\"" . $msg['subtitle'] ."\",
      \"sound\":\"default\",
      \"icon\":\"fcm_push_icon\" },
      \"data\":{},
      \"to\":\"". (!empty($msg['user']) ? $msg['user'] : $this->package) ."\",
      \"priority\":\"high\",
      \"restricted_package_name\":\"". $this->package ."\"}";

      $headers = array(
        "authorization:" . $this->key,
        "cache-control: no-cache",
        "content-type: application/json"
      );

      curl_setopt_array($curl,
      array(
        CURLOPT_URL => $this->url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "utf8",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $fields,
        CURLOPT_HTTPHEADER => $headers
      )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    return empty($response) && !empty($err) ? $err : $response;
  }
}
