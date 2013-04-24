Online-Diary

This application can be run using any server (LAMP, WAMP, XAMPP) that supports PHP.

1.)Connecting to the database:
-Create a new database called "diary"
-Import tables* on the created database

Before we can access data in a database, we must open a connection to the MySQL server.
The file for connection is located inside the Online-Diary/back/connect.php.
mysql_connect(host,username,password,dbname);

Parameter	| Description
-------------------------------------------------------------------------------------
host		| Optional. Either a host name or an IP address
username	| Optional. The MySQL user name
password	| Optional. The password to log in with
dbname		| Optional. The default database to be used when performing queries

*SQL files for tables are located in Online-Diary/db/ directory
2.)Running the program to the browser: localhost/Online-Diary
