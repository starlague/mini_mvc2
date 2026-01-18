<h2 class="text-center mb-3">Détails du produit</h2>

<div class="d-grid mx-auto w-50 product-container p-2" style="grid-template-columns: repeat(2, 1fr);">
    <div class="container-img p-2">
        <img src="/img/produitImg/<?= htmlspecialchars($produit['image']) ?>" alt="" class="img-fluid">
    </div>
    
    <div class="d-flex flex-column justify-content-center ms-5">
        <p class="fs-3"><?= htmlspecialchars($produit['nom']) ?></p>
        <p><?= htmlspecialchars($produit['prix']) ?> €</p>
        <p><?= htmlspecialchars($produit['description']) ?></p>
        <div class="d-flex">
            <a href="/panier/add?produit_id=<?= $produit['id'] ?>&quantite=1" class="add">Ajouter au panier</a>
        </div>
    </div>
</div>


