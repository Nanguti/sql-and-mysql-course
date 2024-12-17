
# 9. Transactions and Concurrency in MySQL

In MySQL, **transactions** are used to ensure data integrity and consistency, especially when performing multiple operations that should be treated as a single unit of work. A transaction allows you to group multiple queries together, and only if all of them succeed will the changes be committed to the database. If any operation fails, you can roll back the transaction, ensuring that the database is not left in an inconsistent state.

## 1. What Are Transactions?

A **transaction** is a sequence of one or more SQL statements executed as a single unit of work. Transactions are important when you need to ensure that operations such as inserts, updates, and deletes are completed successfully or not at all. This prevents issues where part of the operation succeeds and the rest fails, leaving the database in an inconsistent state.

In MySQL, a transaction begins with the `START TRANSACTION` statement, and can be completed using either `COMMIT` (to save changes) or `ROLLBACK` (to undo changes).

#### Example:
```sql
START TRANSACTION;

UPDATE accounts SET balance = balance - 100 WHERE account_id = 1;
UPDATE accounts SET balance = balance + 100 WHERE account_id = 2;

COMMIT;
```
In this example, the transaction transfers $100 from `account_id = 1` to `account_id = 2`. If both updates are successful, `COMMIT` saves the changes. If there is an error, `ROLLBACK` would undo the changes.

## 2. ACID Properties

ACID stands for four key properties of transactions that guarantee the database’s reliability and consistency:

### **Atomicity**
- Atomicity ensures that all operations within a transaction are completed successfully. If one operation fails, the entire transaction is rolled back, leaving the database unchanged.
- **Example**: If a bank transfer fails midway, the transaction will be rolled back so that no money is transferred, and the balances remain the same.

### **Consistency**
- Consistency ensures that the database moves from one valid state to another. A transaction must take the database from one consistent state to another, ensuring that business rules are followed and the data remains correct.
- **Example**: If a bank transaction violates business rules, like exceeding the account balance, the transaction will not be allowed.

### **Isolation**
- Isolation ensures that transactions are executed independently of each other. Intermediate changes made by one transaction are not visible to other transactions until the transaction is committed.
- **Example**: If two people attempt to withdraw money from the same account at the same time, isolation ensures that the transactions do not interfere with each other.

### **Durability**
- Durability guarantees that once a transaction is committed, its changes are permanent, even if the system crashes afterward.
- **Example**: After a bank transaction is committed, even if the server crashes, the transaction's effects are still saved to the database.

## 3. Using START TRANSACTION, COMMIT, and ROLLBACK

### **START TRANSACTION**
- Starts a new transaction. This indicates that the following operations are part of the transaction.

```sql
START TRANSACTION;
```

### **COMMIT**
- Commits the current transaction, making all changes made during the transaction permanent.

```sql
COMMIT;
```

### **ROLLBACK**
- Rolls back the current transaction, undoing any changes made during the transaction.

```sql
ROLLBACK;
```

#### Example (Complete transaction example):
```sql
START TRANSACTION;

UPDATE accounts SET balance = balance - 100 WHERE account_id = 1;
UPDATE accounts SET balance = balance + 100 WHERE account_id = 2;

-- If no errors, commit the transaction
COMMIT;

-- If there is an error, roll back the transaction
-- ROLLBACK;
```

In this example:
- If both `UPDATE` queries are successful, `COMMIT` will apply the changes.
- If any error occurs, you would use `ROLLBACK` to undo all changes.

## 4. Isolation Levels

In MySQL, isolation levels control how transactions interact with each other and what data is visible to a transaction. The four standard isolation levels are:

### **READ UNCOMMITTED**
- **Lowest isolation level**.
- Transactions can read data that has been modified by other transactions but not yet committed. This may result in **dirty reads**, where one transaction reads uncommitted changes made by another.
- **Example**: One transaction can see another transaction's uncommitted changes (i.e., the data is still in the process of being updated).

```sql
SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
```

### **READ COMMITTED**
- Transactions can only read committed data. Any uncommitted changes made by other transactions are not visible.
- This prevents **dirty reads**, but still allows for **non-repeatable reads**, where the data may change if the transaction runs multiple times.
- **Example**: If a transaction reads a value and another transaction changes it before the first transaction finishes, the first transaction will see a different value if it reads the same data again.

```sql
SET TRANSACTION ISOLATION LEVEL READ COMMITTED;
```

### **REPEATABLE READ**
- Ensures that once a value is read, it cannot change within the same transaction. **Non-repeatable reads** are prevented, but **phantom reads** are still possible. In a phantom read, new rows added by other transactions may not be visible to the current transaction.
- **Example**: A transaction reads a value. If another transaction updates the value, the first transaction will still see the old value during its execution, ensuring consistent results.

```sql
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;
```

### **SERIALIZABLE**
- **Highest isolation level**.
- Transactions are executed in a way that they are completely isolated from each other. This prevents both dirty and non-repeatable reads, as well as phantom reads.
- This level can cause **locking** and performance issues, as it forces transactions to wait for others to complete.
- **Example**: Transactions act as though they are executed one after the other, ensuring complete isolation but potentially leading to slow performance in highly concurrent systems.

```sql
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;
```

### Example of Using Isolation Levels:
```sql
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

START TRANSACTION;

-- Some SQL operations here

COMMIT;
```

## 5. Conclusion

- **Transactions** are a vital part of ensuring data integrity in database operations.
- **ACID properties** (Atomicity, Consistency, Isolation, Durability) guarantee that transactions are executed reliably.
- MySQL provides isolation levels to control the behavior of transactions in a multi-user environment, ensuring that transactions can operate with varying degrees of concurrency control.

By using `START TRANSACTION`, `COMMIT`, and `ROLLBACK`, along with adjusting the isolation level as needed, you can manage database concurrency effectively and ensure that operations are atomic and consistent.
