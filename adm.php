<?php
require_once "vendor/autoload.php";
require_once "config/Twig.php";
require_once "config/Install.php";
require_once "config/Database.php";
require_once "config/Contents.php";
session_start();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$database = new Database($_ENV['DB_DATABASE'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
$template = new Twig($_ENV['TWIG_PATH'], false);
$install = new Install($database->getPdo());
$twig = $template->getTwig();
$contents = new Contents($database->getPdo());

$query = isset($_SERVER['QUERY_STRING']) ? rawurldecode($_SERVER['QUERY_STRING']) : '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['login'] ?? '';
    $inputPassword = $_POST['password'] ?? '';
    $contents->authenticateUser($inputUsername, $inputPassword);
}

if (!isset($_SESSION['user_id'])) {
    echo $twig->render('login.twig');
} else {
    echo $twig->render('index.twig', [
        'mod' => true,
        'results' => $contents->getMenuItems()
    ]);
}