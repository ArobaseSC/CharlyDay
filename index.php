<?php

use Illuminate\Database\Capsule\Manager as DB;
use Application\dispatch\Dispatcher;

session_start();

require_once 'vendor/autoload.php';

$db = new DB();

$db->addConnection(parse_ini_file('src/conf/conf.ini'));

$db->setAsGlobal();
$db->bootEloquent();

$action = $_GET['action'] ?? '';

$dispatcher = new Dispatcher($action);

$dispatcher->dispatch();
