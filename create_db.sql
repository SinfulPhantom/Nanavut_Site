drop table Orders;
drop table Product;
drop table Customer;
drop table Registration;

CREATE TABLE Customer (
	cc_no numeric(16),
	exp_mo numeric(2) NOT NULL,
	exp_yr numeric(4) NOT NULL,
	name_first varchar(20) NOT NULL,
	name_last varchar(20) NOT NULL,
	email varchar(20) NOT NULL,
	address1 varchar(50) NOT NULL,
	address2 varchar(50),
	city varchar(20) NOT NULL,
	state varchar(2) NOT NULL,
	zip numeric(5) NOT NULL,
	country varchar(20),
	phone varchar(15) NOT NULL,
	fax varchar(15) NOT NULL,
	mail_list numeric(1),
	PRIMARY KEY (cc_no));

CREATE TABLE Product (
	item_no numeric(4) NOT NULL,
	item_name varchar(30) NOT NULL,
	price numeric(9,2) NOT NULL,
	inventory int(11) NOT NULL,
	PRIMARY KEY (item_no));

CREATE TABLE Orders (
	quantity numeric NOT NULL,
	date_sold DATETIME NOT NULL,
	item_no numeric(4),
	cc_no numeric(16),
	FOREIGN KEY (cc_no) REFERENCES Customer(cc_no),
	FOREIGN KEY (item_no) REFERENCES Product(item_no));

CREATE TABLE Registration (
	username varchar(16),
	password varchar(16) NOT NULL,
	email varchar(50) NOT NULL,
	PRIMARY KEY (username));

INSERT INTO Product VALUES (0, 'Moose Boots', 250, 100);
INSERT INTO Product VALUES (1, 'Caribou Skin Boots', 300, 100);
INSERT INTO Product VALUES (2, 'Brown Rabbit Slippters', 150, 100);
INSERT INTO Product VALUES (3, 'Snow Rabbit Slippers', 150, 100);
INSERT INTO Product VALUES (4, 'Earring', 1000, 100);
INSERT INTO Product VALUES (5, 'Necklace', 500, 100);
INSERT INTO Product VALUES (6, 'Hair Clip', 75, 100);
INSERT INTO Product VALUES (7, 'Pendant', 400, 100);
INSERT INTO Product VALUES (8, 'Dog Sled', 1000, 100);
INSERT INTO Product VALUES (9, 'Wood Carving', 500, 100);
INSERT INTO Product VALUES (10, 'Wood Carving', 1500, 100);
INSERT INTO Product VALUES (11, 'Ivory Carvings', 2500, 100);