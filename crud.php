<?php
include 'config.php';
require('fpdf.php');
session_start();
ob_start();
function getAllUsers()
{
    $sql = "SELECT `id`, `first_name`, `last_name`, `email`, `phone`, `gender` FROM users ORDER BY id DESC";
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

function getAdmin($email)
{
    $sql = "SELECT `id`, `password` FROM admins WHERE email='$email'";
    // echo "<script>alert('$sql')</script>";
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
    $sql = "SELECT `id`, `first_name`, `last_name`, `phone`, `gender`, `email`, `password` FROM users WHERE id='$id'";
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
function createUser($first_name, $last_name, $phone, $email, $password, $gender)
{
    $sql = "INSERT INTO `users`(`first_name`, `last_name`,`phone`, `email`, `password`, `gender`) VALUES ('$first_name', '$last_name','$phone','$email','$password','$gender')";
    $result = $GLOBALS['conn']->query($sql);
    if ($result == TRUE) {
        echo "New record created successfully.";
        return true;
    } else {
        echo "Error:" . $sql . "<br>" . $GLOBALS['conn']->error;
        return false;
    }
}
function createAdmin($first_name, $last_name, $email, $password)
{
    $sql = "INSERT INTO `admins`(`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name', '$last_name', '$email','$password')";
    $result = $GLOBALS['conn']->query($sql);
    if ($result == TRUE) {
        echo "New record created successfully.";
        return true;
    } else {
        echo "Error:" . $sql . "<br>" . $GLOBALS['conn']->error;
        return false;
    }
}
function updateUser($user_id, $first_name, $last_name, $phone, $email, $password, $gender)
{
    $sql = "UPDATE `users` SET `first_name`='$first_name', `last_name`='$last_name', `phone`='$phone',`email`='$email',`password`='$password',`gender`='$gender' WHERE `id`='$user_id'";
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
function deleteUser($id)
{
    $sql = "DELETE FROM `users` WHERE `id`='$id'";
    $result = $GLOBALS['conn']->query($sql);
    if ($result == TRUE) {
        return true;
    } else {
        return false;
    }
}



class PDF extends FPDF
{

    // Get data from the text file
    function getDataFrmFile()
    {
        $data = getAllUsers();
        return $data;
    }

    // Simple table
    function getSimpleTable($header, $data)
    {

        // Header
        foreach ($header as $column)
            $this->Cell(40, 7, $column, 1);
        $this->Ln(); // Set current position
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln(); // Set current position
        }
    }

    // Get styled table
    function getStyledTable($header, $data)
    {

        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        // Header
        $colWidth = array(40, 35, 40, 45);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell(
                $colWidth[$i],
                7,
                $header[$i],
                1,
                0,
                'C',
                1
            );
        $this->Ln();

        // Setting text color and color fill
        // for the background
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = 0;
        foreach ($data as $row) {

            // Prints a cell, first 2 columns are left aligned
            $this->Cell($colWidth[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($colWidth[1], 6, $row[1], 'LR', 0, 'L', $fill);

            // Prints a cell,last 2 columns are right aligned
            $this->Cell(
                $colWidth[2],
                6,
                number_format($row[2]),
                'LR',
                0,
                'R',
                $fill
            );
            $this->Cell(
                $colWidth[3],
                6,
                number_format($row[3]),
                'LR',
                0,
                'R',
                $fill
            );
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($colWidth), 0, '', 'T');
    }
}
// Instantiate a PDF object
function generatePDF()
{
    $pdf = new PDF();
    $header = array("id", "first name", "last name", 'email', 'phone', "gender");
    $data = $pdf->getDataFrmFile();
    if ($data) {
        $pdf->SetFont('Arial', '', 8);
        $pdf->AddPage();
        $pdf->getSimpleTable($header, $data);
        $pdf->Output("user.pdf", 'D');
    }
}

// Load the database configuration file 

function generateCSV()
{

    // Fetch records from database 

    $data = getAllUsers();
    if (count($data) > 0) {
        $delimiter = ",";
        $filename = "users-data_" . date('Y-m-d') . ".csv";

        // Create a file pointer 
        $f = fopen('php://memory', 'w');

        // Set column headers 
        $fields = array("id", "first name", "last name", 'email', 'phone', "gender");
        fputcsv($f, $fields, $delimiter);

        // Output each row of the data, format line as csv and write to file pointer 
        foreach ($data as $row) {
            // $status = ($row['status'] == 1) ? 'Active' : 'Inactive';
            $lineData = array($row['id'], $row['first_name'], $row['last_name'], $row['email'], $row['phone'], $row['gender']);
            fputcsv($f, $lineData, $delimiter);
        }

        // Move back to beginning of file 
        fseek($f, 0);
        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        //output all remaining data on a file pointer 
        fpassthru($f);
    }
    exit;
}
