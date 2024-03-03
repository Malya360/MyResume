<?php

$firstname = $_POST['firstName'];
$middle = $_POST['middlename'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$phonenumbers = $_POST['phonenumbers'];
$emailaddress = $_POST['emailAddress'];

// File Upload Handling
$cv = $_FILES['cv'];
$cv_name = $cv['name'];
$cv_tmp_path = $cv['tmp_name'];


// Specify the destination directory to move the uploaded file
$cv_destination = 'desktop/website' . $cv_name;
move_uploaded_file($cv_tmp_path, $cv_destination);


// establishing a connection
$connect = new mysqli("localhost", "root", "", "test");
if ($connect->connect_error) {
    echo "$connect->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $stmt = $connect->prepare("insert into myportfolio(firstName,middlename,surname,username,password,cv,phonenumbers,emailAddress) VALUE(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $firstname, $middle, $surname, $username, $password, $cv_destination, $phonenumbers, $emailaddress);
    $stmt->execute();
    $stmt->close();
    $connect->close();
}

?>