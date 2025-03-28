<?php
Class Install {
    private PDO $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function isInstalled($dbName, $table) : Bool {

        $sql = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :banco AND TABLE_NAME = :tabela";
        $sql = $this->pdo->prepare($sql);
        $sql->execute([
            ':banco' => $dbName, 
            ':tabela' => $table
        ]);
        //Se o resultado for maior que 0, a tabela existe
        return $sql->fetchColumn() > 0;
    }
    public function installDatabase(): void {
        $sql = @file_get_contents("install.sql") or die("Couldn't load install.sql.");
        $this->pdo->exec($sql);
        $this->addDefaultUser();
    }

    private function addDefaultUser(): void {
        $hashedPassword = password_hash('admin', PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => 'admin', 'password' => $hashedPassword]);
    }

}