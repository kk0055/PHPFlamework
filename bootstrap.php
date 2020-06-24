<?php 
require 'core/Classloader.php';

$loader = new Classloader();
$loader->registerDir(dirname(__FILE__).'/core');
$loader->registerDir(dirname(__FILE__).'/models');
$loader->register();