<?php

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $state = $_POST['state'];
  $good_or_bad = $_POST['good_or_bad'];
  echo render_hos(get_hos($state, $good_or_bad));
} else {
  exit();
}



function get_hos($state, $reduction) {
  $sql = 'select distinct
            p.provider_id,
            p.payment_reduction,
            h.hospital_name as hospital_name,
            h.address as address,
            h.city as city,
            h.state as state,
            h.zip_code as zip_code,
            h.phone_number as phone_number
          from problems as p
          join hospitals as h on (p.provider_id = h.provider_id)
          where h.state = ?
          and p.payment_reduction = ?';


  $username = 'homestead';
  $password = 'secret';

  $easy_db = \ParagonIE\EasyDB\Factory::create(
    'pgsql:host=localhost;dbname=homestead',
    $username,
    $password
  );

  return $easy_db->safeQuery($sql, [$state, $reduction]);
}

function render_hos($rows) {
  $m = new Mustache_Engine(array(
      'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views'),
    ));

  $mu = new Mustache_Engine;

  return $m->render('hospitals', ["hospitals" => $rows]);
}

/*
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
*/
