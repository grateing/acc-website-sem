<?php

session_start();
require_once 'config.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Check if password is hashed (bcrypt starts with $2) or plain text
        $passwordMatch = (strpos($user['password'], '$2') === 0) 
            ? password_verify($password, $user['password']) 
            : ($password === $user['password']);
        
        if ($passwordMatch) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            header("Location: loading.html");
            exit();
        }
    }

    $_SESSION['error'] = "Invalid email or password";
    $_SESSION['active_form'] = 'login';
    header("Location: myACC.php");
    exit();
}

?>