DROP USER IF EXISTS 'enti'@'localhost';
DROP USER IF EXISTS 'editor'@'localhost';
CREATE USER 'enti'@'localhost' IDENTIFIED BY 'enti';
CREATE USER 'editor'@'localhost' IDENTIFIED BY 'enti';
GRANT ALL PRIVILEGES ON inventiory.* TO 'enti'@'localhost';
GRANT SELECT,INSERT,UPDATE ON inventiory.* TO 'editor'@'localhost';

