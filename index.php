<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 15/11/2
 * Time: 下午6:56
 */
use dianjoy\batman\Robin;

require 'vendor/autoload.php';

$robin = new Robin('http://localhost:3000', 'dianjoy', 'test');
$robin->log('oh my god');