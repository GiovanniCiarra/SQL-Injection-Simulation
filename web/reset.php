<?php
include 'db.php';

$sql = file_get_contents(__DIR__ . '/init.sql');

echo "<pre>📄 Contenuto SQL:\n" . htmlspecialchars($sql) . "</pre>";

if (!$sql) {
    echo "<h3>❌ Errore: init.sql vuoto o non trovato.</h3>";
    exit;
}

if ($conn->multi_query($sql)) {
    echo "<h3>✅ Database ripristinato con successo.</h3>";
    do {
        // Avanza attraverso i risultati multipli
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
} else {
    echo "<h3>❌ Errore durante il ripristino:</h3>";
    echo "<pre>" . $conn->error . "</pre>";
}
?>
