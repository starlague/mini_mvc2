<h2 class="text-center mb-3">Mon panier</h2>

<div class="w-75 mx-auto">   
    <?php if (!empty($articles)): ?>
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="col-6">Produit</th>
                    <th scope="col" class="col-3">Prix</th>
                    <th scope="col" class="col-3">Quantité</th>
                </tr>
            </thead>
            <tbody class="table-group-divider-black">
                <?php 
                $total = 0;
                foreach ($articles as $article): 
                    $totalArticle = $article['prix'] * $article['quantite'];
                    $total += $totalArticle;
                ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="container-img p-2 w-25">
                                    <img src="/img/produitImg/<?= htmlspecialchars($article['image']) ?>" alt="">
                                </div>
                                <span><?= htmlspecialchars($article['nom']) ?></span>
                            </div>   
                        </td>
                        <td><?= htmlspecialchars($article['prix']) ?> €</td>
                        <td>
                            <a href="/panier/decrease?produit_id=<?= $article['id'] ?>" class="remove"><i class="bi bi-dash-lg"></i></a>
                            <span class="ms-2 me-2"><?= htmlspecialchars($article['quantite']) ?></span>
                            <a href="/panier/add?produit_id=<?= $article['id'] ?>&quantite=1" class="add"><i class="bi bi-plus-lg"></i></a>
                            <a href="panier/delete?produit_id=<?= $article['id'] ?>" class="delete ms-2">Supprimer <i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center"><?= $article['nom'] . ' x ' . $article['quantite'] . ' = ' . $totalArticle . '€'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <td>Total</td>
                <td colspan="2" class="text-end"> <?= $total ?> €</td>
            </tfoot>
        </table>
    <?php else : ?>
        <div class="text-center">
            <p>Aucun produit dans votre panier</p>
        </div>
    <?php endif; ?>
    <?php if (!empty($articles)): ?>
        <div class="text-center mt-4">
            <a href="/commande/checkout" class="btn btn-success">Valider la commande</a>
        </div>
    <?php endif; ?>
</div>
