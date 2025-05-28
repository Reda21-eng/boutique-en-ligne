<?php
// Script de test de connexion et de vérification du hash
$dsn = 'mysql:host=db;dbname=manga_meow;charset=utf8mb4';
$user = 'root';
$pass = 'root';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion MySQL OK<br>";

    $email = 'reda.yahyaoui@laplateforme.io'; // Mets ici l'email que tu testes
    $password = '18oct2024'; // Mets ici le mot de passe en clair que tu testes

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "Hash en base : ".$user['password']."<br>";
        if (password_verify($password, $user['password'])) {
            echo "password_verify OK";
        } else {
            echo "password_verify ECHEC";
        }
    } else {
        echo "Aucun utilisateur trouvé pour cet email.";
    }
} catch (PDOException $e) {
    echo "Erreur PDO : ".$e->getMessage();
}
