<?php

// Database connection configuration
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tutorial_db";

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL server." . PHP_EOL;

// Select the database
$conn->select_db($dbname);

// Step 1: Creating tables with constraints and keys

// Creating 'users' table with PRIMARY KEY, UNIQUE, NOT NULL, DEFAULT, and AUTO_INCREMENT constraints
$sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,  -- Primary Key with Auto Increment
            username VARCHAR(50) NOT NULL,      -- NOT NULL constraint for mandatory values
            email VARCHAR(100) UNIQUE NOT NULL, -- UNIQUE constraint to prevent duplicate emails
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- DEFAULT value for timestamps
        )";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully." . PHP_EOL;
} else {
    echo "Error creating 'users' table: " . $conn->error . PHP_EOL;
}

// Creating 'posts' table with a FOREIGN KEY constraint referencing 'users' table
$sql = "CREATE TABLE IF NOT EXISTS posts (
            id INT AUTO_INCREMENT PRIMARY KEY, -- Primary Key with Auto Increment
            user_id INT NOT NULL,              -- Foreign Key column
            title VARCHAR(255) NOT NULL,       -- NOT NULL constraint
            content TEXT,                      -- No constraint, optional field
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- DEFAULT value for timestamps
            FOREIGN KEY (user_id) REFERENCES users(id) -- FOREIGN KEY constraint
        )";

if ($conn->query($sql) === TRUE) {
    echo "Table 'posts' created successfully." . PHP_EOL;
} else {
    echo "Error creating 'posts' table: " . $conn->error . PHP_EOL;
}

// Step 2: Demonstrating constraints with sample data

// Inserting data into 'users' table
$sql = "INSERT INTO users (username, email) VALUES 
        ('john_doe', 'john.doe@example.com'),
        ('jane_doe', 'jane.doe@example.com')";
if ($conn->query($sql) === TRUE) {
    echo "Sample users inserted successfully." . PHP_EOL;
} else {
    echo "Error inserting users: " . $conn->error . PHP_EOL;
}

// Inserting data into 'posts' table
$sql = "INSERT INTO posts (user_id, title, content) VALUES 
        (1, 'First Post', 'This is the content of the first post.'),
        (2, 'Second Post', 'Content of the second post.')";
if ($conn->query($sql) === TRUE) {
    echo "Sample posts inserted successfully." . PHP_EOL;
} else {
    echo "Error inserting posts: " . $conn->error . PHP_EOL;
}

// Step 3: Explanation of constraints
// - PRIMARY KEY: Ensures each row has a unique identifier.
// - FOREIGN KEY: Links the 'posts.user_id' to 'users.id', enforcing referential integrity.
// - UNIQUE: Prevents duplicate values in the 'email' column of 'users'.
// - NOT NULL: Ensures mandatory fields are filled (e.g., 'username', 'email').
// - DEFAULT: Provides a default value for 'created_at' when not explicitly provided.
// - AUTO_INCREMENT: Automatically generates a unique number for the 'id' columns.

// Closing the connection
$conn->close();
