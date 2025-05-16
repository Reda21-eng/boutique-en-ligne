<?php
require_once '../autoload.php';
require_once '../config.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Récupérer les informations de l'utilisateur depuis la base de données
$userId = $_SESSION['user_id'];
$user = null;

try {
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare("SELECT username, email, created_at FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Erreur lors de la récupération des informations utilisateur.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Manga Meow</title>
    <link rel="stylesheet" href="../View/css/style.css">
    <link rel="stylesheet" href="../View/css/responsive.css">
    <style>
        .profile-container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .profile-container h2 {
            margin-bottom: 1.5rem;
        }
        .profile-info {
            margin-bottom: 1rem;
        }
        .profile-info label {
            font-weight: bold;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.5rem 1.5rem;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <header>
        <nav class="main-nav">
            <div class="nav-brand">
                <a href="../index.php">
                    <h1>Manga Meow</h1>
                </a>
            </div>
        </nav>
    </header>
    <main>
        <div class="profile-container">
            <h2>Mon Profil</h2>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php elseif ($user): ?>
                <div class="profile-info">
                    <label>Nom d'utilisateur :</label>
                    <span><?php echo htmlspecialchars($user['username']); ?></span>
                </div>
                <div class="profile-info">
                    <label>Email :</label>
                    <span><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="profile-info">
                    <label>Membre depuis :</label>
                    <span><?php echo htmlspecialchars(date('d/m/Y', strtotime($user['created_at']))); ?></span>
                </div>
                <a href="logout.php" class="logout-btn">Se déconnecter</a>
            <?php else: ?>
                <p>Impossible de charger les informations du profil.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>