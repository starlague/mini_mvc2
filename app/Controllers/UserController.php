<?php
declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\User;

class UserController extends Controller
{
    public function signin(): void
    {
        $this->render('user/inscription', [
            'title' => 'Inscription',
        ]);
    }
    public function createUser(): void
    {
        session_start();

        if(empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['email'])) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs.';
            header('Location: /signin');
            exit;
        }

        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);

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
        $this->render('user/connexion', [
            'title'=> 'Connexion',
        ]);
    }
    public function userExisting(): void
    {
        session_start();

        if(empty($_POST['email'])) {
            $_SESSION['error'] = 'Veuillez mettre votre email.';
            header('Location: /login');
            exit;
        } 

        $email = htmlspecialchars($_POST['email']);
        $user = User::findByEmail($email);

        if (!$user) {
            $_SESSION['error'] = "Utilisateur introuvable"; 
            header('Location: /login');
            exit;   
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

    public function logout() 
    {
        session_start();
        session_destroy();
        
        header('Location: /');
        exit;
    }

}