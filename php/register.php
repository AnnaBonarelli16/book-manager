<?php
require_once("db.php");

// Prendi i dati dal form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Verifica che i dati non siano vuoti
if (empty($username) || empty($password)) {
    die("Per favore inserisci username e password.");
}

// Cifra la password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // Prepara la query per inserire il nuovo utente
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);

    // Avvia la sessione
    session_start();
    $_SESSION['username'] = $username;

    // Reindirizza alla dashboard
    header("Location: ../dashboard.html");
    exit();

} catch (PDOException $e) {
    die("Errore durante la registrazione: " . $e->getMessage());
}