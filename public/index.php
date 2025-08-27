<?php

declare(strict_types=1);

use Slim\App;

require_once dirname(__DIR__) . '/app/bootstrap/init.php';

/** @var App $app */
$app = require_once ROOT_PATH . '/app/bootstrap/bootstrap_web.php';

$app->run();
