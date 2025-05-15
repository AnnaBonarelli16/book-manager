<?php

class Book {
    private $pdo;

    // Costruttore: riceve l'oggetto PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Aggiungi un libro al database
    public function addBook($titolo, $autore, $anno, $genere, $user_id) {
        try {
            $sql = "INSERT INTO books (titolo, autore, anno, genere, user_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$titolo, $autore, $anno, $genere, $user_id]);
        } catch (PDOException $e) {
            die("Errore durante l'aggiunta del libro: " . $e->getMessage());
        }
    }

    // Recupera tutti i libri di un utente
    public function getBooks($user_id) {
        try {
            $sql = "SELECT * FROM books WHERE user_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Errore durante il recupero dei libri: " . $e->getMessage());
        }
    }

    // Elimina un libro solo se appartiene all'utente
    public function deleteBook($book_id, $user_id) {
        try {
            $sql = "DELETE FROM books WHERE id = ? AND user_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$book_id, $user_id]);
        } catch (PDOException $e) {
            die("Errore durante la cancellazione del libro: " . $e->getMessage());
        }
    }
}
?>

