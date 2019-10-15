use hms;
create table User(
	id int auto_increment,
    userName varchar(32),
    firstName varchar(32),
    lastName varchar(32),
    email varchar(64),
    passHash char(32),
    primary key(id)
	);
insert into User(userName, firstName, lastName, email, passHash)
	values ("bronsinb", "Bronsin", "Benyamin", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("raza", "Raza", "Ghulam", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("kevin", "Kevin", "Pham", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("mikewu", "Mike", "Wu", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("johndoe", "John", "Doe", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("Random", "Ran", "Dom", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("Random2", "Ran", "Dom", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("Random3", "San", "Jose", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("Random4", "David", "Smith", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("Random5", "John", "Smith", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("Random6", "Smith", "David", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("Random7", "Ben", "Bron", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("lebronjames", "LeBron", "James", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("kobe", "Kobe", "Bryant", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("curry", "Steph", "Curry", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
insert into User(userName, firstName, lastName, email, passHash)
	values ("jamesbond", "James", "Bond", "test@email.com", "5d41402abc4b2a76b9719d911017c592");
select * from User;