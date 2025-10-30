-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.42 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para sabor_do_brasil
CREATE DATABASE IF NOT EXISTS `sabor_do_brasil` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sabor_do_brasil`;

-- Copiando estrutura para tabela sabor_do_brasil.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sabor_do_brasil.cache: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sabor_do_brasil.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sabor_do_brasil.cache_locks: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sabor_do_brasil.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id_comentario` int NOT NULL AUTO_INCREMENT,
  `texto` varchar(255) NOT NULL,
  `usuario_id` int NOT NULL,
  `publicacao_id` int NOT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comentario`),
  KEY `usuario_id` (`usuario_id`),
  KEY `publicacao_id` (`publicacao_id`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`id_publicacao`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sabor_do_brasil.comentarios: ~4 rows (aproximadamente)
INSERT INTO `comentarios` (`id_comentario`, `texto`, `usuario_id`, `publicacao_id`, `data`) VALUES
	(1, 'Prato maravilhoso!', 1, 1, '2025-10-29 15:39:22'),
	(2, 'Gostei bastante', 2, 1, '2025-10-29 15:39:22'),
	(3, 'Muito temperado', 1, 2, '2025-10-29 15:39:22'),
	(4, 'Não gostei muito', 3, 3, '2025-10-29 15:39:22');

-- Copiando estrutura para tabela sabor_do_brasil.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sabor_do_brasil.empresa: ~1 rows (aproximadamente)
INSERT INTO `empresa` (`id_empresa`, `nome`, `logo`, `createdAt`, `updatedAt`) VALUES
	(1, 'Sabor do Brasil', 'logo_sabor_do_brasil.png', '2023-11-23 13:49:17', '2021-02-22 12:13:55');

-- Copiando estrutura para tabela sabor_do_brasil.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sabor_do_brasil.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sabor_do_brasil.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sabor_do_brasil.jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sabor_do_brasil.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sabor_do_brasil.job_batches: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sabor_do_brasil.likes
CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `publicacao_id` int NOT NULL,
  `tipo` enum('like','dislike') NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_like`),
  KEY `usuario_id` (`usuario_id`),
  KEY `publicacao_id` (`publicacao_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`id_publicacao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sabor_do_brasil.likes: ~6 rows (aproximadamente)
INSERT INTO `likes` (`id_like`, `usuario_id`, `publicacao_id`, `tipo`, `createdAt`) VALUES
	(1, 1, 1, 'like', '2025-10-29 15:38:50'),
	(2, 2, 1, 'dislike', '2025-10-29 15:38:50'),
	(3, 3, 2, 'like', '2025-10-29 15:38:50'),
	(4, 1, 2, 'like', '2025-10-29 15:38:50'),
	(5, 2, 3, 'like', '2025-10-29 15:38:50'),
	(6, 3, 3, 'dislike', '2025-10-29 15:38:50');

-- Copiando estrutura para tabela sabor_do_brasil.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sabor_do_brasil.migrations: ~6 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_10_23_213912_create_empresas_table', 1),
	(5, '2025_10_23_213958_create_publicacaos_table', 1),
	(6, '2025_10_23_214014_create_usuarios_table', 1);

-- Copiando estrutura para tabela sabor_do_brasil.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sabor_do_brasil.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sabor_do_brasil.publicacao
CREATE TABLE IF NOT EXISTS `publicacao` (
  `id_publicacao` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `titulo_prato` varchar(255) NOT NULL,
  `local` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `empresa_id` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_publicacao`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `publicacao_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sabor_do_brasil.publicacao: ~3 rows (aproximadamente)
INSERT INTO `publicacao` (`id_publicacao`, `foto`, `titulo_prato`, `local`, `cidade`, `empresa_id`, `createdAt`, `updatedAt`) VALUES
	(1, 'publicacao01.png', 'Titulo do Prato 01', 'Local 01', 'Maceio-AL', 1, '2023-02-22 12:15:55', '2023-09-22 12:18:55'),
	(2, 'publicacao02.png', 'Titulo do Prato 02', 'Local 02', 'Minas Gerais-MG', 1, '2023-02-22 12:10:55', '2023-02-22 12:16:55'),
	(3, 'publicacao03.png', 'Titulo do Prato 03', 'Local 03', 'Rio de Janerio-RJ', 1, '2023-05-22 12:13:55', '2023-02-22 12:15:55');

-- Copiando estrutura para tabela sabor_do_brasil.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sabor_do_brasil.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('xFzVPBqWU4UkCMeijkD10DBfTe8vNyHq8Tznq7QU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNVJIQTBFcEJmMUh4eGRhTkczamtadTBYQWdCV1dUVW0yRk4wSnNCaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/bG9naW49dHJ1ZSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c3VhcmlvIjtPOjg6InN0ZENsYXNzIjo4OntzOjI6ImlkIjtpOjE7czo0OiJub21lIjtzOjk6InVzdWFyaW8wMSI7czo1OiJlbWFpbCI7czoyMToidXN1YXJpbzAxQHVzdWFyaW8uY29tIjtzOjg6Im5pY2tuYW1lIjtzOjEwOiJ1c3VhcmlvXzAxIjtzOjU6InNlbmhhIjtzOjY6IjEyMzQ1NiI7czo0OiJmb3RvIjtzOjE0OiJ1c3VhcmlvXzAxLmpwZyI7czo5OiJjcmVhdGVkQXQiO3M6MTk6IjIwMjMtMDYtMjIgMDk6MTM6NTUiO3M6OToidXBkYXRlZEF0IjtzOjE5OiIyMDIzLTA2LTIyIDA5OjE0OjU1Ijt9fQ==', 1761781428);

-- Copiando estrutura para tabela sabor_do_brasil.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sabor_do_brasil.usuario: ~3 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `nome`, `email`, `nickname`, `senha`, `foto`, `createdAt`, `updatedAt`) VALUES
	(1, 'usuario01', 'usuario01@usuario.com', 'usuario_01', '123456', 'usuario_01.jpg', '2023-06-22 12:13:55', '2023-06-22 12:14:55'),
	(2, 'usuario02', 'usuario02@usuario.com', 'usuario_02', '654321', 'usuario_02.jpg', '2023-02-22 12:13:55', '2023-02-22 12:13:58'),
	(3, 'usuario03', 'usuario03@usuario.com', 'usuario_03', '987654', 'usuario_03.jpg', '2023-08-22 12:13:55', '2023-08-22 12:15:55');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
