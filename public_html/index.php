<?php
$start = microtime(true);

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../backend/System.php';
(new Backend\System)->init($start);