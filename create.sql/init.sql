DROP DATABASE IF EXISTS test_db;
CREATE DATABASE IF NOT EXISTS test_db;

USE test_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    pass VARCHAR(50)
);

INSERT INTO users (username, email, pass) VALUES ('usuario1', 'usuario1@example.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO users (username, email, pass) VALUES ('usuario2', 'usuario2@example.com', 'b59c67bf196a4758191e42f76670ceba');
INSERT INTO users (username, email, pass) VALUES ('usuario3', 'usuario3@example.com', '827ccb0eea8a706c4c34a16891f84e7b');

CREATE TABLE IF NOT EXISTS coches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    cilindrada INT,
    consumo FLOAT,
    anio INT
);

INSERT INTO coches (marca, modelo, cilindrada, consumo, anio) VALUES
    ('SEAT', '600', 600, 6.0, 1957),
    ('SEAT', '124', 1197, 8.0, 1968),
    ('SEAT', '1500', 1471, 9.5, 1963),
    ('SEAT', '850', 843, 5.5, 1966),
    ('SEAT', '127', 1010, 7.0, 1971),
    ('SEAT', '1430', 1438, 10.0, 1969),
    ('Renault', '4', 845, 7.5, 1961),
    ('Renault', '8', 956, 8.0, 1962),
    ('Renault', '5', 956, 6.5, 1972),
    ('Citroën', '2CV', 375, 5.0, 1948);