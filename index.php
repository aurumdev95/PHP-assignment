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
                        <th scope="col">full names</th>
                        <th scope="col">email</th>
                        <th scope="col">phone</th>
                        <th scope="col">password</th>
                        <th scope="col">gender</th>
                        <th scope="col"><a href="create.php" class="btn btn-primary">add user</a></th>
                        <th scope="col"><a href="#" class="btn btn-primary">export</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php        
                    include "crud.php";
                    $data = getAllUsers();
                    foreach ($data as $row) {
                        echo "<tr>";
                        // echo "<td scope='row'>hello</td>";
                        echo "<td scope='row'>".$row['id']."</td>";
                        echo "<td>".$row['full_names']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['phone']."</td>";
                        echo "<td>".$row['password']."</td>";
                        echo "<td>".$row['gender']."</td>";

                        echo "<td><button class='btn btn-primary'>update</button></td>";
                        echo "<td><button class='btn btn-danger'>delete</button></td>";
                        echo "</tr>";
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