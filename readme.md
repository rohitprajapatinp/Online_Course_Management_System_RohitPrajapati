# Online Course Management System

This project is a PHP + MySQL based Online Course Management System developed
as part of the Full Site Implementation assessment.

--------------------------------------------------

## Login Credentials

Username: admin  
Password: admin123  

--------------------------------------------------

## Features Implemented

- Session-based authentication (Login / Logout)
- Course management (Add, View, Edit, Delete)
- Instructor assignment to courses
- Student enrollment into courses
- View enrolled students
- Search courses by category, level, or instructor
- Ajax live course search
- Secure coding practices:
  - Prepared statements (SQL Injection prevention)
  - Output escaping (XSS prevention)
  - CSRF protection for form submission

--------------------------------------------------

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- JavaScript (Ajax / Fetch API)

--------------------------------------------------

## Folder Structure

online_course_system/
│
├── config/
│   └── db.php
│
├── public/
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── add_course.php
│   ├── edit_course.php
│   ├── delete_course.php
│   ├── enroll_student.php
│   ├── view_enrollments.php
│   ├── search.php
│   └── search_ajax.php
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── functions.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── ajax.js
│
└── README.md

--------------------------------------------------

## Setup Instructions

1. Import the provided SQL file into phpMyAdmin
2. Update database credentials in config/db.php if required
3. Place the project folder inside the server root
4. Open /public/login.php in the browser
5. Login using the provided credentials

--------------------------------------------------

## Known Issues

- No role-based access control (optional)
- No pagination (not required)
- Inorder to add more instructors, it must be done from the mysql shell using the terminal
- I have just added the functionality to enroll the students into a course, there is no any edit and delete option due to the time constraint. But, the course does have CRUD functionality.
- Some error handling part

--------------------------------------------------

## Author

Student Full Stack Development Assessment Rohit Prajapati - 2462266
