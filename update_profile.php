<?php
session_start();

// Controlla se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Se non è loggato, lo rimanda al login
    exit();
}

// Connessione al database
require_once 'php/db.php';

// Prendi l'ID e l'username dell'utente loggato
$username = $_SESSION['username'];

// Prepara la query per ottenere i dati dell'utente
$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

// Se l'utente non esiste nel database (caso raro), faremo un controllo
if (!$user) {
    echo "Utente non trovato.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Profilo</title>
</head>
<body>
    <h1>Modifica Profilo</h1>

    <!-- Modulo per l'aggiornamento dell'username e password -->
    <form action="update_profile.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>

        <label for="password">Nuova Password:</label>
        <input type="password" id="password" name="password" placeholder="Lascia vuoto se non vuoi cambiare la password"><br>

        <button type="submit">Salva Modifiche</button>
    </form>

    <a href="dashboard.php">Torna alla dashboard</a>
</body>
</html>
