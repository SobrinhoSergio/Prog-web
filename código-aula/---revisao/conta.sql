CREATE TABLE conta(
    id CHAR(10) NOT NULL PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL,
    tipo VARCHAR(1) NOT NULL, -- C=CRÉDITO, D=DÉBITO
    valor DECIMAL(10, 2) DEFAULT 0,
    paga TINYINT(1) DEFAULT 0,
    vencimento DATE NOT NULL -- 0 = NÃO PAGA, 1 = PAGA
)ENGINE=INNODB;

INSERT INTO conta (id, descricao, tipo, valor, paga, vencimento) 
VALUES 
('0000000001', 'Pagamento de luz', 'D', 150.75, 0, '2024-07-10'),
('0000000002', 'Recebimento de salário', 'C', 2500.00, 1, '2024-07-01'),
('0000000003', 'Pagamento de internet', 'D', 100.00, 0, '2024-07-15'),
('0000000004', 'Compra de supermercado', 'D', 300.50, 1, '2024-07-03');

