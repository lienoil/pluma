<?php

namespace Pluma\Tests;

class Quote
{
    public function hello($someone = "world")
    {
        return "Hello {$someone}!";
    }
}
