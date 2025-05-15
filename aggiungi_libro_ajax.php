<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Libro</title>
    <script>
        // Funzione per aggiungere un libro tramite AJAX
        function addBook(event) {
            event.preventDefault(); // Impedisce il comportamento predefinito del form

            // Ottieni i valori dal form
            var title = document.getElementById('title').value;
            var author = document.getElementById('author').value;
            var year = document.getElementById('year').value;
            var genre = document.getElementById('genre').value;

            // Crea l'oggetto per la richiesta
            var bookData = {
                title: title,
                author: author,
                year: year,
                genre: genre
            };

            // Creiamo una richiesta AJAX per inviare il libro
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "api/books.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Libro aggiunto con successo!");
                    loadBooks(); // Ricarica la lista dei libri
                } else {
                    alert("Errore durante l'aggiunta del libro.");
                }
            };

            xhr.send(JSON.stringify(bookData)); // Invia i dati come JSON
        }
    </script>
</head>
<body>
    <h1>Aggiungi un Nuovo Libro</h1>
    
    <form onsubmit="addBook(event)">
        <label for="title">Titolo:</label>
        <input type="text" id="title" required><br><br>
        
        <label for="author">Autore:</label>
        <input type="text" id="author" required><br><br>
        
        <label for="year">Anno di pubblicazione:</label>
        <input type="number" id="year" required><br><br>
        
        <label for="genre">Genere:</label>
        <input type="text" id="genre" required><br><br>

        <button type="submit">Aggiungi Libro</button>
    </form>

    <br>

    <h2>Libri nel Sistema</h2>
    <ul id="booksList">
        <!-- La lista dei libri sarà mostrata qui -->
    </ul>
</body>
</html>
