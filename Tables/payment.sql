use hms;
create table Payment(
	name varchar(64),
	cardNum varchar(128),
	cvv varchar(128),
	expDate date,
	primary key(cardNum)
);
