<h2 class="text-center mb-4">Mes commandes</h2>

<div class="w-75 mx-auto">
    <?php if (empty($commandes)): ?>
        <p class="text-center">Vous n'avez aucune commande.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>N° Commande</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td>#<?= $commande['id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($commande['date_commande'])) ?></td>
                        <td><?= $commande['total'] ?> €</td>
                        <td>
                            <span class="badge bg-<?= $commande['statut'] === 'livree' ? 'success' : 'warning' ?>">
                                <?= htmlspecialchars($commande['statut']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="/commande/details?id=<?= $commande['id'] ?>" class="btn btn-sm btn-success">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>