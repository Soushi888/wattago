--
-- Structure de la table email
--

DROP TABLE IF EXISTS email;
CREATE TABLE email (
  id     int(11) UNSIGNED  NOT NULL AUTO_INCREMENT,
  email  varchar(255)      NOT NULL,
  type   varchar(255)      NOT NULL   DEFAULT "fournisseur" ,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
