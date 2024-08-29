<?php
session_start();

require_once 'config.php';
require_once 'vendor/autoload.php';
require_once 'routes/web.php';

use App\Models\Log;

$log = new Log;
$data = $log->getLogInfo();
$log->insert($data);