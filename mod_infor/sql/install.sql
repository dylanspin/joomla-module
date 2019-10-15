CREATE TABLE IF NOT EXISTS `#__info_database`
(
    `id`           int(11)      NOT NULL AUTO_INCREMENT,
    `pos1`         varchar(255) NOT NULL,
    `pos2`         varchar(255) NOT NULL,

    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `#__info_database` (`pos1`, `pos2`) VALUES ('', '');
