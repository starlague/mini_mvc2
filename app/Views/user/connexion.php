<?php
//vérifier que l'email est dans la base de donnée 
//et peut-être le mettre en session
?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="error text-center">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>


<h2 class="text-center mb-3">Connexion</h2>

<div class="d-flex justify-content-center">
    <form action="" method="post" class="w-50 d-flex flex-column gap-3">
        <div>
            <label for="email">Email : </label>
            <input type="text" name="email" id="email" class="form-control" required>
        </div>
        
        <div>
            <button type="submit" class="submit">Connexion</button>
        </div>
    </form>
</div>