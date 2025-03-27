<?php
use Twig\Environment;
Class Twig {
    private Environment $twig;
    public function __construct(String $templatesPath, String $templatesCache) {
        $loader = new \Twig\Loader\FilesystemLoader($templatesPath);
        $this->twig = new Environment($loader, [
            'cache' => $templatesCache,
        ]);
    }
    public function getTwig(): Environment {
        return $this->twig;
    }
}