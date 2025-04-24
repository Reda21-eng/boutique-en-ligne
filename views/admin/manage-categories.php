<section class="admin-manage">
    <h1>Gérer les Catégories</h1>
    <div class="category-form">
        <input type="text" id="name" placeholder="Nom de la catégorie" required>
        <select id="parent_id">
            <option value="">Aucune catégorie parente</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <button onclick="addCategory()">Ajouter Catégorie</button>
    </div>
    <div class="category-list">
        <?php foreach ($categories as $category): ?>
            <div class="category-item">
                <p><?php echo $category['name']; ?></p>
                <button onclick="deleteCategory(<?php echo $category['id']; ?>)">Supprimer</button>
            </div>
        <?php endforeach; ?>
    </div>
</section>