<?php
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Panier {
    //attributs
    private int $id;
    private int $userId;
    private int $produitId;
    private int $quantite;

    //getters
    public function getId(): int {
        return $this->id;
    }
    public function getUserId(): int {
        return $this->userId;
    }
    public function getProduitId(): int {
        return $this->produitId;
    }
    public function getQuantite(): int {
        return $this->quantite;
    }

    //setters
    public function setId(int $id){
        $this->id = $id;
    }
    public function setUserId(int $userId){
        $this->userId = $userId;
    }
    public function setProduitId(int $produitId){
        $this->produitId = $produitId;
    }
    public function setQuantite(int $quantite){
        $this->quantite = $quantite;
    }

    //méthodes
    public function saveOrAddCart() {
        $pdo = Database::getPDO();

        $sql = "SELECT id, quantite 
                FROM paniers 
                WHERE user_id = ? AND produit_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->userId, $this->produitId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $newQuantity = $row['quantite'] + $this->quantite;
            $sql = "UPDATE paniers SET quantite = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$newQuantity, $row['id']]);
        } else {
            $sql = "INSERT INTO paniers (user_id, produit_id, quantite)
                    VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$this->userId, $this->produitId, $this->quantite]);
        }
    }

    public function getUserCart(int $userId){
        $pdo = Database::getPDO();

        $sql = "SELECT p.id, p.nom, p.image, p.prix, pa.quantite
                FROM paniers pa
                JOIN produits p ON p.id = pa.produit_id
                WHERE pa.user_id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function decreaseQuantity(int $userId, int $produitId){
        $pdo = Database::getPDO();

        $sql = "SELECT id, quantite FROM paniers WHERE user_id = ? AND produit_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $produitId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $newQuantity = $row["quantite"] - 1;

        if ($newQuantity <= 0 ) {
            $sql = "DELETE FROM paniers WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([ $row["id"]]);
        } else {
            $sql = "UPDATE paniers Set quantite = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$newQuantity, $row["id"]]);
        }
    }

    public function deleteProduct(int $userId, int $produitId) {
        $pdo = Database::getPDO();
        $sql = "DELETE FROM paniers WHERE user_id = ? AND produit_id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$userId, $produitId]);
    }
}