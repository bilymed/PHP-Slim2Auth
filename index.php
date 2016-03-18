<?php

session_cache_limiter(false);
session_start();

require 'vendor/autoload.php';

require 'app/config/App.php';

require 'app/config/database.php';

$app = new App();

require 'app/routes.php';

$app->run();