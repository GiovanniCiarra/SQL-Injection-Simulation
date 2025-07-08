<?php
/* Si occupa della gestione delle query sql */
$host = 'db';
$user = 'user';
$password = 'password';
$database = 'vulnerable_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

?>
