<?php
class Contents {
    private PDO $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function authenticateUser($userLogin, $userPass) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $userLogin]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($userPass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $userLogin;
            //header("Location: dashboard.php"); // Redirecionar para a página de administração
        } else {
            die("Credeciais incorretas");
        }
    }
    public function getMenuItems() {
        $stmt = $this->pdo->prepare(
            "
            SELECT 
                i.id AS item_id,
                i.name AS item_name,
                i.price AS item_price,
                i.side as side,
                i.description as description,
                s.id AS section_id,
                s.name AS section_name
            FROM 
                items i
            JOIN 
                sections s ON i.section_id = s.id;
            ");
        $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}