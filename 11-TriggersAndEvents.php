<?php

/**
 * 11. Triggers and Events in MySQL
 * 
 * This PHP file contains a tutorial on triggers and events in MySQL. It covers the following topics:
 * - What are triggers?
 * - BEFORE and AFTER triggers
 * - Use cases for triggers
 * - What are events?
 * - Scheduled tasks with CREATE EVENT
 * - Automating repetitive database tasks
 */

/**
 * What are Triggers?
 * 
 * Triggers are a type of stored procedure that automatically execute when certain events occur in the database. 
 * They can be used to enforce data integrity, maintain audit logs, and automate actions in response to data changes.
 * 
 * Triggers are defined to execute either before or after an INSERT, UPDATE, or DELETE operation.
 * 
 * Triggers can be categorized into two types:
 * - BEFORE triggers: These are executed before the triggering event (INSERT, UPDATE, DELETE).
 * - AFTER triggers: These are executed after the triggering event (INSERT, UPDATE, DELETE).
 */

/**
 * BEFORE and AFTER Triggers
 * 
 * - BEFORE triggers: Useful for validating or modifying data before it is actually written to the database.
 * - AFTER triggers: Useful for actions that need to happen after the database modification has occurred (e.g., logging, cascading changes).
 * 
 * Example of a BEFORE Trigger:
 * 
 * -- Creating a BEFORE INSERT trigger to prevent inserting a negative balance
 * DELIMITER //
 * CREATE TRIGGER prevent_negative_balance
 * BEFORE INSERT ON accounts
 * FOR EACH ROW
 * BEGIN
 *     IF NEW.balance < 0 THEN
 *         SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Balance cannot be negative';
 *     END IF;
 * END;
 * DELIMITER ;
 * 
 * Example of an AFTER Trigger:
 * 
 * -- Creating an AFTER UPDATE trigger to log changes in employee salary
 * DELIMITER //
 * CREATE TRIGGER log_salary_changes
 * AFTER UPDATE ON employees
 * FOR EACH ROW
 * BEGIN
 *     INSERT INTO salary_log (employee_id, old_salary, new_salary, change_date)
 *     VALUES (OLD.employee_id, OLD.salary, NEW.salary, NOW());
 * END;
 * DELIMITER ;
 */

/**
 * Use Cases for Triggers
 * 
 * Triggers can be used in various scenarios, such as:
 * - Enforcing data integrity: Automatically check or modify data before it is inserted or updated.
 * - Auditing changes: Track changes to important tables (e.g., logging updates or deletions).
 * - Automatic updates: Automatically updating related data when certain fields change.
 * - Preventing invalid data: For example, preventing a user from deleting records that are still in use.
 */

/**
 * What are Events?
 * 
 * Events are scheduled tasks that allow you to run SQL queries at specific intervals or at a particular time.
 * These are useful for automating repetitive database tasks, such as archiving old data, cleaning up logs, or performing scheduled backups.
 * 
 * Events are managed by the MySQL Event Scheduler, which must be enabled for events to run.
 */

/**
 * Scheduled Tasks with CREATE EVENT
 * 
 * Events are created using the CREATE EVENT statement. You can specify the schedule (e.g., once, daily, weekly) 
 * and the action (the SQL query) to be executed.
 * 
 * Example of creating an event to delete old records:
 * 
 * -- Enabling the Event Scheduler (if not already enabled)
 * SET GLOBAL event_scheduler = ON;
 * 
 * -- Creating an event to delete records older than 30 days from the "logs" table
 * CREATE EVENT delete_old_logs
 * ON SCHEDULE EVERY 1 DAY
 * STARTS '2024-12-01 00:00:00'
 * DO
 *     DELETE FROM logs WHERE log_date < NOW() - INTERVAL 30 DAY;
 * 
 * The event will run every day and delete records older than 30 days from the `logs` table.
 */

/**
 * Automating Repetitive Database Tasks
 * 
 * Events are particularly useful for automating tasks that need to be repeated at regular intervals, such as:
 * - Data cleanup (e.g., deleting old records, archiving data).
 * - Generating reports (e.g., summarizing monthly sales).
 * - Backing up data or creating backups of specific tables.
 * 
 * Example of an event that generates a daily sales report:
 * 
 * -- Creating an event that generates a daily sales report at 2:00 AM
 * CREATE EVENT daily_sales_report
 * ON SCHEDULE EVERY 1 DAY
 * STARTS '2024-12-01 02:00:00'
 * DO
 *     INSERT INTO daily_report (total_sales, report_date)
 *     SELECT SUM(sale_amount), CURDATE() FROM sales WHERE sale_date = CURDATE();
 */

/**
 * Conclusion
 * 
 * Triggers and events are powerful tools in MySQL that help automate database tasks and ensure data integrity.
 * - Triggers are used to execute actions automatically in response to specific database events (INSERT, UPDATE, DELETE).
 * - Events are used to schedule and automate repetitive tasks at predefined intervals.
 * 
 * Both are essential for creating efficient, automated, and well-maintained database systems.
 */
