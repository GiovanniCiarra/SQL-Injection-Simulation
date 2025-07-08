/* Questo script serve ad inizializzare il db, assegnando valori di default */

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);

INSERT INTO users (username, password) VALUES
('Giovanni', 'ciao123'),
('Marco', 'forzaRoma'),
('Emanuele', 'Ema02'),
('Federico', 'FedeDiFiano'),
('Admin', 'admin1'),
('user', '123456789');
