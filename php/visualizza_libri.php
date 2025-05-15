<?php
session_start();

// Controllo login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connessione al database
require_once 'db.php';

// Ottieni solo i libri dell'utente loggato
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM books WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$libri = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Libri</title>
</head>
<body>
    <h1>I tuoi libri</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>Titolo</th>
                <th>Autore</th>
                <th>Anno</th>
                <th>Genere</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libri as $libro): ?>
                <tr>
                    <td><?php echo htmlspecialchars($libro['titolo']); ?></td>
                    <td><?php echo htmlspecialchars($libro['autore']); ?></td>
                    <td><?php echo htmlspecialchars($libro['anno']); ?></td>
                    <td><?php echo htmlspecialchars($libro['genere']); ?></td>
                    <td>
                        <a href="modifica_libro.php?id=<?php echo $libro['id']; ?>">Modifica</a> |
                        <a href="elimina_libro.php?id=<?php echo $libro['id']; ?>">Elimina</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php">← Torna alla Dashboard</a>
</body>
</html>
