DROP DATABASE IF EXISTS misc;
CREATE DATABASE misc CHARACTER SET=utf8mb4;
USE misc;

CREATE USER IF NOT EXISTS
fred@localhost
IDENTIFIED BY 'zap';
GRANT ALL ON misc.*
TO fred@localhost;

CREATE USER IF NOT EXISTS
fred@127.0.0.1
IDENTIFIED BY 'zap';
GRANT ALL ON misc.*
TO fred@127.0.0.1;

CREATE TABLE autos (
    auto_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    make VARCHAR(128),
    `year` INTEGER,
    mileage INTEGER,
    PRIMARY KEY(auto_id)
);
