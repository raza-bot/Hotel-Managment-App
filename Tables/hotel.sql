use hms;
create table Hotel(
	id int auto_increment,
    name varchar(64),
    address varchar(128),
    primary key(id)
    );
insert into Hotel(name, address) values ("Hotel De Anza", "233 W Santa Clara St, San Jose, CA 95113");
insert into Hotel(name, address) values ("Hyatt Place San Jose/Downtown", "282 S Almaden Blvd, San Jose, CA 95113");
insert into Hotel(name, address) values ("Hotel Fairmont San Jose", "170 S Market St, San Jose, CA 95113");
insert into Hotel(name, address) values ("Four Points by Sheraton San Jose Downtown", "211 S 1st St, San Jose, CA 95113");
insert into Hotel(name, address) values ("Holiday Inn San Jose - Silicon Valley", "1350 N 1st St, San Jose, CA 95112");
insert into Hotel(name, address) values ("Wyndham Garden San Jose Airport", "1355 N 4th St, San Jose, CA 95112");
insert into Hotel(name, address) values ("Staybridge Suites San Jose", "1602 Crane Ct, San Jose, CA 95112");
insert into Hotel(name, address) values ("Hyatt Place San Jose Airport", "82 Karina Ct, San Jose, CA 95131");
insert into Hotel(name, address) values ("DoubleTree by Hilton Hotel San Jose", "2050 Gateway Pl, San Jose, CA 95110");
insert into Hotel(name, address) values ("Hampton Inn & Suites San Jose Airport", "2088 N 1st St, San Jose, CA 95131");
insert into Hotel(name, address) values ("Avatar Hotel", "4200 Great America Pkwy, Santa Clara, CA 95054");
insert into Hotel(name, address) values ("Best Western University Inn Santa Clara", "1655 El Camino Real, Santa Clara, CA 95050");
insert into Hotel(name, address) values ("Hilton Garden Inn San Jose/Milpitas", "30 Ranch Dr, Milpitas, CA 95035");
insert into Hotel(name, address) values ("Hilton Santa Clara", "4949 Great America Pkwy, Santa Clara, CA 95054");
insert into Hotel(name, address) values ("Hyatt Regency Santa Clara", "5101 Great America Pkwy, Santa Clara, CA 95054");
insert into Hotel(name, address) values ("Hyatt House San Jose/Silicon Valley", "75 Headquarters Dr, San Jose, CA 95134");
select * from Hotel;