<?php
class Triangle
{
    private $lengthSideA = 0;
    private $lengthSideB = 0;
    private $lengthSideC = 0;

    /**
     * Triangle constructor.
     * @param int $lengthSideA
     * @param int $lengthSideB
     * @param int $lengthSideC
     */
    public function __construct($lengthSideA, $lengthSideB, $lengthSideC)
    {
        $this->lengthSideA = $lengthSideA;
        $this->lengthSideB = $lengthSideB;
        $this->lengthSideC = $lengthSideC;
    }

    public function whatIsTriangle()
    {
        if ($this->lengthSideA > 0 && $this->lengthSideB > 0 && $this->lengthSideC >0 ) {
            if ($this->lengthSideA == $this->lengthSideB && $this->lengthSideB == $this->lengthSideC) {
                return "Equilateral";
            }
            if ($this->lengthSideA == $this->lengthSideB || $this->lengthSideB == $this->lengthSideC || $this->lengthSideC == $this->lengthSideA) {
                return "Isosceles";
            }
            return "Simple";
        }
        return "Not a triangle";
    }
}