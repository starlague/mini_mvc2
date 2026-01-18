<div class="text-center success p-3 w-50 mx-auto rounded">
    <h2 class="text-success mb-4">✓ Commande validée avec succès !</h2>
    <p>Votre commande n°<?= $commande['id'] ?> a été enregistrée.</p>
    <p>Total : <strong><?= $commande['total'] ?> €</strong></p>
    <div class="d-flex align-items-center justify-content-center gap-2">
        <a href="/commande/details?id=<?= $commande['id'] ?>" class="btn btn-success">Voir les détails</a>
        <a href="/" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
</div>