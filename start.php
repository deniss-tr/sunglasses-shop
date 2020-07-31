<?php
require_once "app/Dbh.php";

$Dbh = new Dbh;
$myPDO = $Dbh->connect();

$sql = "CREATE TABLE users (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	login TEXT,
	password TEXT,
	status TEXT);";
$myPDO->query($sql);

$sql = "CREATE TABLE colors (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	red INTEGER,
	black INTEGER,
	white INTEGER,
	silver INTEGER)";
$myPDO->query($sql);

$sql = "CREATE TABLE products (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name TEXT NOT NULL,
	price INTEGER NOT NULL,
	colors_id INTEGER NOT NULL,
	image TEXT,
	description TEXT,
	FOREIGN KEY (colors_id) REFERENCES colors(id))";
$myPDO->query($sql);

$sql = "CREATE TABLE orders (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	status TEXT,
	date DATE NOT NULL,
	price INTEGER,
	address TEXT)";
$myPDO->query($sql);

$sql = "CREATE TABLE orders_items (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	count INTEGER,
	color TEXT,
	order_id INTEGER NOT NULL,
	product_id INTEGER NOT NULL,
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (product_id) REFERENCES products(id));";
$myPDO->query($sql);	


$myPDO->query("INSERT INTO users (login, password, status) VALUES ('admin', '123', 'admin')");

$myPDO->query("INSERT INTO colors (white, black, red) VALUES (1, 1, 1)");
$myPDO->query("INSERT INTO colors (silver, black, white) VALUES (1, 1, 1)");
$myPDO->query("INSERT INTO colors (red, black) VALUES (1, 1)");

$myPDO->query("INSERT INTO products (name, price, colors_id, image, description) VALUES ('Ray-Ban', '150', 1, 'images/sun2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')");
$myPDO->query("INSERT INTO products (name, price, colors_id, image, description) VALUES ('Boss', '90', 2, 'images/sun1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')");
$myPDO->query("INSERT INTO products (name, price, colors_id, image, description) VALUES ('Gucci', '140', 3, 'images/sun3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.')");