<?php

require_once ('Triangle.php');

class Controller
{
    private $argc;
    private $argv;

    public function __construct($argc, $argv)
    {
        $this->argc = $argc;
        $this->argv = $argv;
    }

    public function start()
    {
        $lengthSideA = $this->argv[1];
        $lengthSideB = $this->argv[2];
        $lengthSideC = $this->argv[3];

        if (!is_numeric($lengthSideA) || !is_numeric($lengthSideB) || !is_numeric($lengthSideC)) {
            echo "Triangle sides must be a number";
            return;
        }

        if ($lengthSideA < 0 || $lengthSideB < 0 || $lengthSideC  < 0) {
            echo "Side cannot be negative length";
            return;
        }

        $triangle = new Triangle($lengthSideA, $lengthSideB, $lengthSideC);
        $triangleType = $triangle->whatIsTriangle();
        echo "$triangleType";
    }
}