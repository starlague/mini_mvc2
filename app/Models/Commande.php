<?php
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Commande {
    private int $id;
    private int $userId;
    private float $total;
    private string $statut;
    private string $dateCommande;
    private string $adresseLivraison;

    // Getters
    public function getId(): int {
        return $this->id;
    }
    
    public function getUserId(): int {
        return $this->userId;
    }
    
    public function getTotal(): float {
        return $this->total;
    }
    
    public function getStatut(): string {
        return $this->statut;
    }
    
    public function getDateCommande(): string {
        return $this->dateCommande;
    }
    
    public function getAdresseLivraison(): string {
        return $this->adresseLivraison;
    }

    // Setters
    public function setId(int $id) {
        $this->id = $id;
    }
    
    public function setUserId(int $userId) {
        $this->userId = $userId;
    }
    
    public function setTotal(float $total) {
        $this->total = $total;
    }
    
    public function setStatut(string $statut) {
        $this->statut = $statut;
    }
    
    public function setDateCommande(string $dateCommande) {
        $this->dateCommande = $dateCommande;
    }
    
    public function setAdresseLivraison(string $adresseLivraison) {
        $this->adresseLivraison = $adresseLivraison;
    }

    /**
     * Crée une commande à partir du panier de l'utilisateur
     * Lit directement depuis la table paniers et transfère vers commandes
     */
    public function createFromPanier(string $adresseLivraison): bool {
        $pdo = Database::getPDO();
        
        try {
            $pdo->beginTransaction();
            
            // Récupération des articles du panier avec leurs prix
            $sql = "SELECT p.id, p.prix, pa.quantite
                    FROM paniers pa
                    JOIN produits p ON p.id = pa.produit_id
                    WHERE pa.user_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->userId]);
            $panierItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($panierItems)) {
                $pdo->rollBack();
                return false;
            }
            
            // Calcul du total
            $total = 0;
            foreach ($panierItems as $item) {
                $total += $item['prix'] * $item['quantite'];
            }
            
            // Insertion de la commande
            $sql = "INSERT INTO commandes (user_id, total, statut, adresse_livraison) 
                    VALUES (?, ?, 'en_attente', ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->userId, $total, $adresseLivraison]);
            $commandeId = $pdo->lastInsertId();
            
            // Transfert des produits du panier vers commande_produit
            $sql = "INSERT INTO commande_produit (commande_id, produit_id, quantite, prix_unitaire) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            foreach ($panierItems as $item) {
                $stmt->execute([
                    $commandeId,
                    $item['id'],
                    $item['quantite'],
                    $item['prix']
                ]);
            }
            
            // Vider le panier après validation (suppression de tous les articles)
            $sql = "DELETE FROM paniers WHERE user_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->userId]);
            
            $pdo->commit();
            $this->id = (int)$commandeId;
            $this->total = $total;
            return true;
            
        } catch (\Exception $e) {
            $pdo->rollBack();
            error_log("Erreur création commande: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Récupère toutes les commandes d'un utilisateur
     */
    public static function getUserOrders(int $userId): array {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM commandes WHERE user_id = ? ORDER BY date_commande DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une commande avec ses produits
     */
    public static function getOrderWithProducts(int $commandeId): array {
        $pdo = Database::getPDO();
        
        // Récupération de la commande
        $sql = "SELECT * FROM commandes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$commandeId]);
        $commande = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$commande) {
            return [];
        }
        
        // Récupération des produits de la commande
        $sql = "SELECT cp.*, p.nom, p.image 
                FROM commande_produit cp
                JOIN produits p ON p.id = cp.produit_id
                WHERE cp.commande_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$commandeId]);
        $commande['produits'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $commande;
    }

    /**
     * Met à jour le statut d'une commande
     */
    public function updateStatut(string $nouveauStatut): bool {
        $pdo = Database::getPDO();
        $sql = "UPDATE commandes SET statut = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nouveauStatut, $this->id]);
    }
}