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

- Role-based access control is not implemented (optional feature).
- To add new instructors, you must currently use MySQL directly (via phpMyAdmin or terminal).
- Student enrollment functionality is implemented, but editing or deleting enrolled students is not available due to time constraints.
- Some error handling is still basic and may need improvement.
- There is only one login account for the system at the moment; multi-user functionality is not implemented yet.

--------------------------------------------------

## Author

Rohit Prajapati – Student Full Stack Development Assessment – ID: 2462266