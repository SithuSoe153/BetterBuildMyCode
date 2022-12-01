Create Database Job_DB

Use Job_DB

Create Table Department
(
    Department_no int not null Primary Key,
    Department_name varchar(30) not null,
    Location varchar(15),
    Head_of_department int,
)

Select *
from Department


Create Table Employee
(
    Employee_no int not null Primary Key,
    Surname varchar(15) not null,
    Forenames varchar(30) not null,
    Date_of_birth DATETIME,
    Address varchar(50),
    Tel_No varchar(20),
    Department_no int not null,
    Foreign Key (Department_no) references Department (Department_no),
)

Select *
from Employee



Create Table Jobhistory
(
    Employee_no int not null,
    Position varchar(30) not null Primary Key,
    Start_date DATETIME,
    End_date DATETIME,
    Salary int,
    Foreign Key (Employee_no) references Employee (Employee_no),
)

Select *
from Jobhistory


Create Table Course
(
    Course_no int not null primary key,
    Course_name varchar(20) not null,
    Course_date DATETIME not null,
)

Select *
from Course


Create Table Empcourse
(
    Employee_no int not null,
    Course_no int not null,
    Foreign Key (Employee_no) references Employee(Employee_no),
    Foreign Key (Course_no) references Course(Course_no),
)

Select *
from Empcourse


-- Page 6 Exercise

-- No 1
Create table company_car
(
    registration_number varchar(40) not null Primary key,
    car_type varchar(20) not null,
    year_of_manufacture DATE,
    date_of_last_service DATE,
    next_service_mileage int not null,
    employee_no int not null,
    Foreign Key (employee_no) references Employee(employee_no),
)

Select *
from company_car;

-- No 2

Drop table company_car;

-- No 3

Select Employee_no, Surname, Forenames, Date_of_birth, Address, Tel_No, Department_no
into employee_copy
from Employee;

Select *
from employee_copy;

-- No 4

Alter table employee_copy
Add Phone_no varchar(15);

Select *
from employee_copy;

-- No 5

Alter table employee_copy
Drop column Date_of_birth;

Select *
from employee_copy;

-- No 6

Select *
from employee_copy;

-- No 7

Create synonym e for Employee;
Drop Synonym e;

Select *
from e;

-- No 8

Create synonym jh for Jobhistory;
Drop synonym jh;

select *
from jh;

-- No 9

Create Table Employee
(
    Employee_no int not null Primary Key,
    Surname varchar(15) not null,
    Forenames varchar(30) not null,
    Date_of_birth DATETIME,
    Address varchar(50),
    Tel_No varchar(20),
    Department_no int not null,
    Foreign Key (Department_no) references Department (Department_no),
)



-- Topic 8

-- 2 example

Insert into Department
Values(4, 'HR', 'Yangon', '2');

Insert into Department
Values(3, 'R&D', 'Yangon', '5');


Select *
from Department;

Insert into Employee
VALUES(56, 'Smith', 'Janet', '12-Dec-1978', '32 High St, Cupar', '0138625367', 4);

Insert into Employee
VALUES(40, 'Clarlk', 'Maeve', '01-Jan-1982', 'Lauder Collage', '01383845000', 3);

Select *
from e;

-- Topic 8 Page 3

-- No 1

Insert into Course
Values
    (1, 'Design Techniques', '1-Aug-2022');

Select *
from Course;

-- No 2

Insert into Empcourse
Values
    (40, 1);

Select *
from Empcourse;


-- No 3

Insert into Employee
Values(41, 'Soe', 'Sithu', '15-Mar-2001', 'Yangon', '099898998997', 4);

Select *
from Employee;

-- No 4

Insert into Jobhistory
Values(41, 'HR Manager', '1-Jan-2022', NULL, 5000000);

Insert into Jobhistory
Values(40, 'Network Administrator', '1-Jan-2022', '1-Jan-2023', 8000000);

select *
from Jobhistory;
-- No 5

Insert into Empcourse
Values(41, 1);

Select *
from Empcourse;

-- No 6

Insert into Course
Values(2, 'Networking', '1-feb-2022');

Insert into Course
Values(3, 'Advance Office', '1-Aug-2022');

Select *
from Course;

-- No 7

Insert into empcourse
Values(41, 2);

Select *
from empcourse;


--  Test

select Department_name, Location
from Department;

select course_date
from Course
where Course_name = 'Advance Office';


-- Topic 9

-- No 1

Select Surname, Tel_No
from
    Employee
Where
Department_no = 3;


-- No 2

Select *
from Course
Order by Course_date ASC;


-- No 3

Select Surname, Department_name, Location
From Employee e, Department p
Where e.Department_no = p.Department_no;


-- No 4

Select e.Surname, d.Department_name, jh.Position
From Employee e, Department d, Jobhistory jh
Where e.Employee_no = jh.Employee_no
    And e.Department_no = d.Department_no
Order By Surname, Position DESC;


-- No 5

Select Surname, Position, Start_date, Department_name
From Employee e, Jobhistory jh, Department d
Where e.Employee_no = jh.Employee_no
    And e.Department_no = d.Department_no


-- No 6

Select Surname, Forenames, Course_name
From Employee e, Course c, empcourse ec
Where e.Employee_no = ec.Employee_no
    And ec.Course_no =c.Course_no

-- No 7

Select Surname, Start_date
From Employee e, Jobhistory jh
Where e.Employee_no = jh.Employee_no
    And Start_date >= '1-Jan-2000'

-- No 8

Select Surname, Forenames, Position, Department_name
From Employee e, Jobhistory jh, Department d
Where e.Employee_no = jh.Employee_no
    And e.Department_no = d.Department_no

-- No 9

Select Position
From Jobhistory

-- No 10

Select Position, Surname
From Employee e, Jobhistory jh
where e.Employee_no = jh.Employee_no
    And End_date IS NULL;

