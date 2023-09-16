<?php
$servername = "localhost"; //give your server name
$username = "root"; //give your server username
$password = ""; //give your server pass if available


// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database automatically
$sql = "CREATE DATABASE IF NOT EXISTS php_crud;";
if ($conn->query($sql) === TRUE) {
    // echo "Database created successfully";
    $conn->close();

    //create table automatically
    $sql = "CREATE TABLE IF NOT EXISTS `php_crud`.`crud` (`ID` INT NOT NULL AUTO_INCREMENT , `Name` VARCHAR(200) NOT NULL , `Email` VARCHAR(200) NOT NULL , `Age` INT(4) NOT NULL , `Gender` VARCHAR(8) NOT NULL , `DOB` DATE NOT NULL , `About` VARCHAR(255) NOT NULL , `Image` VARCHAR(255) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;";


    $dbname = "php_crud";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // mysqli_query($conn, $sql);
    $conn->query($sql);

    // if ($conn->query($sql) === TRUE) {
    //     // echo "Table Created Success";
    // }
} else {
    echo "Error creating database: " . $conn->error;
    $conn->close();
}
