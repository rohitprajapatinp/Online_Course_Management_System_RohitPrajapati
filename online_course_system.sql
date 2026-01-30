-- Online Course Management System
-- FULL DATABASE SQL FILE

-- Create database
CREATE DATABASE IF NOT EXISTS online_courses;
USE online_courses;

-- USERS TABLE (for login / authentication)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert admin user
-- Username: admin
-- Password: admin123
-- Insert admin user with password_hash()
    INSERT INTO users (username, password) VALUES
    ('admin', '$2y$10$vvUujgaw4906cduc37kX7.g4YmhVS/mxDBeNtBzILq3GCP0fTw6Qi');  -- <-- paste your PHP output here


-- INSTRUCTORS TABLE
CREATE TABLE instructors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Sample instructors
INSERT INTO instructors (name) VALUES
('John Doe'),
('Jane Smith'),
('Alex Brown'),
('Emily White');

-- COURSES TABLE
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    level VARCHAR(50) NOT NULL,
    instructor_id INT,
    FOREIGN KEY (instructor_id) REFERENCES instructors(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- Sample courses
INSERT INTO courses (title, category, level, instructor_id) VALUES
('Introduction to PHP', 'Programming', 'Beginner', 1),
('Advanced PHP', 'Programming', 'Advanced', 2),
('Web Development Basics', 'Web', 'Beginner', 3),
('Database Design', 'Database', 'Intermediate', 4);

-- STUDENTS TABLE
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Sample students
INSERT INTO students (name, email) VALUES
('Rahul Sharma', 'rahul@gmail.com'),
('Anita Koirala', 'anita@gmail.com'),
('Suman Thapa', 'suman@gmail.com');

-- ENROLLMENTS TABLE
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Sample enrollments
INSERT INTO enrollments (student_id, course_id) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 3);

-- END OF DATABASE