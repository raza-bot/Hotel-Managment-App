use hms;
create table Employee(
		userId int,
        isAdmin bool,
        salary int,
        primary key(userId)
	);
insert into Employee(userId, isAdmin, salary) values (1, true, 100000);
insert into Employee(userId, isAdmin, salary) values (2, true, 100000);
insert into Employee(userId, isAdmin, salary) values (3, true, 100000);
insert into Employee(userId, isAdmin, salary) values (43, false, 60000);
insert into Employee(userId, isAdmin, salary) values (51, false, 55000);
insert into Employee(userId, isAdmin, salary) values (26, false, 40000);
insert into Employee(userId, isAdmin, salary) values (7, false, 40000);
insert into Employee(userId, isAdmin, salary) values (84, false, 70000);
insert into Employee(userId, isAdmin, salary) values (9, false, 80000);
insert into Employee(userId, isAdmin, salary) values (10, false, 47000);
insert into Employee(userId, isAdmin, salary) values (41, false, 76000);
insert into Employee(userId, isAdmin, salary) values (72, false, 70000);
insert into Employee(userId, isAdmin, salary) values (13, false, 90000);
insert into Employee(userId, isAdmin, salary) values (14, false, 30000);
insert into Employee(userId, isAdmin, salary) values (15, false, 60000);
select * from Employee;