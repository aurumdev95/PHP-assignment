<?php
include "crud.php";


$id = $_GET['id'];


$data = getUser($id)[0];



// if (isset($_POST['submit'])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $id = $_GET['id'];
    $first_name = $_REQUEST['fname'];
    $last_name = $_REQUEST['lname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $gender = $_REQUEST['gender'];
    $phone = $_REQUEST['phone'];
    $res = updateUser($id, $first_name, $last_name, $phone, $email, $password, $gender);
    if ($res) {
        header("Location: http://localhost/phpLearn/assignment3/PHP-assignment/home.php", true, 302);
    } else {
        echo "<script>alert('error has occured');</script>";
    }
    $GLOBALS['conn']->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create user</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <header class="container-fluid d-flex justify-content-center text-primary bg-light">
        <h1>PHP CRUD</h1>
    </header>
    <main class="container-fluid d-flex flex-column justify-content-center">
        <form class="container bg-white p-3 mt-3" action="<?php echo $_SERVER['PHP_SELF']."?id=$id"; ?>" method="post">
            <div class="d-flex justify-content-between align-items-center">
                <h2>update User</h2><a href="http://localhost/phpLearn/assignment3/PHP-assignment/home.php" class="btn btn-primary">back Home</a>
            </div>
            <div class="form-group row">
                <label for="FirstName" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo $data['first_name'] ?>" id="FirstName" placeholder="First Name" name="fname" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="LastName" class="col-sm-2 col-form-label">Last name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="LastName" value="<?php echo $data['last_name'] ?>" placeholder="last name" name="lname" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" value="<?php echo $data["email"] ?>" id="inputEmail3" placeholder="Email" name="email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPhone3" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="inputPhone3" value="<?php echo $data["phone"] ?>" placeholder="Phone" name="phone" required minlength="10" maxlength="10">
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" <?php if ($data['gender'] == "male") {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                            <label class="form-check-label" for="gridRadios1">
                                male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female" <?php if ($data['gender'] == "female") {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                            <label class="form-check-label" for="gridRadios2">
                                female
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </main>
    <footer class=".container-fluid fixed-bottom d-flex justify-content-center align-items-center text-white">
        <p>2023 . made by Isimwe Mugisha Benjamin</p>
    </footer>
</body>

</html>