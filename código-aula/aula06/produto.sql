CREATE TABLE produto(
    id INT NOT NULL AUT_INCREMENT PRIMARY KEY,
    descricao VARCHAR(200) NOT NULL,
    estoque int DAFAULT 0,
    preco DECIMAL(10, 2) NOT NULL
)ENGINE = INNODB;

INSET INTO produto(id, descricao, estoque, preco) VALUES 
('1', 'Coca-Cola', 3, 5, 6.50),
('2', 'Refrigerante', 6, 5, 6.50),
('3', 'Água', 7, 5, 6.50),
