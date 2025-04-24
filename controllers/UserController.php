<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $db;
    private $userModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->userModel = new User($this->db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            if ($this->userModel->register($data)) {
                header('Location: /login.php');
            } else {
                $error = "Erreur lors de l'inscription";
            }
        }
        $content = __DIR__ . '/../views/register.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->login($_POST['email'], $_POST['password']);
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin'];
                header('Location: /index.php');
            } else {
                $error = "Identifiants incorrects";
            }
        }
        $content = __DIR__ . '/../views/login.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function profile() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login.php');
        }
        $user = $this->userModel->getById($_SESSION['user_id']);
        $content = __DIR__ . '/../views/profile.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function update() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email']
            ];
            if ($this->userModel->update($_SESSION['user_id'], $data)) {
                $success = "Profil mis à jour";
            } else {
                $error = "Erreur lors de la mise à jour";
            }
        }
        $this->profile();
    }
}
?>