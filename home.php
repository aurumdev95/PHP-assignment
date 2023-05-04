<?php
include "crud.php";
if (@$_GET['logout']) {
    session_destroy();
    header('Location: http://localhost/phpLearn/assignment3/PHP-assignment/home.php');
}
if (!isset($_SESSION['loggedin'])) {
    header('Location: http://localhost/phpLearn/assignment3/PHP-assignment/login.php');
    exit;
}
try {
    $id = @$_GET['id'];
    $res = deleteUser($id);
} catch (Exception $e) {
    echo "<script>{$e->getMessage()}</script>";
}
try {
    $pdf = @$_GET['export'];
    if ($pdf == "pdf") {
        generatePDF();
    } else if ($pdf == "csv") {
        generateCSV();
    }
} catch (Exception $e) {
    echo "<script>{$e->getMessage()}</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .popover__title {
            font-size: 24px;
            line-height: 36px;
            text-decoration: none;
            color: rgb(228, 68, 68);
            text-align: center;
            padding: 15px 0;
        }

        .popover__wrapper {
            position: relative;
            margin-top: 1.5rem;
            display: inline-block;
        }

        .popover__content {
            opacity: 0;
            visibility: hidden;
            position: absolute;
            left: 0px;
            transform: translate(0, 10px);
            background-color: #bfbfbf;
            padding: .5rem;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
            width: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }

        .popover__content:before {
            position: absolute;
            z-index: -1;
            content: "";
            right: calc(50% - 10px);
            top: -8px;
            border-style: solid;
            border-width: 0 10px 10px 10px;
            border-color: transparent transparent #bfbfbf transparent;
            transition-duration: 0.3s;
            transition-property: transform;
        }

        .popover__wrapper:hover .popover__content {
            z-index: 10;
            opacity: 1;
            visibility: visible;
            transform: translate(0, -20px);
            transition: all 0.5s cubic-bezier(0.75, -0.02, 0.2, 0.97);
        }

        .popover__message {
            text-align: center;
        }
    </style>
</head>

<body class="bg-dark">
    <header class="container-fluid d-flex justify-content-center text-primary bg-light">
        <h1>PHP CRUD</h1>
    </header>
    <a href="<?php echo $_SERVER['PHP_SELF'] . "?logout=true"; ?>" style="position: absolute; top: 1rem; right: 6rem;" class="btn btn-primary">logout</a>
    <main class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="container overflow-auto mt-3" style="height: 30rem;">
            <table class="table bg-white table-hover table-md">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">first name</th>
                        <th scope="col">last name</th>
                        <th scope="col">email</th>
                        <th scope="col">phone</th>
                        <!-- <th scope="col">password</th> -->
                        <th scope="col">gender</th>
                        <th scope="col"><a href="create.php" class="btn btn-primary">add user</a></th>
                        <th scope="col">
                            <div class="popover__wrapper">
                                <a href="#" class="btn btn-primary">export</a>
                                <div class="popover__content">
                                    <a href="<?php echo $_SERVER['PHP_SELF'] . "?export=pdf"; ?>" class="btn btn-primary">PDF</a>
                                    <a href="<?php echo $_SERVER['PHP_SELF'] . "?export=csv"; ?>" class="btn btn-primary">CSV</a>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = getAllUsers();
                    if ($data) {
                        foreach ($data as $row) {
                            echo "<tr>";
                            // echo "<td scope='row'>hello</td>";
                            echo "<td scope='row'>" . $row['id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            // echo "<td>" . $row['password'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td><a href='update.php/?id=" . $row["id"] . "' class='btn btn-primary'>update</a></td>";
                            $url = $_SERVER['PHP_SELF'] . "?id=" . $row['id'];
                            echo "<td><a href=$url class='btn btn-danger'>delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<div class='alert alert-info' role='alert'>
                        No users found, click on add user to insert new user.
                      </div>";
                    }
                    $GLOBALS['conn']->close();
                    ?>
                </tbody>
            </table>
        </div>





    </main>
    <footer class=".container-fluid fixed-bottom d-flex justify-content-center align-items-center text-white">
        <p>2023 . made by Isimwe Mugisha Benjamin</p>
    </footer>
</body>

</html>