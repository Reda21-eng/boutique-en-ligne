<section class="auth">
    <h1>Connexion</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="auth-form">
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Mot de passe" required>
        <button onclick="login()">Se connecter</button>
    </div>
    <p>Pas de compte ? <a href="/register.php">Inscrivez-vous</a></p>
</section>