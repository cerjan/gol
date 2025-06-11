<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

$_SERVER['VAR_DUMPER_FORMAT'] = 'server';
$_SERVER['VAR_DUMPER_SERVER'] = 'host.docker.internal:9912';


return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
