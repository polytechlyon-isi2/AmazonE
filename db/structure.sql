DROP TABLE IF EXISTS t_categories;
DROP TABLE IF EXISTS t_subcategories;
DROP TABLE IF EXISTS t_items;

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
    it_price integer NOT NULL,
    subcat_id integer NOT NULL,
    UNIQUE(it_name),
    CONSTRAINT fk_subcat_id FOREIGN KEY(subcat_id) REFERENCES t_subcategories(subcat_id)
) engine=innodb character SET utf8 collate utf8_unicode_ci;