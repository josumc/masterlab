DROP DATABASE IF EXISTS test_db;

CREATE DATABASE IF NOT EXISTS test_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use test_db
;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    username VARCHAR(50),
    email VARCHAR(100),
    pass VARCHAR(50),
    apikey VARCHAR(50),
    address VARCHAR(50),
    description VARCHAR(250),
    image VARCHAR(50)
);

INSERT INTO users (name, username, email, pass, address, apikey, description, image) VALUES ('Juan Valdivia', 'juanvaldivia91', 'jvaldivia91@outluck.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Calle del Silencio, 3', '2ee30372a2a6b82ed02ac06cebdee58c', 'Me gustan los coches clásicos y el rock!', 'valdivia.jpeg');
INSERT INTO users (name, username, email, pass, address, apikey, description, image) VALUES ('Pedro Andreu', 'pedroandreu87', 'pandreu87@jmail.com', 'b59c67bf196a4758191e42f76670ceba', 'Calle del Tambor, 45', '84e8cd18301caf8a296bd79cc3d2555f', 'Los buenos coches como el vino, mejoran con los años!', 'andreu.jpeg');
INSERT INTO users (name, username, email, pass, address, apikey, description, image) VALUES ('Azucena Martin','azucenamartin76', 'amartin76@jmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Avenida Baja, 16', 'f6569f43a06a12e20286ed989a0b2ea1', 'Clásicos siempre!!!', 'azucena.jpeg');

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

CREATE TABLE IF NOT EXISTS likes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  car_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (car_id) REFERENCES coches(id)
);

INSERT INTO likes (user_id, car_id) VALUES (1, 1);
INSERT INTO likes (user_id, car_id) VALUES (2, 1);
INSERT INTO likes (user_id, car_id) VALUES (3, 2);


