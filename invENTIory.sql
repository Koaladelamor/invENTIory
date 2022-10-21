DROP USER IF EXISTS 'enti'@'localhost';
DROP USER IF EXISTS 'editor'@'localhost';
CREATE USER 'enti'@'localhost' IDENTIFIED BY 'enti';
CREATE USER 'editor'@'localhost' IDENTIFIED BY 'enti';
GRANT ALL PRIVILEGES ON inventiory.* TO 'enti'@'localhost';
GRANT SELECT,INSERT,UPDATE ON inventiory.* TO 'editor'@'localhost';

DROP TABLE IF EXISTS inventory_armours;
DROP TABLE IF EXISTS inventory_weapons;
DROP TABLE IF EXISTS inventory_items;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS weapons;
DROP TABLE IF EXISTS armours;
DROP TABLE IF EXISTS item_types;
DROP TABLE IF EXISTS armour_types;
DROP TABLE IF EXISTS weapon_types;
DROP TABLE IF EXISTS bank_accounts;
DROP TABLE IF EXISTS users;


CREATE TABLE users (
id_user INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
username VARCHAR (32) NOT NULL,
name VARCHAR(48) NOT NULL,
password CHAR(32) NOT NULL,
phone VARCHAR(16),
birthdate DATE NOT NULL,
gender CHAR(1),
email VARCHAR(32) NOT NULL,
country CHAR(2) NULL,
registration DATETIME NOT NULL
);
CREATE TABLE bank_accounts (
id_bank_account INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
balance DECIMAL (12,2) NOT NULL,
id_user INT UNSIGNED NOT NULL,
		FOREIGN KEY(id_user) REFERENCES users(id_user)
		ON DELETE CASCADE
);

CREATE TABLE item_types (
id_item_type INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
type VARCHAR(16) NOT NULL,
icon VARCHAR(24) NOT NULL
);
CREATE TABLE items (
id_item INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
item VARCHAR(32) NOT NULL,
description TEXT,
value DECIMAL (12,2) NOT NULL,
weight FLOAT DEFAULT 1,
rarity INT DEFAULT 2,
icon VARCHAR(24),
id_item_type INT UNSIGNED NOT NULL,
		FOREIGN KEY(id_item_type) REFERENCES item_types(id_item_type)
		ON DELETE CASCADE
);
CREATE TABLE inventory_items (
	id_inventory_items INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	id_item INT UNSIGNED NOT NULL,
	id_user INT UNSIGNED NOT NULL,
	purchased DATETIME NOT NULL,
		FOREIGN KEY(id_item) REFERENCES items(id_item)
		ON DELETE RESTRICT,
		FOREIGN KEY (id_user) REFERENCES users(id_user)
		ON DELETE CASCADE
);


CREATE TABLE weapon_types (
id_weapon_type INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
type VARCHAR(16) NOT NULL,
icon VARCHAR(24) NOT NULL
);
CREATE TABLE weapons (
id_weapon INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
weapon VARCHAR (32) NOT NULL,
description TEXT,
value DECIMAL (12,2) NOT NULL,
weight FLOAT DEFAULT 1,
rarity INT DEFAULT 2,
icon VARCHAR (24),
id_weapon_type INT UNSIGNED NOT NULL,
		FOREIGN KEY(id_weapon_type) REFERENCES weapon_types(id_weapon_type)
		ON DELETE CASCADE
);
CREATE TABLE inventory_weapons (
	id_inventory_weapons INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	id_weapon INT UNSIGNED NOT NULL,
	id_user INT UNSIGNED NOT NULL,
	purchased DATETIME NOT NULL,
		FOREIGN KEY(id_weapon) REFERENCES weapons(id_weapon)
		ON DELETE RESTRICT,
		FOREIGN KEY (id_user) REFERENCES users(id_user)
		ON DELETE CASCADE
);

CREATE TABLE armour_types (
id_armour_type INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
type VARCHAR(16) NOT NULL,
icon VARCHAR(24) NOT NULL
);
CREATE TABLE armours (
id_armour INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
armour VARCHAR (32) NOT NULL,
description TEXT,
value DECIMAL (12,2) NOT NULL,
weight FLOAT DEFAULT 1,
rarity INT DEFAULT 2,
icon VARCHAR (24),
id_armour_type INT UNSIGNED NOT NULL,
		FOREIGN KEY(id_armour_type) REFERENCES armour_types(id_armour_type)
		ON DELETE CASCADE
);
CREATE TABLE inventory_armours (
	id_inventory_armours INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	id_armour INT UNSIGNED NOT NULL,
	id_user INT UNSIGNED NOT NULL,
	purchased DATETIME NOT NULL,
		FOREIGN KEY(id_armour) REFERENCES armours(id_armour)
		ON DELETE RESTRICT,
		FOREIGN KEY (id_user) REFERENCES users(id_user)
		ON DELETE CASCADE
);
