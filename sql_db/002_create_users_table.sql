CREATE TABLE users (
   user_id INTEGER NOT NULL AUTO_INCREMENT KEY,
   name VARCHAR(128),
   email VARCHAR(128),
   password VARCHAR(128),
   INDEX(email)
) ENGINE=InnoDB CHARSET=utf8;

INSERT INTO users (name,email,password) VALUES ('Chuck','csev@umich.edu','123');
INSERT INTO users (name,email,password) VALUES ('Glenn','gg@umich.edu','456');
