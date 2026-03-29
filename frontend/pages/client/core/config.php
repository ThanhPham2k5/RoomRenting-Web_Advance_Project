<?php 
  define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/frontend');

function call_api($url, $method = 'GET', $data = []) {
  $curl = curl_init();
  $options = [
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 10,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_HTTPHEADER => [
          "Accept: application/json",
          "Content-Type: application/json",
          "Authorization:Bearer 2|6DAtA7EkyWcqnbd9dCnrloVQvboTOPF0RddJCoOJf635df41"
      ],
  ];

  if (($method == 'POST' || $method == 'PUT') && !empty($data)) {
      $options[CURLOPT_POSTFIELDS] = json_encode($data);
  }

  curl_setopt_array($curl, $options);

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {
      return [];
  } else {
      $decoded = json_decode($response, true);
      return $decoded ?? [];
  }
}
?>