CREATE DATABASE IF NOT EXISTS amazone CHARACTER SET utf8 collate utf8_unicode_ci;
USE amazone;

GRANT ALL PRIVILEGES ON amazone.* to 'amazone_user'@'localhost' identified by 'secret';