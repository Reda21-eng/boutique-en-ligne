<section class="auth">
    <h1>Inscription</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="auth-form">
        <input type="text" id="username" placeholder="Nom d'utilisateur" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Mot de passe" required>
        <button onclick="register()">S'inscrire</button>
    </div>
    <p>Déjà un compte ? <a href="/login.php">Connectez-vous</a></p>
</section>