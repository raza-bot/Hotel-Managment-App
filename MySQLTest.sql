CREATE DATABASE hms;
use hms;
CREATE TABLE user(
        firstname VARCHAR(32) NOT NULL,
        lastname VARCHAR(64) NOT NULL
        );
INSERT INTO user(firstname, lastname) VALUES ('Testing', 'MySQL');
INSERT INTO user(firstname, lastname) VALUES ('Bronsin', 'Benyamin');