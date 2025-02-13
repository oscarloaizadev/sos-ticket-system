<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'username' => $_POST['username'],
    'password' => $_POST['password'],
]);

$signedIn = (new Authenticator())->attempt(
    $attributes['username'], $attributes['password'],
);

if (!$signedIn) {
    $form->error(
        'username', 'Usuario de red, email, o contraseña inválido.',
    )->throw();
}

redirect(BASE_ROUTE . '/');
