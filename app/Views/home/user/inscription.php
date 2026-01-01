<h2 class="text-center mb-3">Inscription</h2>

<div class="d-flex justify-content-center">
    <form action="" method="post" class="w-50 d-flex flex-column gap-3">
        <div>
            <label for="prenom">Prénom : </label>
            <input type="text" name="prenom" id="prenom" class="form-control" required>
        </div>

        <div>
            <label for="nom">Nom : </label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div>
            <label for="email">Email : </label>
            <input type="text" name="email" id="email" class="form-control" required>
        </div>

        <div>
            <button type="submit" class="submit">Valider</button>
        </div>
    </form>
</div>
<?php
//mettre le user en session?
session_start();
?>