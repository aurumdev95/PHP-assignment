<?php
include "crud.php";

try {
    $id = @$_GET['id'];
    $res = deleteUser($id);
} catch (Exception $e) {
    echo "<script>{$e->getMessage()}</script>";
}
try {
    $pdf = @$_GET['pdf'];
    if ($pdf) {
        generatePDF();
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
</head>

<body class="bg-dark">
    <header class="container-fluid d-flex justify-content-center text-primary bg-light">
        <h1>PHP CRUD</h1>
    </header>
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
                        <th scope="col"><a href="<?php echo $_SERVER['PHP_SELF']."?pdf=pdf"; ?>" class="btn btn-primary">export</a></th>
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
                            $url = $_SERVER['PHP_SELF']."?id=".$row['id'];
                            echo "<td><a href=$url class='btn btn-danger'>delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<h3 class='text-light'>no users found, click add new users insert new users.</h3>";
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