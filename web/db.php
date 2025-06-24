<?php
$host = 'db';
$user = 'user';
$password = 'password';
$database = 'vulnerable_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Funzione helper per eseguire query multiple (piggybacked)
function run_multi_query($conn, $query) {
    if ($conn->multi_query($query)) {
        do {
            if ($result = $conn->store_result()) {
                return $result; // ritorna il primo result set utile
            }
        } while ($conn->more_results() && $conn->next_result());
    }
    return false;
}
?>
