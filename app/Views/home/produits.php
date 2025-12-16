<h2>Liste des produits</h2>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit): ?>
        <tr>
            <td><?= $produit['nom'];?></td>
            <td><?= $produit['prix'];?> €</td>
            <td>
                <a href="">Description</a>
                <a href="">Ajouter au panier</a>
                <a href="">Commander</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>