<?php
// Includi il file di connessione al database
require_once("db.php");

// Verifica se l'utente è loggato, altrimenti reindirizza alla pagina di login
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Se il form è stato inviato (metodo POST), allora processa i dati
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titolo = $_POST['titolo'] ?? '';
    $autore = $_POST['autore'] ?? '';
    $anno = $_POST['anno'] ?? '';
    $genere = $_POST['genere'] ?? '';
    $user_id = $_SESSION['user_id'];

    if (empty($titolo) || empty($autore) || empty($anno) || empty($genere)) {
        die("Per favore inserisci tutti i campi richiesti.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO books (titolo, autore, anno, genere, user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$titolo, $autore, $anno, $genere, $user_id]);

        header("Location: visualizza_libri.php");
        exit();
    } catch (PDOException $e) {
        die("Errore durante l'aggiunta del libro: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Libro</title>
</head>
<body>
    <h1>Aggiungi un nuovo libro</h1>

    <form action="aggiungi_libro.php" method="POST">
        <label for="titolo">Titolo:</label>
        <input type="text" name="titolo" required><br><br>

        <label for="autore">Autore:</label>
        <input type="text" name="autore" required><br><br>

        <label for="anno">Anno di pubblicazione:</label>
        <input type="text" name="anno" required><br><br>

        <label for="genere">Genere:</label>
        <input type="text" name="genere" required><br><br>

        <button type="submit">Aggiungi Libro</button>
    </form>

    <a href="dashboard.php">← Torna alla Dashboard</a>
</body>
</html>

