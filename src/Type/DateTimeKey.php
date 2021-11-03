<?php

namespace App\Type;

class DateTimeKey extends \DateTime
{
    public function __toString()
    {
        return $this->format('c');
    }
}