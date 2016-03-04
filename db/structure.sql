DROP TABLE IF EXISTS t_items;
DROP TABLE IF EXISTS t_subcategories;
DROP TABLE IF EXISTS t_categories;
DROP TABLE IF EXISTS t_users;

CREATE TABLE t_categories
(
    cat_id integer NOT NULL PRIMARY KEY auto_increment,
    cat_label varchar(100) NOT NULL,
    cat_description varchar(2000) NOT NULL,
    UNIQUE(cat_label)
) engine=innodb character SET utf8 collate utf8_unicode_ci;

CREATE TABLE t_subcategories
(
    subcat_id integer NOT NULL PRIMARY KEY auto_increment,
    subcat_label varchar(100) NOT NULL,
    cat_id integer NOT NULL,
    UNIQUE(subcat_label),
    CONSTRAINT fk_cat_id FOREIGN KEY(cat_id) REFERENCES t_categories(cat_id)
) engine=innodb character SET utf8 collate utf8_unicode_ci;

CREATE TABLE t_items
(
    it_id integer NOT NULL PRIMARY KEY auto_increment,
    it_name varchar(250) NOT NULL,
    it_description varchar(2000) NOT NULL,
    it_price float NOT NULL,
    it_image varchar(100) NOT NULL,
    subcat_id integer NOT NULL,
    UNIQUE(it_name),
    CONSTRAINT fk_subcat_id FOREIGN KEY(subcat_id) REFERENCES t_subcategories(subcat_id)
) engine=innodb character SET utf8 collate utf8_unicode_ci;

CREATE TABLE t_users
(
    usr_id integer NOT NULL PRIMARY KEY auto_increment,
    usr_lastname varchar(50) NOT NULL,
    usr_firstname varchar(50) NOT NULL,
    usr_address varchar(150) NOT NULL,
    usr_zipCode varchar(50) NOT NULL,
    usr_city varchar(50) NOT NULL,
    usr_email varchar(50) NOT NULL,
    usr_password varchar(88) NOT NULL,
    usr_salt varchar(23) NOT NULL,
    usr_role varchar(50) NOT NULL,
    UNIQUE(usr_email)
) engine=innodb character set utf8 collate utf8_unicode_ci;