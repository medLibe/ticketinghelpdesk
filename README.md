<h1>Ticketing Helpdesk</h1>
![](https://drive.google.com/file/d/1-Pc8e8DdXtr7dPJM2jQGs1CNm4REwzCB/view?usp=sharing)
Ticketing Helpdesk is an Web based system that make other department easier to ask helpdesk from IT department.

How to use:
1. Create a database, for example 'ticketing' in your DBMS.
2. Open the project in your text editor, edit .env file and write your database name in .env file.
3. Open this project on your terminal.
4. Run 'php artisan serve'.
5. Run 'php artisan migrate:fresh'.
6. Congratulations the app run successfully, but first step you have to add at least 1 user in 'users' table, then you can login in -> localhost:8000
7. If you access app as other department, you can access localhost:8000/helpdeskticket.

Feature (v1.1):
As admin you are able to:
1. View report of ticket (default by current month).
2. Filter report of ticket by month, department and status.
3. Print, Export to excel, pdf, or csv of the report.

Feature (v1.0):
As Admin you are able to:
1. Create master data Helpdesk.
2. Create master data Department.
3. Receive email ticket submitted.
4. View active ticket from other departments.
5. Accept it and submit problem solving detail.

As User (other departments) you are able to:
1. Create ticket.
2. Send email about the ticket to Admin / IT's email.
3. View detail of your ticket submitted.
4. Re-check your ticket's progress base on your ticket number.
