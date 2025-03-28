<?php
class Database {
    private PDO $pdo;
    public function __construct(String $dbName, String $dbUser, String $dbPassword) {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
    public function getPdo(): PDO {
        return $this->pdo;
    }
}