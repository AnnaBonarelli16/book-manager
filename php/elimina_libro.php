<?php
session_start();

// Verifica che l'utente sia loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Controlla se è stato passato un ID valido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID libro non valido.");
}

$book_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Connessione al database
require_once 'db.php';

try {
    // Verifica che il libro appartenga all'utente loggato
    $check = $pdo->prepare("SELECT * FROM books WHERE id = :id AND user_id = :user_id");
    $check->execute(['id' => $book_id, 'user_id' => $user_id]);
    $libro = $check->fetch();

    if (!$libro) {
        die("Libro non trovato o non autorizzato.");
    }

    // Elimina il libro
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $book_id, 'user_id' => $user_id]);

    // Torna all’elenco dei libri
    header("Location: visualizza_libri.php");
    exit();
} catch (PDOException $e) {
    die("Errore durante l'eliminazione: " . $e->getMessage());
}

