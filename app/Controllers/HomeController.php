<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Produit;
use Mini\Models\User;

// Déclare la classe finale HomeController qui hérite de Controller
final class HomeController extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function index(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/index', [
            // Définit le titre transmis à la vue
            'title' => 'Boutique en ligne',
            'produits' => $produits = Produit::getAllProduct(),
        ]);
    }

    public function users(): void
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /signin');
            exit;
        } else {
            // Appelle le moteur de rendu avec la vue et ses paramètres
            $this->render('home/user/users', [
                // Définit le titre transmis à la vue
                'users' => $users = User::getAll(),
                'title' => 'Liste des utilisateurs',
            ]);
        }
    }

    public function signin(): void
    {
        $this->render('home/user/inscription', [
            'title' => 'Inscription',
        ]);
    }

    public function createUser(): void
    {
        session_start();

        if(empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['email'])) {
            echo 'Veuillez remplir tous les champs.';
            return;
        }

        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];

        $user = new User();
        $user->setPrenom($prenom);
        $user->setNom($nom);
        $user->setEmail($email);

        $user->save();

        $_SESSION["user"] = [
            "id" => $user->getId(),
            "prenom"=> $user->getPrenom(),
            "nom"=> $user->getNom(),
            "email"=> $user->getEmail(),
        ];

        header('Location: /');
        exit; 
    }

    public function login(): void  
    {
        $this->render('home/user/connexion', [
            'title'=> 'Connexion',
        ]);
    }

    public function userExisting(): void
    {
        session_start();

        if(empty($_POST['email'])) {
            echo 'Veuillez mettre votre email.';
            return;
        } 

        $email = $_POST['email'];
        $user = User::findByEmail($email);

        if (!$user) {
            echo "Utilisateur introuvable";
            return;
        }

        $_SESSION["user"] = [
            "id" => $user['id'],
            "prenom"=> $user['prenom'],
            "nom"=> $user['nom'],
            "email"=> $user['email'],
        ];
        
        header('Location: /');
        exit;
        
    }

    public function detailsProduit(): void
    {
        $id = (int) $_GET['id'];  

        $produit = Produit::getProductById($id);

        $this->render('home/produit/details', [
            'produit' => $produit,
            'title' => 'Détails du produit',
        ]);
    }
}