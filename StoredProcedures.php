<?php

/**
 * 10. Stored Procedures and Functions in MySQL
 * 
 * This PHP file contains a tutorial on stored procedures and functions in MySQL. It covers the following topics:
 * - What are stored procedures and functions?
 * - Creating and calling stored procedures
 * - Creating and using functions
 * - Handling parameters: IN, OUT, INOUT
 * - Error handling in procedures
 */

/**
 * What are Stored Procedures and Functions?
 * 
 * Stored procedures and functions are essential for encapsulating business logic directly in the database.
 * They allow for the reusability of code, better performance (as operations are executed on the server), and improved security
 * by controlling access to the database.
 * 
 * Stored Procedure: A collection of SQL statements executed on the MySQL server as a single unit of work.
 * Function: A set of SQL statements that return a single value, and they can be used in SQL queries.
 */

/**
 * Creating and Calling Stored Procedures
 * 
 * Stored procedures are created using the CREATE PROCEDURE statement and can be called with the CALL statement.
 * Example:
 * 
 * -- Creating the TransferFunds procedure
 * CREATE PROCEDURE TransferFunds(IN sender_id INT, IN recipient_id INT, IN amount DECIMAL(10,2))
 * BEGIN
 *     UPDATE accounts SET balance = balance - amount WHERE account_id = sender_id;
 *     UPDATE accounts SET balance = balance + amount WHERE account_id = recipient_id;
 * END;
 * 
 * You can call the procedure using:
 * 
 * -- Calling the TransferFunds procedure
 * CALL TransferFunds(1, 2, 100.00);
 */

/**
 * Creating and Using Functions
 * 
 * Functions are created using the CREATE FUNCTION statement. They return a single value and can be used in SQL queries.
 * Example:
 * 
 * -- Creating the CalculateArea function
 * CREATE FUNCTION CalculateArea(radius DECIMAL(10,2)) 
 * RETURNS DECIMAL(10,2)
 * BEGIN
 *     RETURN PI() * radius * radius;
 * END;
 * 
 * The function can be used in a query as follows:
 * 
 * -- Calling the CalculateArea function
 * SELECT CalculateArea(10);
 */

/**
 * Handling Parameters: IN, OUT, INOUT
 * 
 * Parameters can be passed into or out of procedures and functions:
 * 
 * - IN: The parameter is used to pass data into the procedure or function.
 * - OUT: The parameter is used to return data from the procedure or function.
 * - INOUT: The parameter is used for both input and output.
 */

/**
 * Example of IN Parameter:
 * 
 * -- Creating the AddBonus procedure with an IN parameter
 * CREATE PROCEDURE AddBonus(IN bonus_amount DECIMAL(10,2))
 * BEGIN
 *     UPDATE employees SET salary = salary + bonus_amount;
 * END;
 */

/**
 * Example of OUT Parameter:
 * 
 * -- Creating the GetEmployeeSalary procedure with an OUT parameter
 * CREATE PROCEDURE GetEmployeeSalary(IN emp_id INT, OUT emp_salary DECIMAL(10,2))
 * BEGIN
 *     SELECT salary INTO emp_salary FROM employees WHERE employee_id = emp_id;
 * END;
 * 
 * -- Calling the GetEmployeeSalary procedure
 * CALL GetEmployeeSalary(1, @salary);
 * SELECT @salary;
 */

/**
 * Example of INOUT Parameter:
 * 
 * -- Creating the UpdateSalary procedure with an INOUT parameter
 * CREATE PROCEDURE UpdateSalary(INOUT emp_id INT, IN salary_increase DECIMAL(10,2))
 * BEGIN
 *     UPDATE employees SET salary = salary + salary_increase WHERE employee_id = emp_id;
 *     SET emp_id = emp_id + 1; -- Modifies emp_id value
 * END;
 * 
 * -- Calling the UpdateSalary procedure
 * CALL UpdateSalary(1, 5000.00);
 */

/**
 * Error Handling in Procedures
 * 
 * MySQL provides error handling through the DECLARE...HANDLER statement. This allows you to handle specific errors or
 * conditions during the execution of the procedure.
 * 
 * Example of error handling:
 * 
 * -- Declaring an error handler and creating the SafeTransfer procedure
 * DELIMITER //
 * CREATE PROCEDURE SafeTransfer(IN sender_id INT, IN recipient_id INT, IN amount DECIMAL(10,2))
 * BEGIN
 *     DECLARE insufficient_funds CONDITION FOR SQLSTATE '45000';
 *     DECLARE EXIT HANDLER FOR insufficient_funds
 *         ROLLBACK;
 *     
 *     START TRANSACTION;
 *     
 *     -- Check if sender has enough funds
 *     IF (SELECT balance FROM accounts WHERE account_id = sender_id) < amount THEN
 *         SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Insufficient funds';
 *     END IF;
 *     
 *     UPDATE accounts SET balance = balance - amount WHERE account_id = sender_id;
 *     UPDATE accounts SET balance = balance + amount WHERE account_id = recipient_id;
 *     
 *     COMMIT;
 * END;
 * DELIMITER ;
 */

/**
 * Conclusion
 * 
 * Stored procedures and functions are powerful tools in MySQL for managing business logic, improving performance,
 * and enhancing security. By using parameters and proper error handling, you can build robust and efficient database applications.
 */
