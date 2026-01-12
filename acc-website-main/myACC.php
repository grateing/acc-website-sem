<?php

session_start();

$errors = [
    'login' => $_SESSION['error'] ?? ''
];
$active_form = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($errors) {
    return !empty($errors) ? "<p class='error-message'>{$errors}</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container <?= isActiveForm('login', $active_form); ?>" id="loginForm">
        <div class="form-panel">
            <div class="logo">
                <a href="index.html">
                    <img src="myACC.png" alt="Login Logo">
                </a>
            </div>
            <form method="POST" action="login.php" class="inner-form-panel">
                <h5 class="user-login-title">User Login</h5>
                <?= showError($errors['login']); ?>
                <div class="form-group">
                    <input type="text" id="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group password-container">
                    <input type="password" id="password" name="password" placeholder="Your Password" required>
                    <button type="button" class="toggle-password">
                        <img src="eyecon.png" alt="Toggle Password">
                    </button>
                </div>
                <button type="submit" name="login" class="login-btn">Login</button>
                <div class="forgot-password">
                    <p><a href="#" onclick="showForm('loginForgot')">Forgot Password?</a></p>
                </div>
            </form>
        </div>
    </div>

    <div class="login-container" id="loginForgot">
        <div class="logo">
            <img src="myACC.png" alt="Login Logo">
        </div>
        <h3>Please contact your adviser to retrieve your password.</h3>
        <div class="forgot-password">
            <p><a href="#" onclick="showForm('loginForm')">< Back</a></p>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>

</html>