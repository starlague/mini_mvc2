<!-- Paragraphe d'accueil affiché sur la page d'accueil -->
<div>
    <h2 class="text-center mb-3">Nos produits</h2>

    <div class="d-grid w-75 mx-auto gap-5" style="grid-template-columns: repeat(4, 1fr);">
        <?php foreach ($produits as $produit): ?>
            <div class="card d-flex align-items-center p-2">
                <div class="container-img">
                    <img src="/img/produitImg/<?= htmlspecialchars($produit['image']) ?>" alt="">
                </div>
                <p><strong><?= htmlspecialchars($produit['nom']) ?></strong></p>
                <p><?= htmlspecialchars($produit['prix']) ?> €</p>
     
                <a href="/details?id=<?= $produit['id'] ?>" class="detail">Description</a>
                <a href="/panier/add?produit_id=<?= $produit['id'] ?>&quantite=1" class="add">Ajouter au panier</a>
            </div>
    
        <?php endforeach; ?>
    </div>
</div>
