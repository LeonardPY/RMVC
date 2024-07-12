<?php

require_once "Seeder.php";
require_once "../vendor/autoload.php";

use App\Models\Database;


$database = Database::getInstance();
$migration = new Seeder($database->getConnection());
$migration->run();