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

// Step 1: Types of Joins

// Inner Join
// Fetch data from two tables where there is a matching record in both tables.
$sql = "SELECT users.id, users.username, orders.order_date, orders.amount 
        FROM users 
        INNER JOIN orders ON users.id = orders.user_id";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Inner Join Results:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

// Left Join
// Fetch all records from the left table and the matching records from the right table.
$sql = "SELECT users.id, users.username, orders.order_date, orders.amount 
        FROM users 
        LEFT JOIN orders ON users.id = orders.user_id";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Left Join Results:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

// Right Join
// Fetch all records from the right table and the matching records from the left table.
$sql = "SELECT users.id, users.username, orders.order_date, orders.amount 
        FROM users 
        RIGHT JOIN orders ON users.id = orders.user_id";
$result = $conn->query(query: $sql);
if ($result->num_rows > 0) {
    echo "Right Join Results:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r(value: $row);
    }
}

// Full Outer Join
// Fetch all records where there is a match in either table. (Not directly supported by MySQL, simulated using UNION)
$sql = "SELECT users.id, users.username, orders.order_date, orders.amount 
        FROM users 
        LEFT JOIN orders ON users.id = orders.user_id
        UNION
        SELECT users.id, users.username, orders.order_date, orders.amount 
        FROM users 
        RIGHT JOIN orders ON users.id = orders.user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Full Outer Join Results:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}

// Self Join
// Fetch data by joining a table with itself.
$sql = "SELECT a.username AS User1, b.username AS User2 
        FROM users a, users b 
        WHERE a.id <> b.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Self Join Results:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}

// Step 2: Working with Multiple Tables

// Example of fetching data from related tables
$sql = "SELECT users.username, orders.order_date, products.product_name 
        FROM users 
        INNER JOIN orders ON users.id = orders.user_id
        INNER JOIN products ON orders.product_id = products.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Data from Multiple Tables:" . PHP_EOL;
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}

// Step 3: Entity-Relationship (ER) Diagrams
// ER diagrams visually represent the relationships between tables.
// Example: A "Users" table is connected to an "Orders" table through "user_id".

/*
Table structures:

Users Table:
- id (Primary Key)
- username

Orders Table:
- id (Primary Key)
- user_id (Foreign Key to Users.id)
- order_date
- amount

Products Table:
- id (Primary Key)
- product_name
*/

// Step 4: Understanding Normalization

// 1NF: Ensure atomic values (no repeating groups or arrays).
// Example: Each cell contains a single value.

// 2NF: Ensure that each non-primary key attribute is fully dependent on the primary key.
// Example: Orders table depends entirely on "id" as its primary key.

// 3NF: Remove transitive dependencies (non-primary key attributes depend only on the primary key).
// Example: Products table avoids storing redundant details like supplier info.

// BCNF: Every determinant must be a candidate key.
// Example: Addressing anomalies in composite keys.

// Closing the connection
$conn->close();
