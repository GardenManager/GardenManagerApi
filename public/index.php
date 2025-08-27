<?php

declare(strict_types=1);

use Slim\App;

$rootPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');

define('ROOT_PATH', $rootPath);
require_once $rootPath . '/vendor/autoload.php';

/** @var App $app */
$app = require_once $rootPath . '/app/bootstrap/bootstrap_web.php';

$app->run();