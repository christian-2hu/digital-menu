<?php
require_once "vendor/autoload.php";
require_once "config/Twig.php";
require_once "config/Database.php";
require_once "config/Contents.php";
require_once "config/Init.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$init = new Init();
$contents = new Contents($init->getDatabase()->getpdo());
$twig = $init->getTwigEnvironment();
echo $twig->render('index.twig', [
    'mod' => false,
    'results' => $contents->getMenuItems()
]);
