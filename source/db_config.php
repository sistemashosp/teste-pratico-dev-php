<?php

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$config = [
  "driver" => "mysql",
  "host" => "127.0.0.1",
  "database" => "devphp",
  "username" => "root",
  "password" => "",
  "charset" => "latin1",
  "collation" => "latin1_swedish_ci"
];

$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();