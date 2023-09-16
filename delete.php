<?php
session_start();
include "./connection.php";
$id = $_GET["id"];
$image = $_SESSION["img"];

unlink($image);
session_unset();
session_destroy();

$sql = "DELETE FROM `crud` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
  // echo $result;
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
