<?php
include 'config.php';


function getAllUsers()
{
    $sql = "SELECT * FROM users ORDER BY id DESC";
    $result = $GLOBALS['conn']->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return $data;
    } else {
        return null;
    }
}

function getUser($id)
{
    $sql = "SELECT * FROM users WHERE id='$id' ORDER BY id DESC";
    $result = $GLOBALS['conn']->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return $data;
    } else {
        return null;
    }
}
function createUser($full_names, $phone, $email, $password, $gender)
{
    $sql = "INSERT INTO `users`(`full_names`, `phone`, `email`, `password`, `gender`) VALUES ('$full_names','$phone','$email','$password','$gender')";
    $result = $GLOBALS['conn']->query($sql);
    if ($result == TRUE) {
        echo "New record created successfully.";
        return true;
    } else {
        echo "Error:" . $sql . "<br>" . $GLOBALS['conn']->error;
        return false;
    }
}
function updateUser($user_id, $full_names, $phone, $email, $password, $gender) {
    $sql = "UPDATE `users` SET `full_names`='$full_names',`phone`='$phone',`email`='$email',`password`='$password',`gender`='$gender' WHERE `id`='$user_id'";
    echo $sql;
    $result = $GLOBALS['conn']->query($sql);
    if ($result == TRUE) {
        echo "Record updated successfully.";
        return true;
    } else {
        echo "Error:" . $sql . "<br>" . $GLOBALS['conn']->error;
        return false;
    }
}
function deleteUser($id) {
    $sql = "DELETE FROM `users` WHERE `id`='$id'";
    $result = $GLOBALS['conn']->query($sql);
    if ($result == TRUE) {
       echo "Record deleted successfully.";
       return true;
    }else{
       echo "Error:" . $sql . "<br>" . $GLOBALS['conn']->error;
       return false;
    }
}
?>