<?php
/*
Explanation of Concepts:
Scalar Subquery: Returns a single value, like a single column or aggregate result.

Example: In the query, it fetches the average price from the products table for each category.
Row Subquery: Returns a row with multiple columns.

Example: The query returns the price and description of a product where the id is 1 for each category.
Table Subquery: Returns multiple rows and columns.

Example: The query fetches all products from the products table for each category.
Derived Tables: These are subqueries in the FROM clause. They act as a temporary table in the query.

Example: In the query, the derived table filters products with a price greater than 50 before joining them with categories.
Common Table Expressions (CTEs): Defined using the WITH keyword, they can be reused multiple times in the main query.

Example: A CTE is used to get products with prices greater than 100, which is then queried to retrieve the results.
UNION vs. UNION ALL:

UNION removes duplicate rows from the result set.
UNION ALL includes all rows, even duplicates.
Example: The query demonstrates how these two operators differ by returning category and product names.
CASE Statements: Used to add conditional logic in the query.

Example: The query classifies products as 'Expensive', 'Moderate', or 'Cheap' based on their price using a CASE expression.
*/

// Database connection settings
$host = 'localhost';
$dbname = 'example_db';
$username = 'root';
$password = '';

// Create a new PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

/**
 * Advanced Querying Techniques Tutorial
 */

// 1. Scalar Subquery: A subquery that returns a single value.
echo "\n\n1. Scalar Subquery:\n";
$query = "
    SELECT 
        name,
        (SELECT AVG(price) FROM products) AS average_price
    FROM 
        categories;
";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . " - Average Price: " . $row['average_price'] . "\n";
}

// 2. Row Subquery: A subquery that returns a single row with multiple columns.
echo "\n\n2. Row Subquery:\n";
$query = "
    SELECT 
        name,
        (SELECT price, description FROM products WHERE id = 1) AS product_info
    FROM 
        categories;
";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . " - Product Info: " . implode(", ", $row['product_info']) . "\n";
}

// 3. Table Subquery: A subquery that returns a set of rows (a table).
echo "\n\n3. Table Subquery:\n";
$query = "
    SELECT 
        name,
        (SELECT * FROM products WHERE category_id = categories.id) AS product_details
    FROM 
        categories;
";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . " - Products: " . implode(", ", $row['product_details']) . "\n";
}

/**
 * Derived Tables
 * A derived table is a subquery in the FROM clause, treated as a virtual table.
 */
echo "\n\n4. Derived Table:\n";
$query = "
    SELECT 
        c.name, p.price
    FROM 
        categories c
    JOIN 
        (SELECT * FROM products WHERE price > 50) p
    ON 
        c.id = p.category_id;
";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . " - Price: " . $row['price'] . "\n";
}

/**
 * Common Table Expressions (CTEs)
 * A CTE is defined using the WITH keyword and can be referenced multiple times within the query.
 */
echo "\n\n5. Common Table Expression (CTE):\n";
$query = "
    WITH ProductCTE AS (
        SELECT id, name, price
        FROM products
        WHERE price > 100
    )
    SELECT name, price
    FROM ProductCTE;
";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . " - Price: " . $row['price'] . "\n";
}

/**
 * UNION and UNION ALL
 * UNION combines the results of two queries and removes duplicate rows. UNION ALL does not remove duplicates.
 */
echo "\n\n6. UNION and UNION ALL:\n";
$query = "
    SELECT name FROM categories
    UNION
    SELECT name FROM products;
";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Category or Product Name: " . $row['name'] . "\n";
}

echo "\nUsing UNION ALL:\n";
$query = "
    SELECT name FROM categories
    UNION ALL
    SELECT name FROM products;
";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Category or Product Name (ALL): " . $row['name'] . "\n";
}

/**
 * CASE Statements
 * A CASE statement allows conditional logic within queries.
 */
echo "\n\n7. CASE Statement:\n";
$query = "
    SELECT 
        name,
        CASE 
            WHEN price > 100 THEN 'Expensive'
            WHEN price BETWEEN 50 AND 100 THEN 'Moderate'
            ELSE 'Cheap'
        END AS price_category
    FROM products;
";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . " - Price Category: " . $row['price_category'] . "\n";
}
