# 10. Stored Procedures and Functions in MySQL

Stored procedures and functions are essential for encapsulating business logic directly in the database. They allow for the reusability of code, better performance (as operations are executed on the server), and improved security by controlling access to the database.

## 1. What Are Stored Procedures and Functions?

### **Stored Procedures**

A **stored procedure** is a collection of SQL statements that can be executed on the MySQL server. It allows you to define a set of operations to be executed as a single unit. Stored procedures can be invoked using a `CALL` statement, and they may return results or modify data.

### **Functions**

A **function** is similar to a stored procedure, but it must return a single value (scalar or table). Functions are typically used for computations, and they can be used in SQL queries as expressions.

## 2. Creating and Calling Stored Procedures

### **Creating a Stored Procedure**

You can create a stored procedure using the `CREATE PROCEDURE` statement. Here is an example of a procedure that accepts two input parameters and performs a simple operation:

```sql
DELIMITER //

CREATE PROCEDURE TransferFunds(IN sender_id INT, IN recipient_id INT, IN amount DECIMAL(10,2))
BEGIN
    UPDATE accounts SET balance = balance - amount WHERE account_id = sender_id;
    UPDATE accounts SET balance = balance + amount WHERE account_id = recipient_id;
END //

DELIMITER ;
```

In the above example:

IN parameters are used to pass values into the procedure.
The procedure deducts money from one account and adds it to another.
Calling a Stored Procedure
Once the procedure is created, you can call it using the CALL statement:
CALL TransferFunds(1, 2, 100.00);
