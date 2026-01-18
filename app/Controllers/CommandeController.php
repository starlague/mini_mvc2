<?php
declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Commande;
use Mini\Models\Panier;

class CommandeController extends Controller {
    
    //affiche le formulaire de validation de commande
    //utilise la méthode getUserCart() existante du Panier
    public function checkout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /signin');
            exit;
        }

        $panier = new Panier();
        $articles = $panier->getUserCart($_SESSION['user']['id']);

        if (empty($articles)) {
            header('Location: /panier');
            exit;
        }

        //calcul du total (comme dans la vue panier)
        $total = 0;
        foreach ($articles as $article) {
            $total += $article['prix'] * $article['quantite'];
        }

        $this->render('commande/checkout', [
            'title' => 'Valider votre commande',
            'articles' => $articles,
            'total' => $total
        ]);
    }

    //traite la validation de la commande
    //transfère les données du panier vers la commande
    public function validate() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /signin');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /panier');
            exit;
        }

        $adresseLivraison = trim($_POST['adresse_livraison'] ?? '');
        
        if (empty($adresseLivraison)) {
            $_SESSION['error'] = 'Veuillez renseigner une adresse de livraison';
            header('Location: /commande/checkout');
            exit;
        }

        //vérifier que le panier n'est pas vide
        $panier = new Panier();
        $articles = $panier->getUserCart($_SESSION['user']['id']);

        if (empty($articles)) {
            $_SESSION['error'] = 'Votre panier est vide';
            header('Location: /panier');
            exit;
        }

        //créer la commande depuis le panier
        $commande = new Commande();
        $commande->setUserId($_SESSION['user']['id']);
        
        if ($commande->createFromPanier($adresseLivraison)) {
            $_SESSION['success'] = 'Votre commande a été validée avec succès !';
            header('Location: /commande/success?id=' . $commande->getId());
            exit;
        } else {
            $_SESSION['error'] = 'Une erreur est survenue lors de la validation de votre commande';
            header('Location: /commande/checkout');
            exit;
        }
    }

    //affiche la page de confirmation
    public function success() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /signin');
            exit;
        }

        $commandeId = (int)($_GET['id'] ?? 0);
        $commande = Commande::getOrderWithProducts($commandeId);

        if (empty($commande) || $commande['user_id'] != $_SESSION['user']['id']) {
            header('Location: /');
            exit;
        }

        $this->render('commande/success', [
            'title' => 'Commande validée',
            'commande' => $commande
        ]);
    }

    //affiche l'historique des commandes
    public function history() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /signin');
            exit;
        }

        $commandes = Commande::getUserOrders($_SESSION['user']['id']);

        $this->render('commande/history', [
            'title' => 'Mes commandes',
            'commandes' => $commandes
        ]);
    }

    //affiche les détails d'une commande
    public function details() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /signin');
            exit;
        }

        $commandeId = (int)($_GET['id'] ?? 0);
        $commande = Commande::getOrderWithProducts($commandeId);

        if (empty($commande) || $commande['user_id'] != $_SESSION['user']['id']) {
            header('Location: /commande/history');
            exit;
        }

        $this->render('commande/details', [
            'title' => 'Détails de la commande',
            'commande' => $commande
        ]);
    }
}