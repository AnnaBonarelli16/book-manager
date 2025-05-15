<?php
session_start();
header('Content-Type: application/json');

require_once 'Book.php';

$book = new Book();

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'Utente non autenticato']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Gestione richieste HTTP
switch ($_SERVER['REQUEST_METHOD']) {

    // 📖 GET – Leggi i libri
    case 'GET':
        $books = $book->getBooks($user_id);
        echo json_encode($books);
        break;

    // ➕ POST – Aggiungi libro
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (
            isset($data['title']) &&
            isset($data['author']) &&
            isset($data['year']) &&
            isset($data['genre'])
        ) {
            $book->addBook($data['title'], $data['author'], $data['year'], $data['genre'], $user_id);
            echo json_encode(['message' => 'Libro aggiunto']);
        } else {
            http_response_code(400); // Bad request
            echo json_encode(['error' => 'Dati incompleti']);
        }
        break;

    // ❌ DELETE – Elimina libro
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        if (isset($data['id'])) {
            $book->deleteBook($data['id']);
            echo json_encode(['message' => 'Libro eliminato']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID libro mancante']);
        }
        break;

    // Metodo non supportato
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Metodo non supportato']);
        break;
}
