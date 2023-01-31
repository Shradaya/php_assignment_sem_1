# Basic Php Webpage

This repo contains the code for a basic php page. It showcases the user registration, login, logout, comment and contact facilities.

## Repo Directory Structure
        |- classes
            |- *.php
        |- config
            |- *.php
        |- database_scripts
            |- *.sql
        |- image
            |- *.png
        |- libraries
            |- *.php
        |- views
            |- *.php
        |- *.php

### classes
Here, we define classes that are used to display informations dynamically in the page.

### config
The database config file is placed here. Rename the db_example.php file to db.php and place your credentials here.

### database_scripts
This directory contains the DDL, and DML statements for each table in use.

### image
This directory is used to store the image to be used in the page.

### libraries
A precreated password hashing mechanism has been used in the project. Here, that library is stored.

### views
The web pages are defined here.

## How to run the project?
* Start off with renaming the db_example.php to db.php and inserting the correct db informations in place of the astreiks.
* Visit the root folder from the command line
* Execute the command `php -S localhost:8000 -t .`