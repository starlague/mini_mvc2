<?php
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Produit {

    //attributs
    private int $id;
    private string $nom;
    private float $prix;

    //getters
    public function getId() {
        return $this->id;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getPrix() {
        return $this->prix;
    }

    //setters
    public function setId(int $id) {
        $this->id = $id;
    }
    public function setNom(string $nom) {
        $this->nom = $nom;
    }
    public function setPrix(float $prix) {
        $this->prix = $prix;
    }

    //méthode
    public function getAllProduct() {
       $pdo = Database::getPDO();
       $stmt = $pdo->query("SELECT * FROM produits");
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
