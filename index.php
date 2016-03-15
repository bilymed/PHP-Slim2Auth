<?php

session_cache_limiter(false);
session_start();

require 'vendor/autoload.php';

require 'bootstrap/App.php';

require 'app/database.php';

$app = new App();

require 'app/routes.php';

$app->run();