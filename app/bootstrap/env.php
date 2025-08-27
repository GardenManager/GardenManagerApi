<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

$loader = new Dotenv();

$loader->loadEnv(ROOT_PATH . '/.env');
