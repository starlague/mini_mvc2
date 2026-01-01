<h2 class="text-center mb-3">Connexion</h2>

<div class="d-flex justify-content-center">
    <form action="/login" method="post" class="w-50 d-flex flex-column gap-3">
        <label for="email">Email : </label>
        <input type="text" name="email" id="email" class="form-control" required>

        <div>
            <button type="submit" class="submit">Connexion</button>
        </div>
    </form>
</div>

<?php
//vérifier que l'email est dans la base de donnée 
//et peut-être le mettre en session
session_start()
?>