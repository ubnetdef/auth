Update Server
========

This is the Update Server used for setting up UBNETDEF's Cyber Security Competition.

## Requirements

* PHP 5.4
* MySQL
* Composer

## Installation

1. Rename the file "app/Config/database.php.default" to "app/Config/database.php"
2. Edit "app/Config/database.php" and enter the appropriate database credentials
3. Run ```composer install``` to install the project dependencies
4. Run ```./cake server install``` to install the Inject Engine
5. Point your webroot to the directory "webroot"
6. You're done! The username and password to login is __admin__
