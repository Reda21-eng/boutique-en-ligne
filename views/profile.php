<section class="profile">
    <h1>Votre Profil</h1>
    <?php if (isset($success)): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="profile-form">
        <input type="text" id="username" value="<?php echo $user['username']; ?>" required>
        <input type="email" id="email" value="<?php echo $user['email']; ?>" required>
        <button onclick="updateProfile()">Mettre à jour</button>
    </div>
    <h2>Historique des commandes</h2>
    <div class="orders">
        <?php foreach ($orders as $order): ?>
            <div class="order">
                <p>Commande #<?php echo $order['id']; ?> - <?php echo $order['total']; ?> €</p>
                <p>Statut : <?php echo $order['status']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>