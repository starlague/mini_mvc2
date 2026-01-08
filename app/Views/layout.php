<!doctype html>
<!-- Définit la langue du document -->
<html lang="fr">
<!-- En-tête du document HTML -->
<head>
    <!-- Déclare l'encodage des caractères -->
    <meta charset="utf-8">
    <!-- Configure le viewport pour les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Définit le titre de la page avec échappement -->
    <title><?= isset($title) ? htmlspecialchars($title) : 'App' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<!-- Corps du document -->
<body>
<!-- En-tête de la page -->
<header class="p-2 mb-5">
    <!-- Affiche le titre principal avec échappement -->
    <div class="d-flex align-items-center">
        <!-- <h1><?= isset($title) ? htmlspecialchars($title) : 'App' ?></h1> -->
        <h1 class="me-3">Boutique en ligne</h1>

        <nav class="d-flex gap-3 mx-auto">
            <a href="/" class="nav">Accueil <i class="bi bi-house"></i></a> 
            <a href="/panier" class="nav">Votre panier <i class="bi bi-cart4"></i></a> 
            <a href="" class="nav">Vos commandes <i class="bi bi-box-seam"></i></a> 
            <a href="" class="nav">Nous contacter <i class="bi bi-envelope"></i></a> 
        </nav>
        
        <div class=" d-flex gap-2">
            <a href="/signin" class="signin">S'inscrire <i class="bi bi-person-plus"></i></a> 
            <a href="/login" class="login">Se connecter <i class="bi bi-box-arrow-in-right"></i></a> 
        </div>
        
    </div>
</header>
<!-- Zone de contenu principal -->
<main>
    <!-- Insère le contenu rendu de la vue -->
    <?= $content ?>
    
</main>
<!-- Fin du corps de la page -->
</body>
<!-- Fin du document HTML -->
</html>

