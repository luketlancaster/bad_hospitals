<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the GET method
  $state = $_POST['state'];
  echo get_hospitals($state);
} else {
  exit();
}

function get_hospitals($state) {
  $poor_preformers_url = "https://data.medicare.gov/resource/5u3e-gkdf.json?state=$state&payment_reduction=Yes";
  $hospital_url = "https://data.medicare.gov/resource/rbry-mqwu.json?state=$state";

  $hospitals = file_get_contents($hospital_url);
  $poor_preformers = file_get_contents($poor_preformers_url);
  //
  $hospitals = json_decode($hospitals, true);
  $poor_preformers = json_decode($poor_preformers, true);

  $munged = hospital_munger($hospitals, $poor_preformers);

  return json_encode($munged);
}

function hospital_munger($hospitals, $performances) {
  foreach($hospitals as $h_key => $hospital) {
    foreach($performances as $p_key => $performance) {
      if ($performance['provider_id'] === $hospital['provider_id']) {
        $performances[$p_key]['address'] = $hospital['address'];
        $performances[$p_key]['zip_code'] = $hospital['zip_code'];
        $performances[$p_key]['city'] = $hospital['city'];
      }
    }
  }

  return $performances;
}

