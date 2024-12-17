<?php

/**
 * 15. Advanced MySQL Features
 * 
 * This PHP file contains a tutorial on advanced MySQL features. It covers the following topics:
 * - Views
 * - Partitioning tables
 * - Using Window functions
 * - Full-Text Search
 */

/**
 * Views in MySQL
 * 
 * A view in MySQL is a virtual table based on the result set of an SQL query. It allows you to save complex queries as reusable entities.
 * 
 * Views are useful for abstracting complex queries and presenting simplified data to users or applications.
 */

/**
 * Creating and Using Views
 * 
 * A view can be created using the `CREATE VIEW` statement. Once created, the view can be used like a regular table in SELECT queries.
 * 
 * Example of creating a view:
 * 
 * -- Creating a view to select employee details with department information
 * CREATE VIEW employee_view AS
 * SELECT employees.employee_id, employees.name, employees.salary, departments.department_name
 * FROM employees
 * JOIN departments ON employees.department_id = departments.department_id;
 * 
 * You can then use the view like a table:
 * 
 * -- Querying the view for employee details
 * SELECT * FROM employee_view;
 */

/**
 * Advantages of Views
 * 
 * Views provide several advantages:
 * - Simplify complex queries: You can create a view to encapsulate complex queries, making it easier to work with.
 * - Security: By restricting access to certain columns or tables, views can provide an additional layer of security.
 * - Data abstraction: Views can hide the complexity of the underlying database schema from the user or application.
 */

/**
 * Materialized Views (if applicable)
 * 
 * Materialized views store the result of the query physically, unlike regular views that are virtual and executed on the fly.
 * However, MySQL does not natively support materialized views. You can simulate them by creating a table and periodically refreshing it with the results of a query.
 * 
 * Example of simulating a materialized view:
 * 
 * -- Creating a table to store the results of the view
 * CREATE TABLE employee_view_table AS
 * SELECT employees.employee_id, employees.name, employees.salary, departments.department_name
 * FROM employees
 * JOIN departments ON employees.department_id = departments.department_id;
 * 
 * You can then refresh this table periodically by running the query again and updating the table.
 */

/**
 * Partitioning Tables in MySQL
 * 
 * Partitioning allows you to split large tables into smaller, more manageable pieces, called partitions. Each partition can be stored and queried separately, which can improve performance and ease of management.
 * 
 * MySQL supports several types of partitioning:
 * - RANGE partitioning
 * - LIST partitioning
 * - HASH partitioning
 * - KEY partitioning
 * 
 * Example of RANGE partitioning:
 * 
 * -- Creating a partitioned table for employee records based on salary ranges
 * CREATE TABLE employees (
 *     employee_id INT,
 *     name VARCHAR(100),
 *     salary DECIMAL(10, 2)
 * ) 
 * PARTITION BY RANGE (salary) (
 *     PARTITION p0 VALUES LESS THAN (50000),
 *     PARTITION p1 VALUES LESS THAN (100000),
 *     PARTITION p2 VALUES LESS THAN (150000)
 * );
 */

/**
 * Using Window Functions
 * 
 * Window functions allow you to perform calculations across a set of rows related to the current row. These functions are used to perform operations like ranking, calculating moving averages, and more, without needing to group the results.
 * 
 * Some commonly used window functions are:
 * - `ROW_NUMBER()`: Assigns a unique sequential integer to rows within a partition.
 * - `RANK()`: Assigns ranks to rows within a partition, with gaps in the ranking for ties.
 * - `NTILE()`: Divides the result set into a specified number of buckets.
 * - `LAG()`: Accesses the value of a column from a previous row in the result set.
 * - `LEAD()`: Accesses the value of a column from a subsequent row in the result set.
 */

/**
 * Example of using ROW_NUMBER():
 * 
 * -- Assigning a row number to each employee based on salary, ordered from highest to lowest
 * SELECT employee_id, name, salary,
 *        ROW_NUMBER() OVER (ORDER BY salary DESC) AS row_num
 * FROM employees;
 */

/**
 * Example of using RANK():
 * 
 * -- Ranking employees based on salary, with gaps in the ranking for ties
 * SELECT employee_id, name, salary,
 *        RANK() OVER (ORDER BY salary DESC) AS rank
 * FROM employees;
 */

/**
 * Example of using NTILE():
 * 
 * -- Dividing employees into 4 groups based on salary
 * SELECT employee_id, name, salary,
 *        NTILE(4) OVER (ORDER BY salary DESC) AS quartile
 * FROM employees;
 */

/**
 * Example of using LAG():
 * 
 * -- Getting the previous employee's salary compared to the current employee
 * SELECT employee_id, name, salary,
 *        LAG(salary) OVER (ORDER BY salary DESC) AS previous_salary
 * FROM employees;
 */

/**
 * Example of using LEAD():
 * 
 * -- Getting the next employee's salary compared to the current employee
 * SELECT employee_id, name, salary,
 *        LEAD(salary) OVER (ORDER BY salary DESC) AS next_salary
 * FROM employees;
 */

/**
 * Full-Text Search in MySQL
 * 
 * Full-Text Search allows you to search for words or phrases within text-based columns. This is ideal for searching through long text fields or large amounts of unstructured data.
 * 
 * MySQL supports Full-Text Search using the `MATCH` and `AGAINST` operators.
 */

/**
 * MATCH and AGAINST for Searching Text Fields
 * 
 * The `MATCH` operator is used to perform a full-text search on a column, while `AGAINST` specifies the search query.
 * Full-text indexes must be created on the columns you want to search.
 * 
 * Example of creating a full-text index:
 * 
 * -- Creating a full-text index on the `description` column
 * CREATE FULLTEXT INDEX idx_description ON products(description);
 * 
 * Example of performing a full-text search:
 * 
 * -- Searching for products with the keyword 'laptop'
 * SELECT * FROM products
 * WHERE MATCH(description) AGAINST('laptop');
 */

/**
 * Conclusion
 * 
 * Advanced MySQL features like views, partitioning, window functions, and full-text search provide powerful capabilities for optimizing your database queries and managing large datasets.
 * 
 * Key takeaways:
 * - Views simplify complex queries and improve security.
 * - Partitioning helps with managing large tables and improving query performance.
 * - Window functions allow for advanced analytical queries without grouping.
 * - Full-text search enables efficient searching of text-based data.
 */
