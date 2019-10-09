<?php
    require_once ('Controller.php');

    if ($argc == 4) {
        $controller = new Controller($argc, $argv);
        $controller->start();
    } else {
        echo "error";
    }
