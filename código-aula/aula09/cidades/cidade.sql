CREATE TABLE cidade(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60) NOT NULL UNIQUE
)ENGINE=INNODB;

CREATE TABLE contato(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone CHAR(11) NOT NULL UNIQUE,
    cidade_id INT NOT NULL,
    CONsTRAINT fk_contato_cidade_id FOREIGN KEY (cidade_id),
    REFERENCES cidade(id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=INNODB;


-- Inserir dados na tabela cidade
INSERT INTO cidade (nome) VALUES
('São Paulo'),
('Rio de Janeiro'),
('Belo Horizonte'),
('Salvador');

-- Inserir dados na tabela contato
INSERT INTO contato (nome, telefone, cidade_id) VALUES
('João', '11987654321', 1),   -- João em São Paulo
('Maria', '21987654321', 2),  -- Maria no Rio de Janeiro
('Pedro', '31876543210', 3),  -- Pedro em Belo Horizonte
('Ana', '71876543210', 4);    -- Ana em Salvador
