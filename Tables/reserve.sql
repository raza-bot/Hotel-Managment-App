CREATE TABLE reserve(hotelId INT, RoomNum INT, Customerid INT UNIQUE, 
	StartFrom Date, TimePeriod INT, adults TINYINT NOT NULL, children TINYINT default 0);
