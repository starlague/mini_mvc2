<?php
declare(strict_types= 1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Panier;

class PanierController extends Controller {
    public function panier() 
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /signin');
            exit;
        }

        $panier = new Panier();
        $articles = $panier->getUserCart($_SESSION['user']['id']);

        $this->render('panier/index', [
            'title'=> 'Votre panier',
            'articles'=> $articles,
        ]);
    }

    public function addToCart()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /signin');
            exit;
        }

        $userId    = $_SESSION['user']['id'];
        $produitId = (int)$_GET['produit_id']; 
        $quantite = (int)($_GET['quantite'] ?? 1);

        $panier = new Panier();
        $panier->setUserId($userId);
        $panier->setProduitId($produitId);
        $panier->setQuantite($quantite);

        $panier->saveOrAddCart();

        header('Location: /panier');
        exit;
    }

    public function decrease() 
    {
        session_start();

        $userId    = $_SESSION['user']['id'];
        $produitId = (int)$_GET['produit_id'];
        
        $panier = new Panier();
        $panier->decreaseQuantity($userId, $produitId);
        
        header('Location: /panier');
        exit;
    }

    public function delete()
    {
        session_start();

        $userId    = $_SESSION['user']['id'];
        $produitId = (int)$_GET['produit_id'];

        $panier = new Panier();
        $panier->deleteProduct($userId, $produitId);
        
        header('Location: /panier');
        exit;
    }
}