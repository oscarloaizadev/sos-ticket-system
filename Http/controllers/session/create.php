<?php

use Core\Session;

view('session/create.view.php', [
    'heading' => 'Bienvenid@ a nuestra mesa de ayuda',
    'errors'  => Session::get('errors'),
]);


