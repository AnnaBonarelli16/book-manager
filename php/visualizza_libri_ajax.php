<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Libri</title>
    <script>
        // Funzione per caricare i libri tramite AJAX
        function loadBooks() {
            // Creiamo una richiesta AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "api/books.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            // Quando la risposta arriva
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Se la richiesta è andata a buon fine
                    var books = JSON.parse(xhr.responseText);
                    var booksList = document.getElementById('booksList');
                    booksList.innerHTML = ''; // Pulisce la lista esistente

                    // Aggiungi i libri alla lista
                    books.forEach(function(book) {
                        var li = document.createElement('li');
                        li.textContent = book.title + ' - ' + book.author;
                        booksList.appendChild(li);
                    });
                } else {
                    console.log("Errore nella richiesta AJAX");
                }
            };

            xhr.send();
        }

        // Carica i libri quando la pagina è pronta
        window.onload = function() {
            loadBooks();
        };
    </script>
</head>
<body>
    <h1>Libri nel Sistema</h1>
    <ul id="booksList">
        <!-- I libri saranno aggiunti qui -->
    </ul>
</body>
</html>
