Test task for Developer
Objectives:
	Build a daily time record system that will use a QR Code for employees. The goal of this test is to check your skills and abilities on how you will create simple software using the MVC framework.

Scenario:
	Sample Company is currently using a manual system that will log the time of their employees. There are currently 5000 employees working in the company. Each employee will write down their time in and out on the logbook. Some of the employees lie about their time entries if they are late. So, the company decided to convert it into an automated system so incidents like this will be prevented and you are the one who will create this project.

Instructions:
	Create a daily time record system that will generate a qr code unique for each employee. This qr code will be used to log in and out using the company’s QR Code scanner machine. The following is the list of modules that are needed in the system:

	•	Employee Module 
		•	Fields needed:
			•	id – Primary key (Auto generated value)
			•	first_name
			•	last_name
			•	created_by (link to user id who created the employee)
			•	datetime_added
			•	datetime_updated
		
		•	Employee Module Features:
			•	Create new employee
			•	Update existing employee
			•	Delete employee
			•	User can delete single record or multiple records.
			•	List of employees

	•	Employee Time Record Module
		•	Fields needed:
			•	id – Primary key (Auto-generated value)
			•	employee_id
			•	user_id
			•	date_added
			•	time_in
			•	time_out
		
		•	Employee Time Record Module Features:
			•	Employee’s qrcode or id search module
			•	When scanning qr code or adding the employee id on this field, it will find a match in the current listing of employees from the DB.
			•	If qr code or id is matched, the employee id, current login user, date, and time in or out will be added to the time record table.
			•	Employees’ Time in and Time out listing module
			•	This will show the list of current dates and time in/out of employees based on the employee’s time record table.

	•	User Module
		•	Fields needed:
			•	Id – Primary key (Auto-generated value)
			•	user_name
			•	user_password
			•	user_type – (1 = super admin and 2 = admin)
			•	datetime_added
			•	datetime_modified
		•	User Type
			•	Super Admin – can access all modules.
			•	Admin – can access only the employee time record module.

	
	•	User Module Features
		•	Create a new user
		•	Edit user
		•	Password
		•	 When user input a value on this field, it should contain a lowercase, uppercase, number, and special character.
		•	Minimum of 10 characters.
		•	Create your own custom function to generate a password.
		•	Remove existing user
		•	User can remove single or multiple records but cannot remove his account.
		•	List of Users 
		•	Login verification
		•	User check session
		•	You must use hooks to be able to check if the current user’s session is expired or not. If it is expired, the user will be redirected to the login page. If the user’s session is still not expired and he tried to access the login page, he will be redirected to the employee’s time record page.

	Technologies used:
		•	Codeigniter 3.1.11 (PHP Framework)
		•	Bootstrap (CSS Framework)
		•	Jquery using ajax
		•	Jquery Datatables
		•	Mysql Database
		•	Any library for qr code generator

Note: Make sure to provide a github link for your assessment and can be executed inside docker container using docker-compose. The deadline to complete this task is on {Date including time zone}. Also make it so that the app will run using docker compose file.


Good luck and God Bless!!!

