<?php

use Core\Authenticator;

(new Authenticator())->logout();

header("location: " . BASE_ROUTE . "/");
exit();