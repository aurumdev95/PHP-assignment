<?php
include 'crud.php';
// session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $first_name = $_REQUEST['fname'];
    $last_name = $_REQUEST['lname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $res = createAdmin($first_name, $last_name, $email, $password);
    if ($res) {
        // session_start();
        session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		// $_SESSION['name'] = $_POST['username'];
		// $_SESSION['id'] = $id;
        header("Location: http://localhost/phpLearn/assignment3/PHP-assignment/home.php");
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
    <title>sign up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <header class="container-fluid d-flex justify-content-center text-primary bg-light">
        <h1>PHP CRUD</h1>
    </header>
    <main class="container-fluid d-flex flex-column justify-content-center">
        <form class="container bg-white p-3 mt-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Sign up</h2><a href="home.php" class="btn btn-primary">back Home</a>
            </div>
            <div class="form-group row">
                <label for="FirstName" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="FirstName" placeholder="First Name" name="fname" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="LastName" class="col-sm-2 col-form-label">Last name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="LastName" placeholder="last name" name="lname" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Sign up</button>
                    <a href="login.php" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                        already have an account, login.
                    </a>
                </div>
            </div>
        </form>
    </main>
    <footer class=".container-fluid fixed-bottom d-flex justify-content-center align-items-center text-white">
        <p>2023 . made by Isimwe Mugisha Benjamin</p>
    </footer>
</body>

</html>