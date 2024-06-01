<?php

class item
{
    private $name;
    private $price;
    private $rpSign;

    public function __construct($name = '', $price = '', $rpSign = false)
    {
        $this->name = $name;
        $this->price = $price;
        $this->rpSign = $rpSign;
    }

    public function getAsString($width = 48)
    {
        $rightCols = 10;
        $leftCols = $width - $rightCols;
        if ($this->rpSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols);

        $sign = ($this->rpSign ? 'Rp ' : '');
        $right = str_pad($sign . $this->price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }

    public function __toString()
    {
        return $this->getAsString();
    }
}

