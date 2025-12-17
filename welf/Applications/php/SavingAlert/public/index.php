<?php

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

chdir(__DIR__);

$pathsConfig = FCPATH . '../app/Config/Paths.php';

require $pathsConfig;

$paths = new Config\Paths();

$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

$app = require $bootstrap;

$app->run();
