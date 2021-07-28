
/*CREATE DATABASE IF NOT EXISTS `wiki` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `wiki`;*/


CREATE TABLE `article` (
  `id` int(10) NOT NULL,
  `id_categorie` int(255) DEFAULT NULL,
  `title` varchar(1024) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `categorie` (
  `id` int(255) NOT NULL,
  `creatAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_article` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `editor` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(120) COLLATE utf8_bin NOT NULL,
  `email` varchar(320) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `emailVerified` tinyint(4) DEFAULT '0',
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `page` (
  `id` int(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(255) NOT NULL,
  `updateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `page_categorie` (
  `id` int(255) NOT NULL,
  `id_page` int(255) NOT NULL,
  `id_categorie` int(255) NOT NULL,
  `creatAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `static` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(1024) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_article_cat` (`id_categorie`);

ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `editor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `page_categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_page_categorie` (`id_categorie`),
  ADD KEY `FK_page_categorie2` (`id_page`);


ALTER TABLE `article`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;


ALTER TABLE `categorie`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;


ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;


ALTER TABLE `editor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;


ALTER TABLE `page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;


ALTER TABLE `page_categorie`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;


ALTER TABLE `article`
  ADD CONSTRAINT `FK_article_cat` FOREIGN KEY (`id_categorie`) REFERENCES `wk_categorie` (`id`);


ALTER TABLE `page_categorie`
  ADD CONSTRAINT `FK_page_categorie2` FOREIGN KEY (`id_page`) REFERENCES `wk_page` (`id`);
  commit;

