CREATE TABLE produto(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao varchar(100) NOT NULL UNIQUE,
    estoque INT DEFAULT 0,
    preco_compra DECIMAL(10,2) NOT NULL,
    tipo CHAR(2) DEFAULT 'P', -- 'P' Produto, 'PT' Produto Tributado'
    imposto DECIMAL(4, 2) DEFAULT 0
 )ENGINE = INNODB;


 INSERT INTO produto (descricao, estoque, preco_compra, tipo, imposto) VALUES 
 ('Água Mineral', 100, 2.50, 'P', 0),
 ('Refrigerante', 3, 4.50, 'PT', 30),
 ('Notebook Acme', 9, 2000, 'PT', 80),
 ('Chinelo XPTO', 20, 9.50, 'P', 0);


 SELECT * FROM produto;

 SELECT * FROM produto WHERE descricao LIKE "%a%";

 SELECT COUNT(id) as contagem FROM produto;

 SELECT descricao, preco_compra * estoque AS inventario FROM produto;

 SELECT CAST(AVG(preco_compra) AS DECIMAL(10,2)) FROM produto;

 SELECT descricao, tipo FROM produto
 GROUP BY tipo;

