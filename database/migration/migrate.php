<?php

require_once "Migration.php";
require_once "../vendor/autoload.php";

use App\Models\Database;


$database = Database::getInstance();
$migration = new Migration($database->getConnection());
$migration->run();