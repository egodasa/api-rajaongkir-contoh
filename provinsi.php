<?php

$url = "https://api.rajaongkir.com/starter/province";
$query_string = http_build_query($_GET);

if(!empty($_GET))
{
  $url .= "?".$query_string;
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: YOUR_KEY_DISINI"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


$result_tmp = json_decode($response);
$result = [];

$result['code'] = $result_tmp->rajaongkir->status->code;
$result['message'] = $result_tmp->rajaongkir->status->description;
$result['data'] = null;

if (!$err) {
  $result['data'] = $result_tmp->rajaongkir->results;
}

echo json_encode($result, JSON_PRETTY_PRINT);
?>
