<?php

// Database connection configuration
// Define the database host, username, password, and database name for the connection.
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sql_tut";

// Create a new MySQLi connection
$conn = new mysqli($host, username: $user, password: $password, database: $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL server." . PHP_EOL;
// Step 1: Data Definition Language (DDL)

// Creating a new database
// The following code creates a database named 'tutorial_db' if it doesn't already exist.
$sql = "CREATE DATABASE IF NOT EXISTS sql_tut";
if ($conn->query($sql) == TRUE) {
    echo "Database created successfully" . PHP_EOL;
} else {
    echo "Unable to create the database" . PHP_EOL;
}
// Switching to the created database
// Select the 'tutorial_db' database to execute subsequent commands within it.
$conn->select_db($dbname);

// Creating a new table
// The following code creates a 'users' table with columns for ID, name, email, and timestamps.
$sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            phone VARCHAR(15),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
if ($conn->query(query: $sql) === TRUE) {
    echo "Table 'users' created successfully." . PHP_EOL;
} else {
    echo "Error creating table: " . $conn->error . PHP_EOL;
}

// Step 2: Data Manipulation Language (DML)

// Inserting data into the table
// Insert sample records into the 'users' table.
$sql = "INSERT INTO users(name, email, phone) VALUES ('Kevin Wanyonyi', 'kevin@gmail.com', '0726076333'), ('Nanguti Wafula Wanyonyi', 'wafula@xmail.com', '0724076334')";
if ($conn->query($sql) === TRUE) {
    echo "Records inserted successfully." . PHP_EOL;
} else {
    echo "Error inserting records: " . $conn->error . PHP_EOL;
}
// Updating data in the table
// Update the phone number for the user named 'John Doe'.
$sql = "UPDATE users SET email = 'updatedemail@gmail.com' WHERE id = 1";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully." . PHP_EOL;
} else {
    echo "Error updating record: " . $conn->error . PHP_EOL;
}

// Deleting data from the table
// Delete the record for the user named 'Jane Smith'.
$sql = "DELETE FROM users WHERE name = 'Kevin Wanyonyi'";
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully." . PHP_EOL;
} else {
    echo "Error deleting record: " . $conn->error . PHP_EOL;
}

// Step 3: Querying Data

// Selecting all data from the table
// Retrieve all records from the 'users' table.
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "All Users:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "No records found." . PHP_EOL;
}

// Using WHERE clause
// Filter records where the name contains 'John'.
$sql = "SELECT * FROM users WHERE name LIKE '%Kevin%'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Filtered Users (name contains 'Kevin'):" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "No records found for filter." . PHP_EOL;
}

// Sorting data with ORDER BY
// Retrieve records from the 'users' table ordered by 'created_at' in descending order.
$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Users Ordered by Created Date (Descending):" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "No records found." . PHP_EOL;
}

// Limiting results
// Retrieve only the first record from the 'users' table.
$sql = "SELECT * FROM users LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "First User (LIMIT 1):" . PHP_EOL;
    print_r($result->fetch_assoc());
} else {
    echo "No records found." . PHP_EOL;
}

// Closing the connection
$conn->close();
