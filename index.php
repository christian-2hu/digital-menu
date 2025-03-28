<?php
require_once "vendor/autoload.php";
require_once "config/Twig.php";
require_once "config/Install.php";
require_once "config/Database.php";
require_once "config/Contents.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$database = new Database($_ENV['DB_DATABASE'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
$template = new Twig($_ENV['TWIG_PATH'], false);
$install = new Install($database->getPdo());
$contents = new Contents($database->getPdo());
$twig = $template->getTwig();
echo $twig->render('index.twig', [
    'mod' => false,
    'results' => $contents->getMenuItems()
]);
