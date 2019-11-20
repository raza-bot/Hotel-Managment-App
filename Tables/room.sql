CREATE TABLE Room (hotelID INT, roomNum SMALLINT, type VARCHAR(20), status boolean, price FLOAT(2) DEFAULT 0.00);

INSERT INTO Room(hotelID, roomNum, type, status, price) VALUES('14', 711, 'Single', true, 113.22);
INSERT INTO Room(hotelID, roomNum, type, status, price) VALUES('2', 54, 'Double', false, 221.99);
INSERT INTO Room(hotelID, roomNum, type, status, price) VALUES('12', 652, 'Triple', true, 367.47);
INSERT INTO Room(hotelID, roomNum, type, status, price) VALUES('9', 124, 'Triple', true, 356.32);
INSERT INTO Room(hotelID, roomNum, type, status, price) VALUES('7', 256, 'Suite', false, 513.22);
INSERT INTO Room(hotelID, roomNum, type, status, price) VALUES('10', 316, 'Regular', false, 443.37);