<?php
require_once "vendor/autoload.php";
require_once "config/Twig.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$template = new Twig($_ENV['TWIG_PATH'], $_ENV['TWIG_CACHE']);
$twig = $template->getTwig();
echo $twig->render('index.twig', ['test' => 'Fabien']);
