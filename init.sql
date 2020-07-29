CREATE TABLE users (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	login VARCHAR(50),
	password VARCHAR(50),
	status VARCHAR(50));

CREATE TABLE colors (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	red BIT(1),
	black BIT(1),
	white BIT(1),
	silver BIT(1));

CREATE TABLE products (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	price INT NOT NULL,
	colors_id INT NOT NULL,
	image VARCHAR(100),
	description TEXT,
	FOREIGN KEY (colors_id) REFERENCES colors(id));

CREATE TABLE orders (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	status VARCHAR(50),
	date DATE NOT NULL,
	price INT,
	address VARCHAR(100));

CREATE TABLE orders_items (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	count INT,
	color VARCHAR(50),
	order_id INT NOT NULL,
	product_id INT NOT NULL,
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (product_id) REFERENCES products(id));



INSERT INTO users (login, password, status) VALUES ('admin', '123', 'admin');

INSERT INTO colors (white, black, red) VALUES (1, 1, 1);
INSERT INTO colors (silver, black, white) VALUES (1, 1, 1);
INSERT INTO colors (red, black) VALUES (1, 1);

INSERT INTO products (name, price, colors_id, image, description) VALUES ('Ray-Ban', '150', 1, 'images/sun2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
INSERT INTO products (name, price, colors_id, image, description) VALUES ('Boss', '90', 2, 'images/sun1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
INSERT INTO products (name, price, colors_id, image, description) VALUES ('Gucci', '140', 3, 'images/sun3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');


