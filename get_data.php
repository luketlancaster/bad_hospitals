<?php

require __DIR__ . '/vendor/autoload.php';


// YOU'LL NEED THESE
$username = '';
$password = '';
$db_name = '';

$easy_db = \ParagonIE\EasyDB\Factory::create(
  'pgsql:host=localhost;dbname='.$db_name,
  $username,
  $password
);

$socrata = new Socrata('data.medicare.gov');

//$hospitals = $socrata->get('/resource/rbry-mqwu.json?$limit=10000000');
$bad_ones = $socrata->get('/resource/5u3e-gkdf.json?$limit=100000000');


/*
 * THIS ISN'T GREAT BUT IT'LL DO
foreach ($bad_ones as $b) {
  if (isset($b['mrsa_footnote'])) unset($b['mrsa_footnote']);
  if (isset($b['ssi_score_footnote'])) unset($b['ssi_score_footnote']);
  if (isset($b['cauti_score_footnote'])) unset($b['cauti_score_footnote']);
  if (isset($b['clabsi_score_footnote'])) unset($b['clabsi_score_footnote']);
  if (isset($b['cdi_footnote'])) unset($b['cdi_footnote']);
  if (isset($b['domain_2_score_footnote'])) unset($b['domain_2_score_footnote']);
  if (isset($b['ahrq_psi_90_score_footnote'])) unset($b['ahrq_psi_90_score_footnote']);
  if (isset($b['domain_1_score_footnote'])) unset($b['domain_1_score_footnote']);
  if (isset($b['footnotes'])) unset($b['footnotes']);
  if (isset($b['payment_reduction_footnote'])) unset($b['payment_reduction_footnote']);
  $easy_db->insert('problems', $b);
}

$count = 0;
foreach ($hospitals as $h) {
  if (isset($h['efficient_use_of_medical_imaging_national_comparison_footnote'])) unset($h['efficient_use_of_medical_imaging_national_comparison_footnote']);
  if (isset($h['safety_of_care_national_comparison_footnote'])) unset($h['safety_of_care_national_comparison_footnote']);
  if (isset($h['patient_experience_national_comparison_footnote'])) unset($h['patient_experience_national_comparison_footnote']);
  if (isset($h['hospital_overall_rating_footnote'])) unset($h['hospital_overall_rating_footnote']);
  if (isset($h['mortality_national_comparison_footnote'])) unset($h['mortality_national_comparison_footnote']);
  if (isset($h['readmission_national_comparison_footnote'])) unset($h['readmission_national_comparison_footnote']);
  if (isset($h['effectiveness_of_care_national_comparison_footnote'])) unset($h['effectiveness_of_care_national_comparison_footnote']);
  if (isset($h['timeliness_of_care_national_comparison_footnote'])) unset($h['timeliness_of_care_national_comparison_footnote']);
  $easy_db->insert('hospitals', $h);
  $count++;
}
 */

/**
 * OLD WAY BELOW HERE
 */
/*
$poor_preformers_url = "https://data.medicare.gov/resource/5u3e-gkdf.json?payment_reduction=Yes";
$hospital_url = "https://data.medicare.gov/resource/rbry-mqwu.json";

$hospitals = file_get_contents($hospital_url);
$poor_preformers = file_get_contents($poor_preformers_url);
//
$hospitals = json_decode($hospitals, true);
$poor_preformers = json_decode($poor_preformers, true);

//$munged = hospital_munger($hospitals, $poor_preformers);

function hospital_munger($hospitals, $performances) {
  foreach($hospitals as $h_key => $hospital) {
    foreach($performances as $p_key => $performance) {
      if ($performance['provider_id'] === $hospital['provider_id']) {
        //if(empty($hospital['address'])) {
         // $performances[$p_key]['address'] = '';
        //} else {
          $performances[$p_key]['address'] = $hospital['address'];
        //}

        //if(empty($hospital['zip_code'])) {
         // $performances[$p_key]['zip'] = '';
        //} else {
          $performances[$p_key]['zip'] = $hospital['zip_code'];
        //}

        //if(empty($hospital['city'])) {
         // $performances[$p_key]['city'] = '';
        
        //} else {
          $performances[$p_key]['city'] = $hospital['city'];
        //}
      }
      $easy_db->insert('hospitals', $performances[$p_key]);
    }
  }

  return $performances;
}
$count = 0;

 */
