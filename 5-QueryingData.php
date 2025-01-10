<?php

// Database connection configuration
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sql_tut";

// Create a new MySQLi connection
$conn = new mysqli(hostname: $host, username: $user, password: $password, database: $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL server." . PHP_EOL;

// Step 1: Advanced SELECT Statements

// Using ALIASES with SELECT statements
$sql = "SELECT name AS user, email AS email_address FROM users";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Users with Aliases:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

// Filtering data with WHERE, LIKE, BETWEEN, and IN
$sql = "SELECT * FROM users WHERE name LIKE 'j%';"; // Names starting with 'j'
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Filtered Users (name LIKE 'j%'):" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

$sql = "SELECT * FROM users WHERE id BETWEEN 1 AND 5;"; // IDs between 1 and 5
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Users with IDs between 1 and 5:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}

$sql = "SELECT * FROM users WHERE id IN (1, 2);"; // IDs matching 1 or 2
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Users with IDs 1 or 2:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

// Using Logical Operators: AND, OR, NOT
$sql = "SELECT * FROM users WHERE name LIKE 'j%' AND email LIKE '%yahoo.com';"; // Starts with 'j' AND contains 'example.com'
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Users matching logical operators (AND):" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

// Step 2: Using Functions in Queries

// Aggregate functions: COUNT, SUM, AVG, MAX, MIN
$sql = "SELECT COUNT(*) AS user_count FROM users";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Total Users: " . $row['user_count'] . PHP_EOL;
}

$sql = "SELECT MAX(id) AS max_id FROM users";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Highest User ID: " . $row['max_id'] . PHP_EOL;
}

// String functions: CONCAT, LENGTH, UPPER, LOWER
$sql = "SELECT CONCAT(name, ' <', email, '>') AS user_email FROM users";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Concatenated User Emails:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

$sql = "SELECT name, LENGTH(name) AS username_length FROM users";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Username Lengths:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

// Date functions: NOW, CURDATE, DATEDIFF
$sql = "SELECT NOW() AS current_time, CURDATE() AS current_date";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Current Date and Time: " . PHP_EOL;
    print_r(value: $row);
}

$sql = "SELECT DATEDIFF(NOW(), created_at) AS days_since_created FROM users";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Days Since User Creation:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

// Closing the connection
$conn->close();
