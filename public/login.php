<?php
require '../pdo.php';
require '../functions.php';

$title = 'ClotheLine';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $users = find($pdo, 'user', 'email', $email);

    foreach ($users as $user) {
        if ($user['password'] == $password) {
            session_start();
            $_SESSION['login'] = $user['userid'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        }
    }

    $message = "Invalid email or password. Please try again.";
}

$templateVars = [
    'title' => $title,
    'message' => isset($message) ? $message : '',
    'loggedIn' => isset($_SESSION['login']),
];

$output = loadTemplate('../templates/Login.html.php', $templateVars);
require '../templates/mainTemp.html.php';