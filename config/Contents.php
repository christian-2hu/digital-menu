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
}