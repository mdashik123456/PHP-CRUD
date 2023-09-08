<?php
include "./connection.php";
$id = $_GET["id"];
// echo $id;
$sql = "DELETE FROM `crud` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
  // echo $result;
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
