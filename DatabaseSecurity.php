<?php

/**
 * 12. Database Security in MySQL
 * 
 * This PHP file contains a tutorial on database security in MySQL. It covers the following topics:
 * - User management
 * - Securing connections
 * - Data encryption at rest and in transit
 * - Protecting against SQL injection
 */

/**
 * User Management
 * 
 * User management is a key aspect of database security. You can create users, grant or revoke privileges, and manage access control to ensure that only authorized users can perform specific actions on the database.
 */

/**
 * Creating Users
 * 
 * Users are created using the CREATE USER statement. The user can be granted specific privileges on specific databases or tables.
 * 
 * Example of creating a user:
 * 
 * -- Creating a new user 'john' with a password
 * CREATE USER 'john'@'localhost' IDENTIFIED BY 'password123';
 */

/**
 * Granting and Revoking Privileges
 * 
 * After creating a user, you can grant or revoke privileges to allow or restrict access to databases or tables.
 * - GRANT: Used to grant privileges to users.
 * - REVOKE: Used to remove privileges from users.
 * 
 * Example of granting privileges to the user:
 * 
 * -- Granting SELECT and INSERT privileges on the `employees` table
 * GRANT SELECT, INSERT ON employees TO 'john'@'localhost';
 * 
 * Example of revoking privileges from the user:
 * 
 * -- Revoking SELECT privileges on the `employees` table
 * REVOKE SELECT ON employees FROM 'john'@'localhost';
 */

/**
 * Securing Connections
 * 
 * To ensure secure communication between the client and the database server, you should use SSL/TLS encryption to protect against eavesdropping and man-in-the-middle attacks.
 * MySQL supports SSL encryption for connections, which can be enabled when creating a user or configuring the server.
 * 
 * Example of creating a user with SSL encryption:
 * 
 * -- Creating a user with SSL encryption for secure connection
 * CREATE USER 'john'@'localhost' IDENTIFIED BY 'password123' REQUIRE SSL;
 * 
 * You can also configure MySQL to require SSL for all connections by editing the server configuration file (my.cnf).
 */

/**
 * Data Encryption at Rest and in Transit
 * 
 * Data encryption is critical to protect sensitive information both at rest (on disk) and in transit (during transmission).
 * 
 * - Encryption at Rest: Protects data when stored in the database by encrypting files on the disk.
 * - Encryption in Transit: Protects data during transmission over the network by using SSL/TLS encryption.
 * 
 * Example of enabling SSL for connections to ensure encryption in transit:
 * 
 * -- Enabling SSL for secure communication
 * GRANT ALL PRIVILEGES ON *.* TO 'john'@'localhost' REQUIRE SSL;
 * 
 * For encryption at rest, you can use MySQL's built-in features or third-party solutions to encrypt the database files.
 */

/**
 * Protecting Against SQL Injection
 * 
 * SQL injection is a serious security vulnerability where attackers can manipulate SQL queries by injecting malicious code into the query input.
 * To protect against SQL injection, you should:
 * - Use parameterized queries.
 * - Use Object-Relational Mapping (ORM) frameworks that automatically handle SQL query construction and data binding.
 */

/**
 * Parameterized Queries
 * 
 * Parameterized queries allow you to safely pass user input into SQL queries without the risk of SQL injection. The parameters are treated as data rather than executable code, making it impossible for attackers to inject malicious SQL.
 * 
 * Example of a parameterized query in PHP using MySQLi:
 * 
 * -- Using a parameterized query to select an employee by ID
 * $stmt = $mysqli->prepare("SELECT * FROM employees WHERE employee_id = ?");
 * $stmt->bind_param("i", $employee_id);  // 'i' indicates an integer type
 * $stmt->execute();
 * $result = $stmt->get_result();
 * 
 * This ensures that the user input is properly escaped and avoids any risk of SQL injection.
 */

/**
 * Using ORM for Safer Queries
 * 
 * ORM (Object-Relational Mapping) frameworks abstract SQL query construction and allow you to interact with the database using high-level object-oriented code. Most modern ORMs automatically handle SQL injection protection by parameterizing queries behind the scenes.
 * 
 * Example of using an ORM (e.g., Laravel's Eloquent ORM) to safely query the database:
 * 
 * -- Using Laravel's Eloquent ORM to find an employee by ID
 * $employee = Employee::find($employee_id);
 * 
 * This code is safe from SQL injection because the ORM handles the parameter binding for you.
 */

/**
 * Conclusion
 * 
 * Database security is an essential part of building secure applications. By managing users and their privileges, securing connections, encrypting data, and protecting against SQL injection, you can significantly reduce the risks to your MySQL database.
 * 
 * Key best practices include:
 * - Proper user management (create users with limited privileges).
 * - Use SSL/TLS to secure database connections.
 * - Encrypt sensitive data both at rest and in transit.
 * - Use parameterized queries and ORMs to prevent SQL injection.
 */
