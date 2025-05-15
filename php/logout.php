<?php
session_start(); // Avvia la sessione

// Distruggi tutte le sessioni
session_unset(); 
session_destroy(); 

// Reindirizza alla pagina di login
header("Location: login.php");
exit();
?>
