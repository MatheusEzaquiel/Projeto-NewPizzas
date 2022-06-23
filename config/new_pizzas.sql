-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Jun-2022 às 14:30
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `new_pizzas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin`
--

CREATE TABLE `tb_admin` (
  `idAdmin` int(11) NOT NULL,
  `nomeAdmin` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `emailAdmin` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `senhaAdmin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fotoAdmin` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_admin`
--

INSERT INTO `tb_admin` (`idAdmin`, `nomeAdmin`, `emailAdmin`, `senhaAdmin`, `fotoAdmin`) VALUES
(1, 'Administrador', 'adm@gmail.com', 'QURN', '62b084d3dd665.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_carrinho`
--

CREATE TABLE `tb_carrinho` (
  `idPedido` int(11) NOT NULL,
  `identificadorCliente` int(11) NOT NULL,
  `identificadorProduto` int(11) NOT NULL,
  `nomeProduto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tamanhoPizza` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bordaPizza` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precoBorda` decimal(5,2) DEFAULT NULL,
  `quantidadeProduto` int(10) NOT NULL,
  `precoProduto` decimal(7,2) NOT NULL,
  `precoPedido` decimal(7,2) NOT NULL,
  `fotoProduto` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `estadoPedido` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_carrinho`
--

INSERT INTO `tb_carrinho` (`idPedido`, `identificadorCliente`, `identificadorProduto`, `nomeProduto`, `tamanhoPizza`, `bordaPizza`, `precoBorda`, `quantidadeProduto`, `precoProduto`, `precoPedido`, `fotoProduto`, `estadoPedido`) VALUES
(332, 1, 1, 'Calabresa', 'M', 'Sem borda', '0.00', 2, '21.00', '42.00', '627b1320ca6e3.jpg', 1),
(333, 1, 37, 'Portuguesa', 'G', 'Catupiry artesanal', '4.00', 4, '35.00', '156.00', '627999a8a4df3.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `idCliente` int(11) NOT NULL,
  `nomeCliente` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `emailCliente` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `enderecoCliente` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefoneCliente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `senhaCliente` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`idCliente`, `nomeCliente`, `emailCliente`, `enderecoCliente`, `telefoneCliente`, `senhaCliente`) VALUES
(1, 'Teste', 'teste@gmail.com', 'bairro teste, rua teste, n° 202', '00000000000', 'dGVzdGU='),
(2, 'Lauro Mercedes', 'lauroM@gmail.com', 'bairro Link, rua dos provedores, rua  ipv4', '85995226475', 'MTIz'),
(3, 'Renata Pereira Costa', 'renata@gmail.com', 'bairro Modal II, rua Sen. Fenício de Oliveira, nº202', '85992685732', 'MTIz'),
(4, 'Luan', 'luan@gmail.com', 'bairro Modal I, rua  dos campos, nº105', '85997685532', 'bHVhbg=='),
(5, 'Suehtam', 'suehtham@outlook.com', 'bairro Lunas Cruz, rua Lua Prata, 202', '85994556780', 'MTIz'),
(6, 'Matheus', 'matheus@outlook.com', 'bairro Lunas Cruz, rua Lua Prata, 202', '85994556780', 'MTIz'),
(7, 'Leila Alves', 'leila@gmail.com', 'bairro A, rua B, casa C', '85997665326', 'MTIz'),
(8, 'teste2', 'teste2@gmail.com', 'bairro 123, rua 456, mº 789', '85996525547', 'MTIz'),
(9, 'Átila', 'a@gmail.com', 'a/a/a', '85996565446', 'MTIz'),
(10, 'leticia', 'le@gmail.com', 'bairro Lunas Cruz, rua Lua Prata, 202', '85994556780', 'MTAxMDEwMTA=');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pagamento`
--

CREATE TABLE `tb_pagamento` (
  `idPagamento` int(11) NOT NULL,
  `informacaoAdicional` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `clientePagamento` int(11) NOT NULL,
  `totalPagamento` decimal(7,2) NOT NULL,
  `tipoPagamento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipoEntrega` set('entrega','retirar no local') COLLATE utf8_unicode_ci NOT NULL,
  `enderecoCliente` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `idProduto` int(11) NOT NULL,
  `tipoProduto` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeProduto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamanhoProduto` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricaoProduto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precoProduto` decimal(7,2) NOT NULL,
  `fotoProduto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`idProduto`, `tipoProduto`, `nomeProduto`, `tamanhoProduto`, `descricaoProduto`, `precoProduto`, `fotoProduto`) VALUES
(1, 'PIZZA', 'Calabresa', 'M', 'Uma deliciosa pizza de calabresa!', '21.00', '627b1320ca6e3.jpg'),
(4, 'PIZZA', 'Mussarela', 'M', 'Uma super pizza de sabor mussarela!', '21.00', '627b171111b1b.jpg'),
(5, 'PIZZA', 'Portuguesa', 'M', 'Ingrendientes: queijo mussarela, tomate, cebola, orégano', '23.00', '627999a8a4df3.jpg'),
(8, 'PIZZA', 'Soda', '350mL', 'Uma soda para refrescar o corpo nesse verão', '4.00', '62b29e5d011fa.png'),
(9, 'BEBIDA', 'Coca-Cola', '350mL', 'Uma coquinha gelada para alegrar seu coração S2', '4.00', '629019c0e5a1e.jpg'),
(10, 'SOBREMESA', 'Brigadeiro', '60g', 'Um brigadeirão muito top!', '3.00', '62901a502c088.jpg'),
(11, 'PIZZA', 'Frango', 'M', 'Ingredientes: peito de frango cozido, dente de alho, milho verde, mussarela ralada, cebola, catupiry, orégano', '24.00', '62901ea233a20.png'),
(12, 'PIZZA', 'Marguerita', 'M', 'Ingredientes: molho de tomate, queijo mussarela, tomates, manjericão a gosto, azeite de oliva, orégano', '24.00', '62901ed02c9ac.jpg'),
(13, 'PIZZA', 'Quatro-queijos', 'M', 'Ingredientes: queijo gorgonzola, queijo mussarela, queijo parmesão, catupiry, orégano', '25.00', '62901f0358c5f.jpg'),
(14, 'PIZZA', 'Vitamina de goiaba', '450ml', 'Para quem tem hábitos saudáveis uma vitamina de goiaba sempre cai bem Copo de 400ml', '4.00', '62901f38937f9.jpeg'),
(16, 'PIZZA', 'Portuguesa', 'P', 'Ingredientes: tomates, cebolas, presunto, queijo mussarela, ovos, milho verde, azeitona, orégano', '22.00', '62902048303db.jpg'),
(17, 'SOBREMESA', 'Sonho', '100g', 'Um sonho para se deliciar', '3.00', '629020a5253e0.jpg'),
(20, 'BORDA', 'Chocolate', '', 'Delicioso e cremoso, uma ótima opção de borda para quem pede uma pizza doce', '4.00', '6296c343509d3.jpg'),
(22, 'BEBIDA', 'Pepsi', '250mL', 'Uma latinha de refrigerante Pepsi para esfriar a mente', '3.00', '6296df6e5c37d.jpg'),
(23, 'BEBIDA', 'Suco de laranja', '400mL', 'Um suquinho bom demais da conta mah!', '6.75', '629748e4c87ae.jpg'),
(24, 'SOBREMESA', 'Brownie', '200g', 'cada fatia tem 200g, recheio opicional', '4.00', '62975072774a7.jpg'),
(25, 'BORDA', 'Cheddar artesanal', '', 'Para os amantes de queijo, adicione cremosidade à sua pizza com o cheddar original da casa', '4.00', '62975e8f7b337.jpg'),
(26, 'BORDA', ' Doce de leite', '', 'Mais uma opção de borda para pizza doce, conservamos o sabor e a cremosidade do leite', '4.00', '629761f48479a.jpeg'),
(27, 'BORDA', 'Catupiry artesanal', '', 'O tradicional e original catupiry da casa conta com um sabor diferenciado do verdadeiro requeijão', '4.00', '62976288d8ee0.jpg'),
(34, 'PIZZA', 'Calabresa', 'P', 'Uma deliciosa pizza sabor Calabresa! ', '17.00', '62b27160c971f.jpg'),
(35, 'PIZZA', 'Calabresa', 'G', 'Uma deliciosa pizza decalabresa!', '29.00', '62b260fe24ed7.jpg'),
(36, 'PIZZA', 'Mussarela', 'P', 'Uma super pizza de sabor mussarela!', '18.00', '627b171111b1b.jpg'),
(37, 'PIZZA', 'Portuguesa', 'G', 'Ingrendientes: queijo mussarela, tomate, cebola, orégano', '35.00', '627999a8a4df3.jpg'),
(38, 'PIZZA', 'Frango', 'P', 'Ingredientes: peito de frango cozido, dente de alho, milho verde, mussarela ralada, cebola, catupiry, orégano', '19.00', '62901ea233a20.png'),
(39, 'PIZZA', 'Marguerita', 'P', 'Ingredientes: molho de tomate, queijo mussarela, tomates, manjericão a gosto, azeite de oliva, orégano', '20.00', '62901ed02c9ac.jpg'),
(40, 'PIZZA', 'Quatro-queijos', 'P', 'Ingredientes: queijo gorgonzola, queijo mussarela, queijo parmesão, catupiry, orégano', '21.00', '62901f0358c5f.jpg'),
(41, 'PIZZA', 'Mussarela', 'G', 'Uma super pizza de sabor mussarela!', '29.00', '627b171111b1b.jpg'),
(42, 'PIZZA', 'Frango', 'G', 'Ingredientes: peito de frango cozido, dente de alho, milho verde, mussarela ralada, cebola, catupiry, orégano', '31.00', '62901ea233a20.png'),
(43, 'PIZZA', 'Marguerita', 'G', 'Ingredientes: molho de tomate, queijo mussarela, tomates, manjericão a gosto, azeite de oliva, orégano', '31.00', '62901ed02c9ac.jpg'),
(44, 'PIZZA', 'Quatro-queijos', 'G', 'Ingredientes: queijo gorgonzola, queijo mussarela, queijo parmesão, catupiry, orégano', '34.00', '62901f0358c5f.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Índices para tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `identificadorCliente` (`identificadorCliente`),
  ADD KEY `identificadorProduto` (`identificadorProduto`);

--
-- Índices para tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices para tabela `tb_pagamento`
--
ALTER TABLE `tb_pagamento`
  ADD PRIMARY KEY (`idPagamento`);

--
-- Índices para tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`idProduto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_pagamento`
--
ALTER TABLE `tb_pagamento`
  MODIFY `idPagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  ADD CONSTRAINT `tb_carrinho_ibfk_1` FOREIGN KEY (`identificadorCliente`) REFERENCES `tb_cliente` (`idCliente`),
  ADD CONSTRAINT `tb_carrinho_ibfk_2` FOREIGN KEY (`identificadorProduto`) REFERENCES `tb_produto` (`idProduto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
