<?php

require __DIR__ . '/vendor/autoload.php';

use BadHospitals\HospitalRepo;
use Auryn\Injector;
use BadHospitals\DatabaseStorage;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $state = $_POST['state'];
  $good_or_bad = $_POST['good_or_bad'];
  //echo render_hos(get_hos($state, $good_or_bad));
  echo create_and_render($state, $good_or_bad);
} else {
  exit();
}


function create_and_render($state, $good_or_bad)
{
    $dsn = 'pgsql:host=localhost;dbname=homestead';
    $username = 'homestead';
    $password = 'secret';

    $injector = new Injector;

    $db_storage = new DatabaseStorage($dsn, $username, $password);

    $hospitalRepo = new HospitalRepo($db_storage);
    $templateFactory = $injector->make('BadHospitals\TemplateFactory'); ///ARUYN MAKE IT!!!

    $hospitals = $hospitalRepo->get_hospitals($state, $good_or_bad);
    $template = $templateFactory->create_template('hospitals', ['hospitals' => $hospitals]);

    return $template;
}

