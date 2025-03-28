<?php
require_once "vendor/autoload.php";
require_once "config/Twig.php";
require_once "config/Install.php";
require_once "config/Database.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$database = new Database($_ENV['DB_DATABASE'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
$install = new Install($database->getPdo());
$template = new Twig($_ENV['TWIG_PATH'], $_ENV['TWIG_CACHE']);
$twig = $template->getTwig();


if($install->isInstalled($_ENV['DB_DATABASE'], "items") && $install->isInstalled($_ENV['DB_DATABASE'], "sections")) {
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $install->installDatabase();
    header('Location: ' . '/index.php');
} 

echo $twig->render('install.twig');

