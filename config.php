<?php

require './enviroment.php';

global $config;
$config = array();

if (ENVIROMENT == "development") {
    $config['dbname'] = 'contaazul';
    $config['dbhost'] = 'localhost';
    $config['dbuser'] = 'kali';
    $config['dbpass'] = '12345';
} else {
    // $config para ambiente de produção
    $config['dbname'] = 'contaazul';
    $config['dbhost'] = 'localhost';
    $config['dbuser'] = 'kali';
    $config['dbpass'] = '12345';
}