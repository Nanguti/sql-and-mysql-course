<?php

// Database connection configuration
// Define the database host, username, password, and database name for the connection.
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

// Select the database
$conn->select_db($dbname);

// Step 1: Creating a table with various data types
// The following code creates a 'data_types_demo' table to demonstrate different MySQL data types.
$sql = "CREATE TABLE IF NOT EXISTS data_types_demo (
            id INT AUTO_INCREMENT PRIMARY KEY,       -- Numeric type: INT for primary key
            name VARCHAR(50) NOT NULL,              -- String type: VARCHAR for variable-length text
            description TEXT,                       -- String type: TEXT for large text data
            price DECIMAL(10, 2),                   -- Numeric type: DECIMAL for exact values
            rating FLOAT,                           -- Numeric type: FLOAT for approximate values
            created_at DATETIME,                    -- Date/Time type: DATETIME for specific datetime
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
            ON UPDATE CURRENT_TIMESTAMP -- Date/Time type: TIMESTAMP with automatic update
        )";

if ($conn->query($sql) === TRUE) {
    echo "Table 'data_types_demo' created successfully." . PHP_EOL;
} else {
    echo "Error creating table: " . $conn->error . PHP_EOL;
}

// Step 2: Inserting data into the table
// Insert sample records demonstrating the use of different data types.
$sql = "INSERT INTO data_types_demo (name, description, price, rating, created_at) VALUES 
        ('Item A', 'Description for Item A', 123.45, 4.5, '2024-01-01 10:00:00'),
        ('Item B', 'Description for Item B', 678.90, 3.8, '2024-01-02 11:00:00')";
if ($conn->query($sql) === TRUE) {
    echo "Sample data inserted successfully." . PHP_EOL;
} else {
    echo "Error inserting data: " . $conn->error . PHP_EOL;
}

// Step 3: Querying data from the table
// Retrieve and display all records to illustrate the data types in use.
$sql = "SELECT * FROM data_types_demo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Records from 'data_types_demo':" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "No records found." . PHP_EOL;
}

// Step 4: Choosing the right data types for columns
// Example notes:
// - Use INT for numeric identifiers like primary keys.
// - Use VARCHAR for variable-length strings (e.g., names) with a defined maximum length.
// - Use TEXT for large blocks of text (e.g., descriptions).
// - Use DECIMAL for precise numeric values (e.g., prices).
// - Use FLOAT for approximate numeric values (e.g., ratings).
// - Use DATE, DATETIME, or TIMESTAMP based on your needs for date/time tracking.

// Closing the connection
$conn->close();
