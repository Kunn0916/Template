ALTER TABLE appointments
ADD CONSTRAINT fk_pet
FOREIGN KEY (pet_id)
REFERENCES pets(pet_id)
ON DELETE CASCADE
ON UPDATE CASCADE;

$query = "
    SELECT 
        appointments.*,
        pets.pet_name
    FROM appointments
    INNER JOIN pets
    ON appointments.pet_id = pets.pet_id
";

CREATE TABLE table_name (
    id INT PRIMARY KEY AUTO_INCREMENT,
    column1 VARCHAR(100) NOT NULL,
    column2 INT,
    column3 DATE,
    column4 DECIMAL(10,2)
);

CREATE TABLE departments (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(100) NOT NULL
);

CREATE TABLE students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    student_name VARCHAR(100) NOT NULL,
    age INT,
    department_id INT,

    FOREIGN KEY (department_id)
    REFERENCES departments(department_id)
);

-- Primary Key
id INT PRIMARY KEY AUTO_INCREMENT

-- Foreign Key
FOREIGN KEY (column_id)
REFERENCES parent_table(column_id)

-- Not Null
name VARCHAR(100) NOT NULL

-- Unique
email VARCHAR(100) UNIQUE

-- Default
status VARCHAR(50) DEFAULT 'Pending'

-- Decimal
price DECIMAL(10,2)

-- Date
created_at DATETIME