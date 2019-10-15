use hms;
create table Payment(
	cardNum char(16),
    cvv char(3),
    expDate date,
    primary key(cardNum)
    );
insert into Payment(cardNum, cvv, expDate) values ("4564914461228654", "895", '2023-01-11');