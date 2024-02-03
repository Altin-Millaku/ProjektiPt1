<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/Bootstrap.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

require dirname(__DIR__) . '/public/route.php';
?>
