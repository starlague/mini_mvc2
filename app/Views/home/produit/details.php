<h2 class="text-center mb-3">Détails du produit</h2>

<div class="d-grid mx-auto w-75" style="grid-template-columns: repeat(2, 1fr);">
    <div class="container-img">
        <img src="/img/produitImg/<?= $produit['image'] ?>" alt="" class="img-fluid">
    </div>
    
    <div class="d-flex flex-column justify-content-center ms-5">
        <p class="fs-3"><?= $produit['nom'] ?></p>
        <p><?= $produit['prix'] ?> €</p>
        <p><?= $produit['description'] ?></p>
        <div>
            <a href="" class="add">Ajouter au panier</a>
        </div>
        
    </div>
</div>


