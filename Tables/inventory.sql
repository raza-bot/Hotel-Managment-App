use hms;
create table Inventory(
	itemId int auto_increment,
    name varchar(32),
    description varchar(128),
    quantity int,
    primary key(itemId)
	);
insert into Inventory(name, description, quantity) values ("Chair", "Needed by various rooms and lobby", 2500);
insert into Inventory(name, description, quantity) values ("Couch", "Needed by various rooms and lobby", 2000);
insert into Inventory(name, description, quantity) values ("Table", "Needed by various rooms and lobby", 1000);
insert into Inventory(name, description, quantity) values ("Bed", "Needed for rooms", 1000);
insert into Inventory(name, description, quantity) values ("TV", "Needed for various rooms", 800);
insert into Inventory(name, description, quantity) values ("Silverware", "Needed for kitchens and restaurants", 8000);
insert into Inventory(name, description, quantity) values ("Towel", "Needed for rooms and restaurants", 15000);
insert into Inventory(name, description, quantity) values ("Steak", "Needed for kitchen", 3000);
insert into Inventory(name, description, quantity) values ("Chicken", "Needed for kitchen", 3000);
insert into Inventory(name, description, quantity) values ("Shrimp", "Needed for kitchen", 1500);
insert into Inventory(name, description, quantity) values ("Vegetable", "Needed for kitchen", 1500);
insert into Inventory(name, description, quantity) values ("Potato", "Needed for kitchen", 4000);
insert into Inventory(name, description, quantity) values ("Mirror", "Needed for various rooms", 1000);
insert into Inventory(name, description, quantity) values ("Hairdryer", "Needed for rooms", 1000);
select * from Inventory;