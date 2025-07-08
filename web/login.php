<?php
/* Viene gestito il login dell'utente, assegnando i valori a username e password, 
    eseguendo le query sql necessarie e reindirizzando l'utente alla pagina result.php */

session_start();
include 'db.php';

// Recupera username e password inseriti dall'utente, che poi vengono inseriti direttamente nella query
$username = $_POST['username'];
$password = $_POST['password'];

// Query non parametrizzata
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$_SESSION['query'] = $query;

// Vengono inizializzate le variabili per il successo del login e i dati restituiti dalla query
$_SESSION['login_success'] = false;
$_SESSION['login_data'] = [];

// Viene utilizzato multi_query per permettere attacchi Piggybacked
if ($conn->multi_query($query)) {
    do {
        if ($result = $conn->store_result()) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $result->free();

            // Salva i dati se la SELECT ha restituito qualcosa
            if (count($rows) > 0) {
                $_SESSION['login_data'] = array_merge($_SESSION['login_data'], $rows);
                $_SESSION['login_success'] = true;
            }
        }
    } while ($conn->more_results() && $conn->next_result());
} else {
    $_SESSION['query_error'] = $conn->error;
}

// L'utente viene reindirizzato alla pagina result.php
header("Location: result.php");
exit;
?>

