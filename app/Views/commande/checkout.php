<h2 class="text-center mb-4">Valider votre commande</h2>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="w-75 mx-auto">
    <div class="row">
        <div class="col-md-8">
            <h3>Récapitulatif</h3>
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?= htmlspecialchars($article['nom']) ?></td>
                            <td><?= htmlspecialchars($article['prix']) ?> €</td>
                            <td><?= htmlspecialchars($article['quantite']) ?></td>
                            <td><?= htmlspecialchars($article['prix'] * $article['quantite']) ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th><?= $total ?> €</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="col-md-4">
            <h3>Adresse de livraison</h3>
            <form method="POST" action="/commande/validate">
                <div class="mb-3">
                    <label for="adresse_livraison" class="form-label">Adresse complète</label>
                    <textarea class="form-control" id="adresse_livraison" name="adresse_livraison" rows="4" required></textarea>
                </div>
                <button type="submit" class=" btn btn-success w-100">Valider la commande</button>
            </form>
        </div>
    </div>
</div>