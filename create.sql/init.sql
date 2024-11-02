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
    anio INT,
    precio INT,
    foto VARCHAR(50)
);

INSERT INTO coches (marca, modelo, anio, precio, foto) VALUES
    ('SEAT', '600', 1957, 3500, '600.png'),
    ('SEAT', '124', 1968, 4500, '124.png'),
    ('SEAT', '1500', 1963, 5000, '1500.png'),
    ('SEAT', '850', 1966, 1400, '850.png'),
    ('SEAT', '127', 1971, 750, '127.png'),
    ('SEAT', '131', 1973, 5000, '131.png'),
    ('Renault', '4', 1961, 3000, '4.png'),
    ('Renault', '8', 1962, 2500, '8.png'),
    ('Renault', '5', 1972, 1750, '5.png'),
    ('Citroën', '2CV', 1948, 4700, '2cv.png');
