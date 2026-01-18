<h2 class="text-center mb-4">Détails de la commande #<?= $commande['id'] ?></h2>

<div class="w-75 mx-auto">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Informations de la commande</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Numéro de commande :</strong> #<?= $commande['id'] ?></p>
                    <p><strong>Date de commande :</strong> <?= date('d/m/Y à H:i', strtotime($commande['date_commande'])) ?></p>
                    <p><strong>Statut :</strong> 
                        <span class="badge bg-<?= $commande['statut'] === 'livree' ? 'success' : ($commande['statut'] === 'en_attente' ? 'warning' : 'info') ?>">
                            <?= htmlspecialchars($commande['statut']) ?>
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total :</strong> <span class="fs-4 important"><?= number_format($commande['total'], 2, ',', ' ') ?> €</span></p>
                    <?php if (!empty($commande['adresse_livraison'])): ?>
                        <p><strong>Adresse de livraison :</strong></p>
                        <p class="text-muted"><?= nl2br(htmlspecialchars($commande['adresse_livraison'])) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Produits commandés</h5>
        </div>
        <div class="card-body">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="col-6">Produit</th>
                        <th scope="col" class="col-2">Prix unitaire</th>
                        <th scope="col" class="col-2">Quantité</th>
                        <th scope="col" class="col-2">Total</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php 
                    $totalVerif = 0;
                    foreach ($commande['produits'] as $produit): 
                        $totalProduit = $produit['prix_unitaire'] * $produit['quantite'];
                        $totalVerif += $totalProduit;
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if (!empty($produit['image'])): ?>
                                        <div class="container-img p-2 w-25 me-3">
                                            <img src="/img/produitImg/<?= htmlspecialchars($produit['image']) ?>" 
                                                 alt="<?= htmlspecialchars($produit['nom']) ?>" 
                                                 class="img-fluid">
                                        </div>
                                    <?php endif; ?>
                                    <span><?= htmlspecialchars($produit['nom']) ?></span>
                                </div>
                            </td>
                            <td><?= number_format($produit['prix_unitaire'], 2, ',', ' ') ?> €</td>
                            <td><?= htmlspecialchars($produit['quantite']) ?></td>
                            <td><strong><?= number_format($totalProduit, 2, ',', ' ') ?> €</strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3" class="text-end">Total de la commande :</th>
                        <th><p class="important"><?= number_format($commande['total'], 2, ',', ' ') ?> €</p></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/commande/history" class="btn btn-secondary">Retour à mes commandes</a>
        <a href="/" class="btn btn-success">Retour à l'accueil</a>
    </div>
</div>