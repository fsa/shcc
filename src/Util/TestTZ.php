<?php

namespace App\Util;

class TestTZ
{
    public function __construct(
        private string $timezone
    ) {
    }

    public function get()
    {
        return $this->timezone;
    }
}
