<?php
declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Produit;

class ProduitController extends Controller
{
    public function productDetails(): void
    {
        $id = (int) $_GET['id'];  

        $produit = Produit::getProductById($id);

        $this->render('produit/index', [
            'produit' => $produit,
            'title' => 'Détails du produit',
        ]);
    }
}