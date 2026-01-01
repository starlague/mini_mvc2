<?php
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Produit {

    //attributs
    private int $id;
    private string $nom;
    private float $prix;
    private string $description;
    private string $image;

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
    public function getDescription() {
        return $this->description;
    }
    public function getImage() {
        return $this->image;
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
    public function setDescription(string $description) {
        $this->description = $description;
    }
    public function setImage(string $image) {
        $this->image = $image;
    }

    //méthodes
    public static function getAllProduct() {
       $pdo = Database::getPDO();
       $stmt = $pdo->query("SELECT * FROM produits");
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProductById(int $id) {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
