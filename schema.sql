CREATE TABLE IF NOT EXISTS `sample_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `description` text,
  `address` text,
  `image_full` varchar(255) DEFAULT NULL,
  `image_thumbnail` varchar(255) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `num_bedrooms` varchar(5) DEFAULT NULL,
  `num_bathrooms` varchar(5) DEFAULT NULL,
  `price` varchar(25) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `property_type_title` varchar(255) DEFAULT NULL,
  `property_type_description` text,
  `created_at` varchar(75) DEFAULT NULL,
  `updated_at` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;