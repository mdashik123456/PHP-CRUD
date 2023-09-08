<?php
include "./connection.php";
$id = $_GET["id"];



if (isset($_POST["update_btn"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone_num = $_POST["phone_num"];
    $department = $_POST["department"];

    $sql = "UPDATE `crud` SET `name` = '$name', `email` = '$email', `phone_number` = '$phone_num', `department` = '$department' WHERE `id` = '$id';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=Record updated successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark justify-content-center">
        <h3 class="text-light my-3">CRUD (Create, Read, Update, Delete) using PHP</h3>
    </nav>


    <?php
    $sql = "SELECT * FROM `crud` WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container my-5">
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" placeholder="Enter Student ID" name="id" value="<?php echo $row['id'] ?>" disabled>
            </div>


            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Full Name" name="name" value="<?php echo $row['name'] ?>" required>
            </div>


            <div class="mb-3">
                <label for="name" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email" value="<?php echo $row['email'] ?>" required>
            </div>


            <div class="mb-3">
                <label for="name" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_num" placeholder="Enter Phone Number" name="phone_num" value="<?php echo $row['phone_number'] ?>" required>
            </div>


            <div class="col-md-3">
                <label for="validationCustom04" class="form-label">Department</label>
                <select class="form-select" id="validationCustom04" name="department">
                    <option <?php echo ($row["department"] == 'Software Engineering') ? "selected" : ""; ?>>Software Engineering</option>
                    <option <?php echo ($row["department"] == 'Computer Science & Engineering') ? "selected" : ""; ?>>Computer Science & Engineering</option>
                    <option <?php echo ($row["department"] == 'Electrical and Electronic Engineering') ? "selected" : ""; ?>>Electrical and Electronic Engineering</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid state.
                </div>
            </div>
            <br>

            <div class="modal-footer">
                <button type="submit" class="btn btn-dark" name="update_btn">Update</button>
            </div>
        </form>

    </div>













    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>