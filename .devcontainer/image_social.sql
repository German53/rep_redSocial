CREATE DATABASE IF NOT EXISTS  image_social;
USE image_social;

CREATE TABLE `users` (
  `id` int(255) auto_increment not null,
  `role` varchar(20) not null,
  `name` varchar(100) not null,
  `surname` varchar(200) not null,
  `nick` varchar(100) not null,
  `email` varchar(255) not null,
  `password` varchar(255) not null,
  `image` varchar(255) not null,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  CONSTRAINT pk_users PRIMARY KEY(id),
  CONSTRAINT uq_email UNIQUE(email)
) ENGINE=InnoDb;

CREATE TABLE `images` (
  `id` int(255) auto_increment NOT NULL,
  `user_id` int(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  CONSTRAINT pk_images PRIMARY KEY(id),
  CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE `comments` (
  `id` int(255) auto_increment NOT NULL,
  `user_id` int(255) NOT NULL,
  `image_id` int(255) NOT NULL,
  `content` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  CONSTRAINT pk_comments PRIMARY KEY(id),
  CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
  CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
) ENGINE=InnoDB;


CREATE TABLE `likes` (
  `id` int(255) auto_increment NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  CONSTRAINT pk_likes PRIMARY KEY(id),
  CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
  CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
) ENGINE=InnoDB;
