CREATE TABLE lutador(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
    idade INT NOT NULL,
	peso DECIMAL(5,2) NOT NULL,
	altura DECIMAL(3,2) NOT NULL
) ENGINE=INNODB;


INSERT INTO lutador (nome, idade, peso, altura)
VALUES
    ('João', 25, 70.5, 1.75),
    ('Maria', 30, 65.2, 1.60),
    ('Pedro', 28, 80.0, 1.85),
    ('Alice', 22, 55.8, 1.68),
    ('Lucas', 31, 78.3, 1.80),
    ('Isabela', 24, 63.7, 1.63),
    ('Gustavo', 27, 75.6, 1.78),
    ('Larissa', 29, 58.9, 1.70),
    ('Rafael', 26, 71.2, 1.72),
    ('Fernanda', 33, 68.4, 1.67),
    ('Bruno', 23, 85.0, 1.90),
    ('Mariana', 25, 61.1, 1.55),
    ('Rodrigo', 32, 77.8, 1.79),
    ('Amanda', 28, 53.5, 1.61),
    ('Felipe', 30, 70.0, 1.76),
    ('Sofia', 26, 62.4, 1.64),
    ('Eduardo', 29, 79.7, 1.83),
    ('Camila', 27, 56.2, 1.58),
    ('Carlos', 31, 74.9, 1.71),
    ('Laura', 24, 60.5, 1.66);
