<?php
session_start(); // Avvia la sessione

// Verifica se il form è stato inviato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connetti al database
    require_once 'db.php'; // Assicurati che il percorso di db.php sia corretto

    // Ottieni i dati dal form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se l'utente esiste nel database
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Verifica la password
    if ($user && password_verify($password, $user['password'])) {
        // Login riuscito, crea la sessione dell'utente
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // Reindirizza alla dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Login effettuato.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Accedi</button>
    </form>
</body>
</html>
