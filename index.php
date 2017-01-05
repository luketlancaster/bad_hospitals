<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the GET method
  $state = $_POST['state'];
  echo "You got it, dude, you're from $state";
} else {
  exit();
}



// Write a function that'll go out and do the work...
// Endpoints to hit:
// Hospital-Acquired Condition Reduction Program
// https://data.medicare.gov/resource/5u3e-gkdf.json?state={state}&payment_reduction=Yes
//
// General hospital information
// https://data.medicare.gov/resource/rbry-mqwu.json?state={state}
//
// Get the addresses out of the General Hospital Information array
// and return the mushed data back to FE
