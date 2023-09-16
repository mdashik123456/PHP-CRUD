<?php
session_start();
include "./connection.php";

if (isset($_POST["submit_btn"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $about_user = $_POST["about_user"];

    //Image processing
    $target_file = $_FILES["profile_pic"]["name"];
    $image_tmp_name = $_FILES["profile_pic"]["tmp_name"];
    $imageFileExt = pathinfo($target_file, PATHINFO_EXTENSION);
    $profile_pic = "images/" . $email . "." . $imageFileExt;

    move_uploaded_file($image_tmp_name, $profile_pic);

    $sql = "INSERT INTO `crud` (`ID`, `Name`, `Email`, `Age`, `Gender`, `DOB`, `About`, `Image`) VALUES (NULL, '$name', '$email', '$age', '$gender', '$dob', '$about_user', '$profile_pic')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=New record created successfully");
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
    <title>PHP CRUD Project</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <nav class="navbar navbar-dark bg-dark justify-content-center">
        <h3 class="text-light my-3">CRUD (Create, Read, Update, Delete) using PHP</h3>
    </nav>


    <!-- Create Modal -->
    <div class="modal fade" id="add_new_user_modal" tabindex="-1" aria-labelledby="add_new_user_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_new_user_modalLabel">Add New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Full Name" name="name"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email Address"
                                name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" placeholder="Enter Age" name="age"
                                required>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom04" class="form-label">Gender</label>
                            <select class="form-select" id="validationCustom04" name="gender" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                        <br>

                        <div class="mb-3">
                            <label class="form-label">DOB</label>
                            <input type="date" class="form-control" id="dob" placeholder="Date of Barth" name="dob"
                                required>
                        </div>

                        <div class="form-group">
                            <label>About User</label>
                            <textarea class="form-control" id="about_user" name="about_user" rows="3" placeholder="Write a short description"></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="form-label">Upload Image</label>
                            <input class="form-control" type="file" name="profile_pic" accept=".jpg, .png, .jpeg, .gif"
                                value=""></input>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark" name="submit_btn">Submit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    


    <div class="container">

        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<br><br><div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>

        <button type="button" class="btn btn-outline-dark mt-5 mb-2" data-bs-toggle="modal"
            data-bs-target="#add_new_user_modal">Add New User</button>
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">About Users</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM `crud`";
                $result = mysqli_query($conn, $sql);
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $i++;
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $i ?>
                        </th>
                        <td>
                            <?php echo $row["Name"] ?>
                        </td>
                        <td>
                            <?php echo $row["Email"] ?>
                        </td>
                        <td>
                            <?php echo $row["Age"] ?>
                        </td>
                        <td>
                            <?php echo $row["Gender"] ?>
                        </td>
                        <td>
                            <?php echo $row["DOB"] ?>
                        </td>
                        <td>
                            <?php echo $row["About"] ?>
                        </td>
                        <td>
                            <?php $image = $row["Image"];
                            echo "<img style='height: 100px; width: 100px;' src='$image'>" ?>

                        <td>
                            <a href="update.php?id=<?php echo $row["ID"] ?>" class="link-dark"><i
                                    class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete.php?id=<?php echo $row["ID"]?> <?php $_SESSION["img"] = $row["Image"]?>" class="link-dark"><i
                                    class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>