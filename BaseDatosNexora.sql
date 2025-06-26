CREATE DATABASE nexora;
USE nexora;

CREATE TABLE people (
	birthdate date NOT NULL,
    message VARCHAR(250),
    ocupation VARCHAR(30),
    phone INT(9) NOT NULL,
	usr_name VARCHAR(20) NOT NULL,
    usr_surname VARCHAR(20) NOT NULL,
    lawful_resident TINYINT(1) NOT NULL,
    num_family INT(10) NOT NULL,
    usr_email VARCHAR(50),
    usr_pass VARCHAR(30),
    usr_ci INT(8) NOT NULL,
    marital_status VARCHAR(15),
    income INT(255) NOT NULL,
    owner_house TINYINT(1) NOT NULL,
	PRIMARY KEY(usr_ci)
);

CREATE TABLE partner (
	entry_date date NOT NULL,
    id_partner INT(20) NOT NULL,
    adress VARCHAR(50) NOT NULL,
	voucher_first_payment blob,
    usr_ci INT(8) NOT NULL,
    first_payment_status VARCHAR(20) NOT NULL,
    partner_role VARCHAR(20) NOT NULL,
    FOREIGN KEY(usr_ci) REFERENCES people(usr_ci),
    PRIMARY KEY(id_partner)
);

CREATE TABLE entry_apli (
	id_apli INT(20) NOT NULL,
    usr_ci INT(8) NOT NULL,
    apli_status VARCHAR(20) NOT NULL,
    entry_date date NOT NULL,
    FOREIGN KEY (usr_ci) REFERENCES people(usr_ci),
    PRIMARY KEY(id_apli)
);

