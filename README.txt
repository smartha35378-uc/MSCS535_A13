ASSIGNMENT 14

PROJECT TITLE

Secure Website Registration Example Using HTML, JavaScript, PHP, and SQLite

PROJECT DESCRIPTION

This project is a secure website registration example created for an assignment that requires:

HTML tags that make sense
JavaScript code that makes sense
PHP code that makes sense
SQL code for the database that makes sense

The project shows how a website form can collect user information and store it securely in a database.

TECHNOLOGIES USED

HTML
JavaScript
PHP
SQLite
SQL

PROJECT FILES

index.html
Contains the website form with semantic HTML tags, labels, input fields, and a submit button.

script.js
Contains JavaScript validation to check that all fields are filled in, that the email format is valid, and that the password is long enough before the form is submitted.

process.php
Contains the PHP code that:
Receives the form data
Validates the data on the server side
Connects securely to the SQLite database using PDO
Creates the users table if it does not already exist
Stores the user information using a prepared statement
Hashes the password before saving it

schema.sql
Contains the SQL table definition for the users table.

HOW THE PROJECT WORKS

1. The user opens index.html and fills out the registration form.
2. JavaScript checks the form before submission.
3. The form sends data to process.php using the POST method.
4. PHP validates the data again on the server side.
5. PHP connects to the SQLite database file named secure_db.sqlite.
6. PHP creates the users table if it does not already exist.
7. PHP hashes the password and stores the data securely in the database.

SECURE CODING FEATURES

Client-side validation in JavaScript
Server-side validation in PHP
POST method used for form submission
PDO used for secure database connection
Prepared statements used to prevent SQL injection
Password hashing used to protect passwords
Output escaping used to prevent unsafe HTML output
Unique email constraint in the database

SQL DATABASE DETAILS

The SQL table includes:

id as the primary key
name as a required field
email as a required unique field
password_hash as a required field
created_at timestamp for record creation

PROJECT STATUS

This project is complete as a secure code example for the assignment rubric.
To run it as a working website, PHP must be installed and a local PHP server must be used.

EXAMPLE

If PHP is installed, the project can be run with a local server such as:

php -S localhost:8000

Then open the site in a browser and submit the form. The SQLite database file will be created automatically after a successful form submission.
