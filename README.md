Doctor Appointment Management System (DAMS)

Overview

The Doctor Appointment Management System (DAMS) is a web-based application developed using PHP and MySQL that allows patients to book appointments with doctors online. It also provides an admin/doctor panel to manage appointments, patients, and schedules efficiently.
Initially i have developed the website only with the Doctor login, Later during security improvements and fixing vulnerabilities have added the Patient login considering the requirements.

Features

Patient Module

Book appointments online
Select doctor specialization
Choose appointment date and time
View appointment details

Doctor/Admin Module

Manage patient appointments
View and update appointment status
Add/manage doctor specializations
Dashboard for system overview

Authentication

Secure login system
Session-based access control

Demo Login Credentials

Doctor Login

Email:anu@gmail.com
Password:Anu@123

Patient Login
Email:gss@gmail.com
Password:Sai@123

Note: These credentials are for testing/demo purposes only.

Technologies Used

Frontend: HTML, CSS, JavaScript
Backend: PHP
Database: MySQL
Server: Apache (XAMPP/WAMP/LAMP)

Project Structure

dams/
│── index.php
│── doctor/
│── patient/
│── includes/
│── assets/
│── database.sql


Installation Guide

1. Clone the Project using git clone (https://github.com/GowriSaiSanka-P/Doctor-Appointment-Management-System-.php/tree/master)
2. Move the folder inside: htdocs (XAMPP)
3. Setup Database
 Open phpMyAdmin
 Create a database named `damsmsdb`
 Import the `damsmsdb.sql` file
4. Configure Database
includes/dbconnection.php
Update to 
$host = "localhost";
$dbname = "dams";
$username = "root";
$password = "";
5. Run Project in browser:http://localhost/dams

Future Enhancements

Online payment integration
Email/SMS notifications
Doctor availability scheduling
Patient history tracking
