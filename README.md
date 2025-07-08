Progetto realizzato da:

- Giovanni Ciarravano, 1989209
- Marco Linardi, 2003980

L'obiettivo del progetto è quello di simulare un attacco SQL Injection.Per farlo sono stati creati una interfaccia web e un database vulnerabili.

Il file docker-compose.yml permette di avviare il tutto utilizzando un solo comando: $docker compose up

Nella cartella web sono presenti i seguenti file:

- init.sql: gestisce l'inizializzazione del database e lo popola con dati iniziali;
- db.php: gestisce le query che vengono inviate al db;
- index.php: rappresenta la pagina di login, in cui l'utente può inserire username e password e dove l'attaccante può iniettare il codice malevolo;
- login.php: gestisce i dati del login e reindirizza l'utente a result.php;
- result.ph: rappresenta la pagina in cui vengono mostrati i dati ritornati dalla query. Al fine didattico, la pagina presenta anche la query
  che è stata eseguita e lo stato attuale del database;
- reset.php: è uno script utile a resettare lo stato iniziale del database.
