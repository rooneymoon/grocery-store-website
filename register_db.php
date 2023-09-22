<?php
session_start();
include('condb.php');

$errors = array();

if (isset($_POST['reg_user'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    $user_check_query = "SELECT * FROM member WHERE username = '$username' OR email = '$email' ";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        if ($result['username'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($result['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    if (count($errors) == 0) {

        $sql = "INSERT INTO member(username, email, password, gender, usertype)
        VALUES ('$username','$email','$password','$gender','$usertype')";
        mysqli_query($conn, $sql);

        if ($usertype == 'Admin') {
            $_SESSION['username'] = $username;
            header('location: admin.php');
        } else {
            $_SESSION['username'] = $username;
            header('location: index.php');
        }
    } else {
        array_push($errors, "Email or Username already exists");
        $_SESSION['error'] = "Email or Username already exists";
        header("location: register.php");
    }
}
