# SamosRentals
A university project about a website for auctioning and renting hotel rooms in samos.
made by Nikolaos Bousios (Rambou) and Kostas Chasiotis (Armageddonas) for the class of "Internet Programming"
with instructor Manolis Maragoudakis. Here is a link of a working live [website](r-samos.ml)

It's based on Material design using Materialize, Animate and bootstrap.

## Configuration
The configuration file is located at Admin/configuration.php .There you can edit the credentials for the mysql database connection.

## Install 
To install default values on your database simply run {YOUR_IP}/Admin/install.php
It creates a database etc.

### Ubuntu
Mysql tables in ubuntu are by default case sensitive. To change that in `sudo nano /etc/mysql/my.cnf` under `[mysqld]` add `lower_case_table_names = 1`