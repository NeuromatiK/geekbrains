<?php

abstract class Figure
{
    abstract public function draw($x, $y);
}

class Cicrle extends Figure
{

    public function draw($x, $y)
    {
        // TODO: Implement draw() method.
    }
}

function draw(Figure $figure)
{

    $figure->draw(0, 0);
}