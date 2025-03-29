<?php

use Twig\Environment;

class Init {
    private Database $database;
    private Twig $twig;

    public function __construct() {
        $this->database = new Database($_ENV['DB_DATABASE'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $this->twig = new Twig($_ENV['TWIG_PATH'], $_ENV['TWIG_CACHE']);
    }

    public function getDatabase(): Database {
        return $this->database;
    }
    public function getTwig(): Twig {
        return $this->twig;
    }
    public function getTwigEnvironment(): Environment {
        return $this->twig->getTwigEnvironment();
    }
}