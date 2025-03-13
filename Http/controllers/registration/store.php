<?php

use Core\App;
use Http\Forms\RegisterForm;
use Core\Database;

$db = App::resolve(Database::class);

$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$passwordConfirmation = htmlspecialchars($_POST['confirmPassword']);

$hola = true;

$query = 'SELECT * FROM users WHERE email = :email OR username = :username';
$user = $db->query($query, [
    'email' => $email, 'username' => $username,
])->find();

$form = RegisterForm::validate($attributes = [
    'username'        => $username,
    'email'           => $email,
    'password'        => $password,
    'confirmPassword' => $passwordConfirmation,
    'userInDb'        => $user,
]);

$errors = [];

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors'  => $errors,
        'heading' => 'Registrate para tener una cuenta nueva',
    ]);
}

if ($user) {
    header('location:' . BASE_ROUTE . '/register');
    exit();
} else {
    $query = 'INSERT INTO users(email, username, password, role, company_id)
          VALUES(:email, :username, :password, :role, :company_id)';
    $user = $db->query($query, [
        'email'      => $email,
        'username'   => $username,
        'password'   => password_hash($password, PASSWORD_BCRYPT),
        'role'       => 'client',
        'company_id' => 2,
    ]);
    
    header('location:' . BASE_ROUTE . '/login');
    exit();
}

