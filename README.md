" # Eduquery-SD1_Project " 
 ' Educational Query & Resource Management System '
EduQuery is a web-based Educational Query & Resource Management System designed to streamline communication and resource sharing between students, teachers, and administrators in academic institutions. The system enables role-based access, allowing students to view notices, submit assignments, and check results; teachers to post notices, upload results, and manage assignments; and administrators to oversee the entire system. Developed using PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap, EduQuery offers a responsive design, secure authentication, and a scalable architecture. The project enhances accessibility, reduces paperwork, and fosters an organized academic environment.

Objectives:

	Develop a user-friendly web-based academic management platform.

	Implement secure role-based authentication for Students, Teachers, and Admins.

	Enable students to view notices, submit assignments, and check results.

	Allow teachers to manage assignments, upload results, and post notices.

	Provide admins with full control over user management and monitoring.

	Store all academic data in a secure MySQL database.

Algorithms:
•	Role-Based Access Control (RBAC) for authentication.
•	CRUD Operations for managing assignments, notices, and results.
•	Password Hashing for secure user authentication.

Tools and Technologies:
•	Frontend: HTML5, CSS3, JavaScript, Bootstrap
•	Backend: PHP
•	Database: MySQL (via XAMPP


Here are the specific steps to get the project running on another computer:
  1. Install XAMPP

   * Download and install XAMPP from the official website (https://www.apachefriends.org/index.html). This will give you Apache, MariaDB, and PHP.

  2. Copy Project Files

   * Copy the entire eduquery folder to the htdocs directory inside your new XAMPP installation folder (usually C:\xampp\htdocs).

  3. Import the Database

   * Start the Apache and MySQL modules in the XAMPP Control Panel.
   * Open your web browser and go to http://localhost/phpmyadmin.
   * Click on the "Databases" tab.
   * In the "Create database" field, enter eduquery and click "Create".
   * Click on the eduquery database in the left-hand menu.
   * Click on the "Import" tab.
   * Click "Choose File" and select the database.sql file from your eduquery project folder.
   * Click "Go" at the bottom of the page to import the database.

  4. Configure Database Connection

  The includes/db.php file shows that the project connects to the database with these settings:

   * Host: localhost
   * Database Name: eduquery
   * Username: root
   * Password: (empty)

  These are the default settings for a new XAMPP installation, so you shouldn't need to change anything.

  5. Run the Project

   * Open your web browser and go to http://localhost/eduquery

  That's it! The project should now be running on the new computer. You can log in with the default admin user:

   * Email: admin@example.com
   * Password: your_secure_password

Challenges:
•	Initial database structuring took longer than expected.
•	Managing session states for multiple roles required careful handling.

Limitations:
•	Currently limited to local hosting; no cloud deployment in this version.

Future Work:
•	Add notification system.
•	Mobile app integration.
•	Cloud hosting for remote access.
