<div class="text-center">
    <h2 class="text-success mb-4">✓ Commande validée avec succès !</h2>
    <p>Votre commande n°<?= $commande['id'] ?> a été enregistrée.</p>
    <p>Total : <strong><?= $commande['total'] ?> €</strong></p>
    <a href="/commande/details?id=<?= $commande['id'] ?>" class="btn btn-primary">Voir les détails</a>
    <a href="/" class="btn btn-secondary">Retour à l'accueil</a>
</div>