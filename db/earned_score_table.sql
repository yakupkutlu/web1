-- earned_score tablosu oluşturma
CREATE TABLE `earned_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `process` int(11) NOT NULL COMMENT '1=author, 2=reviewer, 3=editor',
  `earned_score` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_paper_process` (`user_id`, `paper_id`, `process`),
  KEY `user_id` (`user_id`),
  KEY `paper_id` (`paper_id`),
  KEY `process` (`process`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
