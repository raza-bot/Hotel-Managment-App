CREATE TABLE reserve(hotelId INT, RoomNum INT, Customerid INT UNIQUE, 
	StartFrom Date, EndTo Date, adults TINYINT NOT NULL, children TINYINT default 0,
	primary key (hotelId, RoomNum, Customerid)); 
