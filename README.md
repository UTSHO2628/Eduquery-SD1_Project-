 " # Eduquery-SD1_Project " 
 ' Educational Query & Resource Management System '
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
