<?php
// Avvia la sessione
session_start();

// Controlla se l'utente è loggato
if (!isset($_SESSION['username'])) {
    // Se non è loggato, reindirizza alla pagina di login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Benvenuto, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Sei connesso al sistema.</p>

    <ul>
        <li><a href="aggiungi_libro.php">📘 Aggiungi un libro</a></li>
        <li><a href="visualizza_libri.php">📚 Visualizza i tuoi libri</a></li>
        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</body>
</html>

