# Login_1DV608
Interface repository for 1DV608 assignment 2 and 4

# State of the application
## Implementation
All of the functionalities of the original application are not implemented due to time constraints.
As such, this version of the application does not pass all of the test cases.
Below you will see a list of the test cases that are not implemented:
1. Test case 3.2 (Although it works for me when testing it manually.)
2. Test case 3.4
4. Test case 3.6
5. Test case 3.7
6. Test case 3.8

Total percentage on automated tests = 81%.

## How to install

To be able to test this application locally, you will need to create a database with the correct tables and also create a Config file for storing the credentials for accessing said database.

### Create Database
Create a database and add tables for user and posts.
Below is the code for creating the database as they appear in my project:

#### Users:

~~~~
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_bin NOT NULL,
  `password` varchar(100) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
  ~~~~ 


#### Posts
~~~~
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE latin1_bin NOT NULL,
  `body` text COLLATE latin1_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
~~~~

### Add a Config file
Below you will find the layout of the Config file I used. Replace the placeholder values with values that represent your database.
~~~~
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'chosenPassword');
define('DB_NAME', 'chosenName');
define('URLROOT', 'your root url for application');
~~~~

## New functionalities
I implemented a way for users to write their own posts and view them for later use, like a personal notebook. The time the posts were made is recorded so that some kind of time keeping can be maintained. The user can also remove posts that are no longer important. Only the users own posts are visible. I have also created new Use Cases and Test Cases for these functionalities to make sure that they work as intended.

## How to use the application!

Running version of the application can be found here: 

http://104.248.170.11/codingWithReq/

Username: Admin
Password: Password

## Test Cases and Use Cases
The new Test Cases and Use Cases covering the new functionalities can be found in separate files in this project root.<br/>
[Test Cases](https://github.com/simonnice/codingWithReq/blob/master/TestCases.md)<br/>
[Use Cases](https://github.com/simonnice/codingWithReq/blob/master/UseCases.md)








