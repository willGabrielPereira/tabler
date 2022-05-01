-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 01-Maio-2022 às 18:21
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.4.19
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

CREATE SCHEMA IF NOT EXISTS `tabler`;

use `tabler`;

--
-- Banco de dados: `tabler`
--
-- --------------------------------------------------------
--
-- Estrutura da tabela `products`
--
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `available` int(11) NOT NULL,
  `barcode` text NOT NULL,
  `value` double NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Extraindo dados da tabela `products`
--
INSERT INTO
  `products` (
    `id`,
    `description`,
    `available`,
    `barcode`,
    `value`,
    `deleted_at`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Descrição',
    3,
    '123456789',
    15.9,
    NULL,
    '2022-05-01 13:01:42',
    '2022-05-01 13:01:42'
  ),
  (
    3,
    'bagulho 2',
    5,
    '19823980123',
    5.25,
    NULL,
    '2022-05-01 14:55:50',
    '2022-05-01 14:55:50'
  ),
  (
    4,
    'mais um treco',
    1,
    '908210398123',
    200,
    NULL,
    '2022-05-01 14:55:50',
    '2022-05-01 14:55:50'
  );

-- --------------------------------------------------------
--
-- Estrutura da tabela `sales`
--
CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit_value` double NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Extraindo dados da tabela `sales`
--
INSERT INTO
  `sales` (
    `id`,
    `product_id`,
    `amount`,
    `unit_value`,
    `deleted_at`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    3,
    2,
    5.25,
    NULL,
    '2022-05-01 15:02:42',
    '2022-05-01 15:02:42'
  );

--
-- Índices para tabelas despejadas
--
--
-- Índices para tabela `products`
--
ALTER TABLE
  `products`
ADD
  PRIMARY KEY (`id`);

--
-- Índices para tabela `sales`
--
ALTER TABLE
  `sales`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `product_sale_fk` (`product_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--
--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE
  `products`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT de tabela `sales`
--
ALTER TABLE
  `sales`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- Restrições para despejos de tabelas
--
--
-- Limitadores para a tabela `sales`
--
ALTER TABLE
  `sales`
ADD
  CONSTRAINT `product_sale_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;