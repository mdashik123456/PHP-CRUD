<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS php_crud;";
if ($conn->query($sql) === TRUE) {
    // echo "Database created successfully";
    $conn->close();

    $sql = "CREATE TABLE IF NOT EXISTS crud (
            id varchar(25) NOT NULL,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            phone_number varchar(13) NOT NULL,
            department varchar(255) NOT NULL
          );";


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
