<?php
/* File   : dbconnect.php
   Subject: Data scraping Shodor
   Authors: Section 2 Group 2
   Version: 1.0
   Date   : April 10, 2015
   Description: create database connection to the selected database. Start by creating a database named education and then import guestbook.mysql into it.
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
